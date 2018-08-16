<?php
namespace Admin\Controller;

/**
 * 景区分析
 */
class ScenicController extends AdminController{
	//本省id
    public static $province_id = 2898;
    public static $scenic_id = 1;
    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;

    /**
         * 景区车流
     */
    public function carFlow(){
    	$this->meta_title = "景区客流";
    	$model = M('scenic_car');
    	$real_model = M('scenic_car_real');
    	$flow_area = M('scenic_flow_area');

    	//车流量汇总
    	$where = array();
    	$where['s_date'] = date("Ymd",time());
    	$flow_info = $model->where($where)->find();
        if(9<date('H',time())+0 && date('H',time())+0<= 19){
            $flow_info['car_num'] = round($flow_info['car_num']*(date('H',time())+0)/19);
            $flow_info['year_total'] = round($flow_info['year_total']+$flow_info['car_num']);
            if(date('d',time())+0 == '1'){
                $flow_info['month_total'] = $flow_info['car_num'];
            }else{
                $flow_info['month_total'] = round($flow_info['month_total']+$flow_info['car_num']);
            }
        }elseif(date('H',time())+0<= 9){
            $flow_info['car_num'] = 0;
            if(date('d',time())+0 == '1'){
                $flow_info['month_total'] = 0;
            }
        }
        if(date('md',time())+0 == '0101'){
            $flow_info['year_total'] = $flow_info['month_total'];
        }
    	//近七日车流
    	$map = array();
    	$map['s_date'] = array('between',array(date('Ymd',strtotime('-7 days')),date('Ymd',strtotime('-1 day'))));
    	$flow_info['sevenday_total'] = $model->where($map)->field('SUM(car_num) as num')->getField('SUM(car_num)');
    	$this->assign('flow_info',$flow_info);

    	//车辆实时监控
        $s_time = date('H',time());
        $param['s_time'] = array('between',['09',$s_time]);
    	$real_info = $real_model->where($where)->where($param)->field('s_time,SUM(car_num) as num')->group('s_time')->select();
    	$real_data_hour = $real_data = '[';
    	foreach($real_info as $key=>$value){
//    		$real_data_hour .= '"'.date('H:i',$value['s_time']).'",';
            $real_data_hour .= '"'.$value['s_time'].':00'.'",';
    		$real_data .= $value['num'].",";
    	}
    	$real_data_hour .= ']';
    	$real_data .= ']';
    	$this->assign('real_data',$real_data);
    	$this->assign('real_data_hour',$real_data_hour);

    	//车辆类型实时
    	$type_info = $real_model->where($where)->where(['s_time' => date('H',time())])->order('id desc')->field('car_type,car_num')->select();
    	foreach($type_info as $val){
			$keys[]=$val['car_type'];
		}
		array_multisort($keys,SORT_ASC,SORT_NUMERIC,$type_info);
		if(empty($type_info)){
            $type_info[] = array('car_type'=>1,'car_num'=>0);
            $type_info[] = array('car_type'=>2,'car_num'=>0);
            $type_info[] = array('car_type'=>3,'car_num'=>0);
        }
//        var_dump($type_info);die;
        $type_data = '[{value:'.$type_info[0]['car_num'].',name:"5座小车"},'.'{value:'.$type_info[1]['car_num'].',name:"大巴车辆"},'.']';
        $this->assign('type_data',$type_data);
    	$this->assign('type_info',$type_info);

    	//车辆来源省份TOP10统计（外省）
    	$where['province_id'] = array('neq',self::$province_id);
    	$where['s_date'] = array('between',array(date('Ymd',strtotime('-7 days')),date('Ymd',strtotime('-1 day'))));
    	$provinces = $flow_area->where($where)->field('province_id,SUM(car_num) as num')->group('province_id')->order('num desc')->limit(6)->select();
        $sort = array(
                'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
                'field'     => 'num',       //排序字段
        );
        $arrSort = array();
        foreach($provinces AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $provinces);
        }
        $province_car_num = $province = $province_num = '[';
        $province_max = 0;
        foreach($provinces as $key=>$value){
            $province_max = $province_max<$value['num']?$value['num']:$province_max;
            //查询省份名称
            $province_name = M('area')->where(array('id'=>$value['province_id']))->getField('shortname name');
            if($key == 0){
                $province .= "'".$province_name."'";
                $province_num .= "{name:'".$province_name."',value:".$value['num']."}";
                $province_car_num .= $value['num'];
            }else{
                $province .= ",'".$province_name."'";
                $province_num .= ",{name:'".$province_name."',value:".$value['num']."}";
                $province_car_num .= ",".$value['num'];
            }
        }
        $province .= "]";
        $province_num .= "]";
        $province_car_num .= "]";
        $this->assign('province',$province);
        $this->assign('province_num',$province_num);
        $this->assign('province_car_num',$province_car_num);
        $this->assign('province_max',intval($province_max));
    	
