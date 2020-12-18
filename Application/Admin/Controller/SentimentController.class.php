<?php
/**
 * Created by PhpStorm.
 * User: summer
 * Date: 2018/2/26
 * Time: 上午11:10
 */

namespace Admin\Controller;

class SentimentController extends AdminController
{

    const  LAST_TIME7 = '604800'; //86400*7;
    const  LAST_TIME30 = '2592000';//86400*30;
    const  LAST_TIME90 = '7776000'; // //86400*90;
    const  LAST_TIME180 = '15552000';//86400*180;
    const  LAST_TIME365 = '31536000'; //86400*365;


    /**
     * 舆情分析
     */
    public function index(){

        $this->display();
    }

    /**
     * 负面舆情TOP10
     */
    public function getNews(){
        $db = M();
//        $where['s_time'] = 1;
        $where['type'] = 2;  //负面
        $list = $db->field('(@rowNum:=@rowNum+1) as ranking,title,media_id,url_path,sentiment_index')
            ->where($where)->table('ff_sentiment_news a, (Select (@rowNum :=0) ) b')->order('sentiment_index desc')->select();
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$list);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }


    /**
     * 舆情正负情感走势
     */
    public function getSentimentTrend(){
        $hours = \I('hours',6); // 6 12
        // 6小时 12小时 24小时 48小时 72小时 全部
        $lastTime = getLastTime($hours,'hours');
        $currentTime = \time();
        $db = M('sentimentIndex');
        $where['s_time'] = array('between',[$lastTime,$currentTime]);
        $list = $db->field(" FROM_UNIXTIME(s_time,'%Y/%m/%d %H:00') as s_time ,sentiment_index,positive_index,negative_index")
            ->where($where)->order('s_time asc')->select();
        foreach ($list as $k=>$v){
            $data['s_time'][$k] = $v['s_time'];
            $data['positive_index'][$k] = $v['positive_index'];
            $data['negative_index'][$k] = $v['negative_index'];
            $data['sentiment_index'][$k] =  $v['sentiment_index'];
        }
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 舆情声量走势分析
     */
    public function getSlTrend(){

        $hours = I('hours',6);
//        $currentTime = \mktime(\date('H'),'0','0',\date('m'),\date('d'),\date('Y'));
        $currentTime = \time();
        $first = 0;
        while ($first < $hours) {
            $lastTime = $currentTime - 3600 * $first;
            $afterDay = date('YmdH',$lastTime);
//            $dateHours = date('Y/m/d H:00',$lastTime);
            $timeNumArray[$afterDay] = array('num'=>0,'media_id'=>0,'name'=>'','s_date'=>$afterDay);
            $first++;
        }
//        $timeNumArray= \array_reverse($timeNumArray);
        // 获取媒体名称
        $db = M('sentimentPopular');
        $media_arr = $db->alias('a')->join('left join ff_media b on a.media_id = b.id')->getfield('media_id,name');
        //$lastTimes = getLastTime($hours,'hours');
        if($hours != 0){
            $where['s_time'] = array('between',[$lastTime,$currentTime]);
        }
        $i =0;
        $data_arr = [];
        foreach ($media_arr as $k=>$v){
            $where['media_id'] = $k;

           $list = $db->where($where)->order('s_time asc')->getField("FROM_UNIXTIME(s_time,'%Y%m%d%H') as s_date,num,media_id");
          $arr = (array)$list + (array)$timeNumArray;
            ksort($arr);
           $data['name'][$i] = $v;
           $data['list'][$i]['name'] = $v;
           $data['list'][$i]['type'] = 'line';
           $data['list'][$i]['lineStyle'] = array('normal'=>array('width'=>2));
            foreach ($arr as $key=>$val){
                $data['s_date'][$key] = $val['s_date'];
                $data['list'][$i]['data'][] = $arr[$key]['num'];
                //全部舆情
                $data_arr['dataAll'][$key] +=$arr[$key]['num'];
            }
            $i ++;
        }
        //
        $data['s_date'] = \array_values($data['s_date']);
        $dataAll = \array_values($data_arr['dataAll']);

        $push_data = array('name'=>'全部','type'=>'line','lineStyle'=>array('normal'=>array('width'=>2)),'data'=>$dataAll);
        array_push($data['list'],$push_data);
        array_push($data['name'],'全部');
        $data['max'] = max($dataAll)+1;
        $data['min'] = min($dataAll)-1;
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }

    /**
     * 舆情来源构成
     */
    public function getSourceStructure(){
        $hours = I('hours',6);
//        $db = M('sentimentSource');
        $db = M('sentimentPopular');
        $lastTime = \getLastTime($hours);
        $currentTime = \time();
        if($hours != 0){
            $where['s_time'] = array('between',[$lastTime,$currentTime]);
        }
        $list = $db->alias('a')->field('a.media_id,SUM(num) num,b.name')
            ->join('left join ff_media b on a.media_id = b.id')
            ->where($where)->order('a.num desc')->group('a.media_id')->select();
        foreach ($list as $k=>$v){
            $data['media_name'][$k] = $v['name'];
            $data['info'][$k]['name'] = $v['name'];
            $data['info'][$k]['value'] = $v['num'];
        }
//        array_reverse();
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);

    }

    /**
     * 舆情来源量媒体排行
     */
    public function getMediaRanking(){
        $hours = I('hours');
        $db = M('sentimentMediaRank');
        $lastTime = \getLastTime($hours);
        if(!empty($hours)){
            $currentTime = \time();
            $where['s_time'] = array('between',[$lastTime,$currentTime]);
        }

        $list = $db->alias('a')->field('s_date,s_time,SUM(num) num,site_name')
            ->where($where)->order('num desc')->group('site_name')->limit(10)->select();

        $rank = 1;
        foreach ($list as $k=>$v){
            $data['data'][$k] = $v;
            $data['data'][$k]['ranking'] = $rank;
            $data['ranking'][$k] = $rank;
            $data['site_name'][$k] = $v['site_name'];
            $data['value'][$k] = $v['num'];
            $rank ++;
        }
//        array_reverse();
        if($list){
            $data =array('code'=>1, 'msg'=>'成功','data'=>$data);
        }else{
            $data =array('code'=>0, 'msg'=>'暂无数据','data'=>array());
        }
        $this->ajaxReturn($data);
    }




}