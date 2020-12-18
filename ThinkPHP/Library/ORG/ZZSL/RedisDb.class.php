<?php
namespace ORG\ZZSL;
use ORG\Flexihash\Flexihash;
use ORG\Flexihash\Hasher\Crc32Hasher;

defined('THINK_PATH') or exit();
class RedisDb {
	protected $_redis           =   null; // Redis Object
    protected $_keyname         =   null; // Redis Key
    protected $_dbName          =   ''; // dbName
    protected $_cursor          =   null; // Reids Cursor Objectis
    protected $_linkID          =   null;
    protected $_hash            =   null;
    
    public $linkID;
    public $config = array();
    public $queryStr;
    public $connected = false;
    /**
     * 架构函数 读取数据库配置信息
     * @access public
     * @param array $config 数据库配置数组
     */
    public function __construct($config=''){
        if ( !class_exists('redis') ) {
            throw_exception(L('_NOT_SUPPERT_').':redis');
        }    
        
        if(empty($config)) {
            $this->config   =   array(
            	"REDIS_HOST" => C("REDIS_HOST"),
            	"REDIS_PORT" => C("REDIS_PORT"),
            	"REDIS_AUTH" => C("REDIS_AUTH"),            	
            	
            );
            if(empty($this->config['params'])) {
                $this->config['params'] =   array();
            }
        }
               
        $this->_hash = new Flexihash(new Crc32Hasher());
        $this->_hash->addTargets(explode(',', C("REDIS_HOSTS")), 1);
    }
    
    /**
     * 利用__call方法实现一些特殊的Model方法
     * @param string $method
     * @param array $args
     * @return void|\Org\YJY\RedisDb
     */
    public function __call($method,$args) {
        if(in_array(strtolower($method),array('type','where','order','limit','page','field'),true)) {
            // 连贯操作的实现
            $this->options[strtolower($method)] =   $args[0];
            return $this;
        }else{
            throw_exception(__CLASS__.':'.$method.L('_METHOD_NOT_EXIST_'));
            return;
        }
    }

    /**
     * 连接数据库方法
     * @access public
     */
    public function connect($config='', $host='') {
        if(!isset($this->linkID[$host])){
            if(empty($config))  
                $config =   $this->config;           
            $redis = new \Redis(); 
			$redis->connect($host, $config["REDIS_PORT"]?$config["REDIS_PORT"]:6379);
			$info=$redis->info();
			
            //标记连接成功
            if(!empty($info["redis_version"])){
            	$this->_linkID = $this->_redis = $this->linkID[$host] = $redis;
            	$this->connected = true;
            }
        }

        return $this->linkID[$host];
    }
    
    /**
     * 切换当前操作的Db和redis key
     * @access public
     * @param string $keyname  redis key
     * @param string $db  db
     * @return void
     */
    public function switchKey($keyname, $db=''){
        $host = $this->_hash->lookup($keyname);
        //当前没有连接 则首先进行数据库连接
        if(!isset($this->linkID[$host]) || !$this->linkID[$host]) 
            $this->connect($this->config, $host);
        
        try{
            if(!empty($db)) {
                $this->_dbName  =  $db;
                $this->_redis = $this->_linkID->select($db);
            }
            
            if($this->_keyname != $keyname) {
                $this->_keyname  = $keyname;
            }
        }catch (\Exception $e){
            throw_exception($e->getMessage());
        }
    }
    
    public function getZSet($field){
        return $this->_linkID->zScore($this->_keyname, $field);
    }
    
    public function get(){
        return $this->_linkID->get($this->_keyname);
    }
    
    public function set($value, $expired = 0){  
        if($this->get()){
            return $this->type('string')->incr($value);
        }else{
            $this->_linkID->setex($this->_keyname, $expired, $value);
            return $value;
        }
    }
    
