<?php
namespace ORG\ZZSL;
class Cmd{    
    /**
     * 获取GET数据
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function _get($key, $default = ''){
        return self::_arr($_GET, $key, $default);
    }
    
    /**
     * 获取POST数据
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function _post($key, $default = ''){
        return self::_arr($_POST, $key, $default);
    }
    
    /**
     * 根据键索引获取键值
     * @param array $array
     * @param string $key
     * @param mixed $default
     * @return mixed <string, unknown>
     */ 
    public static function _arr($array, $key, $default=''){
       return isset($array[$key]) ? $array[$key] : $default;
    }
}