    	//车辆来源地城市分布（本省）
    	$map['province_id'] = self::$province_id;
        $citys_old = $flow_area->where($map)->field('city_id,SUM(car_num) as num')->group('city_id')->select();
        $citys = array_slice($citys_old, 0, 9);
        $citys_other = array_slice($citys_old, 9);
        $num = 0;
        foreach($citys_other as $value){
            $num += $value['num'];
        }
//        if($num == 0){ //待定
//            //$num = mt_rand(100,2000);
//            $num = 1342;
//        }
//        if(!empty($citys)){
//        	$citys[9] = array('num'=>$num,'city_id'=>'其他');
//        }
        $city = $city_num = '[';
        foreach($citys as $key=>$value){
        	//查询城市名称
        	if($value['city_id'] == '其他'){
        		$city_name = '其他';
        	}else{
        		$city_name = M('area')->where(array('id'=>$value['city_id']))->getField('name');
        	}
            if($key == 0){
                $city .= "'".$city_name."'";
                $city_num .= "{value:".$value['num'].",name:'".$city_name."'}";
            }else{
                $city .= ",'".$city_name."'";
                $city_num .= ",{value:".$value['num'].",name:'".$city_name."'}";
            }
        }
        $city .= "]";
        $city_num .= "]";
        $this->assign('city',$city);
        $this->assign('city_num',$city_num);

        //外省与本省车流统计分析
        $in_province = $flow_area->where($map)->field('SUM(car_num) as num')->find();
        if(empty($in_province['num'])){
            $in_province['num'] = 0;
        }
        $map['province_id'] = array('neq',self::$province_id); //本省省份名称待定
        $out_province = $flow_area->where($map)->field('SUM(car_num) as num')->find();
        if(empty($out_province['num'])){
            $out_province['num'] = 0;
        }
        $in_out_province_num = "[{value:".$out_province['num'].", name:'外省'},{value:".$in_province['num'].", name:'本省'}]";
        $this->assign('in_out_province_num',$in_out_province_num);

        //车辆停留时长统计
        $map = array();
    	$map['s_date'] = array('between',array(date('Ymd',strtotime('-7 days')),date('Ymd',strtotime('-1 day'))));
        $remain = array(0,0,0,0,0);
        $remain_num = M('scenic_car_stay')->where($map)->field('phase_type,SUM(vehicle_num) as num')->group('phase_type')->select();
        foreach($remain_num as $key=>$value){
            $remain[$value['phase_type']-1] = $value['num'];
        }
        $remain_num = "[{value:".$remain[0].", name:'<1H'},{value:".$remain[1].", name:'1-2H'},{value:".$remain[2].", name:'2-3H'},{value:".$remain[3].", name:'>3H'}]";
        $this->assign('remain_num',$remain_num);
        //平均停留时长
        $average_reamin_hour = $flow_area->where($map)->field('AVG(car_stay)')->where(['car_stay'=>['neq',0]])->getField('AVG(car_stay)');
        $total = $flow_area->where($map)->count();
//        $average_reamin_hour = $average_reamin_hour?sprintf("%.1f",$average_reamin_hour/$total):0;
        $this->assign('average_reamin_hour',round($average_reamin_hour,1));

        //车流量TOP10景区
    	$scenics = M('scenic_flow_day')->where($map)->field('scenic_id,SUM(car_num) as num')->group('scenic_id')->order('num desc')->limit(10)->select();
    	$scenic_car_num = $scenic = $percent = '[';
    	$scenic_total = 0;
    	foreach($scenics as $key=>$value){
    		$scenic_total += $value['num'];
    	}
        foreach($scenics as $key=>$value){
            //查询景区名称
            $scenic_name = M('scenic')->where(array('id'=>$value['scenic_id']))->getField('name');
            if($key == 0){
                $scenic .= "'".$scenic_name."'";
                $scenic_car_num .= $value['num'];
                $percent .= "'".sprintf("%.2f",($value['num']/$scenic_total)*100)."'";
            }else{
                $scenic .= ",'".$scenic_name."'";
                $scenic_car_num .= ",".$value['num'];
                $percent .= ",'".sprintf("%.2f",($value['num']/$scenic_total)*100)."'";
            }
        }
        $scenic .= "]";
        $percent .= "]";
        $scenic_car_num .= "]";
        $this->assign('scenic',$scenic);
        $this->assign('percent',$percent);
        $this->assign('scenic_car_num',$scenic_car_num);

