<?php
namespace Cron\Model;
use Think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/8
 * Time: 10:31
 */
class CollectionModel extends Model{
    /**获取城市、省份客流比例
     * @return array
     */
    public function getRadio(){
        $arr = [
            ['province_id' => 1964,'city_id' => 1965,'radio' => 12.9],//广东
            ['province_id' => 801,'city_id' => 802,'radio' => 10.5],//上海
            ['province_id' => 2898,'city_id' => 2899,'radio' => 9.6],//陕西
            ['province_id' => 1,'city_id' => 2,'radio' =>  8.3],//北京
            ['province_id' => 820,'city_id' => 821,'radio' => 7.7],//江苏
            ['province_id' => 933,'city_id' => 934,'radio' => 5.1],//浙江
            ['province_id' => 37,'city_id' => 38,'radio' => 4.7],//河北
            ['province_id' => 1532,'city_id' => 1533,'radio' => 4.3],//河南
            ['province_id' => 2367,'city_id' => 2368,'radio' => 4],//成都
            ['province_id' => 1709,'city_id' => 1710,'radio' => 3.5],//武汉
        ];
        //返回十个省份的 城市id 省份id 比例
        foreach($arr as $k => &$v){
            $float = $this->randFloat(-0.45,0.45);
            $v['radio'] = $v['radio']+$float;
            $v['float'] = $float;
        }
        return $arr;
    }

    /**0--0.45之间随机两位小数
     * @param float $min
     * @param float $max
     * @return float
     */
    public function randFloat($min=-0.45, $max=0.45){
        $num = $min + mt_rand()/mt_getrandmax() * ($max-$min);
        $num = round($num,2);
        return $num;
    }

    /**获取每日客流数量
     * @param $date
     * @param int $min 最小值
     * @param int $max 最大值
     * @return mixed
     */
    public function getFlow($date,$min=28000,$max=34000){
        $ymd = strtotime($date);
        $ymd = date("w",$ymd);
        $arr = [
            20710528,20710529,20710530,//2017端午
            20710429,20710430,20710501,//2017五一
            20171001,20171002,20171003,20171004,20171005,20171006,20171007,20171008,//2017国庆中秋
            20180616,20180617,20180618,//2018端午
            20180429,20180430,20180501,//2018五一
            20180922,20180923,20180924,//2018中秋节
            20181001,20181002,20181003,20181004,20181005,20181006,20181007,//2018国庆节
        ];
//        echo date("w",$date);die;
        $num = mt_rand($min,$max);//平时
        if((20170705<=$date && $date<=20170827) || (20180705<=$date && $date<=20180827) || in_array($date,$arr)){
            $num =ceil($num*1.8); //如果为法定节假日或者暑假
        }elseif($ymd ==0 || $ymd ==6){
            $num =ceil($num*1.2); //如果为周六、日
        }
        return $num;
    }

    /**客流预测数据
     * @param $date
     * @return mixed
     */
    public function addCustomerFlow($date){
        $param = [];
        $model = D('forecastArea'); //客流表
        $carModel = D('forecastFlow'); //车流表
        $radio = $this->getRadio();//十个省份的 城市id 省份id 比例
        $num = $this->getFlow($date);//每日客流总人数
        foreach($radio as $k => $v){
            $param[$k]['s_date'] = $date;//日期
            $param[$k]['province_id'] = $v['province_id'];//省份id
            $param[$k]['city_id'] = $v['city_id'];//城市id
            $param[$k]['user_num'] = ceil($v['radio']*$num/100);//客流人数
            $param[$k]['created'] = time();//创建时间
            $busNum = ceil($param[$k]['user_num']*0.36/40);//大巴车流量
            $carNum = ceil($param[$k]['user_num']*0.54/4);//小车车流量
            $param[$k]['car_num'] = $busNum+$carNum;//车流量
        }
        $model->where(['s_date' => $date])->delete();//客流表删除重复数据
        if($model->addAll($param)){
            $carModel->where(['s_date' => $date])->delete();//车流表删除重复数据
            echo $carModel->addAll($param) ? $date.'--forecastArea---forecastFlow--'.'添加成功'.'<br/>' : $carModel->_sql().'<br/>';
        }else{
            echo $date.'--forecastArea---forecastFlow--'.'faise'.'<br/>';
        }
    }

