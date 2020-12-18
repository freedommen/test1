<?php
namespace Cron\Controller;


//use Think\Controller;
use Cron\Model\HotelModel;


class HotelController //extends Controller
{

    public function autoLoad(){
        $startdate = $_SERVER['argv'][2] ? $_SERVER['argv'][2] : 20170701;
        $enddate = $_SERVER['argv'][3] ? $_SERVER['argv'][3] : 20181231;
        $data_arr = $this->getDateFromRange($startdate, $enddate);
       // $ymd = date('Ymd', \time());
        foreach ($data_arr as $ymd){
           // 入住统计
            $this->addHotelOrder($ymd);
            //添加酒店价格，需每天执行
            $this->addHotelRate($ymd);
            //酒店约定渠道
            $this->addBookingChannel($ymd);
            //酒店预定
            $this->addFavoriteHotel($ymd);
            echo  $ymd.' --|  <br>';
        }
        echo ok;

    }

    /**
     * 获取指定日期段内每一天的日期
     * @param  Date  $startdate 开始日期
     * @param  Date  $enddate   结束日期
     * @return Array
     */
    private function getDateFromRange($startdate, $enddate){

        $stimestamp = strtotime($startdate);
        $etimestamp = strtotime($enddate);
        // 计算日期段内有多少天
        $days = ($etimestamp-$stimestamp)/86400+1;
        // 保存每天日期
        $date = array();
        for($i=0; $i<$days; $i++){
            $date[] = date('Ymd', $stimestamp+(86400*$i));
        }
        //工作日、休息日区分
//        foreach ($date as $k=>$v){
//            $week = date('w',\strtotime($v));
//            // 0表示星期日 6表示星期六
//            if($week == '0' || $week =='6'){
//                $data['weekend'][] = $v;
//            }else{
//                $data['weekday'][] = $v;
//            }
//        }
        return $date;
    }



    /**
     * 添加酒店价格，需每天执行
     * @param $date 日期格式 yyyymmdd
     * @user liurg
     */
    public function addHotelRate($date)
    {
        //获取所有渠道
        $channel = M('hotelChannel')->order('id asc')->select();
        M('hotelRate')->where(['s_date'=>$date])->delete();
        //所有酒店
        $hotel = HotelModel::getHotel();
        $data =array();
        foreach ($hotel as $k => $v) {
            foreach ($channel as $kk => $vv) {
                //循环所有酒店，渠道价格 +-5元  每天的价格相同，不分节假日
                $rate = \mt_rand(-5, 5);
                //获取酒店id
                $data[$kk]['hotel_id'] = $v['id'];
                $data[$kk]['s_date'] = $date;
                $data[$kk]['channel_id'] = $vv['id'];
                $data[$kk]['daily_rate'] = $v['avg_rate'] + $rate;
                $data[$kk]['rate_t1'] = $v['avg_rate'] + $rate;
                $data[$kk]['rate_t2'] = $v['avg_rate'] + $rate;
                $data[$kk]['rate_t3'] = $v['avg_rate'] + $rate;
                $data[$kk]['rate_t4'] = $v['avg_rate'] + $rate;
                $data[$kk]['rate_t5'] = $v['avg_rate'] + $rate;
                $data[$kk]['rate_t6'] = $v['avg_rate'] + $rate;
                $data[$kk]['created'] = \time();
            }
            HotelModel::addHotelRate($data);
        }
        //echo array('code'=>200);
    }

