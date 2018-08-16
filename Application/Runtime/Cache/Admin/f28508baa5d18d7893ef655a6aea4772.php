<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo ($meta_title); ?> | 中智尚联</title>
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome/css/font-awesome.min.css">
    <!--[if lt IE 7] -->
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome/css/font-awesome-ie7.min.css">
    <!-- [endif] -->

    <!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome-4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/ffcommon.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/fuFengStyle.css">
	<!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">-->

    <!--[if lt IE 9] -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <!-- [endif]-->

    <!--[if lte IE9]>
    <script type="text/javascript">
        document.write("<div style='position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 100; width: 100%; min-width: 1000px;  height: 100%; min-height: 500px; overflow: auto; padding-top: 6%;  background-color: #fff'><p style='width: 900px; overflow: auto; margin: 0 auto; font-size: 22px; line-height: 48px; color: #333;'><span style='font-size: 28px; width: 100%; display: block; color: #999'>当前浏览器版本过低</span><br>请使用高版本IE浏览器，<br><a style='color: #3986d6; font-size: 14px; line-height: 28px; display: block;'  href=' ' target='_blank'>下载地址：https://support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads</a ><br>\n" +
                "或使用以下浏览器：<br> <a style='color: #3986d6; font-size: 14px; line-height: 28px; display: block;'  href='http://www.mozillaonline.com/' target='_blank'>Firefox下载地址：http://www.mozillaonline.com/</a ><a style='color: #3986d6; font-size: 14px; display: block; line-height: 28px;'  href='http://www.google.com/chrome/?hl=zh-CN' target='_blank'>Chrome下载地址：http://www.google.com/chrome/?hl=zh-CN</a ></p ></div>")
    </script>
    <![endif]-->

    <!-- 百度插件 -->
    <script src="/Application/Admin//Public/Admin/js/ff/echarts.min.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/china.js"></script>

    <script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>


</head>
<body onload="aTim();onWxLoad()" class="GZHSJbody">
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
		<div class="secondLevelNav">
			<ul>
				<li><a href="<?php echo U('Network/index');?>">网络搜索监测</a></li>
				<li><a class="active">公众号数据</a></li>
			</ul>
		</div>
		<ul>
			<li>
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>公众号用户累计人数统计</h4>
						<p class="clearfix">
							<span class="active" onclick="getWxUsersNum(1)" >7天</span>
							<span onclick="getWxUsersNum(2)" >30天</span>
							<span onclick="getWxUsersNum(3)" >90天</span>
							<span onclick="getWxUsersNum(4)" >半年</span>
							<!--<span onclick="getWxUsersNum(5)" >1年</span>-->
						</p>
					</div>
					<div class="char-plate">
						<div id="GZHTotal" style="width: 550px; height:300px;"></div>
					</div>
				</div>
			</li>
			<li>
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>公众号新增用户人数统计</h4>
						<p class="clearfix">
							<span class="active" onclick="getWxUsersAdd(1)">7天</span>
							<span onclick="getWxUsersAdd(2)">30天</span>
							<span onclick="getWxUsersAdd(3)">90天</span>
							<span onclick="getWxUsersAdd(4)">半年</span>
						</p>
					</div>
					<div class="char-plate">
						<div id="GZHNew" style="width: 550px; height:300px;"></div>
					</div>
				</div>
			</li>
			<li>
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>
							收藏转发量统计
						</h4>
						<p class="clearfix">
							<span class="active" onclick="getWxAnalysis(1)">7天</span>
							<span  onclick="getWxAnalysis(2)">30天</span>
							<span  onclick="getWxAnalysis(3)">90天</span>
							<span  onclick="getWxAnalysis(4)">半年</span>
						</p>
					</div>
					<div class="char-plate">
						<div id="dzzf" style="width: 550px; height:300px;"></div>
					</div>
				</div>
			</li>
			<li>
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>
							公众号活跃用户人数统计
						</h4>
						<p class="clearfix">
							<span class="active" onclick="getWxUsersActive(1)">7天</span>
							<span onclick="getWxUsersActive(2)">30天</span>
							<span onclick="getWxUsersActive(3)">90天</span>
							<span onclick="getWxUsersActive(4)">半年</span>
						</p>
					</div>
					<div class="char-plate">
						<div id="hyyh" style="width: 550px; height:300px;"></div>
					</div>
				</div>
			</li>
			<li class="clearfix onelineOne">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>
							图文阅读人数与次数统计
						</h4>
						<p class="clearfix">
							<span class="active" onclick="getReadNum(1)">7天</span>
							<span onclick="getReadNum(2)">30天</span>
							<span onclick="getReadNum(3)">90天</span>
							<span onclick="getReadNum(4)">半年</span>
						</p>
					</div>
					<div class="char-plate">
						<div id="readTimes" style="width: 1150px; height:300px;"></div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/index.js"></script>-->
