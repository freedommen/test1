<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/2/26
 * Time: 上午11:10
 */

namespace Admin\Controller;
\define('DAYDATE',date('Y-m-d',NOW_TIME));

class DataController extends AdminController
{

    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;


    /**
     * 分析
     */
    public function index(){
        //游客综合信息
        $info = S('visitor_info');
        if(empty($info)){
//            $info = M('visitor')->field('*')
//                ->order('s_date asc,s_time asc')->order('s_date desc,id desc')->find();
//            $info['average_remain_day'] = \round($info['average_remain_day'],1);

            //年度游客累积数
            //从元月1号到昨日 时间段
            $w['s_date'] = array('between',[\date('Y0101'),\date('Ymd',strtotime("-1 day"))]);
            $info['total_user_num'] =  M('visitorDay')->where($w)->SUM('user_num');
            //年度游客峰值
            $visitor_info = M('visitorDay')->field(' SUM(user_num) user_num_max ,s_date')->group('s_date')->order('user_num_max desc')->select();
            $info['pcu'] = $visitor_info[0]['user_num_max'];
            //年度游客平均逗留天数  //转换为天
            $avg_day =sprintf("%.2f", M('visitorStay')->where($w)->AVG('avg_day')/24);
            $info['average_remain_day'] = $avg_day;
            //上月游客累积人数
            $map['s_date'] = array('between',[date('Ym01', strtotime('-1 month')),date('Ymt', strtotime('-1 month'))]);
            $info['lastmonth_num'] = M('visitorDay')->where($map)->SUM('user_num');
            //昨日游客人数
            $map['s_date'] = date('Ymd', strtotime('-1 day'));
            $info['yesterday_num'] =  M('visitorDay')->where($map)->SUM('user_num');
            //本月
            $map['s_date'] = array('between',[date('Ym01',\time()),date('Ymd', \time())]);
            $info['month_num'] = M('visitorDay')->where($map)->SUM('user_num');
            S('visitor_info',$info,3600);
        }

        $this->assign('_info',$info);

        //出行方式
        $trip = M('VisitorTrip')->field('*')->order('id desc')->limit(1)->find();
        $total = $trip['aircraft']+$trip['train']+$trip['bus']+$trip['car'];
        $trip['aircraft'] =  sprintf("%01.2f", ($trip['aircraft']/$total)*100).'%';
        $trip['train'] =  sprintf("%01.2f", ($trip['train']/$total)*100).'%';
        $trip['bus'] =  sprintf("%01.2f", ($trip['bus']/$total)*100).'%';
        $trip['car'] = sprintf("%01.2f", ($trip['car']/$total)*100).'%';
        $this->assign('trip',$trip);

        //重点区域客流排行
        $db = M('visitorRealSpot');
        $where =array();
        $where['s_date'] = \date('Ymd');
        $where['b.status'] = 1;
        //查询景区id
        $key_list = $db->alias('a')->field('s_date,s_time,SUM(user_num) user_num,scenic_id,AVG(saturation) saturation,b.name')->where($where)
            ->join('left join ff_scenic b on a.scenic_id = b.id')
            ->order('user_num desc')->group('scenic_id')->limit(1)->select();

        $where['a.scenic_id'] = $key_list{0}['scenic_id'];
        //获取该景区客流
        $spot_list = $db->alias('a')->field('a.*,a.scenic_id,spot_id,b.name')
            ->join('left join ff_scenic b on a.scenic_id = b.id')
//            ->join('left join ff_scenic_spot b on a.spot_id = b.id')
            ->group('spot_id')->where($where)->select();
        $spot_list{0}['name'] = $key_list{0}['name'];
        $this->assign('scenic_name',$key_list{0}['name']);
        $this->assign('spot_list',$spot_list);
        $this->display();
    }