    /**消费方式
     * @param $date
     * @param $money
     */
    public function addPayType($date,$money){
        $data = [];
        $model = D('consumePaytype'); //支付方式
        //支付方式
        $data['5'] = $this->randFloat(30,35)*$money/100;//现金方式支付
        $data['1'] = $this->randFloat(17,19)*$money/100;//微信方式支付
        $data['3'] = $this->randFloat(17,19)*$money/100;//银联方式支付
        $data['2'] = $this->randFloat(17,19)*$money/100;//支付宝方式支付
        $data['4'] = $money-array_sum($data);//其他方式支付
        foreach($data as $k=>$v){
            $model->where(['s_date' => $date,'type' => $k])->delete();
            if($model->add(['s_date'=> $date,'type' => $k,'amount' => $v,'created' => time()])){
                echo $date.'--consumePaytype--'.'添加成功'.'<br/>';
            }else{
                echo $date.'--consumePaytype--'.'faise'.'<br/>';
            }
        }
    }

    /**消费金额
     * @param $date
     * @param $money
     */
    public function addPayMoney($date,$money){
        $data = [];
        $model = D('consumeTotal'); //支付金额
        //支付方式
        $data['1'] = $this->randFloat(35,37)*$money/100;//200以下
        $data['2'] = $this->randFloat(47,49)*$money/100;//200-500
        $data['3'] = $this->randFloat(12,13)*$money/100;//500-1000
        $data['4'] = $money-array_sum($data);//1000以上
        foreach($data as $k=>$v){
            $model->where(['s_date' => $date,'amount_phase' => $k])->delete();
            if($model->add(['s_date'=> $date,'amount_phase' => $k,'amount' => $v,'created' => time()])){
                echo $date.'--consumeTotal--'.'添加成功'.'<br/>';
            }else{
                echo $date.'--consumeTotal--'.'faise'.'<br/>';
            }
        }
    }
    /**消费分布
     * @param $date
     * @param $money
     */
    public function addPayDistribution($date,$money){
        $data = [];
        $model = D('consumeChannel'); //消费分布
        //支付方式
        $data['1'] = $this->randFloat(20,23)*$money/100;//住宿
        $data['2'] = $this->randFloat(40,45)*$money/100;//景区
        $data['3'] = $this->randFloat(3,5)*$money/100;//购物
        $data['4'] = $this->randFloat(18,20)*$money/100;//吃喝玩
        $data['5'] = $this->randFloat(3,5)*$money/100;//交通
        $data['6'] = $money-array_sum($data);//其他
        foreach($data as $k=>$v){
            $model->where(['s_date' => $date,'type' => $k])->delete();
            if($model->add(['s_date'=> $date,'type' => $k,'amount' => $v,'created' => time()])){
                echo $date.'--consumeChannel--'.'添加成功'.'<br/>';
            }else{
                echo $date.'--consumeChannel--'.'faise'.'<br/>';
            }
        }
    }

    /**投诉分析
     * @param $date
     */
    public function addComplainArea($date){
        $model = D('complainArea'); //客源地省、城市投诉数量统计
        $complainModel = D('complain'); //行业投诉数、投诉量统计
        $complainRadio = $this->getComplainArea();
        for($i=1;$i<=6;$i++){
            $param[$i-1]['s_date'] = $date;//日期
            $param[$i-1]['created'] = time();//添加时间
            $param[$i-1]['type'] = $i;//投诉类型 1交通 2景点 3购物 4 OAT 5 餐饮 6 旅行社
            $param[$i-1]['num'] = mt_rand(0,2);//投诉量
        }
        $complainModel->where(['s_date' => $date])->delete();
        if($complainModel->addAll($param)){
            foreach($complainRadio as $k => $v){
                $data[$k]['num'] = $param[$k]['num'];//投诉量
                $data[$k]['s_date'] = $date;//日期
                $data[$k]['province_id'] = $v['province_id'];//省份id
                $data[$k]['city_id'] = $v['city_id'];//城市id
                $data[$k]['created'] = time();//添加时间
            }
            $model->where(['s_date' => $date])->delete();
            if($model->addAll($data)) { //添加客源地省、城市投诉数量统计
                echo $date.'--complainArea--complain--'.'添加成功'.'<br/>';
            }else{
                echo $date.'--'.'faise'.'<br/>';
            }
        }else{
            echo $date.'----complainArea--complain--'.'faise'.'<br/>';
        }
    }

