<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 9:51
 */
namespace Admin\Model;
use Think\Model;
//\define('DAYDATE',date('Y-m-d',NOW_TIME-3600*24));

class WxCollectModel extends Model{
    const UserCumulate = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token={token}';//累计用户数据统计
    const UserSummary = 'https://api.weixin.qq.com/datacube/getusersummary?access_token={token}';//获取用户增减数据
//    const UserRead = 'https://api.weixin.qq.com/datacube/getuserread?access_token={token}';//获取图文统计数据
    const UserShare = 'https://api.weixin.qq.com/datacube/getusershare?access_token={token}';//获取图文分享转发数据
    const ArticleTotal = 'https://api.weixin.qq.com/datacube/getarticletotal?access_token={token}';//获取图文群发总数据
    const ArticleSummary = 'https://api.weixin.qq.com/datacube/getarticlesummary?access_token={token}';//获取图文群发每日数据
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
        $url = C('WXURL').'?app_id='.C('APPID').'&sign='.md5(C('APPID').C('SIGN'));
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
        $model = D('wxUser');
        $data['created'] = time();
        $data['s_date'] = date('Ymd',strtotime($ymd));//日期
        $data['active_num'] = $this->articleTotalCount($date)['activeNum'];//活跃用户人数
        $data['user_num'] = $this->getUserSummary($date);//获取新增用户数量
        $data['total_user_num'] = $this->getUserCumulate($date);//累计用户数据统计
        //查询当前数据是否添加过
        $list= $model->where(['s_date' => $data['s_date']])->delete();
        if($lastInsId = $model->add($data)){
            $msg = "ff_wx_user 插入数据 id 为：$lastInsId";
        } else {
            $msg =  '数据插入失败';
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
        $post_data['end_date'] = $post_data['begin_date'] =  $date;
        $articleTotalUrl = str_replace('{token}',$token,self::ArticleTotal);
        $data = self::post($articleTotalUrl,json_encode($post_data));
        if($data['code'] == 1 && !empty($data['data']['list'])){
            foreach($data['data']['list'] as $k => $v){
                $readCount = $v['details'][0];
                $rs['ref_date'] = $v['ref_date'];//数据日期
                $rs['readCount'] += $readCount['int_page_from_session_read_count'];//时间段内所有文章阅读量总和
                $rs['readUserCount'] += $readCount['int_page_from_session_read_user'];//时间段内公众号会话阅读人数
            }
            $rs['articleCount'] = count($data);//时间段内所有被阅读文章数量
            $rs['activeNum'] = round($rs['readCount']/$rs['articleCount']);//活跃用户人数
        }
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
            $msg = "ff_wx_statistics 插入数据 id 为：$lastInsId";
        } else {
            $msg =  '数据插入失败';
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
}