<!--<script src="/Application/Admin//Public/Admin/js/ff/wlxw.js"></script>-->

</html>
<script>

    $(function(){
        $(".clearfix span").click(function(){
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        });
    });

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


//    function aTim(){
//        var myDate = new Date();
//        myDate.getYear(); //获取当前年份(2位)
//        myDate.getFullYear(); //获取完整的年份(4位,1970-????)
//        myDate.getMonth(); //获取当前月份(0-11,0代表1月)         // 所以获取当前月份是myDate.getMonth()+1;
//        myDate.getDate(); //获取当前日(1-31)
//        myDate.getDay(); //获取当前星期X(0-6,0代表星期天)
//        myDate.getTime(); //获取当前时间(从1970.1.1开始的毫秒数)
//        myDate.getHours(); //获取当前小时数(0-23)
//        myDate.getMinutes(); //获取当前分钟数(0-59)
//        myDate.getSeconds(); //获取当前秒数(0-59)
//        myDate.getMilliseconds(); //获取当前毫秒数(0-999)
//        myDate.toLocaleDateString(); //获取当前日期
//        var mytime=myDate.toLocaleTimeString(); //获取当前时间
//        myDate.toLocaleString( ); //获取日期与时间
//        $(".date-left .time").text(mytime);
////        $(".date-left .time").text(hours + ":" + min + ":" + sec);
//        setTimeout("aTim()",1000);
//    }
</script>

