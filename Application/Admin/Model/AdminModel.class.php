<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
    static $instance = null;
    
    /**
     * 获取应用实例
     * @return model
     */
    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    //获取所有管理员信息
    public static function getAll($isForceUpdate=false){
        $instance = self::getInstance();
    
        //获取详情
        $keyname = C('DATA_CACHE_PREFIX') . "all_admin";
        $itemInfo = S($keyname);
        if(empty($itemInfo) || $isForceUpdate){
            $shop = $instance->select();
            $itemInfo = array();
            foreach($shop as $k => $v){
                $itemInfo[$v['id']] = $v['nickname'];
            }
            if(!empty($itemInfo)){
               S($keyname, $itemInfo); 
            }
        }
        return $itemInfo;
    }  
}