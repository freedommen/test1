<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 9:47
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\WxCollectModel;
\define('DAYDATE',date('Y-m-d',NOW_TIME-3600*24));

class WxCollectController extends Controller{
    /**
     * 微信用户数据
     */
    public function addUserTotal(){
        $msg = '';
        $ymd = \I('ymd');
        $ymd = !empty($ymd) ? \I('ymd') : DAYDATE;;
        $model = new WxCollectModel();
        $rs = $model->addUserTotal($ymd,$msg);
        echo $rs;
    }
    /**
     * 微信文章数据
     */
    public function addArticleTotal(){
        $msg = '';
        $ymd = \I('ymd');
        $ymd = !empty($ymd) ? \I('ymd'): DAYDATE;
        $model = new WxCollectModel();
        $rs = $model->addArticleTotal($ymd,$msg);
        echo $rs;
    }
}