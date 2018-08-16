<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/2/26
 * Time: 上午11:10
 */

namespace Admin\Controller;

use ORG\ZZSL\Cmd;
use ORG\ZZSL\Net;
use Think\Model;

class HotelController extends AdminController
{

    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;

    public function test(){
//        $url = 'http://test.clean-doctor.com/admin.php?s=/ScriptTasks/test';
//        $res = Net::post($url);
//        $this->ajaxReturn($res);
        $data = \json_decode($res,true);
        $this->ajaxReturn($data);
    }

    /**
     * 酒店分析
     */
    public function index(){

        $level = array(0=>'不限',2=>'名宿',1=>'客栈',6=>'经济型',3=>'三星级',4=>'四星级',5=>'五星级');
        $region = M('hotel_region')->field('id,name')->select();
        $this ->assign('level_list',$level);
        $this ->assign('region_list',$region);
        $this->display();
    }

    public function getHotel(){

        $level_id = \I('levelId');
        $region_id = \I('regionId');
        $keyword = \I('keyword');
        $page = \I('page',1);
        $limit = \I('limit',10);
        $db = M('Hotel');
        if(!empty($keyword)){
            $where['a.name'] = array('like','%'.$keyword.'%');
        }
        if(!empty($level_id)){
            $where['level'] = array('in',$level_id);
        }
        if(!empty($region_id)){
            $where['region_id'] = array('in',$region_id);
        }
        $list = $db->alias('a')->field('a.id,a.name,region_id,address,type,level,b.name region')
            ->join('left join ff_hotel_region b on a.region_id =b.id')
            ->where($where)->page($page,$limit)->select();
        foreach ($list as $k=>$v){
            $data['list'][$k] = $v;
            $data['list'][$k]['level'] = \getHotelLevel($v['level']);
        }
        if($list){
            //总接待人数、往日客流、往日客流洼值
            $count = $db->alias('a')->field('id,name,region_id,address,type,level')
                ->where($where)->count();
            $data['page'] = $page;
            $data['count'] = $count;
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    public function getHotelRate(){
        $hotelId = \I('hotelId','1');
        $db = \M('hotelRate');
        //当前日期
        //TODO
         $where['s_date']= \date('Ymd');
        $where['hotel_id']=  array('IN',$hotelId);
        $list['list'] = $db->alias('a')->field('a.hotel_id,s_date,daily_rate,rate_t1,rate_t2,rate_t3,rate_t4,rate_t5,rate_t6,b.name hotel_name,c.name channel_name')
            ->join('inner join ff_hotel b on a.hotel_id = b.id')
            ->join('inner join ff_hotel_channel c on a.channel_id = c.id')
//            ->group('a.hotel_id')
            ->where($where)->select();
        $i=1;
        foreach ($list['list'] as &$k ){
            $k['rank'] = $i++;
            $k['daily_rate'] = (float)$k['daily_rate'];
            $k['rate_t1'] = (float)$k['rate_t1'];
            $k['rate_t2'] = (float)$k['rate_t2'];
            $k['rate_t3'] = (float)$k['rate_t3'];
            $k['rate_t4'] = (float)$k['rate_t4'];
            $k['rate_t5'] = (float)$k['rate_t5'];
            $k['rate_t6'] = (float)$k['rate_t6'];
            $k['t1'] = (float)sprintf("%.2f",(($k['rate_t1']-$k['daily_rate'])/$k['daily_rate']) * 100);
            $k['t2'] = (float)sprintf("%.2f",(($k['rate_t2']-$k['daily_rate'])/$k['daily_rate']) * 100);
            $k['t3'] = (float)sprintf("%.2f",(($k['rate_t3']-$k['daily_rate'])/$k['daily_rate']) * 100);
            $k['t4'] = (float)sprintf("%.2f",(($k['rate_t4']-$k['daily_rate'])/$k['daily_rate']) * 100);
            $k['t5'] = (float)sprintf("%.2f",(($k['rate_t5']-$k['daily_rate'])/$k['daily_rate']) * 100);
            $k['t6'] = (float)sprintf("%.2f",(($k['rate_t6']-$k['daily_rate'])/$k['daily_rate']) * 100);
        }
        if($list){
            $list['hotelName'] = $list['list']{0}['hotel_name'];
            $data =array('code'=>1, 'msg'=>'成功','data'=>$list);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }



}