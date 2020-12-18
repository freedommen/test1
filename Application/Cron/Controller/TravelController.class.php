<?php
namespace Cron\Controller;


//use Think\Controller;
use Cron\Model\TravelModel;


class TravelController //extends Controller
{

    public function autoLoad(){
        $startdate = $_SERVER['argv'][2] ? $_SERVER['argv'][2] : 20170601;
        $enddate = $_SERVER['argv'][3] ? $_SERVER['argv'][3] : 20181231;
        $data_arr = $this->getDateFromRange($startdate, $enddate);
       // $ymd = date('Ymd', \time());
        foreach ($data_arr as $v){
            $this->addTravelAgency($v);
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


    /**
     * 组团和地接行程数
     */
    private function addTravelAgency($date){
        //地接笔数
        $local_num = \rand(15,25);
        //旅客人数
        $local_usernum = \rand(20,40);
        //组团笔数
        $group_num = \rand(5,15);
        //旅客人数
        $group_usernum = \rand(20,40);
        //变更笔数
        $midify = \rand(0,1);
        $data['s_date'] = $date;
        $data['local_ordernum']     = $local_num;
        $data['local_usernum']      = $local_num * $local_usernum;
        $data['group_ordernum']     =  $group_num;
        $data['group_usernum']      = $group_num * $group_usernum;
        $data['midify_ordernum']    = $midify;
        $data['created'] = $date;
        TravelModel::addTravelAgency($data);
        $this->addTravelTotal($date,$midify,$local_num+$group_num);
    }

    /**
     * 团队运作情况
     */
    private function addTravelTotal($date,$midify,$conduct_ordernum){
        $data['s_date'] = $date;
        // 计划中
        $data['plan_ordernum'] = \rand(10,20);
        //进行中
        $data['conduct_ordernum'] =$conduct_ordernum;  //\rand(10,20);
        //结束笔数
        $data['ends_ordernum'] = \rand(10,20);
        //导游人数
        $data['guide_usernum'] = \rand(30,45);
        //变更笔数
        $data['midify_ordernum'] = $midify;
        $data['created'] = \time();
        TravelModel::addTravelTotal($data,$midify);
    }




}