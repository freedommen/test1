<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/6/14
 * Time: 下午3:45
 */

namespace Cron\Controller;


class HolidayController
{

    /**
     * type 假日类型 1、国庆  2端午 3劳动 4中秋
     */
    public function  autoload(){
        //劳动节 2018
        $date = $this->getDateFromRange(20180426,20180504);
        foreach ($date as $k=>$v){
            $rate = isHoliday($v)['multiple'];
            $this->addHoliday($v,3,$rate);
        }
        //端午节
        $date = $this->getDateFromRange(20180613,20180621);
        foreach ($date as $k=>$v){
            $rate = isHoliday($v)['multiple'];
            $this->addHoliday($v,2,$rate);
        }
        //国庆节 2017年
        $date = $this->getDateFromRange(20170924,20171014);
        foreach ($date as $k=>$v){
            $rate = isHoliday($v)['multiple'];
            $this->addHoliday($v,1,$rate);
        }
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


    public function addHoliday($date,$type=1,$rate=1){
        //景区 顺序与占比 法门寺、七星河、野河山、关中风情园
//        $scenic = M('scenic')->where(['status'=>1])->select();
        switch ($type){
            //国庆节 占比
            case 1: $proportion = array(20.76,31.67,5.38,3.63);
                break;
                //端午节 占比
            case 2: $proportion = array(8.33,17.01,6.1,4.12);
                break;
                //劳动节 占比
            case 3: $proportion =  array(7.56,16.25,6.27,3.98);
                break;
            default:

        }
        //旅客总人数
        $tourist = \rand(28000,34000) * $rate;
        //景区客流 法门寺
        $scenic1 = \rand(20000,26000) * $rate;
        //七星河
        $scenic2 = \rand(800,1000) * $rate;
        //野河山
        $scenic3 = \rand(300,500) * $rate;
        //关中风情园
        $scenic4 = \rand(1000,1500) * $rate;
        $scenic_arr = array(
            ['scenic_id'    => 1, 'user_num'    =>  $scenic1],
            ['scenic_id'    => 2, 'user_num'    =>  $scenic2],
            ['scenic_id'    => 3, 'user_num'    =>  $scenic3],
            ['scenic_id'    => 4, 'user_num'    =>  $scenic4],
        );
        //        比例浮动范围
        $float = array(-0.0045,0,0.0045);
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
        //用于假日客流统计
        $datetime = \strtotime($date);
        $db = M('visitorHoliday');
        //同比 上一年
        $increase_date = \date('Ymd',strtotime("-1year",$datetime));
        $increase_user = $db->where(['s_date'=>$increase_date])->getField('user_num');
        $increase = sprintf("%.2f",($tourist-$increase_user) /$increase_user *100);
        if($increase_user == null){
            $increase = \sprintf("%.2f",\randFloat(05,25));
        }
        //环比上期
        $ratio_date  = \date('Ymd',strtotime("-1month",$datetime));
        $ratio_user = M('visitorDay')->field('SUM(user_num) user_num')->where(['s_date'=>$ratio_date])->find()['user_num'];
        $ratio = sprintf("%.2f",($tourist-$ratio_user) /$ratio_user *100);
        if($ratio_user == null){
            $ratio = \sprintf("%.2f",\randFloat(10,25));
        }
        $data =array();
        $data['s_date'] = $date;
        $data['type'] = $type;
        $data['user_num'] = $tourist;
        $data['increase'] = $increase;
        $data['ratio'] = $ratio;
        $db->add($data);
        //重点区域客流排行
        $data =array();
        foreach ($scenic_arr as $k=>$v){
            $data[$k]['s_date'] = $date;
            $data[$k]['type'] = $type;
            $data[$k]['scenic_id'] = $v['scenic_id'];
            $data[$k]['user_num'] = $v['user_num'];
            $data[$k]['proportion'] = $proportion[$k];
            $data[$k]['created'] = \time();
        }
        M('visitorHolidayScenic')->addAll($data);
        //来源地区
        $data =array();
        foreach ($area as $k=>$v){
            $user_num = sprintf("%.0f",$v['proportion'] * $tourist);
            $data[$k]['s_date'] = $date;
            $data[$k]['province_id'] = $v['province_id'];
            $data[$k]['city_id'] = $v['city_id'];
            $data[$k]['user_num'] =  $user_num;
            $data[$k]['created'] = \time();
        }
        M('visitorHolidayArea')->addAll($data);
        unset($data);
    }


}