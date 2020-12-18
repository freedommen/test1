<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 9:51
 */
namespace Cron\Model;
use Think\Model;
//\define('DAYDATE',date('Y-m-d',NOW_TIME-3600*24));

class TravelModel extends Model{


    /**
     *
     * @param $data array 添加的数据
     * @user liurg
     */
    public function addTravelTotal($data){
        $db =M('travelTotal');
        $db->where(['s_date'=>$data['s_date']])->delete();
        return $db->add($data);
    }

    /**
     * 组团和地接
     * @param $data
     */
    public function addTravelAgency($data){
        $db = M('travelAgency');
        $db->where(['s_date'=>$data['s_date']])->delete();
        return $db->add($data);
    }

}