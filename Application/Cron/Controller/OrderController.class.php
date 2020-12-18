<?php
namespace Cron\Controller;
use Think\Controller;

class OrderController extends Controller{
    public function all(){

    }
    
    
    public function expired(){
        //获取要处理的时间点,默认为当前时间
        $updatedTime = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : time();
        
        //获取要处理的时间，默认为30分钟
        $expiredTime = isset($_SERVER['argv'][3]) ? $_SERVER['argv'][3] : 30;
        
        //更新订单状态，目前为逐条处理，后续可优化。
        \Yyl\Model\OrderModel::updateExpiredStatus(0, array('updatedTime'=>$updatedTime), $expiredTime);
    }
    
    public function used(){       
        $page = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : 1;
        $pageSize = isset($_SERVER['argv'][3]) ? $_SERVER['argv'][3] : 30;
        $updated = isset($_SERVER['argv'][4]) ? $_SERVER['argv'][4] : date('Y-m-d', strtotime("-1 day"));
        
        \Yyl\Model\OrderModel::updateUsedStatus(0, array('page'=>$page, 'pageSize'=>$pageSize,'updatedTime'=>$updated));
    }
    
    public function refund(){
        $updated = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : date('Y-m-d', strtotime("-1 day"));
    
        \Yyl\Model\OrderModel::updateOrderStatus(0, array('updatedTime'=>$updated));
    }
    

    /**
     * 订单、收入统计
     */
    public function orderStatistics(){
        //header('content-type:text/html;charset=utf-8');
        //获取昨天开始、结束日期
        $start = strtotime(date('Y-m-d',strtotime('-1 day')));
        $end = $start + 86400;
        \Yyl\Model\OrderModel::orderStatistics($start,$end);
        \Yyl\Model\OrderModel::incomeStatistics($start,$end);
    }
}