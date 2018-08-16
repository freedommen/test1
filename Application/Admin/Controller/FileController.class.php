<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: iniu <2497178892>
// +----------------------------------------------------------------------

 
//use User\Api\UserApi as UserApi;
 
namespace Admin\Controller;
use Admin\Controller\AdminController;
/**
 * 上传文件
 * @author iniu <2497178892>
 */
class FileController extends AdminController {

    /**
     * 上传文件
     * @author iniu <2497178892>
     */
    public function uploadPicture( $name = '' ){
		/* 返回标准数据 */
		$config = array(
			'mimes'         =>  array(), //允许上传的文件MiMe类型
			'maxSize'       =>  2*1024*1024, //上传的文件大小限制 (0-不做限制)
			'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
			'autoSub'       =>  true, //自动子目录保存文件
			'subName'       =>  array('date', 'Ymd'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
			'rootPath'      =>  './Uploads/', //保存根路径
			'savePath'      =>  'Picture/',//保存路径
		);
		$config = C('PICTURE_UPLOAD');
    	$upload = new \Think\Upload($config,C('PICTURE_UPLOAD_DRIVER'));// 实例化上传类
    	$info = $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	    	echo json_encode(array('status'=>0, 'info'=>$upload->getError(),'name'=>$name));
	    }else{// 上传成功
			$value = $info['download'];
			foreach ($info as $val){
				$data['url'] = substr($config['rootPath'].$val['savepath'].$val['savename'],1);
				//$return['url'] = substr($PICTURE_UPLOAD['rootPath'].$val['savepath'].$val['savename'],1);
			}
			echo json_encode(array('status'=>1,'info'=>'上传成功','data'=>$data));
		exit();
	    }
    }

	/***
	 * 广告上传
	 */
	public function webup(){

		$config = C('PICTURE_UPLOAD');
		$upload = new \Think\Upload($config);// 实例化上传类
		$info   =   $upload->upload();
		if(!$info) {
			$this->error($upload->getError());// 上传错误提示错误信息
		}else{// 上传成功
			foreach ($info as $va){
				$return.= substr($config['rootPath'].$va['savepath'].$va['savename'],1);
			}
			/* 返回JSON数据 */
			session('webupimage',$return);
			$this->ajaxReturn($return);
		}
	}

	/**
	 * 上传图片
	 * @author huajie <banhuajie@163.com>
	 */
	public function uploadImg(){
		//TODO: 用户登录检测

		/* 返回标准数据 */
		$return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

		/* 调用文件上传组件上传文件 */
		$Picture = D('Picture');
		$pic_driver = C('PICTURE_UPLOAD_DRIVER');
		$info = $Picture->upload(
			$_FILES,
			C('PICTURE_UPLOAD'),
			C('PICTURE_UPLOAD_DRIVER'),
			C("UPLOAD_{$pic_driver}_CONFIG")
		); //TODO:上传到远程服务器

		/* 记录图片信息 */
		if($info){
			$return['status'] = 1;
			$return = array_merge($info['download'], $return);
		} else {
			$return['status'] = 0;
			$return['info']   = $Picture->getError();
		}

		/* 返回JSON数据 */
		$this->ajaxReturn($return);
	}

    /* 文件上传 */
    public function upload(){
        $type = $_REQUEST['type'];
        if($type == 'package' || $type == 'file'){
            $config = C('DOWNLOAD_UPLOAD');
        }else{
            $config = C('PICTURE_UPLOAD');
        }
        $upload = new \Think\Upload($config);// 实例化上传类
        $info = $upload->upload();

        /* 记录图片信息 */
        if($info){
            $return['status'] = 1;
            $return = array_merge($info['download'], $return);
        } else {
            $return['status'] = 0;
            $return['info']   = $upload->getError();
        }
        if($type == 'file'){
        	$return['status'] = 1;
        	foreach ($info as $val){
				$return['url'] = substr($config['rootPath'].$val['savepath'].$val['savename'],1);
			}
        }
        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}