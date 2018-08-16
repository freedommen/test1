<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: datahome改写 <datahome@qq.com>  2014-3-17
// +----------------------------------------------------------------------

namespace Admin\Model; 
use Think\Model;

/**
 * 用户模型
 */

class AdminUserModel extends Model {
    public $tableName='admin';
    
    protected $_validate = array(
    
        /* 验证用户名 */
        array('nickname', '1,16', -1, self::EXISTS_VALIDATE, 'length'),
        array('nickname', '', -3, self::EXISTS_VALIDATE, 'unique'), //用户名被占用         

		/* 验证密码 */
		array('password', '4,30', -4, self::EXISTS_VALIDATE, 'length'), //密码长度不合法

		/* 验证邮箱 */
		array('email', 'email', -5, self::EXISTS_VALIDATE), //邮箱格式不正确
		array('email', '1,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
		array('email', 'checkDenyEmail', -7, self::EXISTS_VALIDATE, 'callback'), //邮箱禁止注册
		array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用

		/* 验证手机号码 */
		/*array('mobile', '//', -9, self::EXISTS_VALIDATE), //手机格式不正确 TODO:
		array('mobile', 'checkDenyMobile', -10, self::EXISTS_VALIDATE, 'callback'), //手机禁止注册
		array('mobile', '', -11, self::EXISTS_VALIDATE, 'unique'), //手机号被占用  */      
        
    );

	/* 用户模型自动完成 */
	protected $_auto = array(
		array('password', 'think_auth_md5', self::MODEL_BOTH, 'function', UC_AUTH_KEY),
		array('reg_time', NOW_TIME, self::MODEL_INSERT),
		array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
		//array('update_time', NOW_TIME),
		array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
	);
    
    
    public function lists($status = 1, $order = 'uid DESC', $field = true){
        $map = array('status' => $status);
        return $this->field($field)->where($map)->order($order)->select();
    }


    public function login($username, $password,$type){
        /* 检测是否在当前应用注册 */
        $user = $this->where(array('username'=>$username))->find();
        if(!$user){
            $this->error = '用户不存在！'; //应用级别禁用
            //return false;
            return -1;
        }
        
        if($user['password'] != $password){
            $this->error = '用户不存在！'; //应用级别禁用
            //return false;
            return -2;
        }
              
        if(1 != $user['status']) {
            $this->error = '用户已被禁用！'; //应用级别禁用
            //return false;
            return -1;
        }

        /*if($user['username'] != 'admin'){
        	//查询用户权限
        	$group_id = M('auth_group_access')->where(array('uid'=>$user['id']))->getField('group_id');
        	if($group_id == 2 && $type != 'common'){
        		$this->error = '用户角色错误！'; //应用级别禁用
	            //return false;
	            return -3;
        	}
            if($group_id == 3 && $type != 'custom'){
        		$this->error = '用户角色错误！'; //应用级别禁用
	            //return false;
	            return -3;
        	}
        }*/
        /*$username = $user['username'];
        $admin_id = $user['id'];
        //判断是否admin 是则增加admin标识
        if($username == 'admin'){
        	//判断角色
	        if($type == 'common'){
	        	$user = $this->where(array('username'=>'common'))->find();
	        }else{
	        	$user = $this->where(array('username'=>'custom'))->find();
	        }
	        $user['admin_id'] = $admin_id;
        }else{
        	$user = $this->where(array('username'=>$username))->find();
        }*/
        //记录行为
        action_log('user_login', 'admin', $user['id'], $user['id']);
        /* 登录用户 */
        $this->autoLogin($user);
        //return true;
        return $user['id'];
    }


    /**
     * 注销当前用户
     * @return void
     */
    public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }

    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'id'             => $user['id'], //admin标识
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
        	'id'              => $user['admin_id'],//管理员id
            'uid'             => $user['id'],
            'username'        => $user['nickname'],
            'last_login_time' => $user['last_login_time'],
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));

    }

    public function getNickName($uid){
        return $this->where(array('id'=>(int)$uid))->getField('nickname');
    }

    
	/**
	 * 注册一个新用户
	 * @param  string $username 用户名
	 * @param  string $password 用户密码
	 * @param  string $email    用户邮箱
	 * @param  string $mobile   用户手机号码
	 * @return integer          注册成功-用户信息，注册失败-错误编号
	 */
	public function register($username, $password, $email, $type){
		$data = array(
			'username' => $username,
			'nickname' => $username,
			'password' => $password,
			'email'    => $email,
			//'mobile'   => $mobile,
			'type'   => $type
		);

		//验证手机
		//if(empty($data['mobile'])) unset($data['mobile']);

		/* 添加用户 */
		if($this->create($data)){
			$uid = $this->add();
			return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
		} else {
			return $this->getError(); //错误详情见自动验证注释
		}
	}  
 
	/**
	 * 检测用户名是不是被禁止注册
	 * @param  string $nickname 用户名
	 * @return boolean          ture - 未禁用，false - 禁止注册
	 */
	protected function checkDenyMember($nickname){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 检测邮箱是不是被禁止注册
	 * @param  string $email 邮箱
	 * @return boolean       ture - 未禁用，false - 禁止注册
	 */
	protected function checkDenyEmail($email){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 检测手机是不是被禁止注册
	 * @param  string $mobile 手机
	 * @return boolean        ture - 未禁用，false - 禁止注册
	 */
	protected function checkDenyMobile($mobile){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 根据配置指定用户状态
	 * @return integer 用户状态
	 */
	protected function getStatus(){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 验证用户密码
	 * @param int $uid 用户id
	 * @param string $password_in 密码
	 * @return true 验证成功，false 验证失败
	 * @author huajie <banhuajie@163.com>
	 */
	public function verifyUser($uid, $password_in){
		$password = $this->where(array('id'=>$uid))->getField('password'); 
		if(think_auth_md5($password_in, UC_AUTH_KEY) === $password){    
			return true;
		}
		return false;
	} 

	/**
	 * 更新用户密码
	 * @param  string $uid  用户名
	 * @param  string $password 用户密码 
	 * @return integer          更新成功-用户信息，更新失败-错误编号
	 */
	public function updatePassword($uid, $oldPassword, $newPassword){       
        $password = $this->where(array('id'=>$uid))->getField('password');         
				if(think_auth_md5($oldPassword, UC_AUTH_KEY) === $password){ 
            $data   =   $this->create(array('id'=>$uid,'password'=>$newPassword) );            
            $res = $this->where(array('id'=>$uid))->save($data);            
						return true;      
         }else{
            return  false ;
        }            
    } 
	/**
	 * 更新其他管理员密码
	 * @param  string $uid  要被修改的管理员uid
	 * @param  string $mid  当前登陆的管理员uid
	 * @param  string $password 用户密码 
	 * @return integer          更新成功-用户信息，更新失败-错误编号
	 */
	public function upPassword( $uid,  $mid, $repassword, $password_in ){
		$password = $this->where(array('id'=>$mid))->getField('password'); 
		if(think_auth_md5($password_in, UC_AUTH_KEY) === $password){ 
            $data   =   $this->create(array('id'=>$uid,'password'=>$repassword) );            
            $res = $this->where(array('id'=>$uid))->save($data);            
			return true;      
         }else{
            return  false ;
        }            
    }    
 
}
