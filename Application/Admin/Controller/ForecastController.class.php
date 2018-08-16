<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/2/26
 * Time: 上午11:10
 */

namespace Admin\Controller;


class ForecastController extends AdminController
{
    //本省id
    const  LAST_TIME7 = 604800;
    const  LAST_TIME30 = 2592000;
    const  LAST_TIME90 = 7776000;
    const  LAST_TIME180 = 15552000;
    const  LAST_TIME365 = 31536000;


    /**
     * 客流预测
     */
    public function index(){

        $this->display();
    }

    /**
     * 未来流量
     */
    public function getFlow(){
        $days= \I('days')+0;
        //近7天、清明节、劳动节、端午节、国庆节、中秋节
        switch ($days){
            case 1: // 清明节
                $start_time = '20180405';
                $end_time = '20180407';
                break;
            case 2: // 劳动节
                $start_time = '20180429';
                $end_time = '20180501';
                break;
            case 3: // 端午节
                $start_time = '20180616';
                $end_time = '20180618';
                break;
            case 4: // 国庆节
                $start_time = '20181001';
                $end_time = '20181007';
                break;
            case 5: // 中秋节
                $start_time = '20181001';
                $end_time = '20181003';
                break;
            default:
                //默认提近7天
                $start_time = date('Ymd',strtotime('1 days'));
                $end_time = date('Ymd',strtotime('7 days'));
        }

        $where['s_date'] = array('between',[$start_time,$end_time]);
        $db = M('forecastFlow');
        //未来离开人数
        $list = $db->field('s_date,SUM(user_num) user_num,SUM(car_num) car_num')
            ->where($where)->order('s_date asc')->group('s_date')->select();

        foreach ($list as $k=>$v){
            $data['date'][$k] = \date('n.j',\strtotime($v['s_date']));
            $data['user_num'][$k] = $v['user_num'];
            $data['car_num'][$k] = $v['car_num'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }



    /**
     * 未来游客来源
     */
    public function getSourceArea(){
        $days= \I('days')+0;
        //近7天、清明节、劳动节、端午节、国庆节、中秋节
        switch ($days){
            case 1: // 清明节
                $start_time = '20180405';
                $end_time = '20180407';
                break;
            case 2: // 劳动节
                $start_time = '20180429';
                $end_time = '20180501';
                break;
            case 3: // 端午节
                $start_time = '20180616';
                $end_time = '20180618';
                break;
            case 4: // 国庆节
                $start_time = '20181001';
                $end_time = '20181007';
                break;
            case 5: // 中秋节
                $start_time = '20181001';
                $end_time = '20181003';
                break;
            default:
                //默认提近7天
                $start_time = date('Ymd',strtotime('1 days'));
                $end_time = date('Ymd',strtotime('7 days'));
        }
        $where['s_date'] = array('between',[$start_time,$end_time]);
        //省
        $provinceList = M('forecastArea')->alias('a')->field('province_id,SUM(user_num) user_num,b.name')->where($where)
            ->join('left join ff_area b on a.province_id = b.id')
            ->group('province_id')->order('user_num desc')->limit(10)->select();
        $local_Province_num = $province_num = '';
        foreach ($provinceList as $k=>$v){
                $data['province'][$k]['name'] = $v['name'];
                $data['province'][$k]['value'] = (int)$v['user_num'];
            //省与外省对比
            if($v['province_id'] == C('PROVINCE_ID')){
                $local_Province_num += $v['user_num'];
                $data['provinceVS'][0] = array('name'=>'本省','value'=>(int)$local_Province_num);
            }else{
                $province_num += $v['user_num'];
                $data['provinceVS'][1] = array('name'=>'外省','value'=>(int)$province_num);
            }
        }

        //市
        $cityList = M('forecastArea')->alias('a')->field('SUM(user_num) user_num,b.name')->where($where)
            ->join('left join ff_area b on a.city_id = b.id')
            ->group('city_id')->order('user_num desc')->limit(10)->select();
        foreach ($cityList as $k=>$v){
            $data['city'][$k]['name'] = $v['name'];
            $data['city'][$k]['value'] = $v['user_num'];
        }
        if($cityList){
            $data['provinceVS'] = \array_values($data['provinceVS']);
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

}