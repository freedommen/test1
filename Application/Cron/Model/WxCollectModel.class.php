<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 9:51
 */
namespace Cron\Model;
use Think\Model;
//\define('DAYDATE',date('Y-m-d',NOW_TIME-3600*24));

class WxCollectModel extends Model{
    const UserCumulate = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token={token}';//累计用户数据统计
    const UserSummary = 'https://api.weixin.qq.com/datacube/getusersummary?access_token={token}';//获取用户增减数据
//    const UserRead = 'https://api.weixin.qq.com/datacube/getuserread?access_token={token}';//获取图文统计数据
    const UserShare = 'https://api.weixin.qq.com/datacube/getusershare?access_token={token}';//获取图文分享转发数据
    const ArticleTotal = 'https://api.weixin.qq.com/datacube/getarticletotal?access_token={token}';//获取图文群发总数据
    const ArticleSummary = 'https://api.weixin.qq.com/datacube/getarticlesummary?access_token={token}';//获取图文群发每日数据
    const HotalInfoUrl = 'http://hotels.ctrip.com/hotel/beijing{id}';//酒店数据
    const TuanHotalUrl = 'http://tuan.ctrip.com/group/hotel/city_shanghai/page_{page_num}';//获取团购酒店数据
    const HomestayUrl = 'http://inn.ctrip.com/inn/tianjin{id}';//客栈民宿
    /*
     * post 方式模拟请求指定地址
     * @param  string url   请求的指定地址
     * @param  json  post_data 请求所带的
     * @return string curl_exec()获取的信息
     * @author andy
     **/
    static public function post($url,$post_data)
    {
        $data['code'] = 0;
        $data['data'] = $data['errcode'] = '';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $rs = curl_exec($curl);
        curl_close($curl);
        $rs = json_decode($rs, TRUE);
        if(!isset($rs['errcode'])){
            $data['code'] = 1;
            $data['data'] = $rs;
        }else{
            $data['errcode'] = $rs['errcode'];
        }
        return $data;

    }
    /**
     *
     *获取token
     **/
    static public function getToken(){
        $url = C('WXURL').'?app_id='.C('APPID').'&app_secret=' . C('APPSECRET') . '&sign='.md5(C('APPID').C('SIGN'));
        $res = file_get_contents($url);
        $dataInfo = json_decode($res, TRUE);
        $accessToken = $dataInfo['access_token'];
        return $accessToken;
    }


    /**微信用户数据
     * @param $msg
     * @return string
     */
    public function addUserTotal($ymd,&$msg){
        $date = $ymd;
        $model = D('wxUsers');
        $data['created'] = time();
        $data['s_date'] = date('Ymd',strtotime($ymd));//日期
        $data['active_num'] = $this->articleTotalCount($date)['activeNum'];//活跃用户人数
        $data['user_num'] = $this->getUserSummary($date);//获取新增用户数量
        $data['total_user_num'] = $this->getUserCumulate($date);//累计用户数据统计
        //查询当前数据是否添加过
        $list= $model->where(['s_date' => $data['s_date']])->delete();
        if($lastInsId = $model->add($data)){
            $str = $this->array2string($data);
            $msg = "执行时间 ".date('Y-m-d H:i:s')." <br/>ff_wx_user 插入数据 id 为：$lastInsId "." 【字段：".$str."】";
        } else {
            $msg =  "执行时间 ".date('Y-m-d H:i:s').' ff_wx_user数据插入失败';
        }
        return $msg;
    }

    /**累计用户数据
     * @param $date
     * @return int
     */
    private function getUserCumulate($date){
        $cumulateUser = 0;
        $token = self::getToken();
//        $post_data['end_date'] = $post_data['begin_date'] =  '2018-04-28';
        $post_data['end_date'] = $post_data['begin_date'] =  $date;
        $url = str_replace('{token}',$token,self::UserCumulate);
        $data = self::post($url,json_encode($post_data));
        if($data['code'] == 1 && !empty($data['data']['list'])){
            foreach($data['data']['list'] as $k => $v){
                $cumulateUser += $v['cumulate_user'];
            }
        }
        return $cumulateUser;
    }
    /**获取新增用户数量
     * @param $date
     * @return int
     */
    private function getUserSummary($date){
        $newUser = 0;
        $token = self::getToken();
        $post_data['end_date'] = $post_data['begin_date'] =  $date;
        $url = str_replace('{token}',$token,self::UserSummary);
        $data = self::post($url,json_encode($post_data));
        if($data['code'] == 1 && !empty($data['data']['list'])){
            foreach($data['data']['list'] as $k => $v){
                $newUser += $v['new_user'];
            }
        }
        return $newUser;
    }

