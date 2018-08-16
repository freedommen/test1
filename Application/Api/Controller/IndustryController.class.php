<?php
namespace Api\Controller;
use ORG\CommonController;
use ORG\ZZSL\Cmd;
use ORG\ZZSL\Des;
use Think\Controller;
\define('DAYDATE',date('Y-m-d',NOW_TIME));

class IndustryController extends Controller{
    //本省id
    public static $province_id = 2898;
    public static $scenic_id = 1;
    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;

    public function getTicket(){
        $s_day = I('param.s_day');
        $where = $this->getDate($s_day);

        $result = M('ticket_day')->where($where)->select();
        $data = array();
        foreach($result as $key=>$value){
            $data['ticket_num_date'][$key] = date('n.j',strtotime($value['s_date']));
            $data['ticket_num'][$key] = $value['num'];
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取查询时间条件
     */
    public function getDate($s_day){
        $where = array();
        switch ($s_day) {
            case '1':
                $where['s_date'] = array('between',array(date('Ymd',strtotime('-7 days')),date('Ymd',strtotime('-1 day'))));
                break;
            case '2':
                $where['s_date'] = array('between',array(date('Ymd',strtotime('-30 days')),date('Ymd',strtotime('-1 day'))));
                break;
            case '3':
                $where['s_date'] = array('between',array(date('Ymd',strtotime('-90 days')),date('Ymd',strtotime('-1 day'))));
                break;
            case '4':
                $where['s_date'] = array('between',array(date('Ymd',strtotime('-180 days')),date('Ymd',strtotime('-1 day'))));
                break;
            default:
                $where['s_date'] = array('between',array(date('Ymd',strtotime('-365 days')),date('Ymd',strtotime('-1 day'))));
                break;
        }
        return $where;
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
    public function getVisitorCount(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = $this->getVisitorCountModel($where);
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
    static function getVisitorCountModel($where){
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
     * 景区游客客流TOP10
     */
    public function getVisitorFlow(){
        $s_day = \I('s_day')+0;//天数;
        $where = $this->getSql($s_day);//查询条件
        $data = self::getVisitorFlowModel($where);
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
    static public function getVisitorFlowModel($where){
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
     * 景区实时客流
     */
    public function getVisitorNum(){
        $data = self::getVisitorNumModel($this->getSql(1));
        if(!empty($data)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取客流人数 （今天 昨天 近七天 本月  本年度）
     */
    static public function getVisitorNumModel($param){
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
     * 景区实时车流
     */
    public function carFlow(){
        $model = M('scenic_car');
        $where = array();
        $where['s_date'] = date("Ymd",time());
        $flow_info = $model->where($where)->find();
        if(9<date('H',time())+0 && date('H',time())+0<= 19){
            $flow_info['car_num'] = round($flow_info['car_num']*(date('H',time())+0)/19);
            $flow_info['year_total'] = round($flow_info['year_total']+$flow_info['car_num']);
            if(date('d',time())+0 == '1'){
                $flow_info['month_total'] = $flow_info['car_num'];
            }else{
                $flow_info['month_total'] = round($flow_info['month_total']+$flow_info['car_num']);
            }
        }elseif(date('H',time())+0<= 9){
            $flow_info['car_num'] = 0;
            if(date('d',time())+0 == '1'){
                $flow_info['month_total'] = 0;
            }
        }
        if(date('md',time())+0 == '0101'){
            $flow_info['year_total'] = $flow_info['month_total'];
        }
        if(!empty($flow_info)){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$flow_info);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
}