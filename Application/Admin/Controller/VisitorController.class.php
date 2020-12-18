<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/2/26
 * Time: 上午11:10
 */

namespace Admin\Controller;
use Admin\Model\AreaModel;
\define('DAYDATE',date('Y-m-d',NOW_TIME));

class VisitorController extends AdminController
{
    //本省id
    public static $province_id = 2898;
    public static $scenic_id = 1;
    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;

    /**
     * 游客分析
     */
    public function index(){

        $this->assign('scenic_list', M('scenic')->where('status=1')->limit(3)->select());

        $this->display();
//        $this->display('passengerFlow');
    }


    /**
     * 扶风旅游客流量统计
     */
    public function getTouristFlow(){

        //查询日期
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
        $end_time = date("Ymd",strtotime("-1 day"));
//        $end_time = date('Ymd',NOW_TIME);
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
     * 获取对比的景区
     */
    public function getScenicInfo(){

        $db = M('visitorDay');
        $list =$db->alias('a')->field('a.*, SUM(user_num) user_num,b.name')
            ->join('left join ff_scenic b on a.scenic_id=b.id')
            ->where('b.status=1')->order('user_num desc')->group('scenic_id')->limit(6)->select();
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$list);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * @param $scenicId 景区ID
     * @param string $cycle 周期
     */
    public function getScenicVs()
    {
        $s_day = \I('s_day',1);
        $scenicId = \I('scenicids');

        //通过景区ID查询景点
        $scenicWhere = [
            'id' => ['IN', $scenicId],
//            'status' => 1
        ];
        $scenicFields = 'id,name';
        $scenicArray = M('scenic')->where($scenicWhere)->getField($scenicFields);
        //周期
        $currentTime = date('Ymd',strtotime("-1 day"));
//        $currentTime = date('Ymd');
        switch ($s_day)
        {
            case 1:
                $cycleTime = date('Ymd',strtotime('-7 days'));
                break;
            case 2:
                $cycleTime = date('Ymd', strtotime('-1 month'));
                break;
            case 3:
                $cycleTime = date('Ymd', strtotime('-3 month'));
                break;
            case 4:
                $cycleTime = date('Ymd', strtotime('-6 month'));
                break;
            case 5:
                $cycleTime = date('Ymd', strtotime('-1 year'));
                break;
            default:
                $cycleTime = date('Ymd', strtotime('-7 days'));
                break;
        }
        $diffDay = (\strtotime($currentTime) -  \strtotime($cycleTime) )/86400 ;
        $timeUserNumArray = [];
        $first = 0;
        while ($first <= $diffDay)
        {
            $afterDay = date('Ymd',strtotime($currentTime) - 3600 * 24 * $first);
            $timeUserNumArray[$afterDay] = 0;
            $first++;
        }
        $newWhere['s_date'] = array('between',[$cycleTime,$currentTime]);
//        $whereString = '(s_date >= '.$currentTime.' AND '.$cycleTime.' >= s_date)';
//        $fieldsString = 'GROUP_CONCAT(IF(user_num != 0, user_num, 0)) user_num';
        $fieldsString = 's_date,user_num';
        $visitor = M('visitor_day');
        $dataArray = [];
        foreach ($scenicArray as $k => $v)
        {
            $newWhere['scenic_id'] = $k;
//            $newWhere = $whereString.' AND scenic_id = '.$k;
            $rowArray = $visitor->where($newWhere)->getField($fieldsString);
            $newRowArray = (array)$rowArray + (array)$timeUserNumArray;

            //按键值重新排序
            ksort($newRowArray);
            $newCurrentArray = [
                'name' => $v,
                'data' => array_values($newRowArray),
                'type'  =>'line',
                'smooth'    => 'true',
                'markPoint' => array(
                    'data' => [array('type'=>'max','name'=>'最大值')]
                ),
            ];
            $dataArray['s_date'] = array_keys($newRowArray);
            $dataArray['series'][] = $newCurrentArray;
        }
        $dataArray['scenic_name'] = array_values($scenicArray);
        if($newRowArray){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$dataArray);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
        //$this->ajaxReturn(returnCodeMsg($dataArray));
    }



    /**
     * 重点区域客流统计
     */
    public function getKeyAreaTop(){
        //查询日期
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
        $end_time = date("Ymd",strtotime("-1 day"));
//        $end_time = date('Ymd',NOW_TIME);
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $where['key_area'] = 1;
        $list =  M('visitorDay')->alias('a')->where($where)
            ->field('a.id,a.s_date,a.scenic_id,a.saturation,SUM(a.user_num) user_num,b.name,b.overall')
            ->join('left join ff_scenic b on a.scenic_id=b.id')->group('scenic_id')
            ->order('user_num desc')->limit(5)->select();
        $i = 1;
        foreach ($list as &$k){
            $k['ranking'] = $i++;
            $k['saturation'] = (float)$k['saturation'].'%';
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$list);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 重点区域游客数量
     */
    public function getKeyAreaDay(){
        //查询日期
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
        $end_time = date("Ymd",strtotime("-1 day"));
//        $end_time = date('Ymd',NOW_TIME);
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $where['scenic_id'] = I('scenic_id',self::$scenic_id);
        $list =  M('visitorDay')->alias('a')->where($where)
            ->field('a.s_date,a.scenic_id,a.saturation,SUM(a.user_num) user_num,b.name scenic_name,b.overall')
            ->join('left join ff_scenic b on a.scenic_id=b.id')->group('s_date')
            ->order('s_date asc')->select();
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = date('n.j',\strtotime($v['s_date']));
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
     * 客源地分析-省份
     */
    public function getProvinceTop(){

        //查询日期
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
        $end_time = date("Ymd",strtotime("-1 day"));

        $where['s_date'] = array('between',[$start_time,$end_time]);
//        $db = M('VisitorProvince');
        $db = M('VisitorCity');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.province_id,b.name')
            ->join('left join ff_area b on a.province_id = b.id')
            ->order('user_num desc')->group('province_id')
            ->where($where)->limit(10)->select();
        foreach ($list as $k=>$v){
            $data['province'][$k] = $v['name'];
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
     * 客源地分析-城市
     */
    public function getCityTop(){
        //查询日期
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
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('VisitorCity');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.city_id,b.name')
            ->join('left join ff_area b on a.city_id = b.id')->where($where)
            ->group('city_id')->order('user_num desc')->limit(10)->select();
//        echo M()->_sql();die;
        foreach ($list as $k=>$v){
            $data['city'][$k] = $v['name'];
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
     * 客流统计-本省VS外省
     */
    public function getProvinceVs(){
//        $db = M('visitorProvince');
        $db = M('visitorCity');
        //查询日期
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
        //外省
        $province_id =self::$province_id;
        $where['province_id'] = array('neq',$province_id);
        $province_arr = $db->field('SUM(user_num) user_num')->where($where)->find();
        //本省客源统计分析
        $where['province_id'] = $province_id;
        $local_province_num = $db->field('SUM(user_num) user_num')->where($where)->find();
        if($local_province_num['user_num'] != null && $province_arr['user_num'] != null){
            $data = array(
                //故意写反
//                array('name'=>'外省','value'=>$local_province_num['user_num']),
//                array('name'=>'本省','value'=>$province_arr['user_num'])
                array('name'=>'本省','value'=>$local_province_num['user_num']),
                array('name'=>'外省','value'=>$province_arr['user_num'])
            );
            $data =array('code'=>1,'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0,'msg'=>'暂无数据',array());
        }
        $this->ajaxReturn($data);
    }


    /**
     * 假日客流
     */
    public function getHoliday(){

//        $this->display('holidayPassengerFlow');
        $this->display('holiday');
    }

    /**
     * 国庆假日客流统计
     */
    public function getHolidayTotal(){
        $s_day = \I('s_day',1)+0;
        $where['s_date'] = array('between',getHolidayDate($s_day));
        $db = M('VisitorHoliday');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,increase,ratio')
            ->order('s_date asc')->group('s_date')->where($where)->limit(7)->select();
        foreach ($list as $k =>$v){
            $data['arr'][$k]['s_date'] = \date('n.j',\strtotime($v['s_date']));
            $data['arr'][$k]['user_num'] =$v['user_num'];
            $data['arr'][$k]['increase'] = ($v['increase'] > 0) ? '+'.$v['increase'].'%' : $v['increase'].'%';
            $data['arr'][$k]['ratio'] =($v['ratio'] > 0) ? '+'.$v['ratio'].'%' :  $v['ratio'].'%';
            $data['total_num'] += $v['user_num'];
            $data['total_increase'] += sprintf("%.2f",$v['increase']);
            $data['total_ratio'] += sprintf("%.2f",$v['ratio']);
            $data['unit'] = ' ';

        }
        if($data['total_increase'] > 0) $data['total_increase'] = '+'.$data['total_increase'];
        if($data['total_ratio'] > 0) $data['total_ratio'] = '+'.$data['total_ratio'];
        //单位转换
        if($data['total_num'] >= 10000){
            $data['unit'] = '万';
            $data['total_num'] = 0;
          //  $data['arr'] =array();
            foreach ($list as $kk=>$vv){
                $user_num = sprintf("%.2f",($vv['user_num']/10000));
                $data['arr'][$kk]['user_num'] = $user_num;
                $data['arr'][$kk]['increase'] = '+'.floatval($vv['increase']).'%';
                $data['arr'][$kk]['ratio'] = '+'.floatval($vv['ratio']).'%';
                $data['total_num'] += $user_num;
            }
        }
        if($list){
            $data['total_num'] =  sprintf("%.2f",$data['total_num']);
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /***
     *假期
     * 重点区域客流排行（实时）
     */
    public function getHolidayScenicTop(){
        //默认国庆节 1、国庆  2端午 3劳动 4中秋
        $s_day = \I('s_day',1);
        $where['s_date'] = array('between',getHolidayDate($s_day));
        $db = M('VisitorHolidayScenic');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,AVG(proportion) proportion,scenic_id,b.name')
            ->join('left join ff_scenic b on a.scenic_id = b.id')
            ->order('user_num desc')->group('scenic_id')->where($where)->limit(10)->select();
        foreach ($list as $k=>$v){
            $data[$k]['ranking'] = $k+1;
            $data[$k]['name'] = $v['name'];
            $data[$k]['user_num'] = $v['user_num'];
            $data[$k]['saturation'] = \round($v['proportion'],2) . '%';
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }


    /**
     * 假日客流节前和节后对比
     */
    public function getHolidayVs(){
        $s_day = \I('s_day',1)+0;
        //1、国庆  2端午 3劳动 4中秋
        switch ($s_day){
            case 1: //国庆节
                $start_time = '20170924';
                $end_time = '20171014';
                break;
            case 2: //端午节
                $start_time = '20180613';
                $end_time = '20180621';
                break;
            case 3: //劳动节
                $start_time = '20180426';
                $end_time = '20180504';
                break;
//            case 4: // 中秋节
//                $start_time = '20171004';
//                $end_time = '20171006';
//                break;
            default:
                //默认提前7天
                $start_time = '20171001';
                $end_time = '20171007';
        }
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('VisitorHolidayArea');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.province_id')
            ->order('s_date asc')->group('s_date')->where($where)->select();
        foreach ($list as $k =>$v){
            $data['s_date'][$k] = \date('n'.'.'.'j',\strtotime($v['s_date']));
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
     * 假日客流客源地分析-省份
     */
    public function getHolidayTop(){
        //查询日期
        $s_day = I('s_day',1);
        $where['s_date'] = array('between',getHolidayDate($s_day));

        $db = M('VisitorHolidayArea');
        //省
        $list_pro = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.province_id,b.name')
            ->join('left join ff_area b on a.province_id = b.id')
            ->order('user_num desc')->group('province_id')
            ->where($where)->limit(10)->select();
        //市
        $data = VisitorController::getHolidayCityTop(getHolidayDate($s_day)[0],getHolidayDate($s_day)[1]);
        //省对比
        $data['province_vs'] = VisitorController::getHolidayProvinceVs(getHolidayDate($s_day)[0],getHolidayDate($s_day)[1]);
        //
        foreach ($list_pro as $k=>$v){
            $data['province'][$k] = $v['name'];
            $data['province_user_num'][$k] = $v['user_num'];
        }
        if($list_pro){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 假如客流客源地分析-城市
     */
    public function getHolidayCityTop($start_time,$end_time){
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('VisitorHolidayArea');
        $list = $db->alias('a')->field('a.s_date,SUM(a.user_num) user_num,a.city_id,b.name')
            ->join('left join ff_area b on a.city_id = b.id')->where($where)
            ->group('city_id')->order('user_num desc')->limit(10)->select();
        foreach ($list as $k=>$v){
            $data['city'][$k] = $v['name'];
            $data['city_user_num'][$k] = $v['user_num'];
        }
        if($list){
            return $data;
        } else{
            return false;
        }
    }

    /**
     * 本省VS外省
     */
    public function getHolidayProvinceVs($start_time,$end_time){
        $db = M('VisitorHolidayArea');
        $where['s_date'] = array('between',[$start_time,$end_time]);
        //外省
        $province_id =self::$province_id;
        $where['province_id'] = array('neq',$province_id);
        $province_arr = $db->field('SUM(user_num) user_num')->where($where)->find();
        //本省客源统计分析
        $where['province_id'] = $province_id;
        $local_province_num = $db->field('SUM(user_num) user_num')->where($where)->find();
        if($local_province_num['user_num'] == null && $province_arr['user_num'] == null){
            return false;
        }else{
            $data = array(
                array('name'=>'本省','value'=>$local_province_num['user_num']),
                array('name'=>'外省','value'=>$province_arr['user_num'])
            );
            return $data;

        }
    }



    /**
     * 假如客流旅游类APP使用行为分析
     */
    public function getVisitorApp(){
        $db = M('visitorApp');
        $s_day = I('s_day');
        //查询日期

        $where['s_date'] = array('between',getHolidayDate($s_day));
//        $where['s_date'] = array('between',[$start_time,$end_time]);
        $list = $db->where($where)
            ->field('s_date,s_time,SUM(user_num) user_num')
            ->order('s_time asc')->group('s_time')->select();
        //app使用情况走势
        foreach ($list as $k=>$v){
            $data['s_time'][$k] =  (empty($v['s_time'])|| $v['s_time']>24 ) ?'0:00': $v['s_time'].':00';
            $data['user_num'][$k] = $v['user_num'];
        }
        //app使用排行榜
        $list_top = $db->where($where)->alias('a')
            ->field('s_date,SUM(user_num) user_num,b.name')
            ->join('left join ff_app b on a.app_id=b.id')
            ->order('user_num asc')->group('app_id')->limit(5)->select();
        $i = 5;
        foreach ($list_top as $key=>$val){
            $data['app'][$key] = $i .'.' . $val['name'];
            $data['app_user_num'][$key] = $val['user_num'];
            $i --;
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }


    /**
     * 住宿分析
     */
    public function innAnalysis(){
        $this->display('innAnalysis');
    }

    /*
     * 酒店接待客流总数据统计
     */
    public function getInnOrdertotal(){
        $db = \M('hotelOrderTotal');
        $s_day = \I('s_day',7);

        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field("hotel_id,s_date,ROUND(AVG(occupancy),2) occupancy,SUM(user_num) user_num")->where($where)->order('s_date asc')->group('s_date')->select();
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = $v['s_date'];
            $data['user_num'][$k] = (int)$v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    //游客入住时长占比统计
    public function getInnStayDays(){
        $db = \M('hotelStaydays');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field("s_date,SUM(user_num) user_num,s_day,AVG(day_avg) day_avg")->where($where)->order('s_date asc')->group('s_day')->select();
        foreach ($list as $k=>$v){
            $data['day_avg'] = $v['day_avg'];
            $data['list'][$k]['name'] = getInnStayDaysText($v['s_day']);
            $data['list'][$k]['value'] = (int)$v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 接待客流TOP10
     */
    public function getReceptionTop10(){
        $db = \M('hotelOrderTotal');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['a.s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->alias('a')->field("hotel_id,a.s_date,SUM(user_num) user_num,b.name,
        (SELECT SUM(user_num) num FROM ff_hotel_order_total a  WHERE ( (s_date BETWEEN {$startTime} AND {$endTime} ) ) LIMIT 1) total")
            ->where($where)->join('left join ff_hotel b on a.hotel_id=b.id')
            ->order('user_num desc')->group('hotel_id')->limit(10)->select();
        foreach ($list as $k=>$v){
            $data['name'][$k] = $v['name'];
            $data['user_num'][$k] = (int)$v['user_num'];
            $data['proportion'][$k] =  (float)sprintf("%.2f",($v['user_num']/$v['total'])*100) ;
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    //酒店预订渠道统计
    public function getHotelBookingChannel(){
        $db = \M('hotelBookingChannel');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['a.s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->alias('a')->field("a.s_date,SUM(user_num) user_num,b.name,
        (SELECT SUM(user_num) num FROM ff_hotel_booking_channel a  WHERE ( (s_date BETWEEN {$startTime} AND {$endTime} ) ) LIMIT 1) total")
            ->where($where)->join('left join ff_hotel_channel b on a.app_id=b.id')
            ->order('user_num desc')->group('app_id')->select();
        foreach ($list as $k=>$v){
            $data['name'][$k] = $v['name'];
            $data['list'][$k]['name'] = $v['name'];
            $data['list'][$k]['value'] = (int)$v['user_num'];
//            $data['list'][$k] =  (float)sprintf("%.2f",($v['user_num']/$v['total'])*100) ;
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /***
     * 酒店类型欢迎程度占比分析
     */
    public function getFavoriteHotel(){
        $db = \M('hotelFavorite');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['a.s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->alias('a')->field("a.s_date,type,AVG(occupancy_rate) occupancy_rate")
            ->where($where)
            ->order('occupancy_rate desc')->group('type')->select();
        foreach ($list as $k=>$v){
            $data['list'][$k]['name'] = getHotelType($v['type']);
            $data['list'][$k]['value'] = sprintf("%.2f",$v['occupancy_rate']);
            $data['name'][$k] = $data['list'][$k]['name'];
//            $data['list'][$k] =  (float)sprintf("%.2f",($v['user_num']/$v['total'])*100) ;
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 酒店分销直销占比
     */
    public function getSaleChannel(){
        $db = \M('hotelSaleChannel');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['a.s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->alias('a')->field("a.s_date,SUM(direct_num) direct_num,SUM(distribute_num) distribute_num")
            ->where($where)->order('s_date asc')->find();
        $data['list'] =array(
            array('name'=>'直销','value'=>$list['direct_num']),
            array('name'=>'分销','value'=>$list['distribute_num'])
        );
        if($list){
            $data['name'] = array('直销','分销');
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }


    /**
     * 住宿旅客性别及年龄占比
     * 平均年龄、停留时长、提前预定天数
     */
    public function getHotelVisitorInfo(){
        //默认最近一周
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        //获取游客性别信息
        $sexInfo= M('hotelVisitorSex')->field('SUM(male_num) male_num,SUM(female_num) female_num')->where($where)->find();
        $data['userTotal'] = ($sexInfo['male_num']+$sexInfo['female_num']);
        $data['sexText'] = array('男','女');
//        $data['sexInfo'] = array(
//            array('value'=> $sexInfo['male_num'],'symbol'=> 'men'),
//            array('value'=> $sexInfo['female_num'],'symbol'=>'women'),
//        );
        $data['sexInfo'] =array('male'=>$sexInfo['male_num'],'female'=>$sexInfo['female_num']);
        //年龄统计
        $visitor_age = M('hotelVisitorAge')->field('age_phase,SUM(user_num) user_num,age_avg')->where($where)->group('age_phase asc')->order('age_phase asc')->select();
        $ageTotal = $ageUser= '';
        foreach ($visitor_age as $k=>$v){
            $ageTotal += ($v['user_num'] * $v['age_avg']);
            $ageUser += $v['user_num'];
            $data['ageInfo'][$k] = array('name' => getHotelAgePhase($v['age_phase']), 'value' =>$v['user_num']);
            $data['ageText'][]   = getHotelAgePhase($v['age_phase']);
        }
        //游客平均年龄
        $data['ageAvg'] = ((float)sprintf("%.2f",($ageTotal/$ageUser)).'岁');
        if($sexInfo['male_num']){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 酒店入住率统计
     */
    public function getOccupancyRate(){
        $db = \M('hotelOrderTotal');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field("hotel_id,s_date,AVG(occupancy) occupancy")->where($where)->order('s_date asc')->group('s_date')->select();
        $occupancy_total = '';
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = $v['s_date'];
            $data['occupancy'][$k] = round($v['occupancy'],2); // $v['occupancy'];
            $occupancy_total += $v['occupancy'];
        }
        //平均入住率
        switch ($s_day){
            case 7: $text = '7天'; break;
            case 30: $text = '30天'; break;
            case 90: $text = '90天'; break;
            case 180: $text = '半年'; break;
            case 365: $text = '1年'; break;
            default : $text = '7天';
        }
        $data['occupancyText'] = '近'.$text .'入住率';
        $data['occupancyAvg'] = (float)sprintf("%.2f",($occupancy_total/$s_day)).'%';
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /***
     * 住宿旅客来源归属地
     */
    public function getHotelVisitorArea(){
        $db = M('hotelVisitorArea');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        //省
        $list = $db->alias('a')->field('s_date,province_id,SUM(user_num) user_num,created,b.name')
            ->join('left join ff_area b on a.province_id = b.id')
            ->where($where)->order('user_num desc')->group('province_id')->limit(10)->select();
        $local_Province_num = $province_num = '';
        foreach ($list as $k=>$v){
//            if($k < 10) {
                $data['provinceName'][$k] = $v['name'];
                $data['provinceNum'][$k] = $v['user_num'];
//            }
            //省与外省对比
            if($v['province_id'] == self::$province_id){
                $local_Province_num += $v['user_num'];
                $data['provinceVS'][0] = array('name'=>'本省','value'=>(int)$local_Province_num);
            }else{
                $province_num += $v['user_num'];
                $data['provinceVS'][1] = array('name'=>'外省','value'=>(int)$province_num);
            }
        }
//        $data['provinceName'] = array_slice($data['provinceName'],3);
        //城市
        $cityList = $db->alias('a')->field('s_date,province_id,SUM(user_num) user_num,created,b.name')
            ->join('left join ff_area b on a.city_id = b.id')
            ->where($where)->order('user_num desc')->limit(10)->group('city_id')->select();
        foreach ($cityList as $k=>$v){
            $data['cityName'][$k] = $v['name'];
            $data['cityNum'][$k] = $v['user_num'];
        }
        $data['provinceVS'] =  \array_values( $data['provinceVS']);
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 数据分析-旅行社监管
     */
    public function travelIndex(){

        $db = \M('travel_agency');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field('s_date,SUM(local_ordernum) local_ordernum,SUM(local_usernum) local_usernum,SUM(group_ordernum) group_ordernum,SUM(group_usernum) group_usernum,SUM(midify_ordernum) midify_ordernum')
            ->where($where)->find();
        // todo 临时显示1
        $list['midify_ordernum'] = 1;
        $this->assign('info',$list);
        $this->display('travelAgencySupervision');
    }

    /***
     * 团队运作情况统计
     */
    public function getTravelGroupTotal(){
        $db = \M('travelTotal');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field('s_date,SUM(plan_ordernum) plan_ordernum,SUM(conduct_ordernum) conduct_ordernum,SUM(ends_ordernum) ends_ordernum,SUM(guide_usernum) guide_usernum,SUM(midify_ordernum) midify_ordernum')
            ->where($where)->group('s_date')->select();
        $midify_ordernum = $guide_usernum = '';
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = $v['s_date'];
            $data['plan_total'] += $v['plan_ordernum'];
            $data['plan_ordernum'][$k] = $v['plan_ordernum'];
            $data['conduct_total'] += $v['conduct_ordernum'];
            $data['conduct_ordernum'][$k] = $v['conduct_ordernum'];
            $data['ends_total'] += $v['ends_ordernum'];
            $data['ends_ordernum'][$k] = $v['ends_ordernum'];
            $guide_usernum = $v['guide_usernum'];
//            $data['guide_usernum'] = $guide_usernum;
//            $midify_ordernum += $v['midify_ordernum'];
//            $data['midify_ordernum'] = $midify_ordernum;
        }
        //todo 订单
        switch ($s_day){
            case 7: $data['midify_ordernum'] =1;
                    $i =0;
            break;
            case 30: $data['midify_ordernum'] =3;
                $i =1;
                break;
            case 90: $data['midify_ordernum'] =7;
                $i =2;
                break;
            case 180: $data['midify_ordernum'] =16;
                $i =3;
                break;
            default :
                $data['midify_ordernum'] =38;
                $i = 4;
        }
        //导游人数
        $data['guide_usernum'] =$list[$i]['guide_usernum']; //$guide_usernum;
        $data['guide_total'] = 160;
        //
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 地接行程数据统计
     */
    public function getTravelLocalOrderInfo(){
//        $db = \M('travel_local');
        $db = \M('travel_agency');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field('s_date,SUM(local_ordernum) local_ordernum,SUM(local_usernum) local_usernum')
            ->where($where)->group('s_date')->select();
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = $v['s_date'];
            $data['orderNum'][$k] = $v['local_ordernum'];
            $data['userNum'][$k] = $v['local_usernum'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /***
     * 组团行程数据统计
     */
    public function getTravelGroupOrderInfo(){
//        $db = \M('travel_group');
        $db = \M('travel_agency');
        $s_day = \I('s_day',7);
        $startTime = \date('Ymd',getLastTime($s_day,'day'));
        $endTime = date('Ymd',strtotime("-1 day"));
        $where['s_date'] = array('between',[$startTime,$endTime]);
        $list = $db->field('s_date,SUM(group_ordernum) ordernum,SUM(group_usernum) user_num')
            ->where($where)->group('s_date')->select();
        foreach ($list as $k=>$v){
            $data['s_date'][$k] = $v['s_date'];
            $data['orderNum'][$k] = $v['ordernum'];
            $data['userNum'][$k] = $v['user_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**qiao
     * 投诉分析
     */
    public function getComplain(){

        $this->display('complaintAnalysis');
    }
    /**qiao
     * 获取投诉量数据
     */
    public function getComplainJson(){
        $s_day = \I('s_day')+0;
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('complain');
        $list= $db->field('s_date,SUM(num) num')->where($where)->group('s_date')->order('s_date asc')->select();
        foreach ($list as $k =>$v){
            $data['s_date'][$k] = \date('n.j',\strtotime($v['s_date']));
            $data['num'][$k] = $v['num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);

    }
    /**qiao
     * 获取行业投诉量数据
     */
    public function getTradeJson(){
        $type = [1 => '景点',2 => '购物',3 => 'OTA',4 => '餐饮',5 => '旅行社',6 => '交通',7 => '其他',];
        $s_day = \I('s_day')+0;
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('complain');
        $list= $db->field('type,SUM(num) num')->where($where)->group('type')->order('type asc')->select();
        foreach ($list as $k =>$v){
            $data['type'][$k] = $type[$v['type']];
            $data['trade'][$k]['name'] = $type[$v['type']];
            $data['trade'][$k]['value'] = $v['num'];
            if($k === 0){
                $data['trade'][$k]['selected'] = true;
            }
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**qiao
     * 投诉客源的省份top10
     */
    public function getProvince(){
        $s_day = \I('s_day')+0;//天数
        $type = \I('type')+0;//1:省份 2：城市
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        if($type == 1){
            $list = AreaModel::getProvinceName($start_time,$end_time);
        }else{
            $list = AreaModel::getCityName($start_time,$end_time);
        }
        foreach ($list as $k =>$v){
            $data['province'][$k] = $v['name'];//省份
            $data['num'][$k] = $v['num'];//投诉量
        }
        //投诉占比
        $total_num = array_sum($data['num']);//总投诉量
        foreach($data['num'] as $k => $v){
            $data['ratio'][$k] = round(($v/$total_num)*100,2);
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**qiao
     * 投诉客源分析
     */
    public function getTourist(){
        $s_day = \I('s_day')+0;//天数
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('complainArea');
        $local= $db->field('SUM(num) num')->where($where)->where('province_id=2898')->select();//本地
        $field = $db->field('SUM(num) num')->where($where)->where('province_id!=2898')->select();//外地
        $data['local'] = $local[0]['num'] != 0 ? $local[0]['num'] : 0;
        $data['field'] = $field[0]['num'] != 0 ? $field[0]['num'] : 0;
        if($local || $field){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**qiao
     * 支付方式分析
     */
    public function getConsumption(){

        $this->display('consumptionAnalysis');
    }
    /**qiao
     *游客支付方式统计分析
     */
    public function getConsumptionAnalysis(){
        $pay_type = [1 => '微信',2 => '支付宝',3 => '银联卡',4 => '其他',5 => '现金',];
        $s_day = \I('s_day')+0;//天数
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('consumePaytype');
        $list= $db->field('type,SUM(amount) amount')->where($where)->group('type')->order('amount asc')->select();
        foreach ($list as $k =>$v){
            $data['payType'][$k] = $pay_type[$v['type']];//消费类型
            $data['payAmount'][$k]['name'] = $pay_type[$v['type']];//消费类型
            $data['payAmount'][$k]['value'] = $v['amount'];//消费金额
            if($k === 0){
                $data['payAmount'][$k]['selected'] = true;
            }
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**qiao
     * 旅游消费统计分析
     */
    public function tourismPay(){
        $pay_amount = [1=>'200以下',2=>'200-500',3=>'500-1000',4=>'1000以上'];
        $s_day = \I('s_day')+0;//天数
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('consumeTotal');
        $list= $db->field('SUM(amount) num ,amount_phase')->where($where)->group('amount_phase')->select();
        foreach ($list as $k =>$v){
            $data['payType'][$k] = $pay_amount[$v['amount_phase']];//消费类型
            $data['payAmount'][$k]['name'] = $pay_amount[$v['amount_phase']];//消费等级
            $data['payAmount'][$k]['value'] = $v['num'];//消费金额
            if($k === 0){
                $data['payAmount'][$k]['selected'] = true;
            }
        }
//        var_dump($list);die;
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**qiao
     *消费分布统计分析
     */
    public function payDistribute(){
        $pay_amount = [ 1=>'住宿',2=>'景区',3=>'购物',4=>'吃喝玩',5 =>'交通','其他'];
        $s_day = \I('s_day')+0;//天数
        $start_t = $this->getDayNum($s_day);
        $start_time =date('Ymd',$start_t);
        $end_time = date("Ymd",strtotime("-1 day"));
        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('consumeChannel');
        $list= $db->field('SUM(amount) amount ,type')->where($where)->group('type')->select();
        foreach ($list as $k =>$v){
            $data['payType'][$k] = $pay_amount[$v['type']];//消费类型
            $data['payAmount'][$k]['name'] = $pay_amount[$v['type']];//消费类型
            $data['payAmount'][$k]['value'] = $v['amount'];//消费金额
            if($k === 0){
                $data['payAmount'][$k]['selected'] = true;
            }
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }
    /**qiao
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



}