    /**
     * 住宿统计
     * @param $date 日期 格式yyyymmdd
     * @param $type 1平日 、2休息日、3法定假日（或者暑假）
     */
    private function addHotelOrder($date){

        //旅客总人数 = 当天总游客数量 * 比例（平时 8%-12%）
        $user_total = \round(\mt_rand(28000,34000) * randFloat(0.08,0.12),0); //
        // M('')->where(['s_date'=>$date])->field('SUM(user_num) user_num')->find();
        //判断平日、双休日、法定节节日（或者暑假） 在乘以倍数
         $res =isHoliday($date,$user_total);
        $hotel_user = $res['num'];
        $occupancy = $res['multiple'];

//        $summer_start = \intval(date('Y') .'0705');
//        $summer_end = \intval(date('Y') .'0827');
//        if($date >= $summer_start && $date <= $summer_end){
//            // '法定节假日';  入住总人数 =游客总人数 * （8%-12%) * 1.8
//            $hotel_user = $user_total * 1.8;
//            //入住率
//            $occupancy = 1.8;
//        }elseif (\date('w',\strtotime($date)) == '0' || \date('w',\strtotime($date)) == '6'){
//            // '休息日';  入住总人数 = 游客总人数 * （8%-12%) * 1.2
//            $hotel_user = $user_total * 1.2;
//            //入住率
//            $occupancy = 1.2;
//        }else{
//         // '平常日';  入住总人数 =  游客总人数 * （8%-12%）
//            $hotel_user = $user_total;
//            $occupancy = 1;
//        }
        //获取所有酒店
        $hotel_list = HotelModel::getHotel();
        $total_data =array();
        //循环酒店获取酒店的id等信息
        foreach ($hotel_list as $k=>$v){
            //入住率  = 入住总人数 * 每个酒店的入住率比例（30%-50% *  节假日比例（1倍|1.2倍|1.8倍）
            $occupancy_rate =  \sprintf("%.2f",(randFloat(30,50) * $occupancy));
            $occupancy_rates = $occupancy_rate/100;

            $total_data[$k]['s_date'] = $date;
            //酒店最大容量 = 房间数量 * 每个房间只允许住两个人
            $room_user = $v['room']*2;
            //随机分配旅客人数
            $user_num = \mt_rand($room_user*$occupancy_rates,$room_user);
            //如何住满，
            if($room_user <= $user_num){
                //入住率即为百分比
//                $occupancy_rate = 100;
            }
            $total_data[$k]['user_num'] = $user_num;
            $total_data[$k]['hotel_id'] = $v['id'];
            $total_data[$k]['occupancy'] = $occupancy_rate;
            $total_data[$k]['created']  = \time();
        }
        M('hotelOrderTotal')->where(['s_date'=>$date])->delete();
        //批量写酒店旅客记录表（每天）
        HotelModel::addHotelOrderTotal($total_data);
        //旅客入住时长
        $this->addHotelStaydays($date);
        //旅客性别年龄
        $this->addHotelUserSex($date);
    }

    /**
     * 游客入住时长占比统计
     * 没有节假日之分
     */
    private function addHotelStaydays($date){
        //查询入住总旅客人数
        $where['s_date'] = $date;
        $hotel_user = M('HotelOrderTotal')->where($where)->SUM('user_num');
        //入住1天旅客数量；比率 68%-70%
        $day1 = \sprintf("%.2f",randFloat(0.68,0.70) * $hotel_user);
        //入住2天旅客数量；比率 25%-28%
        $day2 = \sprintf("%.2f",randFloat(0.25,0.28) * $hotel_user);
        //入住3天以上旅客；比率 68%-70%
        $day3 = $hotel_user-($day1+$day2);
        $day = array(
            ['day'=>$day1,'avg_day'=>\sprintf("%.2f",randFloat(0.2,1))],
            ['day'=>$day2,'avg_day'=>\sprintf("%.2f",randFloat(1.6,2))],
            ['day'=>$day3,'avg_day'=>\sprintf("%.2f",randFloat(2.6,3.9))],
        );
        foreach ($day as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['user_num'] = $v['day'];
            $data[$k]['s_day'] = $k+1;
            $data[$k]['day_avg'] = $v['avg_day'];
            $data[$k]['created'] = \time();
        }
        //插入数据
        //删除同一天数据
        M('hotelStaydays')->where($where)->delete();
        //插入数据到酒店来源地址表
        HotelModel::addHotelStaydays($data);
    }

