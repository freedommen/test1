<?php
namespace Cron\Controller;


//use Think\Controller;
//use Cron\Model\SentimentModel;


class SentimentController //extends Controller
{

    public function autoLoad(){
        $startdate = $_SERVER['argv'][2] ? $_SERVER['argv'][2] : 20170601;
        $enddate = $_SERVER['argv'][3] ? $_SERVER['argv'][3] : 20181231;
        $data_arr = $this->getDateFromRange($startdate, $enddate);
       // $ymd = date('Ymd', \time());
        foreach ($data_arr as $v){
            $this->addSentimentIndex($v);
        }
        echo '---addSentimentIndex--ok---';

    }

    /**
     * 获取指定日期段内每一天的日期
     * @param  Date  $startdate 开始日期
     * @param  Date  $enddate   结束日期
     * @return Array
     */
    private function getDateFromRange($startdate, $enddate){

        $stimestamp = strtotime($startdate);
        $etimestamp = strtotime($enddate);
        // 计算日期段内有多少天
        $days = ($etimestamp-$stimestamp)/86400+1;
        // 保存每天日期
        $date = array();
        for($i=0; $i<$days; $i++){
            $date[] = date('Ymd', $stimestamp+(86400*$i));
        }
        return $date;
    }

    /**
     * 舆情正负情感走势
     * 情感值
     */
   public function addSentimentIndex($date){
       \M('SentimentIndex')->where(['s_date'=>$date])->delete();
       \M('SentimentMediaRank')->where(['s_date'=>$date])->delete();
       \M('SentimentPopular')->where(['s_date'=>$date])->delete();
       for ($i=0;$i<24;$i++){
           //舆情正负走势
           $positive_index  = \rand(0,10);
           $negative_index  = \rand(0,3);
           $data[$i]['s_date'] = $date;
           //小时
           $data[$i]['s_time'] = \strtotime("+{$i} hours",\strtotime($date));

           //正面
           $data[$i]['positive_index'] = $positive_index;
           //负面
           $data[$i]['negative_index'] = $negative_index;
           //情感值
           $data[$i]['sentiment_index'] = $positive_index-$negative_index;
           $data[$i]['created'] = \time();
           $res_arr = array('s_date'=>$date,'s_time'=>$data[$i]['s_time'],'sentiment'=>$positive_index + $negative_index);
           //舆情声量走势分析;
           //每小时的声量值=每个媒体按比例算出正负面数量，然后累加
           $this->addSentimentPopular($res_arr);
           //媒体排行榜 按比例（5%-10%）计算正面+负面
           $this->addSentimentMediaRank($res_arr);
       }
       M('SentimentIndex')->addAll($data);
   }

   /**
    * 舆情声量走势分析
    */
   private function addSentimentPopular($array){
       //声量走势
       $media  = M('media')->field('id,name')->select();
       $new = \rand(45,49)/100;
       $sina = \rand(30,35)/100;
       $weichat = \rand(3,5)/100;
       $toutiao = 1-$new-$sina-$weichat;
       $rate = array(
           $array['sentiment'] * $new,
           $array['sentiment'] * $sina,
           $array['sentiment'] * $weichat,
           $array['sentiment'] * $toutiao,
       );
       foreach ($media as $k=>$v){
           $pop[$k]['s_date'] = $array['s_date'];
           $pop[$k]['s_time'] = $array['s_time'];
           $pop[$k]['media_id'] = $v['id'];
           $pop[$k]['media_name'] = $v['name'];
           $pop[$k]['num'] = sprintf("%.0f",$rate[$k]);
           $pop[$k]['created'] = \time();
       }
       M('SentimentPopular')->addAll($pop);
       return true;
   }

    /**
     * 媒体排行榜
     */
   public function addSentimentMediaRank($array){

       $media_name = array('宝鸡信息网','搜狐网','陕西新闻网','人民日报','新浪','新华网','今日头条','腾讯网','凤凰网','中华网');
       foreach ($media_name as $k=>$v){
           $rate  = \rand(5,10)/100;
           $data[$k]['s_date'] = $array['s_date'];
           $data[$k]['s_time'] = $array['s_time'];
           $data[$k]['site_name'] = $v;
           $data[$k]['num'] =  sprintf("%.0f",$array['sentiment'] * $rate);
           $data[$k]['created'] =  \time();
       }
       \M('SentimentMediaRank')->addAll($data);
   }




}