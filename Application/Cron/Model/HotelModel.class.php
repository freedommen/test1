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

class HotelModel extends Model{


    /**
     * 酒店价格
     * @param $data array 添加的数据
     * @user liurg
     */
    public function addHotelRate($data){
        $db =M('hotelRate');
        return $db->addAll($data);
    }

    /**
     * 酒店入住统计表
     * @user liurg
     */
    public function addHotelOrderTotal($data){
        $db =M('hotelOrderTotal');
        return $db->addAll($data);
    }

    /**
     * 酒店入住平均天数
     * @param $data
     * @return mixed
     */
    public function addHotelStaydays($data){
        return M('hotelStaydays')->addAll($data);
    }


    /**
     * 酒店预定渠道统计表
     * @param $data 数据
     * @return mixed
     */
    public function addBookingChannel($data){
        $db =M('hotelBookingChannel');
        return $db->addAll($data);
    }

    /**
     * 酒店预订分销占比统计表
     * @param $data
     * @return mixed
     */
    public function addHotelSaleChannel($data){
        return \M('hotelSaleChannel')->add($data);
    }

    /**
     * 酒店分布表
     * 批量添加
     * @param $data
     * @return mixed
     */
    public function addFavoriteHotel($data){
        $db =M('hotelFavorite');
        return $db->addAll($data);
    }

    /**
     * 酒店入住旅客性别占比
     * @param $data
     * @return mixed
     */
    public function addHotelUserSex($data){
        return M('hotelVisitorSex')->add($data);
    }

    /**
     * 批量添加酒店旅客年龄占比
     * @param $data
     * @return mixed
     */
    public function addHotelUserAge($data){
        return M('hotelVisitorAge')->addAll($data);
    }

    /**
     * 批量添加酒店旅客来源占比
     * @param $data
     * @return mixed
     */
    public function addHotelUserArea($data){
        return M('hotelVisitorArea')->addAll($data);
    }

    /**
     * 获取所有酒店
     * @return mixed
     */
    public function getHotel(){
        return \M('hotel')->order('id asc')->select();
    }


}