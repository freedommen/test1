<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: datahome改写 <datahome@qq.com>  2014-3-17
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Admin\Controller\AdminController;
use Admin\Model\AdminUserModel;
use ORG\ZZSL\Cmd;
/**
 * 后台用户控制器
 * @author  datahome改写 <datahome@qq.com>  2014-2-26
 */
class UserController extends AdminController {
    public static $limit = 20;

    /**
     * 用户管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $model = 'Admin' ;  //模型名称        
        if(session('user_auth')['id'] > 0){
            $map['id'] = array( 'eq', session('user_auth')['id']);
        }else{
            $map['id'] = array( 'eq', UID);
        }
        //使用前台排序
        //$list  =  M($model)->where($map)->select(); 
        $list = M($model)->where($map)->limit($page->firstRow, $page->listRows)->select();    
        int_to_string($list);
        $this->assign('_list', $list);
        $this->meta_title = '我的';
        $this->display();
    }

    /**
     * 我的
     */
    public function mine(){
        $page = Cmd::_get('p', 1);
        //$limit = Cmd::_get('limit', self::$limit);
        //获取列表数据
        $model = 'Admin' ;  //模型名称        
        //查询过滤条件    
    
        $nickname       =   I('nickname');
        $this->assign('nickname',$nickname);
        $map['status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['id|nickname']=   array(intval($nickname),array('like','%'.$nickname.'%'),'_multi'=>true);
        }else{
            $map['nickname']    =   array('like', '%'.(string)$nickname.'%');
        }

        //使用后台排序
        //$list   =   $this->lists($model, $map);
        if( UID != 1 ){
            $map['id'] = array( 'neq', 1 );
        }
        //使用前台排序
        //$list  =  M($model)->where($map)->select(); 
        $count = M($model)->where($map)->count();
        $page = getNewPage($count,self::$limit);
        $list = M($model)->where($map)->limit($page->firstRow, $page->listRows)->select();
        $this->_page = $page->show();
        
        int_to_string($list);
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    /**
     * 修改昵称初始化
     * @author huajie <banhuajie@163.com>
     */
    public function updateNickname(){
        $uid = I('param.uid');
        //$nickname = M('Member')->getFieldByUid(UID, 'nickname');
        $nickname = M('Admin')->where(array('id'=>$uid))->getField('nickname');
        $this->assign('nickname', $nickname);
        $this->assign('uid',$uid);
        $this->meta_title = '修改昵称';
        $this->display();
    }

    /**
     * 修改昵称提交
     * @author huajie <banhuajie@163.com>
     */
    public function submitNickname(){
        //获取参数
        $nickname = I('post.nickname');
        $password = I('post.password');
        $uid = I('param.uid');
        empty($nickname) && $this->error('请输入昵称');
        empty($password) && $this->error('请输入密码');        
 
        // 需要验证  密码        
        //$Member =   D('Member'); 
        $Member = D('AdminUser');
        if(!$Member->verifyUser($uid,$password) ) {
            $this->error('原密码不符！');
        }                 
        //$data   =   $Member->create(array('nickname'=>$nickname,'password'=>$password));
        $data   =   M('admin')->create(array('nickname'=>$nickname));
        if(!$data){
            $this->error($Member->getError());
        }

        $res = $Member->where(array('id'=>$uid))->save($data);

        if($res !== FALSE){
            /*if($uid == UID){
                $user               =   session('user_auth');
                $user['username']   =   $data['nickname'];
                session('user_auth', $user);
                session('user_auth_sign', data_auth_sign($user));
            }*/
            $this->success('修改昵称成功！',U('User/index'));
        }else{
            $this->error('修改昵称失败！');
        }
    }
     

    /**
     * 修改密码初始化
     * @author huajie <banhuajie@163.com>
     */
    public function updatePassword( $uid = 0 ){
        $this->meta_title = '修改密码';
        $uid = I('param.uid');
        if( $uid ){
            $this->uid = $uid;
        }
        $this->display();
    }

    /**
     * 修改密码提交
     * @author huajie <banhuajie@163.com>
     */
    public function submitPassword(){
        //获取参数
        $password   =   I('post.old');
        $uid   =   I('post.uid');
        if( !$uid ){
            $uid = UID;
        }
        empty($password) && $this->error('请输入原密码');
        $data['password'] = I('post.password');
        empty($data['password']) && $this->error('请输入新密码');
        $repassword = I('post.repassword');
        empty($repassword) && $this->error('请输入确认密码');

        if($data['password'] !== $repassword){
            $this->error('您输入的新密码与确认密码不一致');
        }   
        
        /* 调用修改密码接口 */
        //$Member   =   D('Member') ;
        $Member = D('AdminUser');
        $res    =   $Member->updatePassword($uid, $password, $repassword);                
        if($res){ //修改密码成功
            $this->success('密码修改成功！',U('User/Index')); 
        } else { //修改密码失败，显示错误信息         
            $this->error('原密码不符！'); 
        }     
            
 
    }
    
    /**
     * 用户资料新增        
     * @author  datahome改写 <datahome@qq.com>  2014-2-25
     */
    public function add($username = '', $password = '', $repassword = '', $email = '', $type = ''){
        if(IS_POST){
            /* 检测密码 */
            if($password != $repassword){
                $this->error('密码和重复密码不一致！');
            }

            /* 调用注册接口注册用户 */
            //$Member   =   D('Member') ;
            $Member = D('AdminUser');
            $res    =   $Member->register($username, $password, $email, $type);          
            
            if(0 < $res){ //注册成功
                $this->success('用户添加成功！',U('index')); 
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($res));
            }
        } else {
            $this->meta_title = '新增用户';
            $this->display();
        }
    }
    /**
     * 用户资料新增        
     * @author  datahome改写 <datahome@qq.com>  2014-2-25
     */
    public function addData($username = '', $password = '', $repassword = '', $email = '', $type = ''){
        if(IS_POST){
            /* 检测密码 */
            if($password != $repassword){
                $this->error('密码和重复密码不一致！');
            }
            //检测用户名是否重复
            $result = M('admin')->where(array('username'=>$username))->count();
            if($result){
                $this->error('用户名重复！');
            }

            /* 调用注册接口注册用户 */
            //$Member   =   D('Member') ;
            $Member = D('AdminUser');
            $res    =   $Member->register($username, $password, $email, $type);          
            
            if(0 < $res){ //注册成功
                //$this->success('用户添加成功！',U('index')); 
                $this->success('用户添加成功！',U('mine'));
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($res));
            }
        } else {
            $this->meta_title = '新增用户';
            $this->display('add');
        }
    }

    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showRegError($code = 0){
        switch ($code) {
            case -1:  $error = '用户名长度必须在16个字符以内！'; break;
            case -2:  $error = '用户名被禁止注册！'; break;
            case -3:  $error = '用户名被占用！'; break;
            case -4:  $error = '密码长度必须在4-30个字符之间！'; break;
            case -5:  $error = '邮箱格式不正确！'; break;
            case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
            case -7:  $error = '邮箱被禁止注册！'; break;
            case -8:  $error = '邮箱被占用！'; break;
            case -9:  $error = '手机格式不正确！'; break;
            case -10: $error = '手机被禁止注册！'; break;
            case -11: $error = '手机号被占用！'; break;
            default:  $error = '未知错误';
        }
        return $error;
    }    

    /**
     * 用户行为列表
     * @author huajie <banhuajie@163.com>
     */
    public function action(){
        //获取列表数据
        $model = 'Action' ;  //模型名称 
        
        //查询过滤条件
        $map['status']    =   array('gt', -1);        
 
        //使用后台排序
        //$list   =   $this->lists($model, $map);
        
        //使用前台排序
		$list  =  M($model)->where($map)->select();        
 
        int_to_string($list);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);

        $this->assign('_list', $list);
        $this->meta_title = '用户行为';
        $this->display();
    }

    /**
     * 新增行为
     * @author huajie <banhuajie@163.com>
     */
    public function addAction(){
        $this->meta_title = '新增行为';
        $this->assign('data',null);
        $this->display('editaction');
    }

    /**
     * 编辑行为
     * @author huajie <banhuajie@163.com>
     */
    public function editAction(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = M('Action')->field(true)->find($id);

        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display('editaction');
    }

    /**
     * 更新行为
     * @author huajie <banhuajie@163.com>
     */
    public function saveAction(){
        $res = D('Action')->update();
        if(!$res){
            $this->error(D('Action')->getError());
        }else{
            $this->success($res['id']?'更新成功！':'新增成功！', Cookie('__forward__'));
        }
    }

    /**
     * 会员状态修改
     * @author 朱亚杰 <zhuyajie@topthink.net>
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
        if( in_array(C('USER_ADMINISTRATOR'), $id)){
            $this->error("不允许对超级管理员执行该操作!");
        }
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['uid'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbiduser':
                $this->forbid('Member', $map );
                break;
            case 'resumeuser':
                $this->resume('Member', $map );
                break;
            case 'deleteuser':
                $this->delete('Member', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }
    /**
     * 切换用户角色
     */
    public function changeRole(){
        //查询角色
        $role = M('auth_group_access')->where(array('uid'=>UID))->find();
        if($role['group_id'] == 2){
            //店员版
            $user = M('admin')->where(array('username'=>'custom'))->find();
        }else{
            //大众版
            $user = M('admin')->where(array('username'=>'common'))->find();
        }
        if(session('user_auth')['id'] > 0){
            $user['admin_id'] = session('user_auth')['id'];
        }
        //记录行为
        action_log('user_login', 'admin', $user['id'], $user['id']);
        /* 登录用户 */
        $this->autoLogin($user);
    }
    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'id'             => $user['id'],
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        M('admin')->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            //'id'              => $user['admin_id'],//管理员id
            'uid'             => $user['id'],
            'username'        => $user['nickname'],
            'last_login_time' => $user['last_login_time'],
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
        //$this->redirect('Index/index');
        $this->redirect('Data/dashboard');
    }

}
