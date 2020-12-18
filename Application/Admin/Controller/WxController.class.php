<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/2/26
 * Time: 上午11:10
 */

namespace Admin\Controller;
\define('DAYDATE',date('Y-m-d',NOW_TIME));

class WxController extends AdminController
{

    const  LAST_TIME7 = 604800;
    const  LAST_TIME30 = 2592000;
    const  LAST_TIME90 = 7776000;
    const  LAST_TIME180 = 15552000;
    const  LAST_TIME365 = 31536000;


    /**
     * 公众号分析
     */
    public function index(){
        $this->assign('info',array('get_date'=>date('Y-m-d',NOW_TIME),'get_date_text'=>'今日'));
        $db = M('wxUsers');
        //今日接待客流数(实时数据)、往日客流、往日客流洼值
        $map['s_date'] = date('Ymd',\time());
        $wx_list = $db->field('total_user_num,user_num,active_num')->where($map)->find();
        $this->display();
    }

    public function getWxUsersNum(){
        $s_day = \I('s_day')+0;
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
        $start_time =date('Ymd',$start_t);
        $end_time = date('Ymd',NOW_TIME);
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('wxUsers');
        //总接待人数、往日客流、往日客流洼值
        $list = $db->field('s_date,SUM(total_user_num) total_user_num,SUM(user_num) user_num,SUM(active_num) active_num')
            ->where($where)->order('s_date asc')->group('s_date')->select();
        $user_num = 0;
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = \date('n.j',\strtotime($v['s_date']));
            $data['total_user_num'][$k] = $v['total_user_num'];
            $data['user_num'][$k] = $v['user_num'];
            $data['active_num'][$k] = ($v['active_num'] > $v['total_user_num'])? $v['total_user_num'] : $v['active_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }



    /**
     * 公众号点赞、收藏、转发、图文阅读、次数分析
     */
    public function getWxAnalysis(){
        $s_day = \I('s_day')+0;
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
        $start_time =date('Ymd',$start_t);
        $end_time = date('Ymd',NOW_TIME);
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $list = M('wxStatistics')->field('*')->where($where)->order('s_date asc')->select();
        foreach ($list as $k=>$v){
                $data['s_date'][$k] = \date('n.j',\strtotime($v['s_date']));
//                $data['thumbup_num'][$k] = $v['thumbup_num'];
                $data['forward_num'][$k] = $v['forward_num'];
                $data['collection_num'][$k] = $v['collection_num'];
                $data['read_user_num'][$k] = $v['read_user_num'];
                $data['read_num'][$k] = ($v['read_user_num'] > $v['read_num']) ? $v['read_user_num'] : $v['read_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

}
