<?php
return array(
    //数据缓存设置
    //缓存前缀
    'DATA_CACHE_PREFIX' => 'ff_',
    // 数据缓存类型    
    'DATA_CACHE_TYPE'   => 'Redis',
    
    //文件上传相关配置 
    'DOWNLOAD_UPLOAD' => array(
        //允许上传的文件MiMe类型
        'mimes'    => '',
        //上传的文件大小限制 (0-不做限制)
        'maxSize'  => 2*1024*1024,
        //允许上传的文件后缀
        'exts'     => 'jpg,png,jpeg,pdf',
        //自动子目录保存文件
        'autoSub'  => true,
        //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'subName'  => array('date', 'Ymd'), 
        //保存根路径
        'rootPath' => './Uploads',
        //保存路径
        'savePath' => '/File/', 
        //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveName' => array('uniqid', ''), 
        //文件保存后缀，空则使用原后缀
        'saveExt'  => '',
        //存在同名是否覆盖
        'replace'  => false, 
        //是否生成hash编码
        'hash'     => true, 
        //检测文件是否存在回调函数，如果存在返回文件信息数组
        'callback' => false, 
    ),

    //图片上传相关配置
    'PICTURE_UPLOAD' => array(
        //允许上传的文件MiMe类型
        'mimes'    => '', 
        //上传的文件大小限制 (0-不做限制)
        'maxSize'  => 2*1024*1024,
        //允许上传的文件后缀
        'exts'     => 'jpg,gif,png,jpeg',
        //自动子目录保存文件
        'autoSub'  => true, 
        //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'subName'  => array('date', 'Ymd'), 
        //保存根路径
        'rootPath' => './Uploads', 
        //保存路径
        'savePath' => '/Picture/',
        //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveName' => array('uniqid', ''), 
        //文件保存后缀，空则使用原后缀
        'saveExt'  => '', 
        //存在同名是否覆盖
        'replace'  => false, 
        //是否生成hash编码
        'hash'     => true, 
        //检测文件是否存在回调函数，如果存在返回文件信息数组
        'callback' => false, 
        'hideUploads' => true,
    ),
    //xls上传相关配置
    'FILES_UPLOAD_XLS' => array(
        //允许上传的文件MiMe类型
        'mimes'    => '',
        //上传的文件大小限制 (0-不做限制)
        'maxSize'  => 5*1024*1024,
        //允许上传的文件后缀
        'exts'     => array('xlsx', 'xls'),
        //自动子目录保存文件
        'autoSub'  => true,
        //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'subName'  => array('date', 'Ymd'),
        //保存根路径
        'rootPath' => './Uploads/',
        //保存路径
        'savePath' => 'xls/',
        //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveName' => array('uniqid', ''),
        //文件保存后缀，空则使用原后缀
        'saveExt'  => '',
        //存在同名是否覆盖
        'replace'  => false,
        //是否生成hash编码
        'hash'     => true,
        //检测文件是否存在回调函数，如果存在返回文件信息数组
        'callback' => false,
        'hideUploads' => true,
    ),

    //本地上传文件驱动配置
    'PICTURE_UPLOAD_DRIVER'=>'local',
    'UPLOAD_LOCAL_CONFIG'=>array(),

    //模板相关配置
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . ltrim(MODULE_PATH, '.') . '/Public/Admin/Addons',
        '__IMG__'    => __ROOT__ . ltrim(MODULE_PATH, '.') . '/Public/Admin/images',
        '__CSS__'    => __ROOT__ . ltrim(MODULE_PATH, '.') . '/Public/Admin/css',
        '__JS__'     => __ROOT__ . ltrim(MODULE_PATH, '.') . '/Public/Admin/js',
    ),

    //SESSION 和 COOKIE
    //session前缀
    'SESSION_PREFIX' => 'ff_',
    //Cookie前缀 避免冲突
    'COOKIE_PREFIX'  => 'ff_',
    //修复uploadify插件无法传递session_id的bug
    'VAR_SESSION_ID' => 'session_id',
    
    /* 后台错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Public/success.html', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Public/exception.html',// 异常页面的模板文件
    
    'USER_ADMINISTRATOR'=>1,
    'FILE_DOMAIN' => '/Uploads',
);
