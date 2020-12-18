<?php
namespace Cron\Controller;


//use Think\Controller;


class VisitorController //extends Controller
{

    public function autoLoad(){

        $startdate = $_SERVER['argv'][2] ? $_SERVER['argv'][2] : 20170801;
        $enddate = $_SERVER['argv'][3] ? $_SERVER['argv'][3] : 20181231;
        $data_arr = $this->getDateFromRange($startdate, $enddate);

       // $ymd = date('Ymd', \time());
        foreach ($data_arr as $ymd){
            //入住统计
            $this->addVisitorDay($ymd);
        }

        echo ' ---| End-All |--- ';
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
        return $date;
    }


    /**
     * 游客统计、按景区，需每天执行。
     * 景区id为表示非景区
     * @param $date 日期格式 yyyymmdd
     * @user liurg
     */
    public function addVisitorDay($date)
    {
        M('VisitorRealSpot')->where(['s_date'=>$date])->delete();
        M('VisitorDay')->where(['s_date'=>$date])->delete();
        //旅客总人数
        $isHoliday = isHoliday($date);
        $rate = $isHoliday['multiple'];
        $tourist = \rand(28000,34000) * $rate;
        //景区客流 法门寺
        $scenic1 = \rand(20000,26000) * $rate;
        //七星河
        $scenic2 = \rand(800,1000) * $rate;
        //野河山
        $scenic3 = \rand(300,500) * $rate;
        //关中风情园
        $scenic4 = \rand(1000,1500) * $rate;
        $other = $tourist-$scenic1-$scenic2-$scenic3-$scenic4;
        if($other < 0) {
            $other = 0;
        }
        $proportion_rate1 = sprintf("%.2f",\randFloat(-1,2));
        $proportion_rate2 = sprintf("%.2f",\randFloat(-1,2));
        $proportion_rate3 = sprintf("%.2f",\randFloat(0,2));
        $proportion_rate4 = sprintf("%.2f",\randFloat(0,2));
        //获取所有景区
        $scenic_arr = array(
            ['scenic_id'    => 1, 'user_num'    =>  $scenic1, 'proportion' => 20.76+$proportion_rate1, 'scenic_user_min' =>4000, 'scenic_user_max'=>5000 ],
            ['scenic_id'    => 2, 'user_num'    =>  $scenic2, 'proportion' => 31.67+$proportion_rate2,'scenic_user_min' => 500,'scenic_user_max' =>800],
            ['scenic_id'    => 3, 'user_num'    =>  $scenic3, 'proportion' => 5.38+$proportion_rate3,'scenic_user_min' => 150,'scenic_user_max'=>300],
            ['scenic_id'    => 4, 'user_num'    =>  $scenic4, 'proportion' => 3.63+$proportion_rate4,'scenic_user_min' => 800,'scenic_user_max'=>1200],
            ['scenic_id'    => 0, 'user_num'    =>  $other ,'proportion' =>0],
        );
        //景区每小时客流 9点为零，10-16点 4000-5000。17-19 按照33%减少，
        $time_arr = array(9,10,11,12,13,14,15,16,17,18,19);

        //景区客流
       // $scenic_arr = M('scenic')->where('status=1')->select();
        $data =array();
        foreach ($scenic_arr as $k => $v) {
            //是否是重点区域
            $key_area = ($v['scenic_id'] >0) ? 1 :0;
            $data[$k]['s_date'] = $date;
            $data[$k]['scenic_id'] = $v['scenic_id'];
            $data[$k]['spot_id'] = $v['scenic_id'];
            $data[$k]['key_area'] = $key_area;
            $data[$k]['user_num'] = $v['user_num'];
            $data[$k]['saturation'] = $v['proportion'];
            $data[$k]['created'] = \time();
            //小时
            if($v['scenic_id'] > 0){
                foreach ($time_arr as $kk=>$vv){
                    if($vv == 9) {
                        $s_num =0;
                    }elseif($vv >9 && $vv < 17){
                        $s_num = \rand($v['scenic_user_min'],$v['scenic_user_max']);
                    }else{
                        //17-19点 按照33%持续减少，
                        $s_num =sprintf("%.0f", ($scenic_data[$kk-1]['user_num'])* 0.33);
                    }
                    $scenic_data[$kk]['user_num'] = $s_num;
                    $scenic_data[$kk]['s_date'] = $date;
                    $scenic_data[$kk]['s_time'] = $vv;
                    //景点
                    $scenic_data[$kk]['scenic_id'] = $v['scenic_id'];
                    $scenic_data[$kk]['spot_id'] = $v['scenic_id'];
                    //景区占比
                    $scenic_data[$kk]['saturation'] = $v['proportion'];
                    $scenic_data[$kk]['created'] = \time();
                }
                M('VisitorRealSpot')->addAll($scenic_data);
            }
        }
//        \dump($scenic_arr);
        M('VisitorDay')->addAll($data);
        //客流地区
        $this->addVisitorArea($date,$tourist);
        //客流性别
        $this->addVisitorUserSex($date,$tourist);
        //旅客年龄占比
        $this->addVisitorUserAge($date,$tourist);
    }