    /**
     * 酒店预定渠道
     *
     */
    private function addBookingChannel($date){
        //按规则随机生成总数
        $rankNum = \mt_rand(350,450);
        //节假日换算
        $num = \isHoliday($date,$rankNum);
        $rankNum = $num['num'];
        //各自渠道的占比
        $ctrip = \round(randFloat(0.21,0.23),2);
        $qunar = \round(randFloat(0.26,0.28),2);
        $meituan = \round(randFloat(0.15,0.18),2);
        $tuniu = \round(randFloat(0.12,0.15),2);
        $elong = \round(randFloat(0.08,0.12),2);
        $other = 1-$ctrip-$qunar-$meituan-$tuniu-$elong;
        $channel_arr = array($ctrip,$qunar,$meituan,$tuniu,$elong,$other);
        $channel_list = M('hotelChannel')->select();
        foreach ($channel_list as $k=>$v){
            $data[$k]['app_id'] = $v['id'];
            $data[$k]['s_date'] = $date;
            $data[$k]['user_num'] = sprintf("%.0f",($rankNum * $channel_arr[$k]));
            $data[$k]['created'] = \time();
        }
        M('hotelBookingChannel')->where(['s_date'=>$date])->delete();
        //插入数据库
        HotelModel::addBookingChannel($data);
        //酒店预订分销占比
        $this->addHotelSaleChannel($date,$rankNum);
    }


    /**
     * 酒店分销占比
     * 公式：
     * 总客房=每天总接待客流*入住比例/2
     * 分销数量=预定数量*2
     * 直销数量=总客房-分销数量
     */
    public function addHotelSaleChannel($date,$rankNum){
        //获取每天入住人数
        $where['s_date']= $date;
        //获取总人数
        $visitor_user = M('VisitorDay')->field('SUM(user_num) user_num')->where($where)->find()['user_num'];
        //如果查询失败，按平日随机规则随机生存一个
        if($visitor_user == false){
            $visitor_user = sprintf("%.0f", \mt_rand(28000,34000) *  \randFloat(0.08,0.12));
            $num = \isHoliday($date,$visitor_user);
            $visitor_user = $num['num'];
        }
        //总客房=每天总接待客流*入住比例/2
        $hotel_room = sprintf("%.0f",($visitor_user * \randFloat(0.3,0.5)) /2);
        $data['s_date'] =$date;
        //分销数量
        $data['direct_num'] = $rankNum * 2;
        //直销数量
        $data['distribute_num'] = ($hotel_room-$rankNum);
        $data['created'] = \time();
        //BookingChannel
        //删除同天数据
        M('HotelSaleChannel')->where($where)->delete();
        HotelModel::addHotelSaleChannel($data);

    }


    /**
     * 酒店预定分布
     * 1星级型、2经济型、3民宿其他
     * 不分节假日
     */
    private function addFavoriteHotel($date){
        M('hotelFavorite')->where(['s_date'=>$date])->delete();
        //星级型
        $star =  sprintf("%.2f",randFloat(30,35));
        //经济型
        $econo =  sprintf("%.2f",randFloat(40,45));
        //民宿其他
        $other = 100-$star-$econo;
        $type = array($star,$econo,$other);
        foreach ($type as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['occupancy_rate'] = $v;
            $data[$k]['type'] = $k+1;
            $data[$k]['created'] = \time();
        }
        HotelModel::addFavoriteHotel($data);
    }


    /**
     * 酒店旅客入住男女性别统计
     * @param $date
     *
     */
    private function addHotelUserSex($date){
        $where['s_date'] = $date;
        //删除数据，
        M('HotelVisitorSex')->where($where)->delete();
        //查询每天酒店的总人数
        $hotel_user = M('hotelOrderTotal')->where($where)->SUM('user_num');
        //男性与女性人数
        $male = sprintf("%.2f",randFloat(0.45,0.55));
        $male_num =  sprintf("%.0f",$hotel_user * $male);
        $female_num = $hotel_user - $male_num;
        $data = array(
            's_date'=>$date,
            'male_num'=>$male_num,
            'female_num'=>$female_num,
            'created'=>\time(),
        );
        //添加男女性别
        HotelModel::addHotelUserSex($data);
        //添加旅客年龄占比
        $this->addHotelUserAge($date,$hotel_user);
        //旅客来源地区
        $this->addHotelArea($date,$hotel_user);
    }

