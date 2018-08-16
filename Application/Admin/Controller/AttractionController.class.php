<?php
namespace Admin\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/21
 * Time: 10:11
 */
use Admin\Model\AttractionModel;

\define('DAYDATE',date('Y-m-d',NOW_TIME));

class AttractionController extends AdminController{
    //本省id
    public static $province_id = 2898;
    public static $scenic_id = 1;
    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;

    /**
     * 景区分析
     */
    public function index(){
        $data = AttractionModel::getVisitorNum($this->getSql(1));
        $this->assign('data', $data);
        $this->display('scenicAreaProfile');
    }
    /**
     * 景区分析
     */
    public function passengerFlow(){

        $this->display('scenicAreaPassengerFlow');
    }
    /**
     * 搜索条件
     */
    private function getSql($s_day){
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        return $where;
    }
    /**
     * 获取天数
     */
    private function getDayNum($s_day){
        switch ($s_day){
            case 1: // 7天
                $start_t =  (NOW_TIME - $this::LAST_TIME7);
                break;
            case 2: // 30天
                $start_t =  (NOW_TIME - $this::LAST_TIME30);
                break;
            case 3: // 90天
                $start_t =  (NOW_TIME - $this::LAST_TIME90);
                break;
            case 4: // 180天
                $start_t =  (NOW_TIME - $this::LAST_TIME180);
                break;
            case 5: // 365天
                $start_t =  (NOW_TIME - $this::LAST_TIME365);
                break;
            default:
                //默认提前7天
                $start_t =  (NOW_TIME - $this::LAST_TIME7);
        }
        return $start_t;
    }
    /**
     * 景区客流统计
     */
    public function getVisitorNumByDate(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorNumByDate($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 景区车流统计
     */
    public function getCarNumByDate(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getCarNumByDate($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 景区游客客源地统计
     */
    public function getVisitorFrom(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorFrom($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 客源地省份top10
     */
    public function getVisitorFromByProvince(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorFromByProvince($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 客源地城市top10
     */
    public function getVisitorFromByCity(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorFromByCity($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /*
     * 获取游客性别统计
     */
    public function getVisitSex(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitSex($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取游客年龄统计
     */
    public function getVisitorAge(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorAge($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 景区游客客流TOP10
     */
    public function getVisitorFlow(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorFlow($where);
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 景区近七天平均值统计
     */
    public function getWeekAvg(){
        $where = $this->getSql(1);//查询条件
        $data = AttractionModel::getWeekAvg($where);
        if($data){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取景区实时客流
     */
    public function getRealVisitorFlow(){
        $data = AttractionModel::getRealVisitorFlow();
        if($data){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 景区客流统计
     */
    public function getVisitorCount(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = AttractionModel::getVisitorCount($where);
        if($data){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
}