    /**
     * 旅客地区
     * @param $date 日期 yyyymmdd
     * @param $total_user   接待总人数
     */
    private function addVisitorArea($date,$total_user){
        $float = array(-0.0045,0,0.0045);
//        $hotel_user = sprintf("%.0f",($visitor_user * \randFloat(0.08,0.12)* $return['multiple']));
        //随机比例 正负浮动0.45
        $area =array(
            //山东 随机增加比例、省id、城市ID
            ['proportion'=>0.129 + $float{\rand(0,2)},'province_id'=>1964,'city_id'=>1965],
            //上海
            ['proportion'=>0.105 + $float{\rand(0,2)},'province_id'=>801,'city_id'=>802],
            //陕西
            ['proportion'=>0.096 + $float{\rand(0,2)},'province_id'=>2898,'city_id'=>2899],
            //北京
            ['proportion'=>0.083 + $float{\rand(0,2)},'province_id'=>1,'city_id'=>2],
            //江苏
            ['proportion'=>0.077 + $float{\rand(0,2)},'province_id'=>820,'city_id'=>821],
            //浙江
            ['proportion'=>0.051 + $float{\rand(0,2)},'province_id'=>933,'city_id'=>934],
            //河北
            ['proportion'=>0.047 + $float{\rand(0,2)},'province_id'=>37,'city_id'=>38],
            //河南
            ['proportion'=>0.043 + $float{\rand(0,2)},'province_id'=>1532,'city_id'=>1533],
            //四川
            ['proportion'=>0.04 + $float{\rand(0,2)},'province_id'=>2367,'city_id'=>2368],
            //湖北
            ['proportion'=>0.035 + $float{\rand(0,2)},'province_id'=>1709,'city_id'=>1710],
        );
        $data =array();
        foreach ($area as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['province_id'] = $v['province_id'];
            $data[$k]['city_id'] = $v['city_id'];
            $data[$k]['user_num'] =  sprintf("%.0f",$v['proportion'] * $total_user);
            $data[$k]['created'] = \time();
        }
        //删除同一天数据
        $where['s_date']= $date;
        M('VisitorCity')->where($where)->delete();
        //插入数据到酒店来源地址表
        M('VisitorCity')->addAll($data);
    }


    /**
     * 旅客入住男女性别统计
     * @param $date 日期yyyymmdd
     * @param $total_user 总游客数量
     *
     */
    public function addVisitorUserSex($date,$total_user){
        //男性与女性人数
        $male = sprintf("%.2f",randFloat(0.45,0.55));
        $male_num =  sprintf("%.0f",$total_user * $male);
        $female_num = $total_user - $male_num;
        //删除之前数据，
        M('HotelVisitorSex')->where(['s_date'=>$date])->delete();
        $data = array(
            's_date'=>$date,
            'male_num'=>$male_num,
            'female_num'=>$female_num,
            'created'=>\time(),
        );
        //添加男女性别
        M('VisitorSex')->add($data);
    }

    /**
     * 旅客年龄占比
     * @param $date
     * @param $hotel_user 旅客总数
     *  类型：1、14岁以下；2、15-24岁；3、25-34岁；4、35-44岁；5、45-54岁；6、65岁以上
     * @users liurg
     */
    private function addVisitorUserAge($date,$total_user){
        M('VisitorAge')->where(['s_date'=>$date])->delete();
        //年龄占比随机
        $type1 = sprintf("%.0f",randFloat(0.03,0.04) * $total_user);
        $type2 = sprintf("%.0f",randFloat(0.08,0.10) * $total_user);
        $type3 = sprintf("%.0f",randFloat(0.15,0.17) * $total_user);
        $type4 = sprintf("%.0f",randFloat(0.26,0.28) * $total_user);
        $type5 = sprintf("%.0f",randFloat(0.36,0.38) * $total_user);
        $type6 = $total_user-$type1-$type2-$type3-$type4-$type5;
        $type = array($type1,$type2,$type3,$type4,$type5,$type6);
        foreach ($type as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['age_phase'] =getHotelAgePhase($k+1);
            $data[$k]['user_num'] = $type[$k];
            $data[$k]['total_num'] = $total_user;
            $data[$k]['created'] = \time();
        }
        \M('VisitorAge')->addAll($data);
    }


    /**
     * 每天实时客流
     */
    public function addDataReal(){
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
                    'lng'   =>  (float)getPosition(\rand(1,20))['lng'],
                    'lat'   => (float)getPosition(\rand(1,20))['lat'],
                    'created' => NOW_TIME,
                );
                $k++;
            }
            $db->addAll($add_data);
        }
        \array_merge($list,$add_data);
        //=============假数据自造完毕===
        echo  $where['s_date'] .'--end--|';
    }



}

/**
 * 住宿旅客年龄阶段
 * 1、<16岁;2、17-24;3、25-35;4、36-46;5、47以上
 */
function getHotelAgePhase($age){
    switch ($age){
        case 1: $text = '<14岁'; break;
        case 2: $text = '15-24岁'; break;
        case 3: $text = '25-34岁'; break;
        case 4: $text = '35-44岁'; break;
        case 5: $text = '45-64岁'; break;
        default: $text = '65岁以上';
    }
    return $text;
}