    /**
     * 酒店旅客年龄占比
     * @param $date
     * @param $hotel_user 旅客总数
     *  类型：1、14岁以下；2、15-24岁；3、25-34岁；4、35-44岁；5、45-54岁；6、65岁以上
     * @users liurg
     */
    private function addHotelUserAge($date,$hotel_user){
        $where['s_date'] = $date;
        M('hotelVisitorAge')->where($where)->delete();
        //年龄占比随机
        $type1 = sprintf("%.0f",randFloat(0.03,0.04) * $hotel_user);
        $type2 = sprintf("%.0f",randFloat(0.08,0.10) * $hotel_user);
        $type3 = sprintf("%.0f",randFloat(0.15,0.17) * $hotel_user);
        $type4 = sprintf("%.0f",randFloat(0.26,0.28) * $hotel_user);
        $type5 = sprintf("%.0f",randFloat(0.36,0.38) * $hotel_user);
        $type6 = $hotel_user-$type1-$type2-$type3-$type4-$type5;
        $type = array($type1,$type2,$type3,$type4,$type5,$type6);
        //随机年龄平均
        $age = array(
            sprintf("%.2f",\randFloat(0,14)),
            sprintf("%.2f",\randFloat(15,24)),
            sprintf("%.2f",\randFloat(25,34)),
            sprintf("%.2f",\randFloat(35,44)),
            sprintf("%.2f",\randFloat(45,54)),
            sprintf("%.2f",\randFloat(65,70)),
        );
        foreach ($type as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['age_phase'] = $k+1;
            $data[$k]['user_num'] = $type[$k];
            $data[$k]['age_avg'] = $age[$k];
            $data[$k]['created'] = \time();
        }
        HotelModel::addHotelUserAge($data);
    }

    /**
     * 酒店旅客地区
     * @param $date 日期 yyyymmdd
     * @param $hotel_user  酒店旅客接待总数
     */
    private function addHotelArea($date,$hotel_user){
        //查询客流总人数（每天总接待客流*每天住宿的比例（30%-50%）*客流分省的比例）
        $where['s_date']= $date;
        //删除同一天数据
        M('hotelVisitorArea')->where($where)->delete();
        //获取总人数
       // $visitor_user = M('VisitorDay')->field('SUM(user_num) user_num')->where($where)->find()['user_num'];
        //如果查询失败，按随机规则随机生存一个
//        if($visitor_user == false){
//            $visitor_user_total = \mt_rand(28000,34000);
//            //节假日倍数换算,暑假乘以 1.8倍、休息日1.2倍、平常正常
//            $return = \isHoliday($date,$visitor_user_total);
//            $visitor_user  = $return['num'];
//        }
//        比例浮动范围
        $float = array(-0.0045,0,0.0045);
//        $hotel_user = sprintf("%.0f",($visitor_user * \randFloat(0.08,0.12)* $return['multiple']));
        //随机比例 正负浮动0.45
        $area =array(
            //山东 随机增加比例、省id、城市ID
            ['proportion'=>0.129 + $float{\mt_rand(0,2)},'province_id'=>1964,'city_id'=>1965],
            //上海
            ['proportion'=>0.105 + $float{\mt_rand(0,2)},'province_id'=>801,'city_id'=>802],
            //陕西
            ['proportion'=>0.096 + $float{\mt_rand(0,2)},'province_id'=>2898,'city_id'=>2899],
            //北京
            ['proportion'=>0.083 + $float{\mt_rand(0,2)},'province_id'=>1,'city_id'=>2],
            //江苏
            ['proportion'=>0.077 + $float{\mt_rand(0,2)},'province_id'=>820,'city_id'=>821],
            //浙江
            ['proportion'=>0.051 + $float{\mt_rand(0,2)},'province_id'=>933,'city_id'=>934],
            //河北
            ['proportion'=>0.047 + $float{\mt_rand(0,2)},'province_id'=>37,'city_id'=>38],
            //河南
            ['proportion'=>0.043 + $float{\mt_rand(0,2)},'province_id'=>1532,'city_id'=>1533],
            //四川
            ['proportion'=>0.04 + $float{\mt_rand(0,2)},'province_id'=>2367,'city_id'=>2368],
            //湖北
            ['proportion'=>0.035 + $float{\mt_rand(0,2)},'province_id'=>1709,'city_id'=>1710],
        );
        foreach ($area as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['province_id'] = $v['province_id'];
            $data[$k]['city_id'] = $v['city_id'];
            $data[$k]['user_num'] =  sprintf("%.0f",$v['proportion'] * $hotel_user);
        }
        //插入数据到酒店来源地址表
        HotelModel::addHotelUserArea($data);
    }
}