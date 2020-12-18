<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: datahome改写 <datahome@qq.com>  2014-2-25
// +----------------------------------------------------------------------
 
 
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminUserModel;
/**
 * 后台登录页控制器
 * @author datahome改写 <datahome@qq.com>
 */
class PublicController extends Controller {

    /**
     * 后台用户登录
     * @author datahome改写 <datahome@qq.com>
     */
    public function login($username = null, $password = null, $verify = null){
        /* 记录登录SESSION和COOKIES */
//        $auth = array(
//            'id'              => 1, //$user['admin_id'],//管理员id
//            'uid'             => 1, //$user['id'],
//            'username'        => 'admin', //$user['nickname'],
//            'last_login_time' => \time(),//$user['last_login_time'],
//        );
//
//        session('user_auth', $auth);
//        session('user_auth_sign', data_auth_sign($auth));
        if(IS_POST){
            // 检测验证码 
            if(!check_verify($verify)){
//                $this->error('验证码输入错误！');
            }
            //判断角色
            $type = I('type');
            //调用 Member 模型的 login 方法，验证用户名、密码
            $Member = D('AdminUser');
//            $uid = $Member->login($username, md5($password));
            $uid = $Member->login($username,think_auth_md5($password, UC_AUTH_KEY),$type);

            //$uid =1;
            if(0 < $uid){ // 登录成功，$uid 为登录的 UID
                //跳转到登录前页面
                $this->success('登录成功！', U('Index/index'));
//                $this->success('登录成功！', U('Data/dashboard'));
            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    case -3: $error = '用户角色错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Index/index');
//                $this->redirect('Data/dashboard');
            }else{
				$config['WEB_SITE_TITLE'] = C('WEB_SITE_TITLE');
                C($config); //添加配置
                
                $this->display();
            }
        }
    }

    //退出登录 ,清除 session
    public function logout(){
        if(is_login()){
            //D('Member')->logout();
            D('AdminUser')->logout();
            session_start();
            session(null);
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    //生成 验证码
    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

}
