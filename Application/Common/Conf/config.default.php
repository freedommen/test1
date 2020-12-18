<?php
return array(
    //模块相关配置
    'DEFAULT_MODULE'     => 'Admin',
    'MODULE_DENY_LIST'   => array('Common', 'User'),
    
    'DEFAULT_GROUP'        => 'Admin',
    'APP_SUB_DOMAIN_DEPLOY'=>1,
    'APP_SUB_DOMAIN_RULES'=>array(
        'scenic.admin'=>array('Admin/'),
        'scenic' => array('Home/'),
    ),
    
    //系统数据加密设置
    //默认数据加密KEY
    'DATA_AUTH_KEY' => 'W*]O=3aiNyo:jBp(<bq_s14r0}S)$;v-U2d,u|?/', 
    
    //调试配置
    'SHOW_PAGE_TRACE' => true,
    
    //用户相关设置 
    //最大缓存用户数
    'USER_MAX_CACHE'     => 1000, 
    //管理员用户ID
    'USER_ADMINISTRATOR' => 1, 
    
    //URL配置
    'URL_CASE_INSENSITIVE' => true,
    'URL_MODEL'            => 1,
    'VAR_URL_PARAMS'       => '', 
    'URL_PATHINFO_DEPR'    => '/', 
    
    //全局过滤配置 
    'DEFAULT_FILTER' => '',
    
    //数据库配置
    'DB_TYPE'   => 'mysqli',
    'DB_HOST'   => '127.0.0.1',
    'DB_NAME'   => 'fufeng',
    'DB_USER'   => 'root', 
    'DB_PWD'    => '',
    'DB_PORT'   => '3306',
    'DB_PREFIX' => 'ff_',
    
    //REDIS
    'DATA_CACHE_TYPE'=>'Redis',
    'DATA_CACHE_TIME' => 3600,
    'REDIS_RW_SEPARATE' => false,
    'REDIS_HOST'=>'127.0.0.1',
    'REDIS_PORT'=>'6379',
    'REDIS_TIMEOUT'=>'300',
    'REDIS_PERSISTENT'=>false,   
    
    'AUTH_KEY' => 'abcdefgh',
    'AUTH_IV' =>'abcdefgh',

    //本省ID
    'PROVINCE_ID' => 2898,
);