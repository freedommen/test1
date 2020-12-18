<?php  
namespace ORG\ZZSL;
use ORG\ZZSL\Net;

class ShortUrl{  
    public static function create($url){
        //新浪短网址 appkey需要替换 
        $api = "http://api.t.sina.com.cn/short_url/shorten.json?source=1681459862&url_long=";
        $res = Net::get($api . $url);
        $ret = json_decode($res, TRUE);
        if(empty($ret)){
            throw new \Exception("获取短网址失败", -1);
        }
        return $ret[0]['url_short'];
    } 
}  
?>  

