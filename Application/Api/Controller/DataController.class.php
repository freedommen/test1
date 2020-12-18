<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2017/9/15
 * Time: 下午5:22
 */

namespace Api\Controller;
use ORG\CommonController;
use ORG\ZZSL\Cmd;
use ORG\ZZSL\Des;
use Think\Controller;

class DataController extends Controller{


    /***
     * 热力图
     */
    public function getHeat(){

        $where['s_date'] = date('Ymd',NOW_TIME);
        $where['s_time'] = array('elt', \date('H:i',NOW_TIME));
        // array('between',[$start_time,$end_time]);
        $db = M('visitorReal');
        // FROM_UNIXTIME(s_time,'%H:%i')
        $list = $db->field("s_date,s_time,total_user_num,user_num,lng,lat")
            ->where($where)->order('s_date asc,s_time desc')->group('s_time')->limit(200)->select();
        array_multisort($list,'s_time','SORT_ASC','SORT_NUMERIC');
        $list = arraySort($list,'s_time','SORT_ASC');
        $data =array();
        foreach ($list as $k=>$v){
//            if($v['s_time'] < \date('H',NOW_TIME)){
            $data['s_time'][$k] = $v['s_time'];
            $data['user_num'][$k] = $v['user_num'];
            $data['total_user_num'] = $v['user_num'];
            if($v['user_num'] > 20000){
                $rand = \rand(150,300);
            }else{
                $rand = \rand(20,150);
            }
            $data['position'][$k]  = array( 'lng'=>$v['lng'],'lat'=>$v['lat'],'count'=>$rand);
//            }

        }
        //当前小时  如 生成一条数据(1小时/1条数据)
        $day_h = \date('H',NOW_TIME);
        if($day_h >18 || $day_h < 7){
//            $data['total_user_num'] = 0;
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data['position']);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);

    }


    /**
     * 游客来源来源
     */
    public function getSourceArea(){
        //从元月1号到昨日 时间段
        //省
        $start_time =date('Y0101',\time());
        $end_time = date("Ymd",strtotime("-1 day"));

        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('VisitorCity');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.province_id,b.name')
            ->join('left join ff_area b on a.province_id = b.id')
            ->order('user_num desc')->group('province_id')
            ->where($where)->limit(10)->select();
        foreach ($list as $k=>$v){
            $data['province'][$k] =  array('name'=>$v['name'], 'value'=>$v['user_num']);
        }
        //城市
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.city_id,b.name')
            ->join('left join ff_area b on a.city_id = b.id')->where($where)
            ->group('city_id')->order('user_num desc')->limit(10)->select();
        foreach ($list as $k=>$v){
            $data['city'][$k] = array('name'=>$v['name'], 'value'=>$v['user_num']);
        }
        //年度游客累积数
        $data['year_user'] =  M('visitorDay')->where($where)->SUM('user_num');
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * -景区客流
     */
    public function getScenicFlow(){
        //查询日期
        $start_time = \date('Ymd',strtotime("-7 day"));
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('visitorDay');
        $list= $db->field('s_date,SUM(user_num) user_num')->where($where)->group('s_date')->order('s_date asc')->select();
        foreach ($list as $k =>$v){
            $data['s_date'][$k] = \date('n.j',\strtotime($v['s_date']));
            $data['user_num'][$k] = $v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 入住率
     */
    public function getHotelOccupancy(){
        $db = \M('hotelOrderTotal');
//        $s_day = \I('s_day',7);
//        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $startTime = \date('Ymd',strtotime("-7 day"));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field("hotel_id,s_date,occupancy,SUM(user_num) user_num")->where($where)->order('s_date asc')->group('s_date')->select();
        $occupancy_total = '';
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = date('n.j' ,\strtotime($v['s_date']));
            $data['occupancy'][$k] = $v['occupancy'];
            $data['user_num'][$k] = $v['user_num'];
            $occupancy_total += $v['occupancy'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }




}