    /**返回 活跃用户人数 阅读人数 阅读次数
     * @param $date
     * @return mixed
     */
    private function articleTotalCount($date){
        $rs['readUserCount'] = $rs['readCount'] = $rs['activeNum'] = 0;
        $token = self::getToken();
        
        $readCount = 0;
        $readUserCount = 0;
        $articleCount = 0;
        $activeNum = 0;
        $artileData = array();
        
        //获取七天数据
        for($i=6; $i >=0; $i--){
            $tmpDate = date('Y-m-d', strtotime("-$i day", strtotime($date)));
            $post_data['end_date'] = $post_data['begin_date'] =  $tmpDate;
            $articleTotalUrl = str_replace('{token}', $token, self::ArticleTotal);
            $data = self::post($articleTotalUrl,json_encode($post_data));
            if($data['code'] == 1 && !empty($data['data']['list'])){
                foreach($data['data']['list'] as $k => $v){
                    $tmpDetail = $this->getReadCount($v['details'], $date);
                    if($tmpDetail['readCount'] != 0){
                        $articleData[$v['msgid']] = $v['msgid'];
                        $readCount += $tmpDetail['readCount'];//时间段内所有文章阅读量总和
                        $readUserCount += $tmpDetail['readUserCount'];//时间段内公众号会话阅读人数
                    }
                }
            }
        }
        
        $articleCount = count($articleData);
        $rs = array(
            'ref_date' => $date,
            'readCount' => $readCount,
            'readUserCount' => $readUserCount,
            'articleCount' => $articleCount,
            'activeNum' => !empty($articleCount) ? round($readCount/ $articleCount) : 0,
        );
        return $rs;
    }

    /**添加微信文章数据
     * @param $msg
     * @return string
     */
    public function addArticleTotal($ymd,&$msg){
        $date = $ymd;
        $model = D('wxStatistics');
        $data['created'] = time();
        $data['s_date'] = date('Ymd',strtotime($ymd));//日期
        $param = $this->articleTotalCount($date);//活跃用户人数
        $data['read_num'] = $param['readCount'] ;//阅读次数
        $data['read_user_num'] = $param['readUserCount'] ;//阅读人数
        $data['forward_num'] = $this->getUserShare($date);//分享人数
        $data['collection_num'] = $this->getArticleSummary($date);//收藏次数
        //查询当前数据是否添加过
        $list= $model->where(['s_date' => $data['s_date']])->delete();
        if($lastInsId = $model->add($data)){
            $str = $this->array2string($data);
            $msg = "执行时间 ".date('Y-m-d H:i:s')." <br/>ff_wx_statistics 插入数据 id 为：$lastInsId "." 【字段：".$str."】";
        } else {
            $msg =  "执行时间 ".date('Y-m-d H:i:s').' ff_wx_statistics数据插入失败';
        }
        return $msg;

    }

    /**微信文章分享次数
     * @param $date
     * @return int
     */
    private function getUserShare($date){
        $shareCount = 0;
        $token = self::getToken();
        $post_data['end_date'] = $post_data['begin_date'] =  $date;
        $articleTotalUrl = str_replace('{token}',$token,self::UserShare);
        $data = self::post($articleTotalUrl,json_encode($post_data));
        if($data['code'] == 1 && !empty($data['data']['list'])){
            foreach($data['data']['list'] as $k => $v){
                $shareCount += $v['share_user'];//分享人数统计
            }
        }
        return $shareCount;
    }