    	$this->display('Scenic/carFlow');
    }

    /**
     * 获取查询时间条件
     */
    public function getDate($s_day){
    	$where = array();
    	switch ($s_day) {
    		case '1':
    			$where['s_date'] = array('between',array(date('Ymd',strtotime('-7 days')),date('Ymd',strtotime('-1 day'))));
    			break;
    		case '2':
    			$where['s_date'] = array('between',array(date('Ymd',strtotime('-30 days')),date('Ymd',strtotime('-1 day'))));
    			break;
    		case '3':
    			$where['s_date'] = array('between',array(date('Ymd',strtotime('-90 days')),date('Ymd',strtotime('-1 day'))));
    			break;
			case '4':
    			$where['s_date'] = array('between',array(date('Ymd',strtotime('-180 days')),date('Ymd',strtotime('-1 day'))));
    			break;
    		default:
    			$where['s_date'] = array('between',array(date('Ymd',strtotime('-365 days')),date('Ymd',strtotime('-1 day'))));
    			break;
    	}
    	return $where;
    }

    /**
     * 动态获取车辆省份TOP10（外省）
     */
    public function getProvince(){
    	$s_day = I('param.s_day');
    	$where = $this->getDate($s_day);
    	$where['province_id'] = array('neq',self::$province_id);

    	$provinces = M('scenic_flow_area')->where($where)->field('province_id,SUM(car_num) as num')->group('province_id')->order('num desc')->limit(6)->select();
        $sort = array(
            'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'num',       //排序字段
        );
        $arrSort = array();
        foreach($provinces AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $provinces);
        }
        $province_max = 0;
        $data = array();
        foreach($provinces as $key=>$value){
            $province_max = $province_max<$value['num']?$value['num']:$province_max;
            //查询省份名称
            $province_name = M('area')->where(array('id'=>$value['province_id']))->getField('shortname name');
            $data['province'][$key] = $province_name;
            $data['province_num'][$key]['value'] = $value['num'];
            $data['province_num'][$key]['name'] = $province_name;
            $data['province_car_num'][$key] = $value['num'];
        }
        $data['province_max'] = $province_max;
        $this->ajaxReturn($data);
    }

    /**
     * 动态获取车辆来源地城市分布（本省）
     */
    public function getCity(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $where['province_id'] = array('eq',self::$province_id);
        $citys_old = M('scenic_flow_area')->where($where)->field('city_id,SUM(car_num) as num')->group('city_id')->select();
        $citys = array_slice($citys_old, 0, 9);
        $citys_other = array_slice($citys_old, 9);
        $num = 0;
        foreach($citys_other as $value){
            $num += $value['num'];
        }
//        if($num == 0){ //待定
//            //$num = mt_rand(100,2000);
//            $num = 1342;
//        }
//        if(!empty($citys)){
//            $citys[9] = array('num'=>$num,'city_id'=>'其他');
//        }
        $data = array();
        $i = 0;
        foreach($citys as $key=>$value){
            //查询城市名称
            if($value['city_id'] == '其他'){
                $city_name = '其他';
            }else{
                $city_name = M('area')->where(array('id'=>$value['city_id']))->getField('name');
            }
            $data['city'][] = $city_name;
            $data['city_num'][$i]['value'] = $value['num'];
            $data['city_num'][$i]['name'] = $city_name;
            $i++;
        }
        $this->ajaxReturn($data);
    }

    /**
     * 动态获取车辆外省与本省车流统计分析
     */
    public function getProvinceIO(){
        $flow_area = M('scenic_flow_area');
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $where['province_id'] = array('neq',self::$province_id);
        $out_province = $flow_area->where($where)->field('SUM(car_num) as num')->find();
        if(empty($out_province['num'])){
            $out_province['num'] = 0;
        }
        $where['province_id'] = self::$province_id; //本省省份名称待定
        $in_province = $flow_area->where($where)->field('SUM(car_num) as num')->find();
        if(empty($in_province['num'])){
            $in_province['num'] = 0;
        }
        $data = array();
        $data['in_out_province_num'][0]['value'] = $out_province['num'];
        $data['in_out_province_num'][0]['name'] = '外省';
        $data['in_out_province_num'][1]['value'] = $in_province['num'];
        $data['in_out_province_num'][1]['name'] = '本省';
        $this->ajaxReturn($data);
    }

    /**
    * 动态获取车辆停留时长
    */
    public function getRemain(){
        $flow_area = M('scenic_flow_area');
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $remain = array(0,0,0,0,0);
        $remain_num = M('scenic_car_stay')->where($where)->field('phase_type,SUM(vehicle_num) as num')->group('phase_type')->select();
//        echo M('scenic_car_stay')->_sql();die;
//        var_dump($remain_num);die;
        foreach($remain_num as $key=>$value){
            $remain[$value['phase_type']-1] = $value['num'];
        }
        $data['remain_num'][0]['value'] = $remain[0];
        $data['remain_num'][0]['name'] = '<1H';
        $data['remain_num'][1]['value'] = $remain[1];
        $data['remain_num'][1]['name'] = '1-2H';
        $data['remain_num'][2]['value'] = $remain[2];
        $data['remain_num'][2]['name'] = '2-3H';
        $data['remain_num'][3]['value'] = $remain[3];
        $data['remain_num'][3]['name'] = '>3H';
//        $data['remain_num'][4]['value'] = $remain[4];
//        $data['remain_num'][4]['name'] = '>3H';
        //平均停留时长
        $average_reamin_hour = $flow_area->where($where)->where(['car_stay'=>['neq',0]])->field('AVG(car_stay)')->getField('AVG(car_stay)');
        $total = $flow_area->where($where)->count();
//        $average_reamin_hour = $average_reamin_hour?sprintf("%.1f",$average_reamin_hour/$total):0;
        $data['average_reamin_hour'] = round($average_reamin_hour,1);
        $this->ajaxReturn($data);
    }

    /**
     * 动态获取景区车流量TOP10
     */
    public function getScenic(){
        $flow_area = M('scenic_flow_area');
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $scenics = M('scenic_flow_day')->where($where)->field('scenic_id,SUM(car_num) as num')->group('scenic_id')->order('num desc')->limit(10)->select();
        $scenic_total = 0;
        foreach($scenics as $key=>$value){
            $scenic_total += $value['num'];
        }
        $data = array();
        foreach($scenics as $key=>$value){
            //查询景区名称
            $scenic_name = M('scenic')->where(array('id'=>$value['scenic_id']))->getField('name');
            $data['scenic'][$key] = $scenic_name;
            $data['scenic_car_num'][$key] = $value['num'];
            $data['percent'][$key] = sprintf("%.2f",($value['num']/$scenic_total)*100);
        }
        $this->ajaxReturn($data);
    }

    /**
     * 票务分析
     */
    public function ticketAnalysis(){
        $this->meta_title = "票务分析";
        $model = M('ticket_total');
        //查询售票汇总
        $where = array();
        $where['s_date'] = date("Ymd",time());
        $ticket_info = $model->where($where)->find();
        //近七日售票
        $map = array();
        $map['s_date'] = array('between',array(date('Ymd',strtotime('-7 days')),date('Ymd',strtotime('-1 day'))));
        $ticket_info['sevenday_total'] = $model->where($map)->field('SUM(amount) as amount,SUM(total) as total')->find();
        $this->assign('ticket_info',$ticket_info);

        //售票量统计
        $result = M('ticket_day')->where($map)->select();
        $ticket_num_date = $ticket_num ="[";
        foreach($result as $value){
            $ticket_num_date .= "'".date('n.j',strtotime($value['s_date']))."',";
            $ticket_num .= $value['num'].",";
        }
        $ticket_num_date .= "]";
        $ticket_num .= "]";
        $this->assign('ticket_num',$ticket_num);
        $this->assign('ticket_num_date',$ticket_num_date);

        //提前购票天数
        $result = M('ticket_reservations')->where($map)->field('day_phase,SUM(user_num) as num')->group('day_phase')->select();
        $ticket_reservations = array();
        $ticket_reservations[0] = array("name"=>"0天","value"=>0);
        $ticket_reservations[1] = array("name"=>"1天","value"=>0);
        $ticket_reservations[2] = array("name"=>"2天","value"=>0);
        $ticket_reservations[3] = array("name"=>"3天","value"=>0);
        $ticket_reservations[4] = array("name"=>">3天","value"=>0);
        foreach($result as $key=>$value){
            $k = $value['day_phase'];
            $ticket_reservations[$k]['value'] = $value['num'];
        }
        $this->assign('ticket_reservations',json_encode($ticket_reservations));

        //票务预订来源统计
        $result = M('ticket_channel')->where($map)->field('channel_id,SUM(user_num) as num')->group('channel_id')->select();
        $ticket_source = array();
        $ticket_source[0] = array("name"=>"窗口或自助机","value"=>0);
        $ticket_source[1] = array("name"=>"携程","value"=>0);
        $ticket_source[2] = array("name"=>"美团","value"=>0);
        $ticket_source[3] = array("name"=>"驴妈妈","value"=>0);
        $ticket_source[4] = array("name"=>"其他","value"=>0);
        foreach($result as $key=>$value){
            $k = $value['channel_id'];
            if($k == 0){
                $ticket_source[$k]['value'] = $value['num'];
            }elseif($k == 1){
                $ticket_source[0]['value'] += $value['num'];
            }else{
                $ticket_source[$k-1]['value'] = $value['num'];
            }
        }
        $this->assign('ticket_source',json_encode($ticket_source));

        //售票渠道线上线下占比
//        $ticket_channel = array();
//        $ticket_channel[0] = array("name"=>"窗口","value"=>0);
//        $ticket_channel[1] = array("name"=>"自助机","value"=>0);
//        $ticket_channel[2] = array("name"=>"OTA","value"=>0);
//        foreach($result as $key=>$value){
//            $k = $value['channel_id'];
//            if($k == 0){
//                $ticket_channel[$k]['value'] = $value['num'];
//            }elseif($k == 1){
//                $ticket_channel[$k]['value'] = $value['num'];
//            }else{
//                $ticket_channel[2]['value'] += $value['num'];
//            }
//        }
        $result = M('ticket_total')->where($where)->field('SUM(total) total,SUM(network_total) network_total')->find();
        $ticket_channel = array();
        $ticket_channel[0] = array("name"=>"线上","value"=>$result['network_total']);
        $num = round($result['total']-$result['network_total']);//线下
        $ticket_channel[1] = array("name"=>"线下","value"=>$num);
        $this->assign('ticket_channel',json_encode($ticket_channel));

        //售票类型统计占比
        $result = M('ticket_type_day')->where($map)->field('SUM(individual_num) as individual_num,SUM(group_num) as group_num,SUM(activity_num) as activity_num')->find();
        $ticket_type = array();
        $ticket_type[0] = array("name"=>"散客票","value"=>0);
        $ticket_type[1] = array("name"=>"团队票","value"=>0);
//        $ticket_type[2] = array("name"=>"活动票","value"=>0);
        $i = 0;
        foreach($result as $key=>$value){
            if(!empty($value)){
                $ticket_type[$i]['value'] = $value;
            }
            $i++;
        }
        $this->assign('ticket_type',json_encode($ticket_type));

        //支付方式统计
        $result = M('ticket_pay')->where($map)->field('SUM(alipay) as alipay,SUM(weichat) as weichat,SUM(cash) as cash,SUM(other) as other')->find();
        $ticket_pay = array();
        $ticket_pay[0] = array("name"=>"支付宝","value"=>0);
        $ticket_pay[1] = array("name"=>"微信","value"=>0);
        $ticket_pay[2] = array("name"=>"现金","value"=>0);
        $ticket_pay[3] = array("name"=>"其他","value"=>0);
        $i = 0;
        foreach($result as $key=>$value){
            if(!empty($value)){
                $ticket_pay[$i]['value'] = $value;
            }
            $i++;
        }
        $this->assign('ticket_pay',json_encode($ticket_pay));

        $this->display('Scenic/ticketAnalysis');
    }

    /**
     * 动态获取售票量
     */
    public function getTicket(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $result = M('ticket_day')->where($where)->select();
        $data = array();
        foreach($result as $key=>$value){
            $data['ticket_num_date'][$key] = date('n.j',strtotime($value['s_date']));
            $data['ticket_num'][$key] = $value['num'];
        }
        $this->ajaxReturn($data);
    }

    /**
     * 动态获取提前购票天数
     */
    public function getReservations(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $result = M('ticket_reservations')->where($where)->field('day_phase,SUM(user_num) as num')->group('day_phase')->select();
        $ticket_reservations = array();
        $ticket_reservations[0] = array("name"=>"0天","value"=>0);
        $ticket_reservations[1] = array("name"=>"1天","value"=>0);
        $ticket_reservations[2] = array("name"=>"2天","value"=>0);
        $ticket_reservations[3] = array("name"=>"3天","value"=>0);
        $ticket_reservations[4] = array("name"=>">3天","value"=>0);
        foreach($result as $key=>$value){
            $k = $value['day_phase'];
            $ticket_reservations[$k]['value'] = $value['num'];
        }
        $this->ajaxReturn($ticket_reservations);
    }

    /**
     * 动态获取票务预订来源统计
     */
    public function getSource(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $result = M('ticket_channel')->where($where)->field('channel_id,SUM(user_num) as num')->group('channel_id')->select();
        $ticket_source = array();
        $ticket_source[0] = array("name"=>"窗口或自助机","value"=>0);
        $ticket_source[1] = array("name"=>"携程","value"=>0);
        $ticket_source[2] = array("name"=>"美团","value"=>0);
        $ticket_source[3] = array("name"=>"驴妈妈","value"=>0);
        $ticket_source[4] = array("name"=>"其他","value"=>0);
        foreach($result as $key=>$value){
            $k = $value['channel_id'];
            if($k == 0){
                $ticket_source[$k]['value'] = $value['num'];
            }elseif($k == 1){
                $ticket_source[0]['value'] += $value['num'];
            }else{
                $ticket_source[$k-1]['value'] = $value['num'];
            }
        }
        $this->ajaxReturn($ticket_source);
    }

    /**
     * 动态获取售票类型
     */
    public function getType(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $result = M('ticket_type_day')->where($where)->field('SUM(individual_num) as individual_num,SUM(group_num) as group_num,SUM(activity_num) as activity_num')->find();
        $ticket_type = array();
        $ticket_type[0] = array("name"=>"散客票","value"=>0);
        $ticket_type[1] = array("name"=>"团队票","value"=>0);
//        $ticket_type[2] = array("name"=>"活动票","value"=>0);
        $i = 0;
        foreach($result as $key=>$value){
            if(!empty($value)){
                $ticket_type[$i]['value'] = $value;
            }
            $i++;
        }
        $this->ajaxReturn($ticket_type);
    }

    /**
     * 动态获取售票渠道线上线下占比
     */
    public function getChannel(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

//        $result = M('ticket_channel')->where($where)->field('channel_id,SUM(user_num) as num')->group('channel_id')->select();
//        $result = M('ticket_total')->where($where)->field('total,network_total')->group('channel_id')->find();
        $result = M('ticket_total')->where($where)->field('SUM(total) total,SUM(network_total) network_total')->find();
//        $ticket_channel = array();
//        $ticket_channel[0] = array("name"=>"窗口","value"=>0);
//        $ticket_channel[1] = array("name"=>"自助机","value"=>0);
//        $ticket_channel[2] = array("name"=>"OTA","value"=>0);
        $ticket_channel = array();
        $ticket_channel[0] = array("name"=>"线上","value"=>$result['network_total']);
        $num = round($result['total']-$result['network_total']);//线下
        $ticket_channel[1] = array("name"=>"线下","value"=>$num);
//        foreach($result as $key=>$value){
//            $k = $value['channel_id'];
//            if($k == 0){
//                $ticket_channel[$k]['value'] = intval($value['num']);
//            }elseif($k == 1){
//                $ticket_channel[$k]['value'] = intval($value['num']);
//            }else{
//                $ticket_channel[2]['value'] += $value['num'];
//            }
//        }
        $this->ajaxReturn($ticket_channel);
    }

    /**
     * 动态获取支付方式
     */
    public function getPay(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $result = M('ticket_pay')->where($where)->field('SUM(alipay) as alipay,SUM(weichat) as weichat,SUM(cash) as cash,SUM(other) as other')->find();
        $ticket_pay = array();
        $ticket_pay[0] = array("name"=>"支付宝","value"=>0);
        $ticket_pay[1] = array("name"=>"微信","value"=>0);
        $ticket_pay[2] = array("name"=>"现金","value"=>0);
        $ticket_pay[3] = array("name"=>"其他","value"=>0);
        $i = 0;
        foreach($result as $key=>$value){
            if(!empty($value)){
                $ticket_pay[$i]['value'] = $value;
            }
            $i++;
        }
        $this->ajaxReturn($ticket_pay);
    }
}