    /**获取城市、省份投诉比例
     * @return array
     */
    public function getComplainArea(){
        $arr = [
            ['province_id' => 1964,'city_id' => 1965,'radio' => 17.9],//广东
            ['province_id' => 801,'city_id' => 802,'radio' => 15.5],//上海
            ['province_id' => 2898,'city_id' => 2899,'radio' => 14.6],//陕西
            ['province_id' => 1,'city_id' => 2,'radio' =>  13.3],//北京
            ['province_id' => 820,'city_id' => 821,'radio' => 12.7],//江苏
            ['province_id' => 933,'city_id' => 934,'radio' => 0],//浙江
        ];
        return $arr;
    }

    /**每日售票量
     * @param $date
     */
    public function addTicket($date){
        $model = D('ticketDay'); //每日售票量
        $data['s_date'] = $date;//日期
        $data['num'] = $this->getFlow($date,21300,28000);//每日总票数
        $data['created'] = time();//每日总票数
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--ticketDay--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--ticketDay--'.'faise'.'<br/>';
        }
    }

    /**获取一天总的售票量
     * @param $date
     * @return mixed
     */
    public function getTicket($date){
        $num = M('ticketDay')->field('num')->where(['s_date' => $date])->find();
        return $num;
    }

    /**提前购票数量
     * @param $date
     * @param $num
     */
    public function addTicketReservations($date){
        $radio = 0;
        $model = D('ticketReservations');
        $num = $this->getTicket($date)['num'];//每天总售票量
        for($i=0;$i<=4;$i++){
            if($i == 0){
                $data[$i]['day_phase'] = $i; //类型 0 0天 1 1天 2 2天 3 3天 4 4天以上
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['create'] = time();//添加时间
                $radioNum = mt_rand(68,70);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i ==1){
                $data[$i]['day_phase'] = $i; //类型 0 0天 1 1天 2 2天 3 3天 4 4天以上
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['create'] = time();//添加时间
                $radioNum = mt_rand(15,17);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i == 2){
                $data[$i]['day_phase'] = $i; //类型 0 0天 1 1天 2 2天 3 3天 4 4天以上
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['create'] = time();//添加时间
                $radioNum = mt_rand(9,10);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i == 3){
                $data[$i]['day_phase'] = $i; //类型 0 0天 1 1天 2 2天 3 3天 4 4天以上
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['create'] = time();//添加时间
                $radioNum = mt_rand(4,5);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i == 4){
                $data[$i]['day_phase'] = $i; //类型 0 0天 1 1天 2 2天 3 3天 4 4天以上
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['create'] = time();//添加时间
                $radioNum = 100-$radio;//比例
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }
        }
        $model->where(['s_date' => $date])->delete();
        if($model->addAll($data)){
            echo $date.'--ticketReservations--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--ticketReservations--'.'faise'.'<br/>';
        }
    }

    /**票务预订渠道统计
     * @param $date
     * @param $num
     */
    public function addTicketChannel($date){
        $radio = 0;
        $model = D('ticketChannel');
        $num = $this->getTicket($date)['num'];//每天总售票量
        for($i=1;$i<=5;$i++){
            if($i == 1){
                $data[$i]['channel_id'] = $i; //类型 1、自助机和窗口 2、携程 3、美团 4、驴妈妈 5、其他
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['created'] = time();//添加时间
                $radioNum = mt_rand(65,66);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i ==2){
                $data[$i]['channel_id'] = $i; //类型 1、自助机和窗口 2、携程 3、美团 4、驴妈妈 5、其他
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['created'] = time();//添加时间
                $radioNum = mt_rand(12,14);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i == 3){
                $data[$i]['channel_id'] = $i; //类型 1、自助机和窗口 2、携程 3、美团 4、驴妈妈 5、其他
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['created'] = time();//添加时间
                $radioNum = mt_rand(11,12);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i == 4){
                $data[$i]['channel_id'] = $i; //类型 1、自助机和窗口 2、携程 3、美团 4、驴妈妈 5、其他
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['created'] = time();//添加时间
                $radioNum = mt_rand(6,7);//比例
                $radio+= $radioNum;
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }elseif($i == 5){
                $data[$i]['channel_id'] = $i; //类型 1、自助机和窗口 2、携程 3、美团 4、驴妈妈 5、其他
                $data[$i]['s_date'] = $date;//日期
                $data[$i]['created'] = time();//添加时间
                $radioNum = 100-$radio;//比例
                $data[$i]['user_num'] = round($num*$radioNum/100);//购票数量
            }
        }
        sort($data,1);
        $model->where(['s_date' => $date])->delete();
        if($model->addAll($data)){
            echo $date.'--ticketChannel--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--ticketChannel--'.'faise'.'<br/>';
        }
    }

    /**售票类型
     * @param $date
     * @param $num
     */
    public function addTicketType($date){
        $model = D('ticketTypeDay');
        $num = $this->getTicket($date)['num'];//每天总售票量
        $data['total_ticket'] = $num;
        $radio = $radioNum = mt_rand(65,68);//比例
        $data['group_num'] = round($num*$radio/100);//团队购票数量;
        $data['individual_num'] = round($num*(100-$radio)/100);//散客购票数量;
        $data['s_date'] = $date;//日期;
        $data['created'] = time();//添加时间;
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--ticketTypeDay--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--ticketTypeDay--'.'faise'.'<br/>';
        }
    }
    /**售票渠道
     * @param $date
     * @param $num
     */
    public function addTicketTotal($date,$money){
        $model = D('ticketTotal');
        $num = $this->getTicket($date)['num'];//每天总售票量
        $data['total'] = $num;//每天总售票量
        $radio = $radioNum = mt_rand(65,66);//比例
        $data['network_total'] = round($num*(100-$radio)/100);//网络售票数量;
        $data['s_date'] = $date;//日期;
        $data['amount'] = $num*$money;//售票总金额;
        $data['created'] = time();//添加时间;
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--ticketTotal--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--ticketTotal--'.'faise'.'<br/>';
        }
    }

    /**支付方式
     * @param $date
     */
    public function addTicketPay($date){
        $data = [];
        $model = D('ticketPay');
        $num = $this->getTicket($date)['num'];//每天总售票量
        $data['alipay'] = round(mt_rand(34,36)*$num/100);//支付宝
        $data['weichat'] = round(mt_rand(34,36)*$num/100);//微信
        $data['cash'] = round(mt_rand(21,25)*$num/100);//现金
        $data['other'] = round($num-array_sum($data));//其他
        $data['s_date'] = $date;//日期
        $data['created'] = time();
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--ticketPay--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--ticketPay--'.'faise'.'<br/>';
        }
    }
    /**景区实时客流
     * @param $date
     */
    public function addVisitorReal($date){
//        ini_set('max_execution_time', '0');
        $model = M('visitorRealSpot');//实时客流表
        $flowDayModel = M('scenicFlowDay');//每日客流表
        $arr = ['09','10','11','12','13','14','15','16','17','18','19'];//时间点
        //景区 及 游客人数区间值
        $scenicArr = [
            1 => [20000,26000],//法门寺
            2 => [800,1000],//七星河
            3 => [300,500],//野河山
            4 => [1000,1500],//关中风情园
        ];
        foreach($scenicArr as $k => $v){
            $data = $param = [];
            $num = $this->getFlow($date,$v[0],$v[1]);//景区每天总人数
            /**********每日客流start***********/
            $param[$k]['user_num'] = $num;
            $param[$k]['scenic_id'] = $k;
            $param[$k]['s_date'] = $date;
            $param[$k]['created'] = time();
            $param[$k]['car_num'] = round(($num*0.54/4+$num*0.36/40)*0.7);
            sort($param,1);
            /************每日客流end********************/
            $flowDayModel->where(['s_date' => $date,'scenic_id' => $k])->delete();
            if($flowDayModel->addAll($param)){
                /***************实时客流 start*********************/
                foreach($arr as$key => $val){
                    $data[$key]['total_user_num'] = $num;
                    $data[$key]['s_date'] = $date;//日期
                    $data[$key]['s_time'] = $val;//时间点
                    $data[$key]['scenic_id'] = $k;//景区id
                    $data[$key]['spot_id'] = $k;//景点id
                    $data[$key]['created'] = time();//添加时间
                    if($val == 9){
                        $data[$key]['user_num'] = 0;//游客人数
                    }elseif($val>=10 && $val<=16){
                        $data[$key]['user_num'] = mt_rand(4000,5000);//游客人数
                    }elseif($val == 17){
                        $userNum = mt_rand(3000,4000);//游客人数
                        $data[$key]['user_num'] = $userNum;//游客人数
                    }else{
                        $userNum =$userNum -round($userNum*0.33);//人数递减33%
                        $data[$key]['user_num'] = $userNum;//游客人数
                    }
                }
                /*****************实时客流end*******************/
                $model->where(['s_date' => $date,'scenic_id' => $k])->delete();
                if($model->addAll($data)){
                    echo $date.'--visitorReal--scenicFlowDay--'.'添加成功'.'<br/>';
                }else{
                    echo $date.'----visitorReal--scenicFlowDay--'.'faise'.'<br/>';
                }
            }else{
                echo $date.'----visitorReal--scenicFlowDay--'.'faise'.'<br/>';
            }

        }
    }
    /**
    *游客客源地表-地区（每天）
    * @param $date
    * @return mixed
    */
    public function addFlowArea($date){
        $data = $param = [];
        $model = D('scenicFlowArea'); //游客客源地表
        $radio = $this->getRadio();//十个客流省份的 城市id 省份id 比例
        $num = $this->getVisitor($date)['num'];//每日客流总人数
        $carNum = $this->getVisitor($date)['car_num'];//每日车流数
        //客流数据
        foreach($radio as $k => $v){
            $param[$k]['s_date'] = $date;//日期
            $param[$k]['province_id'] = $v['province_id'];//省份id
            $param[$k]['city_id'] = $v['city_id'];//城市id
            $param[$k]['user_num'] = ceil($v['radio']*$num/100);//客流人数
            $param[$k]['created'] = time();//创建时间
//            $busNum = ceil($param[$k]['user_num']*0.36/40);//大巴车流量
//            $carNum = ceil($param[$k]['user_num']*0.54/4);//小车车流量
//            $param[$k]['car_num'] = ceil($v['radio']*$carNum/100);//车流量
//            $param[$k]['car_stay'] = $this->randFloat(3,4);//车辆平均停留时间
            $param[$k]['car_num'] = 0;//车流量
            $param[$k]['car_stay'] = 0;//车辆平均停留时间
        }
        //车流数据
        $radio = $this->getScenicRadio();//十个客流省份的 城市id 省份id 比例
        foreach($radio as $k => $v){
            $data[$k]['s_date'] = $date;//日期
            $data[$k]['province_id'] = $v['province_id'];//省份id
            $data[$k]['city_id'] = $v['city_id'];//城市id
//            $param[$k]['user_num'] = ceil($v['radio']*$num/100);//客流人数
            $data[$k]['user_num'] = 0;//客流人数
            $data[$k]['created'] = time();//创建时间
//            $busNum = ceil($param[$k]['user_num']*0.36/40);//大巴车流量
//            $carNum = ceil($param[$k]['user_num']*0.54/4);//小车车流量
//            $param[$k]['car_num'] = ceil($v['radio']*$carNum/100);//车流量
//            $param[$k]['car_stay'] = $this->randFloat(3,4);//车辆平均停留时间
            $data[$k]['car_num'] = ceil($v['radio']*$carNum/100);//车流量
            $data[$k]['car_stay'] = $this->randFloat(3,4);//车辆平均停留时间
        }
//        var_dump($param);
//        var_dump($data);die;
        $model->where(['s_date' => $date])->delete();//客流表删除重复数据
        if($model->addAll($param) && $model->addAll($data)){
            echo $date.'--scenicFlowArea--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--scenicFlowArea--'.'faise'.'<br/>';
        }
    }
    /**获取景区城市、省份客流车流比例
     * @return array
     */
    public function getScenicRadio(){
        $arr = [
            ['province_id' => 2898,'city_id' => 2899,'radio' => 12.5],//陕西 西安
            ['province_id' => 2898,'city_id' => 2918,'radio' => 15.9],//陕西 宝鸡
            ['province_id' => 2898,'city_id' => 2931,'radio' => 11.5],//陕西 咸阳
            ['province_id' => 2898,'city_id' => 2931,'radio' => 10.3],//陕西 铜川
            ['province_id' => 220,'city_id' => 290,'radio' => 7.7],//山西 运城
            ['province_id' => 3022,'city_id' => 3023,'radio' => 4.7],//甘肃 兰州
            ['province_id' => 3126,'city_id' => 3127,'radio' => 4.3],//青海 西宁
            ['province_id' => 1,'city_id' => 2,'radio' =>  3.5],//北京
            ['province_id' => 2367,'city_id' => 2368,'radio' => 4],//四川 成都
            ['province_id' => 1709,'city_id' => 1710,'radio' => 5.1],// 河北 武汉
        ];
        //返回十个省份的 城市id 省份id 比例
        foreach($arr as $k => &$v){
            $float = $this->randFloat(-0.45,0.45);
            $v['radio'] = $v['radio']+$float;
            $v['float'] = $float;
        }
        return $arr;
    }

    /**返回扶风总客流 车流
     * @param $date
     * @return mixed
     */
    public function getVisitor($date){
        $num = M('scenicFlowDay')->field('SUM(user_num) num,SUM(car_num) car_num')->where(['s_date' => $date])->find();
        return $num;
    }

    /**游客年龄 岁数
     * @param $date
     */
    public function addVisitorAgeSex($date){
        $data = [];
        $ageModel = M('visitorAge');
        $sexModel = M('visitorSex');
        $num = $this->getVisitor($date)['num'];//景区总客流
        $arr = [
            0 => [0.03,0.04],//14岁以下比例
            1 => [0.08,0.10],//15-24岁以下比例
            2 => [0.15,0.17],//25-34岁比例
            3 => [0.26,0.28],//35-44岁比例
            4 => [0.36,0.38],//45-64岁比例
            5 => [0,0],//64岁以上
        ];
        /*******游客年龄******/
        $radio = $this->randFloat(0.45,0.55);
        $data['male_num'] = round($num*$radio);//男游客人数
        $data['female_num'] = round($num*(1-$radio));//女游客人数
        $data['s_date'] = $date;//日期
        $data['created'] = time();//创建时间
        $sexModel->where(['s_date' => $date])->delete();
        if($sexModel->add($data)){
            $data = [];
            $avg = mt_rand(30,38);//平均年龄
            foreach($arr as $k => $v){
                $data[$k]['total_num'] = $num;//当天总客流
                $data[$k]['age_avg'] = $avg;
                $data[$k]['s_date'] = $date;//日期
                $data[$k]['created'] = time();//创建时间
                if($k == 0){
                    $data[$k]['age_phase'] = '14岁以下';
                    $data[$k]['user_num'] = round($this->randFloat($v[0],$v[1])*$num);
                    $num = $num - $data[$k]['user_num'];
                }elseif($k ==1){
                    $data[$k]['age_phase'] = '15-24岁';
                    $data[$k]['user_num'] = round($this->randFloat($v[0],$v[1])*$num);
                    $num = $num - $data[$k]['user_num'];
                }elseif($k == 2){
                    $data[$k]['age_phase'] = '25-34岁';
                    $data[$k]['user_num'] = round($this->randFloat($v[0],$v[1])*$num);
                    $num = $num - $data[$k]['user_num'];
                }elseif($k == 3){
                    $data[$k]['age_phase'] = '35-44岁';
                    $data[$k]['user_num'] = round($this->randFloat($v[0],$v[1])*$num);
                    $num = $num - $data[$k]['user_num'];
                }elseif($k == 4){
                    $data[$k]['age_phase'] = '45-64岁';
                    $data[$k]['user_num'] = round($this->randFloat($v[0],$v[1])*$num);
                    $num = $num - $data[$k]['user_num'];
                }else{
                    $data[$k]['age_phase'] = '65岁以上';
                    $data[$k]['user_num'] = $num;
                }
            }
            $ageModel->where(['s_date' => $date])->delete();
            if($ageModel->addAll($data)){
                echo $date.'--visitorAge--visitorSex--'.'添加成功'.'<br/>';
            }else{
                echo $date.'----visitorAge--visitorSex--'.'faise'.'<br/>';
            }
        }else{
            echo $date.'----visitorAge--visitorSex--'.'faise'.'<br/>';
        }
    }

    /**游客平均停留时间
     * @param $date
     */
    public function addVisitorStay($date){
        $model = M('visitorStay');
        $data = [];
        $data['s_date'] = $date;
        $data['avg_day'] = $this->randFloat(3,4);//平均停留时间
        $data['created'] = time();//添加时间
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--visitorStay--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--visitorStay--'.'faise'.'<br/>';
        }
    }

    /**实时车流
     * @param $date
     */
    public function addScenicCarReal($date){
        $data = $param = [];
//        ini_set('max_execution_time', '0');
        $model = M('scenicCarReal');//实时客流表
        $arr = ['09','10','11','12','13','14','15','16','17','18','19'];//时间点
        foreach($arr as$key => $val){
            //小车
            $data[$key]['s_date'] = $date;//日期
            $data[$key]['s_time'] = $val;//时间点
            $data[$key]['created'] = time();//添加时间
            $data[$key]['car_type'] = 1;//1 小车 2大巴
            //大巴
            $param[$key]['s_date'] = $date;//日期
            $param[$key]['s_time'] = $val;//时间点
            $param[$key]['created'] = time();//添加时间
            $param[$key]['car_type'] = 2;//1 小车 2大巴
            if($val == 9 || $val == 19){
                $data[$key]['car_num'] = $param[$key]['car_num'] = 0;//车流量
            }elseif($val==10 || $val==16 || $val==12){
                $num = mt_rand(500,600);//车数量
                $data[$key]['car_num'] = round(0.54*$num);//小车数量
                $param[$key]['car_num'] = round($num-$data[$key]['car_num']);//大车数量
            }elseif($val == 17 || $val == 18){
                $num = mt_rand(10,270);//车数量
                $data[$key]['car_num'] = round(0.54*$num);//小车数量
                $param[$key]['car_num'] = round($num-$data[$key]['car_num']);//大车数量
            }else{
                $num = mt_rand(180,280);//车数量
                $data[$key]['car_num'] = round(0.54*$num);//小车数量
                $param[$key]['car_num'] = round($num-$data[$key]['car_num']);//大车数量
            }
        }
        /*****************实时客流end*******************/
        $model->where(['s_date' => $date])->delete();
        if($model->addAll($data) && $model->addAll($param)){
            echo $date.'--scenicCarReal--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--scenicCarReal--'.'faise'.'<br/>';
        }
    }

    /**景区客流汇总
     * @param $date
     */
    public function addScenicFlowTotal($date){
        $data = [];
        $model = M('scenicFlowTotal');
        //获取当前客流总人数
        $data['user_num'] = $this->getVisitor($date)['num'];
        //获取昨天客流总人数
        $day = date('Ymd',strtotime("$date -1 day"));
        $num = $this->getVisitor($day)['num'];
        $data['yesterday_total'] = $num ? $num : 0;//获取昨天客流总人数
        //获取本年度客流总人数
        $star = date('Y',strtotime("$date"));
        $starTime = $star.'0101';
//        $endTime = $star.'1231';
        $endTime = date('Ymd',strtotime("$date -1 day"));
        $where = array('between',[$starTime,$endTime]);
        $data['tear_total'] = $this->getVisitor($where)['num'];//获取本年度客流总人数
        $data['tear_total'] = $data['tear_total']?$data['tear_total']:0;
        //获取本月客流总数
        $star = date('Ym',strtotime("$date"));
        $starTime = $star.'01';
//        $endTime = $star. date('t', strtotime($starTime));
        $endTime = date('Ymd',strtotime("$date -1 day"));
        $where = array('between',[$starTime,$endTime]);
        $data['month_total'] = $this->getVisitor($where)['num'];//获取本月客流总数
        $data['month_total'] = $data['month_total']?$data['month_total']:0;
        $data['created'] = time();//添加时间
        $data['s_date'] = $date;//日期
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--scenicFlowTotal--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--scenicFlowTotal--'.'faise'.'<br/>';
        }
    }

    /**景区车流汇总
     * @param $date
     */
    public function addScenicCar($date){
        $data = [];
        $model = M('scenicCar');
        //获取当前车流数
        $data['car_num'] = $this->getVisitor($date)['car_num'];
        //获取昨天车流数
        $day = date('Ymd',strtotime("$date -1 day"));
        $num = $this->getVisitor($day)['car_num'];
        $data['yesterday_total'] = $num ? $num : 0;//获取昨天客流总人数
        //获取本年度车流数
        $star = date('Y',strtotime("$date"));
        $starTime = $star.'0101';
//        $endTime = $star.'1231';
        $endTime = date('Ymd',strtotime("$date -1 day"));
        $where = array('between',[$starTime,$endTime]);
        $data['year_total'] = $this->getVisitor($where)['car_num'];//获取本年度客流总人数
        $data['year_total'] = $data['year_total']?$data['year_total']:0;
        //获取本月车流数
        $star = date('Ym',strtotime("$date"));
        $starTime = $star.'01';
//        $endTime = $star. date('t', strtotime($starTime));
        $endTime = date('Ymd',strtotime("$date -1 day"));
        $where = array('between',[$starTime,$endTime]);
        $data['month_total'] = $this->getVisitor($where)['car_num'];//获取本月客流总数
        $data['month_total'] = $data['month_total']?$data['month_total']:0;
        $data['created'] = time();//添加时间
        $data['s_date'] = $date;//日期
        $model->where(['s_date' => $date])->delete();
        if($model->add($data)){
            echo $date.'--scenicCar--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--scenicCar--'.'faise'.'<br/>';
        }
    }
    public function addScenicCarStay($date){
        $data = [];
        $radio = 0;
        $model = M('scenicCarStay');
        //获取当天车流数
        $carNum = $this->getVisitor($date)['car_num'];
        $ra = $this->randFloat(0.05,0.08);
        $data[0]['vehicle_num'] = $carNum*$ra;//一小时以内
        $data[0]['phase_type'] =1;
        $data[0]['remain_time'] = round($data[0]['vehicle_num']*$this->randFloat(0,1),2);//一小时内
        $data[0]['s_date'] = $date;//日期
        $data[0]['created'] = time();
        $radio += $ra;

        $ra = $this->randFloat(0.1,0.13);
        $data[1]['vehicle_num'] = $carNum*$ra;//一小时以内
        $data[1]['phase_type'] =2;
        $data[1]['remain_time'] = round($data[0]['vehicle_num']*$this->randFloat(1,2),2);//一小时内
        $data[1]['s_date'] = $date;//日期
        $data[1]['created'] = time();
        $radio += $ra;

        $ra = $this->randFloat(0.45,0.48);
        $data[2]['vehicle_num'] = $carNum*$ra;//一小时以内
        $data[2]['phase_type'] =3;
        $data[2]['remain_time'] = round($data[0]['vehicle_num']*$this->randFloat(2,3),2);//一小时内
        $data[2]['s_date'] = $date;//日期
        $data[2]['created'] = time();
        $radio += $ra;

        $data[3]['vehicle_num'] = $carNum*(1-$radio);//一小时以内
        $data[3]['phase_type'] =4;
        $data[3]['remain_time'] = round($data[0]['vehicle_num']*$this->randFloat(3,5),2);//一小时内
        $data[3]['s_date'] = $date;//日期
        $data[3]['created'] = time();
        $model->where(['s_date' => $date])->delete();
        if($model->addAll($data)){
            echo $date.'--scenicCarStay--'.'添加成功'.'<br/>';
        }else{
            echo $date.'--scenicCarStay--'.'faise'.'<br/>';
        }
    }
}