    /**收藏次数
     * @param $date
     * @return int
     */
    private function getArticleSummary($date){
        $fav = 0;
        $token = self::getToken();
        $post_data['end_date'] = $post_data['begin_date'] =  $date;
        $articleSummary = str_replace('{token}',$token,self::ArticleSummary);
        $data = self::post($articleSummary,json_encode($post_data));
        if($data['code'] == 1 && !empty($data['data']['list'])){
            foreach($data['data']['list'] as $k => $v){
                $fav += $v['add_to_fav_count'];//收藏次数
            }
        }
        return $fav;
    }

    /**插入数据数组转换为字符串
     * @param $array
     * @return mixed
     */
    private function array2string($array){
        $string = [];
        if($array && is_array($array)){

            foreach ($array as $key=> $value){
                $string[] = $key.'->'.$value;
            }
        }
        return implode(',',$string);
    }


    /**
     * 酒店数据
     */
    public function addHotal($start_id,$end_id){
        ini_set('max_execution_time', '0');
        $param = [];
        $model = M('Hotal');
        for($i = $start_id;$i<=$end_id;++$i){
            $url = str_replace('{id}',$i,self::HotalInfoUrl);
            $data = @file_get_contents($url);
            if(!empty($data)){
                $hotalIds = $this->get_tag_data($data,"h2","class","hotel_name","data-id");
                $hotalName = $this->get_hotel_name($data);
                $rs = array_combine($hotalIds,$hotalName);
                foreach ($rs as $k => $v){
                    $param[$k]['hotal_id'] = $k;
                    $param[$k]['hotal_name'] = $v;
                    $param[$k]['ctime'] = time();
                    echo $k.'-'.$v.'<br/>';
                }
            }
            if(!empty($param)){
                sort($param,1);
                $ids = implode(',',$hotalIds);
                $list = $model->where(array('hotal_id' => array('in', $ids)))->select();
                if(empty($list)){
                    echo $model->addAll($param)? 'success'.'<br/>' : '添加失败'.'<br/>';
                    $param = [];
                }else{
                    echo '数据重复'.'<br/>';
                }
            }
        }
        echo '采集完成';
    }

    /**酒店id正则
     * @param $str
     * @param $tag
     * @param $attrname
     * @param $value
     * @param $param
     * @return mixed
     */
    private function get_tag_data($str,$tag,$attrname,$value,$param){ //返回值为数组 ,查找到的标签内的内容
        $regex = "/<$tag.*?$attrname=\".*?$value.*?\".*?$param=\"(.*?)\">(.*?)<\/$tag>/ism";
        preg_match_all($regex,$str,$matches,PREG_PATTERN_ORDER);
        return $matches[1];

    }

    /**酒店名称正则
     * @param $str
     * @return mixed
     */
    private function get_hotel_name($str){ //返回值为数组 ,查找到的标签内的内容
        $regex = "/<span.*?class=\"hotel_num\">.*?<\/span>(.*?)<\/a>/ism";
        preg_match_all($regex,$str,$matches,PREG_PATTERN_ORDER);
        return $matches[1];

    }


    
    
