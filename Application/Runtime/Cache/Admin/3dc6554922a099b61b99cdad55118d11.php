<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">
	<title></title>
	<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/ffcommon.css">
	<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/fuFengStyle.css">
	<script src="/Application/Admin//Public/Admin/js/ff/echarts.min.js"></script>

</head>
<body onload="aTim(),autoLoad(6)" class="GZHSJbody KLCountBody publicOpinion">
<header>
	<div class="box-top">
		<!--<h3>旅游大数据平台</h3>-->
	</div>
</header>
<div class="body-content">
	
<div class="nav">
    <div class="nav-left">
        <ul class="clearfix" >
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><span><?php echo ($menu["title"]); ?></span></a></li>
                <!--<li class="active"><a href="javascript:;">数据概况</a></li>-->
                <!--<li><a href="<?php echo U('Visitor/index');?>">客流统计</a></li>-->
                <!--<li><a href="<?php echo U('Opinion/index');?>">舆情监测</a></li>-->
                <!--<li><a href="javascript:;">酒店监测</a></li>-->
                <!--<li class="clearfix" ><a href="<?php echo U('Wx/index');?>">网络行为</a></li>--><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="nav-right float-right clearfix">
        <div class="quit-content">
            <span>|</span>
            <a href="<?php echo U('Public/logout');?>" class="quit">退出</a>
        </div>
        <div class="date-left">
            <p class="date"><?php echo (date("Y年n月j日",NOW_TIME)); ?></p>
            <p class="time"><?php echo (date("G:i:s",NOW_TIME)); ?></p>
            <!--<span class="week">星期三</span>-->
            <!--<span class="weather"> 晴 ≤3级风 9℃</span>-->
        </div>
    </div>
</div>
<div><img src="/Application/Admin//Public/Admin/images/ffimg/top-fgx.png"></div>

	<div class="main">
		<div class="publicOpinion-top onelineOne">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>正负情感分析</h4>
				</div>
				<div class="publicOpinion-top-inner">
					<div class="box-content negative-top10">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>负面舆情TOP10</h4>
						</div>
						<div class="negative-top10-main">
							<ul id="getNews">

							</ul>
						</div>
					</div>

					<div class="box-content publicOpinionTrend">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>舆情正负情感走势</h4>
							<p class="clearfix">
								<span class="active" onclick="getSentimentTrend(6)">6小时</span>
								<span onclick="getSentimentTrend(12)">12小时</span>
								<span onclick="getSentimentTrend(24)">24小时</span>
								<span onclick="getSentimentTrend(48)">48小时</span>
								<span onclick="getSentimentTrend(72)">72小时</span>
								<span onclick="getSentimentTrend(0)">全部</span>
							</p>
						</div>
						<div class="char-plate">
							<div id="publicOpinionTrendID" style="width: 750px; height:300px;"></div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="publicOpinion-bot onelineOne">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>舆情声量走势分析</h4>
				</div>
				<div class="publicOpinion-bot-inner">

					<div class="box-content publicOpinionTrend">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>舆情声量走势分析</h4>
							<p class="clearfix">
								<span class="active" onclick="getSlTrend(6)">6小时</span>
								<span  onclick="getSlTrend(12)">12小时</span>
								<span  onclick="getSlTrend(24)">24小时</span>
								<span  onclick="getSlTrend(48)">48小时</span>
								<span  onclick="getSlTrend(72)">72小时</span>
								<span  onclick="getSlTrend(0)">全部</span></p>
						</div>
						<div class="char-plate">
							<!--<div id="SLTrendID" style="width: 470px; height:280px;"></div>-->
							<div id="SLTrendID" style="width: 1150px; height:350px;"></div>
						</div>
					</div>

					<div class="publicOpinion-bot-inner-bot">
						<div class="box-content sourceStructure">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>舆情来源构成</h4>
								<p class="clearfix">
									<span class="active"  onclick="getSourceStructure(6)">6小时</span>
									<span onclick="getSourceStructure(12)">12小时</span>
									<span onclick="getSourceStructure(24)">24小时</span>
									<span onclick="getSourceStructure(48)">48小时</span>
									<span onclick="getSourceStructure(0)">全部</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="sourceStructureID" style="width: 500px; height:280px;"></div>
							</div>
						</div>
						<div class="box-content mediaRanking">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>舆情来源量媒体排行</h4>
								<p class="clearfix">
									<span class="active"  onclick="getMediaRanking(6)">6小时</span>
									<span onclick="getMediaRanking(12)">12小时</span>
									<span onclick="getMediaRanking(24)">24小时</span>
									<span onclick="getMediaRanking(48)">48小时</span>
									<span onclick="getMediaRanking(0)">全部</span></p>
							</div>
							<div>
								<div class="rinking-num">
									<ul id="getRanking">

									</ul>
								</div>
								<div class="char-plate">
									<div id="mediaRankingID" style="width: 450px; height:350px;"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/publicOpinion.js"></script>


</html>
<script>

	//时间筛选
    $(function(){
        $(".clearfix span").click(function(){
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        });
    });

    //初始加载
	function autoLoad(hours){
	    //负面舆情TOP10
        getNews(hours);
		//舆情正负情感走势
        getSentimentTrend(hours);
		//舆情声量走势分析
        getSlTrend(hours);
		//舆情来源构成
        getSourceStructure(hours);
	    //舆情来源量媒体排行
        getMediaRanking(hours);
    }
    function aTim(){
        var date = new Date();
        var hours = date.getHours();
        var min = date.getMinutes();
        min = min<10?"0"+min:min;
        var sec = date.getSeconds();
        sec = sec<10?("0"+sec):sec;
        $(".date-left .time").text(hours + ":" + min + ":" + sec);
        setTimeout("aTim()",1000);
    }
</script>
<script>

//	//负面舆情TOP10
//	$.get("/index.php/Admin/Sentiment/getNews",function (res) {
//		if (res.code == 0){
//		    var r = res.data;
//			var str = '';
//            $(r).each(function(i,item){
//                console.log(i);
//                console.log(item.title);
//                str += '<li>' +
//                    '<a href="#">\n' + '<span>'+item.rowNo+'</span>\n' + item.title +
//                    '</a></li>';
//            });
//            $('#getNews').append(str);
//		}
//    });
</script>