<?php
namespace ORG;
use Think\Controller;
use ORG\ZZSL\Des;
use ORG\ZZSL\Cmd;

class CommonController extends Controller{   
    //用户ID 
    public $user_id;
    //用户TOKEN
    public $token;
    //应用ID
    public $app_id;
    //应用类型
    public $app_type; 
    //客户端类型 安卓或者IOS
    public $client_type;
    //请求数据
    public $data = array();
    //3DES对象
    public $des = null;
    
    //错误信息
    //失败
    const ERR_FAILED = 0;
    //成功
    const ERR_SUCCESS = 1;
    //参数错误 
    const ERR_INVALID_PARAM = 1001;
    //token 过期
    const ERR_INVALID_TOKEN = 1002;


    private $login_allow = array('login','isregister','register','getvalidatecode','resetpassword');
    /**
     * 构造函数
     * @param string $appType 公众版或者店员版
     * @param string $isVerify 是否验证TOKEN
     * @throws \Exception
     */
    public function __construct($appType='', $isVerify= true){
        parent::__construct();
        $this->app_type = $appType;
        //获取加密数据
        $this->des = new Des(C("AUTH_KEY"), C("AUTH_IV"));
        $this->data = $this->_decode(Cmd::_post('parameters', array()));

//        $a = 'nFpskkS4EYW9o349VgI%2Bde%2BceV8n9KYbvEcLgAGOEZ158LG%2BwB1E5xNYFRpUiYvd4g2ME7WucuZ6G5Flvwz7DWBiPi6vwksZvUUt6x38IOOGhyEfcabqYn4qgb3P2it7wJ4k3Oakh/G5EbW5vbHn6RsL1RupeNUc0mvf%2BtWJaC%2BR4wx2aGlkFA%3D%3D';
//        $this->data = $this->_decode(Cmd::_get('parameters', array($a)));
//        $a = 'nFpskkS4EYW9o349VgI%2Bde%2BceV8n9KYbvEcLgAGOEZ158LG%2BwB1E5xNYFRpUiYvd4g2ME7WucuZ6G5Flvwz7DWBiPi6vwksZvUUt6x38IOOGhyEfcabqYn4qgb3P2it7wJ4k3Oakh/G5EbW5vbHn6RsL1RupeNUc0mvf%2BtWJaC%2BR4wx2aGlkFA%3D%3D';
//        $a = Cmd::_get('parameters',$a);
//        dump($this->_decode(Cmd::_get('parameters', $a)));die;

        if(!$isVerify){
            return;
        }
        if(in_array(ACTION_NAME,$this->login_allow) ){
            return;
        }
        // TODO 临时放行
        return;
        try{
            //检查数据是否为空
            if(empty($this->data)){
                throw new \Exception('无效的参数.', self::ERR_INVALID_PARAM);
            }
            
            //获取公用数据，如果为空，则返回错误
            foreach(array('client_type', 'token','user_id') as $v){
                $this->$v = Cmd::_arr($this->data, $v, null);
            }
            if(empty($this->client_type) || empty($this->app_id)){
                throw new \Exception('无效的参数,', self::ERR_INVALID_PARAM);
            }

            if($this->app_type == 'Cusapp'){
                $token_str = S('token_member_'.$this->user_id);
            }else{
                $token_str = S('token_user_'.$this->user_id);
            }
            if($token_str == $this->token){
                $info = tp_decrypt($this->token,C('APP_TOKEN'));
                $arr = explode('_',$info);
                if($arr{0} == $this->user_id){
                    return;
                }else{
                    $this->_output(self::ERR_INVALID_TOKEN, 'token已过期.', array());
                }
            }else{
                $this->_output(self::ERR_INVALID_TOKEN, 'token已过期', array());
            }
        }catch(\Exception $e){
            $this->_output($e->getCode(), $e->getMessage());
        }
    }
    
    protected function _getUserId(){
        //$this->user_id = Service::getUserId($this->token);
    }
    
    /**
     * 解密数据
     * @param array $data
     * @return string
     */
    protected function _decode($data){
        if(empty($data)){
            return array();
        }
        return json_decode($this->des->decrypt($data), TRUE);
    }   
    
    /**
     * 加密数据
     * @param string $data
     * @return array
     */
    protected function _encode($data){
        $data = json_encode($data);
        return $this->des->encrypt($data);
    }
    
    /**
     * 统一输出JSON格式数据
     * @param int $code
     * @param string $message
     * @param array $data
     */
    protected function _output($code, $message, $data=array()){
        echo json_encode(
            array(
                'code' => $code,
                'message' => $message,
                'updated' => time(),
                'data' => $this->_encode(all2str($data)),
            )
        );
        exit();
    }
    
	protected function _getRemoteIP(){
		if(getenv('HTTP_CLIENT_IP')){
			$ip = getenv('HTTP_CLIENT_IP');
		}elseif (getenv('HTTP_X_FORWARDED_FOR')){
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}elseif (getenv('HTTP_X_FORWARDED')){
			$ip = getenv('HTTP_X_FORWARDED');
		}elseif (getenv('HTTP_FORWARDED_FOR')){
			$ip = getenv('HTTP_FORWARDED_FOR');
		}elseif (getenv('HTTP_FORWARDED')){
			$ip = getenv('HTTP_FORWARDED');
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		} 
		return $ip;
    }
    
    protected function _getUserAgent(){
        return $_SERVER['HTTP_USER_AGENT'];
    }
    
    protected function _verifySign($sign, $data=array(), $appSecret=''){
        if(empty($data)){
            $data = $_POST;
        }
        unset($data['sign']);
        ksort($data);
        $strData = "";
        foreach($data as $k => $v){
            $strData .= "{$k}={$v}";
        }
        $strData .= empty($appSecret) ? C('ACTIVE_SECRET') : $appSecret;
        
        return (md5($strData) === $sign);
    }

}