    private function getReadCount($detail, $date){
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($date)));
        $yesterdayData = $todayData = array(
            'readCount' => 0,
            'readUserCount'  => 0, 
        );
        foreach($detail as $k => $v){
            if($v['stat_date'] == $yesterday){
                $yesterdayData['readCount'] = $v['int_page_from_session_read_count'];
                $yesterdayData['readUserCount'] = $v['int_page_from_session_read_user'];
            }else if($v['stat_date'] == $date){
                $todayData['readCount'] = $v['int_page_from_session_read_count'];
                $todayData['readUserCount'] = $v['int_page_from_session_read_user'];
                break;
            }
        }
        if(isset($todayData['readCount']) && $todayData['readCount'] != 0 && $todayData['readUserCount'] != 0){
            $todayData['readCount'] -= $yesterdayData['readCount'];
            $todayData['readUserCount'] -= $yesterdayData['readUserCount'];
        }
       
        return $todayData;
    }

    /**gbk编码转换为utf8
     * @param $arr
     * @param string $in_charset
     * @param string $out_charset
     * @return mixed
     */
    function array_iconv($arr, $in_charset="gbk", $out_charset="utf-8")
    {
        $ret = eval('return '.iconv($in_charset,$out_charset,var_export($arr,true).';'));
        return $ret;
    }

    /**团购酒店数据
     * @param $page_num
     */
    public function addTuanHotal($page_num){
        ini_set('max_execution_time', '0');
        $model = M('TuangouHotal');
        $url = self::TuanHotalUrl;
        $data = @file_get_contents($url);
        if(!empty($data)){
            $hotalUrl = $this->get_tuan_hotel_str($data);
        }
        if(!empty($hotalUrl)){
            foreach($hotalUrl as $k =>$v){
                $url = str_replace('city_shanghai',$v,self::TuanHotalUrl);
                $url = str_replace('{page_num}',$page_num,$url);
                $rs = @file_get_contents($url);
                if(empty($this->getNoResult($rs))){
                    $hotalName = $this->get_hotel_name($rs);//酒店名称
                    $hotalName = $this->array_iconv($hotalName);//gbk转换为utf8
                    $hotalIds = $this->get_tag_data($rs,'div','class','gp-list-box clearfix','id');//酒店id
                    $rs = array_combine($hotalIds,$hotalName);
                    foreach ($rs as $k => $v){
                        $param[$k]['hotal_id'] = $k;
                        $param[$k]['name'] =$v;
                        $param[$k]['ctime'] = time();
                    echo $k.'-'.$v.'<br/>';
                    }
                    if(!empty($param)){
                        sort($param,1);
                        $ids = implode(',',$hotalIds);
                        $list = $model->where(array('hotal_id' => array('in', $ids)))->select();
                        if(empty($list)){
                            echo $model->addAll($param)? 'success'.'<br/>' : '添加失败'.'<br/>';
                            $param = [];
                        }else{
                            echo '数据重复'.'<br/>';
                        }
                    }
                }else{
                    echo $v.'分页到头了'.'<br/>';
                }
            }
            echo '采集完成';
        }
    }

    /**团购城市列表
     * @param $str
     * @return mixed
     */
    private function get_tuan_hotel_str($str){ //返回值为数组 ,查找到的标签内的内容
        $regex = "/class=\"letter-city\".*?cid=\"group\/.*?(.*?)\/.*?\"/ism";
        preg_match_all($regex,$str,$matches,PREG_PATTERN_ORDER);
        return $matches[1];

    }
    /**
     * 页码不存在时正则
     */
    private function getNoResult($str)
    {
        $regex = "/class=\"search-noresult\"(.*?)/ism";
        preg_match_all($regex,$str,$matches,PREG_PATTERN_ORDER);
        return $matches[1];
    }

    /**客栈民宿
     * @param $start_id
     * @param $end_id
     */
    public function addHomestay($start_id,$end_id){
        ini_set('max_execution_time', '0');
        $param = [];
        $model = M('Homestay');
        for($i = $start_id;$i<=$end_id;++$i){
            $url = str_replace('{id}',$i,self::HomestayUrl);
            $data = @file_get_contents($url);
            if(!empty($data)){
                $hotalIds = $this->get_tag_data($data,"h2","class","searchresult_name","data-id");//酒店id集合
                $hotalName = $this->get_hotel_name($data);//酒店名称集合
                $rs = array_combine($hotalIds,$hotalName);
                foreach ($rs as $k => $v){
                    $param[$k]['hotal_id'] = $k;
                    $param[$k]['name'] = $v;
                    $param[$k]['ctime'] = time();
                    echo $k.'-'.$v.'<br/>';
                }
            }
            if(!empty($param)){
                sort($param,1);
                $ids = implode(',',$hotalIds);
                $list = $model->where(array('hotal_id' => array('in', $ids)))->select();
                if(empty($list)){
                    echo $model->addAll($param)? 'success'.'<br/>' : '添加失败'.'<br/>';
                    $param = [];
                }else{
                    echo '数据重复'.'<br/>';
                }
            }
        }
        echo '采集完成';
    }
}