    /**
     * 查找记录
     * @access public
     * @param array $options 表达式
     * @return iterator
     */
    public function select() {       
        $options = $this->options;
    
        if(isset($options['table'])) {
            $this->switchKey($options['table'],'',false);
        }
        $cache  =  isset($options['cache'])?$options['cache']:false;
        if($cache) { // 查询缓存检测
            $key =  is_string($cache['key'])?$cache['key']:md5(serialize($options));
            $value   =  S($key,'','',$cache['type']);
            if(false !== $value) {
                return $value;
            }
        }

        $field = null;
        if(isset($options['field']))
            $field = $options['field'];
            try{
                if (isset($options['limit'])){
                    $limit = $options['limit'];
                }else{
                    $limit = array("0"=>0,"1"=>19);
                }
    
                switch($options['type']) {
                    case "list":
                        //列表
                        $_cursor   = $this->_linkID->lRange($this->_keyname, $limit[0],$limit[1]);
                        break;
                    case "sets":
                        //集合 
                        switch (strtolower($options["where"])) {
                            case "sinterstore":
                                //求交集
                                $_cursor   = $this->_linkID->sInter($field);
                                break;
                            case "sunion":
                                //求并集
                                $_cursor   = $this->_linkID->sUnion($field);
                                break;
                            case "sdiff":
                                //求差值
                                $_cursor   = $this->_linkID->sDiff($field);
                                break;
                            default:
                                $_cursor   = $this->_linkID->sMembers($this->_keyname);
    
                        }
                        break;
                    case "zset":
                        //有序集合
                        $zsets=isset($options["order"][0]) ? $options["order"][0] : 'zRevRange';
                        switch (strtolower($zsets)) {
                            case strtolower("zRevRange"):
                                $_cursor   = $this->_linkID->zRevRange($this->_keyname, $limit[0], $limit[1] - 1, true);
                                break;
    
                            default:
                                $_cursor   = $this->_linkID->zRange($this->_keyname, $limit[0], $limit[1] - 1, true);
                                break;
                        }
                        break;
                    case "string":
                        //字符串
                        $_cursor   = $this->_linkID->mget($field);
                        break;
                    case "hash":
                        //HASH
                        if (empty($field)){
                            $_cursor   = $this->_linkID->hGetAll($this->_keyname);
                        }else{
                            $_cursor   = $this->_linkID->hmGet($this->_keyname, $field);
                        }
                        break;
                    default:
                        $_cursor   = $this->_linkID->lRange($this->_keyname, $limit[0],$limit[1]);
                        break;
                }
 
                $this->_cursor =  $_cursor;
                $resultSets  =  $_cursor;
                if($cache && $resultSets ) { 
                    S($key,$resultSets,$cache['expire'],$cache['type']);
                }
                return $resultSets;
            } catch (\Exception $e) {
                throw_exception($e->getMessage());
            }
    
    }
    
    
    /**
     * 添加数据
     * @param array $data
     */
    public function add($data){
        $options = $this->options;
        
        if(isset($options['table'])) {
            $this->switchKey($options['table'],'',false);
        }
    
        try{
            $add = '';
            if($options['type']) {
                if ($options["type"]==strtolower("list")){
                    //列表
                    $add   = $this->_linkID->lPush($this->_keyname,$data);
                }elseif ($options["type"]==strtolower("sets")){
                    //集合
                    $add   = $this->_linkID->sAdd($this->_keyname,$data);
                }elseif ($options["type"]==strtolower("zset")){
                    //有序集合
                    foreach ($data as $member=>$score) {
                        $add   = $this->_linkID->zAdd($this->_keyname,$score,$member);
                    }
                     
                }elseif ($options["type"]==strtolower("string")){
                    //字符串
                    $add   = $this->_linkID->mset($data);
                }elseif ($options["type"]==strtolower("hash")){
                    //HASH
                    $add   = $this->_linkID->hmSet($this->_keyname,$data);
                }
            }else{
                $add   = $this->_linkID->lPush($this->_keyname,$data);
            }
            return $add;
        } catch (\Exception $e) {
            throw_exception($e->getMessage());
        }
    }
    
    /**
     * 删除数据
     * @param array $data
     */
    public function delete($data){
        $options = $this->options;
    
        if(isset($options['table'])) {
            $this->switchKey($options['table'],'',false);
        }
    
        try{
            $add = '';
            if($options['type']) {
                if ($options["type"]==strtolower("list")){

                }elseif ($options["type"]==strtolower("sets")){

                }elseif ($options["type"]==strtolower("zset")){
                    $delete   = $this->_linkID->zDelete($this->_keyname, $data);
                }elseif ($options["type"]==strtolower("string")){

                }elseif ($options["type"]==strtolower("hash")){

                }
            }else{

            }
            return $delete;
        } catch (\Exception $e) {
            throw_exception($e->getMessage());
        }
    }
    
    /**
     * 计数器
     * @param array $options
     * @param number $number
     * @return int
     */
    public function incr($number=1){
        $options = $this->options;       
        if(isset($options['table'])) {
            $this->switchKey($options['table'],'',false);
        }
        
        try{
            if ($options["type"]==strtolower("list") || empty($options["type"])){
    
            }elseif ($options["type"]==strtolower("sets")){
    
            }elseif ($options["type"]==strtolower("zset")){
                $incr = $this->_linkID->zIncrBy($this->_keyname, $number, $options["field"]);
            }elseif ($options["type"]==strtolower("string")){
                $incr = $this->_linkID->incr($this->_keyname, $number);
            }elseif ($options["type"]==strtolower("hash")){
                //HASH
                $incr = $this->_linkID->hincrby($this->_keyname, $options["field"], $number);
            }
            return $incr;
        } catch (\Exception $e) {
            throw_exception($e->getMessage());
        }
    }
    
    public function pos($field, $bScore=false){
        $options = $this->options;
    
        if(isset($options['table'])) {
            $this->switchKey($options['table'],'',false);
        }
    
        try{
            //$field = $options['field'];
            $zsets=isset($options["order"][0]) ? $options["order"][0] : '';
            switch (strtolower($zsets)) {
                case strtolower("zRank"):
                    $_cursor[0]   = $this->_linkID->zRank($this->_keyname, $field) + 1;
                    if($bScore)
                        $_cursor[1]   = $this->_linkID->zScore($this->_keyname, $field);
                        break;
                default:
                    $_cursor[0]   = $this->_linkID->zRevRank($this->_keyname, $field);
                    $_cursor[0] =  ($_cursor[0] === false) ? 0  : ($_cursor[0] + 1);
                    if($bScore)
                        $_cursor[1]   = $this->_linkID->zScore($this->_keyname, $field);
                        break;
            }
    
            $this->_cursor =  $_cursor;
            $resultSets  =  $bScore ? $_cursor : $_cursor[0];
            return $resultSets;
        }catch(\Exception $e){
            throw_exception($e->getMessage());
        }
    }
    
    public function del(){
        return $this->_linkID->del($this->_keyname);
    }
    
	/**
     * 释放查询结果
     * @access public
     */
    public function free() {
        $this->_cursor = null;
    }
}
?>