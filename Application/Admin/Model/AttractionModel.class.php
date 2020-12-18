<?php
namespace Admin\Model;
use Think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 9:29
 */
class AttractionModel extends Model{
    /**
     * 景区实时客流
     */
    static public function getRealVisitorFlow(){
        $data = [];
        $s_date = date('Ymd',time());
        $s_time = date('H',time());
        $where['s_time'] = array('between',['09',$s_time]);
        $list = M('visitorRealSpot')->field('SUM(user_num) num,s_time')->where($where)->where(['s_date' => $s_date])->group('s_time')->select();

        if(!empty($list)){
            foreach($list as &$v){
                $v['s_time'] = ltrim($v['s_time'],'0');
                $v['s_time'] = $v['s_time'].':00';
            }
            $data['num'] = array_column($list,'num');
            $data['s_time'] = array_column($list,'s_time');
        }
        return $data;
    }
    /**
     * 景区客流统计
     */
    static function getVisitorCount($where){
        $data = [];
        //景区客流统计
        $visitor_flow= M('scenicFlowDay')->field('SUM(user_num) num,s_date ')->where($where)->group('s_date')->select();
        //景区排名
        $rank = self::getSpotRank($where);
        if(!empty($visitor_flow)){
            $date = array_column($visitor_flow,'s_date');
            foreach ($date as &$v){
                $v = ltrim(date('m.j',strtotime($v)),'0');
//                $v = ltrim(date('m.d',strtotime($v)),'0');
            }
            $data['num'] = array_column($visitor_flow,'num');
            $data['s_date'] = $date;
            $data['rank'] = !empty($rank) ? $rank : [];
        }
        return $data;
    }
    /**
     * 景区排名
     */
    static function getSpotRank($where){
        //景区排名
        $rank = M('scenicFlowDay')->alias('a')->field('SUM(a.user_num) num,b.name name')
            ->join('left join ff_scenic b on a.scenic_id = b.id')
            ->where($where)
            ->group('scenic_id')->order('num desc')->select();
        return $rank;
    }
    /**
     * 获取客流人数 （今天 昨天 近七天 本月  本年度）
     */
    static public function getVisitorNum($param){
        //获取近七天的数据
        $db = M('scenicFlowTotal');
        $week_list= $db->field('SUM(user_num) week_num ')->where($param)->find();
        //获取 除了近七天数据以外的数据
        $where = ['s_date' => date('Ymd',time())];
        $list = $db->field('user_num,yesterday_total,month_total,tear_total')->where($where)->find();
        if(9<date('H',time())+0 && date('H',time())+0<= 19){
            $list['user_num'] = round($list['user_num']*(date('H',time())+0)/19);
            $list['tear_total'] = round($list['tear_total']+$list['user_num']);
            if(date('d',time())+0 == '1'){
                $list['month_total'] = $list['user_num'];
            }else{
                $list['month_total'] = round($list['month_total']+$list['user_num']);
            }
        }elseif(date('H',time())+0<= 9){
            $list['user_num'] = 0;
            if(date('d',time())+0 == '1'){
                $list['month_total'] = 0;
            }
        }
        if(date('md',time())+0 == '0101'){
            $list['tear_total'] = $list['month_total'];
        }
        $list = !empty($list) ? $list : [];
        $week_list = !empty($week_list) ? $week_list : [];
        $data = array_merge($week_list,$list);
        return $data;
    }
    /**
     * 景区客流统计
     */
    static public function getVisitorNumByDate($where){
        $data = [];
        $db = M('scenicFlowDay');
        $week_list= $db->field('SUM(user_num) num,s_date ')->where($where)->group('s_date')->select();
        foreach ($week_list as $k =>$v){
            $data['s_date'][$k] = \date('n.j',\strtotime($v['s_date']));
            $data['num'][$k] = $v['num'];
        }
        return $data;
    }
    /**
     * 景区车流统计
     */
    static public function getCarNumByDate($where){
        $data = [];
        $db = M('scenicFlowDay');
        $carNum= $db->field('SUM(car_num) num,s_date ')->where($where)->group('s_date')->select();
        foreach ($carNum as $k =>$v){
            $data['s_date'][$k] = \date('n.j',\strtotime($v['s_date']));
            $data['num'][$k] = $v['num'];
        }
        return $data;
    }
    /**
     * 景区游客客源地统计
     */
    static public function getVisitorFrom($where){
        $data = [];
        $db = M('scenicFlowArea');
        $list = $db->alias('a')->field('SUM(a.user_num) num,b.shortname name')
            ->join('left join ff_area b on a.province_id = b.id')
            ->where($where)
            ->group('province_id')->order('user_num desc')->select();
        if($list){
            $data['max'] = max(array_column($list,'num'));
            foreach ($list as $k =>$v){
                $data['data'][$k]['name'] = $v['name'];
                $data['data'][$k]['value'] = $v['num'];
            }
        }
        return $data;
    }
    /**
     * 客源地省份top10
     */
    static public function getVisitorFromByProvince($where){
        $db = M('scenicFlowArea');
        $list = $db->alias('a')->field('SUM(a.user_num) age,b.shortname name')
            ->join('left join ff_area b on a.province_id = b.id')
            ->where($where)
            ->group('province_id')->order('age desc')->limit(10)->select();
        sort($list);
        return $list;
    }
    /**
     * 客源地城市top10
     */
    static public function getVisitorFromByCity($where){
        $db = M('scenicFlowArea');
        $data = $db->alias('a')->field('SUM(a.user_num) age,b.shortname name')
            ->join('left join ff_area b on a.city_id = b.id')
            ->where($where)
            ->group('city_id')->order('age desc')->limit(10)->select();
        foreach($data as &$v){
            $v['age'] = round(0.55*$v['age']);
        }
        sort($data);
        return $data;
    }
    /*
     * 获取游客性别统计
     */
    static public function getVisitSex($where){
        $data = [];
        $db = M('visitorSex');
        $list= $db->field('SUM(male_num) men,SUM(female_num) women ')->where($where)->select();
        if($list){
            $data['num'] = array_sum($list[0]);
            $data['data'] = $list[0];
        }
        return $data;
    }
    /**
     * 获取游客年龄统计
     */
    static public function getVisitorAge($where){
        $data = [];
        $db = M('visitorAge');
        $list= $db->field('SUM(user_num) num,age_phase,avg(age_avg) age_avg')->where($where)->group('age_phase')->select();
        if($list){
            $age_count = count(array_column($list,'age_avg'));
            $data['age_avg'] = round(array_sum(array_column($list,'age_avg'))/$age_count,1);
            foreach($list as $k => $v){
                $data['data'][$k]['name'] = $v['age_phase'];
                $data['data'][$k]['value'] = $v['num'];
            }
        }
        return $data;
    }
    /**
     * 景区游客客流TOP10
     */
    static public function getVisitorFlow($where){
        $data = [];
        $db = M('scenicFlowDay');
        $list = $db->alias('a')->field('SUM(a.user_num) num,b.name name')
            ->join('left join ff_scenic b on a.scenic_id = b.id')
            ->where($where)
            ->group('scenic_id')->order('num desc')->limit(10)->select();
        if($list){
            $data['num'] = array_column($list,'num');
            $data['name'] = array_column($list,'name');
            foreach ($data['num'] as $k => $v){
                $data['radio'][$k] = round(($v/array_sum($data['num']))*100,2);
            }
        }
        return $data;
    }
    /**
     * 景区近七天平均值统计
     */
    static public function getWeekAvg($where){
        $visit_stay_db = M('visitorStay');
        //游客平均停留时长
        $visit_time= $visit_stay_db->field('avg(avg_day) stay_time')->where($where)->find();
        //平均提前预定天数
        $visit_fix_db = M('ticketReservations');
        $visit_fix = $visit_fix_db->field('avg(day_phase) fix_time')->where($where)->find();
        //车辆平均停留时间
        $visit_car_db = M('scenicFlowArea');
        $visit_car = $visit_car_db->field('avg(car_stay) car_time')->where(['car_stay'=>['neq',0]])->where($where)->find();
        //游客平均年龄
        $visit_age_db = M('visitorAge');
        $visit_age = $visit_age_db->field('avg(age_avg) age_avg')->where($where)->find();
        $data['age_avg'] = !empty($visit_age)?round($visit_age['age_avg'],1) : 0;
        $data['visit_time'] = !empty($visit_time)?round($visit_time['stay_time'],1) : 0;
        $data['visit_fix'] = !empty($visit_fix)?round($visit_fix['fix_time'],1) : 0;
        $data['visit_car'] = !empty($visit_car)?round($visit_car['car_time'],1) : 0;
        return $data;
    }
}