<?php
namespace Admin\Model;
use Think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 14:59
 */
class AreaModel extends Model{
    static public function getProvinceName($start_time,$end_time){
        $prefix = C('DB_PREFIX');
        $where['c.s_date'] = array('between',[$start_time,$end_time]);
        $list = M()
            ->field('SUM(c.num) num,a.name name')
            ->table($prefix.'complain_area'.' c')
            ->join ($prefix.'area'." a on c.province_id=a.id")
            ->where($where)
            ->group('c.province_id')
            ->order('num desc')
            ->select();
        return $list;
    }
    static public function getCityName($start_time,$end_time){
        $prefix = C('DB_PREFIX');
        $where['c.s_date'] = array('between',[$start_time,$end_time]);
        $list = M()
            ->field('SUM(c.num) num,a.name name')
            ->table($prefix.'complain_area'.' c')
            ->join ($prefix.'area'." a on c.city_id=a.id")
            ->where($where)
            ->group('c.city_id')
            ->order('num desc')
            ->select();
        return $list;
    }
}