<SCRIPT LANGUAGE = "JavaScript">

	function onWxLoad(s_day) {
        getWxUsersNum(s_day);
        getWxUsersAdd(s_day);
        getWxUsersActive(s_day);
        getWxAnalysis(s_day);
        getReadNum(s_day);
    }

    //公众号用户累计人数统计
    function getWxUsersNum(s_day) {
		$.get("<?php echo U('getWxUsersNum');?>",{s_day:s_day},function (res) {
            var GZHTotalChart = echarts.init(document.getElementById('GZHTotal') , 'westeros');
            GZHTotalChart.clear();
            if(res.code ==1){
			    var r = res.data;


                option = {
                    legend: {
                        x: 'right',
                        y: 'top',
                        data:['累积人数']
                    },
                    tooltip: {
                        trigger: "axis",
                        axisPointer: {
                            lineStyle: {
                                color: "rgb(0, 185, 255)",
                                type: "solid",
                                width: 1
                            },
                            type: "line",
                            areaStyle: {
                                type: "default"
                            }
                        }
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            axisLine: {
                                show: true
                            },
                            splitLine: {
                                "show": false
                            },
                            data:r.s_date,//["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"]
                        }
                    ],
                    yAxis: [
                        {
                            name:'人数',
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "累积人数",
                            type: "line",
                            smooth: true,
                            itemStyle: {
                                normal: {
                                    areaStyle: {
                                        type: "default",
                                        color: "rgba(91, 161, 255, 0.27)"
                                    }
                                }
                            },
                            data: r.total_user_num,//[40, 89, 126, 100, 187, 134, 124, 90, 60]
                        }
                    ]
                };

                GZHTotalChart.setOption(option);
            }
        });
    }

    //公众号新增用户人数统计
    function getWxUsersAdd(s_day) {
        $.get("<?php echo U('getWxUsersNum');?>",{s_day:s_day},function (res) {
            //公众号新增用户人数统计
            var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');
            GZHNewChart.clear();
            if(res.code ==1){
                var r = res.data;
                //公众号新增用户人数统计
                option = {
                    legend: {
                        x: 'right',
                        y: 'top',
                        data:['新增人数']
                    },
                    tooltip: {
                        trigger: "axis"
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_date, //["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
                            splitLine: {
                                "show": false
                            },
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            name:'人数',
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "新增人数",
                            type: "line",
                            smooth: true,
                            data: r.user_num, //[40, 89, 126, 100, 187, 134, 124, 90, 60],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };

                GZHNewChart.setOption(option);

            }
        });
    }

    //公众号活跃用户人数统计
	function getWxUsersActive(s_day) {
        $.get("<?php echo U('getWxUsersNum');?>",{s_day:s_day},function (res) {
            var hyyhChart = echarts.init(document.getElementById('hyyh') , 'westeros');
            hyyhChart.clear();
            if(res.code ==1){
                var r = res.data;
                //公众号活跃用户人数统计
                option = {
                    legend: {
                        x: 'right',
                        y: 'top',
                        data:['活跃人数']
                    },
                    tooltip: {
                        trigger: "axis"
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_date,//["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
                            splitLine: {
                                "show": false
                            },
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            name:'人数',
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "活跃人数",
                            type: "line",
                            smooth: true,
                            data: r.active_num, //[40, 89, 126, 100, 187, 134, 124, 90, 60],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };

                hyyhChart.setOption(option);

            }
        });
    }

    //评论收藏转发量统计
	function getWxAnalysis(s_day) {
        $.get("<?php echo U('getWxAnalysis');?>",{s_day:s_day},function (res) {
            var dzzfChart = echarts.init(document.getElementById('dzzf') , 'westeros');
            dzzfChart.clear();
            if(res.code ==1){
                var r = res.data;
                //评论收藏转发量统计
                option = {
                    legend: {
                        x: 'right',
                        y: 'top',
                        data:['转发','收藏']
                    },
                    tooltip: {
                        trigger: "axis"
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_date, //["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
                            splitLine: {
                                "show": false
                            },
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            name:'人数',
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
//                        {
//                            name: "评论",
//                            type: "line",
//                            smooth: true,
//                            data: r.thumbup_num, //[40, 89, 126, 100, 187, 134, 124, 90, 60],
//                            markPoint: {
//                                data: [
//                                    {type: 'max', name: '最大值'}
//                                ]
//                            }
//                        },
                        {
                            name: "转发",
                            type: "line",
                            smooth: true,
                            data: r.forward_num, //[60, 90, 68, 90, 345, 234, 143, 155, 80],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        },
                        {
                            name: "收藏",
                            type: "line",
                            smooth: true,
                            data: r.collection_num, //[56, 76, 23, 87, 76, 45, 34, 54, 34],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };

                dzzfChart.setOption(option);

            }
        });
    }
    
    //图文阅读人数与次数统计
	function getReadNum(s_day) {
        $.get("<?php echo U('getWxAnalysis');?>",{s_day:s_day},function (res) {
            var readTimesChart = echarts.init(document.getElementById('readTimes') , 'westeros');
            readTimesChart.clear();
            if(res.code ==1){
                var r = res.data;
                //图文阅读人数与次数统计
                option = {
                    grid: [
                        {x: '6%', y: '12%', width: '88%', height: '68%'}
                    ],
                    legend: {
                        x: 'right',
                        y: 'top',
                        data:['次数','人数']
                    },
                    tooltip: {
                        trigger: "axis"
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_date,//["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"],
                            splitLine: {
                                "show": false
                            },
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            name:'人数',
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "次数",
                            type: "line",
                            smooth: true,
                            data: r.read_num, //[40, 89, 126, 100, 187, 134, 124, 90, 60],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        },
                        {
                            name: "人数",
                            type: "line",
                            smooth: true,
                            data: r.read_user_num, //[36, 78, 90, 89, 123, 132, 100, 80, 30],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };
                readTimesChart.setOption(option)
            }
        });

    }




</SCRIPT>