    /**
     * 每天实时客流
     */
    public function getDataReal(){
        $where['s_date'] = date('Ymd',NOW_TIME);
        $where['s_time'] = array('elt', \date('H:i',NOW_TIME));
       // array('between',[$start_time,$end_time]);
        $db = M('visitorReal');
        // FROM_UNIXTIME(s_time,'%H:%i')
        $list = $db->field("s_date,s_time,total_user_num,user_num,lng,lat")
            ->where($where)->order('s_date asc,s_time desc')->group('s_time')->limit(200)->select();
        array_multisort($list,'s_time','SORT_ASC','SORT_NUMERIC');
        $list = arraySort($list,'s_time','SORT_ASC');
        //自造假数据开始------上线移除----------------
//        $map['s_date'] = date('Ymd',NOW_TIME);
        $count =  $db->where($where)->count();

        //当前小时  如 生成一条数据(1小时/1条数据)
        $day_h = \date('H',NOW_TIME);
        $day_s = \mktime(7,'0','0',date('m'),date('d'),date('Y'));
        //每天7点到17点以后之间生成
        if( ($day_h >= 7) && ($day_h < 18) ){
            //当前生成条数
            $limit_num = 1000-$count;
//            $limit_num = (($day_h-7) * 12) - $count;
            //获取上一时间节点
            $lastone_time = ($list{$count-1}['s_time']);
            if($lastone_time < $day_s){
                $lastone_time = $day_s;
            }
            $k =1;
            for ($i=0;$i<$limit_num;$i++){
                if($i > 0){
                    $s_time = $lastone_time+300*$k;
                }else{
                    $s_time = $lastone_time *$k;
                }
                $rand =  \rand(20000,35000);
                $hour =  \date('H',$s_time);
                if($hour < 8 || $hour > 16){
                    $rand =  \rand(18000,20000);
                }
                $add_data[$i] = array(
                    's_date'    => \date('Ymd',NOW_TIME),
                    's_time'    =>  \date('H:i',$s_time),
                    'scenic_id' => \rand(1,11),
                    'total_user_num' => $list{$count-1}['total_user_num'],
                    'user_num' => $rand,
                    'lng'   =>  (float)getPosition(\rand(1,6))['lng'],
                    'lat'   => (float)getPosition(\rand(1,6))['lat'],
                    'created' => NOW_TIME,
                );
                $k++;
            }
            $db->addAll($add_data);
        }
        \array_merge($list,$add_data);
        //=============假数据自造完毕===
        $data =array();
        foreach ($list as $k=>$v){
//            if($v['s_time'] < \date('H',NOW_TIME)){
                $data['s_time'][$k] = $v['s_time'];
                $data['user_num'][$k] = $v['user_num'];
                $data['total_user_num'] = $v['user_num'];
                if($v['user_num'] > 20000){
                    $rand = \rand(150,300);
                }else{
                    $rand = \rand(20,150);
                }
                $data['position'][$k]  = array( 'lng'=>$v['lng'],'lat'=>$v['lat'],'count'=>$rand);
//            }

        }
        if($day_h >18 || $day_h < 7){
//            $data['total_user_num'] = 0;
        }

        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     *  游客年度统计
     *  no
     */
    public function getDataTotal(){
        $info = M('visitor')->field('s_date,s_time,total_user_num,user_num')
            ->order('s_date asc,s_time asc')->order('s_date desc,id desc')->find();
        if($info){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$info);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 重点区域客流排行（实时）
     */
    public function getRealScenicTop(){
        $where['s_date'] = \date('Ymd');
        $db = M('visitorRealSpot');
        $where['s_time'] =  array('eq',date('H'));
        $where['b.status'] = 1;
        $list = $db->alias('a')->field('s_date,s_time, user_num,scenic_id,AVG(saturation) saturation,b.name')
            ->where($where)
            ->join('left join ff_scenic b on a.scenic_id = b.id')
            ->order('user_num desc,s_time asc,s_date asc')->group('scenic_id')->limit(10)->select();
        foreach ($list as $k=>$v){
            $list[$k]['rank'] = $k+1;
            $list[$k]['saturation'] = \round($v['saturation'],2) .'%';
        }
        if(empty($list)){
            $list = $db->alias('a')->field('s_date,s_time, user_num,scenic_id,AVG(saturation) saturation,b.name')
                ->where(['b.status'=>1])
                ->join('left join ff_scenic b on a.scenic_id = b.id')
                ->order('user_num desc,s_time asc,s_date asc')->group('scenic_id')->limit(10)->select();
            foreach ($list as $kk=>$vv){
                $list[$kk]['rank'] = $kk+1;
                $list[$kk]['user_num']  = '--';
                $list[$kk]['saturation'] = '--';
            }
        }

        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$list);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 获取景区的景点名称
     */
    public function getScenicSpot(){
        $where['a.scenic_id'] = \I('scenic_id',1);
        $list = M('visitorRealSpot')->alias('a')->field('a.scenic_id,scenic_id spot_id,b.name')
            ->join('left join ff_scenic b on a.scenic_id = b.id')->order('s_time asc')
            ->group('scenic_id')->where($where)->select();
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$list);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 景点 数据
     */
    public function getRealSpot(){

        $where['scenic_id'] = \I('spotid');
//        $where['spot_id'] = \I('spotid');
        $where['s_time'] = array('elt',\date('H'));
        $list = M('visitorRealSpot')->field(' s_time ,s_date,user_num')->where($where)->order('s_time asc')->group('s_time')->select();
//        $list = M('visitorRealSpot')->field(' s_time ,s_date,user_num')->where($where)->order('s_time asc')->group('s_time')->select();
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = $v['s_date'];
            $data['s_time'][$k] = $v['s_time'].':00';
            if($v['s_time'] > 18){
                $data['user_num'][$k] = 0;
            }else{
                $data['user_num'][$k] = $v['user_num'];
            }
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    //未来7天客流预测
    public function getFutureDays(){
        $mt = strtotime("+1 day");
        $start_time = date('Ymd',$mt);
        $end_time = date('Ymd',\strtotime( '+7 day'));
        $where['s_date'] =  array('between',[$start_time,$end_time]);
        $db = M('forecastFlow');
        $list = $db->field('s_date, SUM(user_num) user_num')->where($where)->group('s_date')->limit(7)->order('s_date asc')->select();
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = date('n'.'.'.'j',\strtotime($v['s_date'])) ;
            $data['user_num'][$k] = $v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 客流迁移情况监控
     */
    public function getTransfer(){
        $start_time = \date('Ymd',(NOW_TIME-(86400*7)));
        $end_time = \date('Ymd',NOW_TIME);
        $where['s_date'] =  array('between',[$start_time,$end_time]);
        $list = M('visitorCity')->alias('a')->field('user_num,b.shortname,lng,lat')->where($where)
//        $list = M('visitorTransfer')->alias('a')->field('user_num,b.shortname,lng,lat')->where($where)
            ->join('left join ff_area b on a.city_id = b.id')->limit(10)->select();
        foreach ($list as $k=>$v){
            $data['name'][$k] = $v['shortname']; //=>[$v['lng'],$v['lat']]];
            $data['point'][$k] =  [$v['lng'],$v['lat']];
            $i =0;
            $data['info'][$k][$i]['name'] = $v['shortname'];
            $data['info'][$k][$i]['value'] = (int)$v['user_num'] / 100;
            $i++;
            $data['info'][$k][$i]['name'] = '扶风';
        }
        \array_push($data['name'],'扶风');
        \array_push($data['point'],array('107.908753','34.381225'));
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 核心客源地TOP1
     */
    public function getProvinceTop(){
        $start_time = \date('Ymd',(NOW_TIME-(86400*7)));
        $end_time = \date('Ymd',NOW_TIME);
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $list = M('visitorCity')->alias('a')
            ->field('province_id,SUM(user_num) user_num,b.name')
            ->join('left join ff_area  b on a.province_id=b.id')
            ->where($where)->group('province_id')->order('user_num desc')->limit(10)->select();

        $list = \arraySort($list,'user_num','SORT_ASC');
        foreach ($list as $k=>$v){
            $data[$k]['name'] = \msubstr($v['name'],0,3,'utf-8',false);
            $data[$k]['value'] = $v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 游客性别及年龄占比
     */
    /**
     * 平均年龄、停留时长、提前预定天数
     */
    public function getVisitorSex(){
        //最近一月
        $start_time = \date('Ymd',(NOW_TIME-(86400*30)));
        $end_time = \date('Ymd',NOW_TIME);
        $where['s_date'] = array('between',[$start_time,$end_time]);
        //游客性别
        $tourist_sex = M('visitorSex')->field('SUM(male_num) male_num,SUM(female_num) female_num')->where($where)->find();

        $data['total_num'] = (int)($tourist_sex['male_num']+$tourist_sex['female_num']);
        $data['sex_text'] = array('男','女');
        $data['male_num'] = (int)$tourist_sex['male_num'];
        $data['female_num'] = (int)$tourist_sex['female_num'];
        //年龄统计
        $tourist_age = M('visitorAge')->field('age_phase,SUM(user_num) user_num,SUM(total_num) total_num')->where($where)->group('age_phase desc')->order('id asc')->select();
        foreach ($tourist_age as $k=>$v){
//            $age_data['percentage'][$k] = \round(($v['user_num']/$v['total_num'])*100,2).'％';
           $data['age_phase'][$k] =  $v['age_phase'];//\getHotelAgePhase($v['age_phase']);
           $data['age_value'][$k] =  $v['user_num'];
        }
        // 假数据
        $data['age_value'] = ['4.16','7.13','19.34','33.12','25.01','11.24'];
        if($tourist_sex && $tourist_age){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 游客到访频次统计
     */
    public function getPv(){
        //最近一周
//        $start_time = \date('Ymd',(NOW_TIME-(86400*7)));
//        $end_time = \date('Ymd',NOW_TIME);
//        $where['s_date'] = array('between',[$start_time,$end_time]);
        $list = M('visitorPv')->field('s_date,pv_phase,SUM(uv) uv')
            ->where($where)->group('pv_phase')->select();
        foreach ($list as $k=>$v){
                if($v['pv_phase'] >2){
                    $data['pv_phase'][$k] = '>'.$v['pv_phase'].'次';
                }else{
                    $data['pv_phase'][$k] = $v['pv_phase'].'次';
                }
                $data['pv_data'][$k]['name'] = $data['pv_phase'][$k];
                $data['pv_data'][$k]['value'] = $v['uv'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 酒店平均价格监测
     */
    public function getHotelAvgPrice(){

        $where['s_date'] =array('lt',\date('Ymd',\strtotime('-1 month',\time())));
        $list = M('visitorHotel')->where($where)->field('s_date,avg_price')->order('s_date desc')->limit('6')->select();
        $list = arraySort($list,'s_date','SORT_ASC');
        foreach ($list as $k=>$v){
            $data['s_date'][$k] =  date('n', \strtotime($v['s_date'])) .'月';
            $data['avg_price'][$k]= $v['avg_price'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }


    /**
     * 舆情监测
     */
    public function getPublicOpinion(){
        //最近一周
//        $start_time = \date('Ymd',(NOW_TIME-(86400*7)));
//        $end_time = \date('Ymd',NOW_TIME);
//        $where['s_date'] = array('between',[$start_time,$end_time]);
        $list = M('visitorOpinion')->field('s_date,type,SUM(user_num) user_num')
            ->where($where)->group('type')->order('s_date desc')->limit(6)->select();
        $list = arraySort($list,'s_date','SORT_ASC');
        foreach ($list as $k=>$v){
            switch ($v['type']){
                case 1: $type_text = '正面';
                    break;
                case 2: $type_text = '中面';
                    break;
                case 3: $type_text = '反面';
                    break;
            }
            $data['name'][$k] = $type_text;
            $data['info'][$k]['name'] = $type_text;
            $data['info'][$k]['value'] = $v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 游客平均驻留时间分析
     */
    public function getStayAvg(){
        $where['s_date'] =array('lt',\date('Ymd',\strtotime('-1 month',\time())));
        $list = M('visitorStay')->field('s_date,avg_day')->where($where)->order('s_date desc')->limit(6)->select();
        $list = arraySort($list,'s_date','SORT_ASC');
        foreach ($list as $k=>$v){
            $data['s_date'][$k] =  date('n', \strtotime($v['s_date'])) .'月';
            $data['avg_day'][$k]= $v['avg_day'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 游客满意度
     */
    public function getSatisfaction(){
        $list = 1;
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

}