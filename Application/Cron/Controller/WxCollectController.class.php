<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 9:47
 */
namespace Cron\Controller;
use Think\Controller;
use Cron\Model\WxCollectModel;
\define('DAYDATE',date('Y-m-d',NOW_TIME-3600*24));

class WxCollectController extends Controller{
    /**
     * 微信用户数据
     */
    public function addUserTotal(){
        $msg = '';
        $ymd = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : DAYDATE;
        $model = new WxCollectModel();
        $rs = $model->addUserTotal($ymd,$msg);
        echo $rs;
    }
    /**
     * 微信文章数据
     */
    public function addArticleTotal(){
        $msg = '';
        $ymd = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : DAYDATE;
        $model = new WxCollectModel();
        $rs = $model->addArticleTotal($ymd,$msg);
        echo $rs;
    }

    /**
     * 获取酒店id和酒店名称
     */
    public function addHotal(){
        $start_id = \I('start_id');
        $end_id = \I('end_id');
        $model = new WxCollectModel();
        $rs = $model->addHotal($start_id,$end_id);
        echo $rs;
    }
    /**
     * 获取团购酒店id和酒店名称
     */
    public function addTuanHotal(){
//        $page_num = \I('page_num');
        $start_page = \I('start_page') ? \I('start_page'): 1;
        $end_page = \I('end_page') ? \I('end_page') : 1;
//        $page_num = isset($page_num) && is_numeric($page_num)? \I('page_num') : 1;
        $model = new WxCollectModel();
        for($i = $start_page;$i<=$end_page; $i++){
            $rs = $model->addTuanHotal($i);
        }
    }
    /**
     * 客栈民宿
     */
    public function addHomestay(){
        $start_id = \I('start_id');
        $end_id = \I('end_id');
        $model = new WxCollectModel();
        $rs = $model->addHomestay($start_id,$end_id);
        echo $rs;
    }
}

