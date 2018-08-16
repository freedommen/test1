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
<body onload="aTim();onLoad();" class="GZHSJbody">
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

	<div class="main clearfix">
		<div class="main-left">
			<div class="box-content box-content-01">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>
						客流实时监控
					</h4>
				</div>
				<div class="char-plate" style="margin-top: 0;">
					<div id="kljk" style="width: 800px; height:680px;"></div>
				</div>
			</div>

			<div class="main-left-oneLineTwo">
				<ul class="clearfix">
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>
									客流迁移情况监控（近一周）
								</h4>
							</div>
							<div class="char-plate">
								<div id="kyqy" style="width: 375px; height:280px;"></div>
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
									核心客源地TOP10（近一周）
								</h4>
							</div>
							<div class="char-plate">
								<div id="coreSourceTop10" style="width: 375px; height:280px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>


			<div class="main-left-oneLineThree clearfix">
				<div class="main-left-oneLineThree-left">
					<div class="box-content box-content-attribute">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								游客性别及年龄占比（近一月）
							</h4>
						</div>
						<div class="char-plate">
							<div id="sexRatio" style="width: 335px; height:70px;"></div>
							<div id="AgeRatio" style="width: 335px; height:200px;"></div>

						</div>
					</div>
					<div class="box-content box-content-visitTimes">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								游客到访频次统计（近一年）
							</h4>
						</div>
						<div class="char-plate">
							<div id="visitTimes" style="width: 375px; height:140px; margin-left: 30px;"></div>
						</div>
					</div>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								目的地舆情监测（近一月）
							</h4>
						</div>
						<div class="char-plate">
							<div id="publicOpinion" style="width: 375px; height:140px; margin-left: 30px;"></div>
						</div>
					</div>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								游客满意度（近一月）
							</h4>
						</div>
						<div class="char-plate satisfaction-contain">
							<div id="satisfaction" style="width: 375px; height:157px; margin-left: 30px;"></div>
							<div class="score-contain">
								<ul>
									<li>
										住宿评分：<span>4.1</span>
									</li>
									<li>
										美食评分：<span>4.2</span>
									</li>
									<li>
										景区评分：<span>4.5</span>
									</li>
									<li>
										娱乐评分：<span>4.0</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="main-left-oneLineThree-right clearfix">
					<div class="box-content travelWay">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								出行方式占比（近一月）
							</h4>
						</div>
						<div class="char-plate">
							<ul class="clearfix">
								<li>
									<p><img src="/Application/Admin//Public/Admin/images/ffimg/plane.png"></p>
									<p><?php echo ((isset($trip["aircraft"]) && ($trip["aircraft"] !== ""))?($trip["aircraft"]):'0%'); ?></p>
								</li>
								<li>
									<p><img src="/Application/Admin//Public/Admin/images/ffimg/train.png"></p>
									<p><?php echo ((isset($trip["train"]) && ($trip["train"] !== ""))?($trip["train"]):'0%'); ?></p>
								</li>
								<li>
									<p><img src="/Application/Admin//Public/Admin/images/ffimg/bus.png"></p>
									<p><?php echo ((isset($trip["bus"]) && ($trip["bus"] !== ""))?($trip["bus"]):'0%'); ?></p>
								</li>
								<li class="clearfix">
									<p><img src="/Application/Admin//Public/Admin/images/ffimg/car.png"></p>
									<p><?php echo ((isset($trip["car"]) && ($trip["car"] !== ""))?($trip["car"]):'0%'); ?></p>
								</li>
							</ul>
						</div>
					</div>

					<div class="box-content hotelAveragePrice">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								酒店平均价格监测
							</h4>
						</div>
						<div class="char-plate">
							<div id="hotelAveragePrice" style="width: 335px; height:350px;"></div>
						</div>
					</div>

					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>
								游客平均驻留时间分析
							</h4>
						</div>
						<div class="char-plate">
							<div id="stayTime" style="width: 375px; height:296px;"></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="main-right">

			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>
						实时客流量
					</h4>
				</div>
				<div class="main-num">
					<p id="total_user_num">0</p>
				</div>

				<div class="char-plate">
					<div id="GZHTotal" style="width: 400px; height:300px;"></div>
				</div>

			</div>

			<div class="box-content yearNumCount">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>

				<ul class="clearfix">
					<li>
						<h5>年度游客峰值</h5>
						<p><?php echo ((isset($_info["pcu"]) && ($_info["pcu"] !== ""))?($_info["pcu"]):0); ?><span>人</span></p>
					</li>
					<li>
						<h5>昨日游客数</h5>
						<p><?php echo ((isset($_info["yesterday_num"]) && ($_info["yesterday_num"] !== ""))?($_info["yesterday_num"]):0); ?><span>人</span></p>
					</li>
					<li>
						<h5>年度游客累计数</h5>
						<p><?php echo ((isset($_info["total_user_num"]) && ($_info["total_user_num"] !== ""))?($_info["total_user_num"]):0); ?><span>人</span></p>
					</li>
					<li>
						<h5>年度游客平均逗留天数</h5>
						<p><?php echo ((isset($_info["average_remain_day"]) && ($_info["average_remain_day"] !== ""))?($_info["average_remain_day"]):0); ?><span>天</span></p>
					</li>
					<li>
						<h5>本月游客累计数</h5>
						<p><?php echo ((isset($_info["month_num"]) && ($_info["month_num"] !== ""))?($_info["month_num"]):0); ?><span>人</span></p>
					</li>
					<li class="clearfix">
						<h5>上月游客累计数</h5>
						<p><?php echo ((isset($_info["lastmonth_num"]) && ($_info["lastmonth_num"] !== ""))?($_info["lastmonth_num"]):0); ?><span>人</span></p>
					</li>
				</ul>
			</div>

			<div class="box-content keyAreaRankings">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>重点区域客流排行（实时）</h4>
				</div>

				<div id="scenic_real" class="keyAreaRankings-contain">

				</div>
				<div class="box-content-top-select clearfix">
					<!--<select>
                        <optgroup label="法门寺">
                            <option>法门寺-景点1景点1</option>
                            <option>法门寺-景点2</option>
                        </optgroup>
                    </select>-->
					<select id="spotid" onchange="getRealSpot(this.value)" disabled="disabled">
						<optgroup label="<?php echo ($scenic_name); ?>">
							<?php if(is_array($spot_list)): $i = 0; $__LIST__ = $spot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["spot_id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</optgroup>
					</select>
					<!--<input value="法门寺">-->
					<!--<ul style="display: none">-->
					<!--<h3>法门寺</h3>-->
					<!--<li>法门寺-景点一</li>-->
					<!--</ul>-->
					<!--<span class="drop-down-span"></span>-->
				</div>
				<div class="char-plate">
					<div id="GZHNew" style="width: 400px; height:350px;"></div>
				</div>
			</div>

			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>未来7天客流预测</h4>
				</div>
				<div class="char-plate">
					<div id="klForecast" style="width: 400px; height:320px;"></div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=nSxiPohfziUaCuONe4ViUP2N"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/Heatmap/2.0/src/Heatmap_min.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/dataProfile.js"></script>-->
<script src="/Application/Admin//Public/Admin/js/ff/heatmap.js"></script>

<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/AreaRestriction/1.2/src/AreaRestriction_min.js"></script>
</html>

<script>
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

    $(document).ready(function () {
        $(".box-content  tbody tr").live("click", function () {
            $(".box-content tbody tr").removeClass("active");
            $(this).addClass("active");

            var tr = $(this).closest("tr");

            var getname = tr.find(".getname").html();

            $('#optionspot').HTML(getname);
        });

        // setTimeout(function(){$(".box-top").hide(500);},1500);//1.5秒后执行该方法
    })



    $(document).ready(function () {
        /*$('.DBAdd-more-btn').click(function () {
            $('.chose-box').addClass('opened-chose-box')
        })*/
        $(".box-content tbody tr").click(function () {
            $(".box-content tbody tr").removeClass("active");
            $(this).addClass("active");
        });


        // setTimeout(function(){$(".box-top").hide(500);},1500);//1.5秒后执行该方法


        $(".box-content-top-select>input").click(function () {
            $(this).next("ul").slideToggle(150);
            $(this).next().next("span").toggleClass("drop-down-span");
            $(this).next().next("span").toggleClass("upward-span")
        });

        $(".box-content-top-select>ul>li").click(function () {
            var text = $(this).text();
            $(this).parent().parent().children("input").val(text);
            $(this).parent("ul").slideToggle(150);
            $(this).parent().parent().children("span").toggleClass("drop-down-span");
            $(this).parent().parent().children("span").toggleClass("upward-span");
        });

        $(".box-content-top-select>span").click(function () {
            $(this).toggleClass("drop-down-span");
            $(this).toggleClass("upward-span");
            $(this).parent().children("ul").slideToggle(150);
        });

    })
</script>

<script type="application/javascript">
    function onLoad() {
        baiduApi();
        //实时监控
        getDataReal();
        getRealTop();
        getRealSpot(1);
        //未来7天
        getFutureDays();
        //迁移地监控
        getTransfer();
        //省排行榜
        getProvinceTop();
        //游客性别
        getVisitorSex();
        //有了到访次数
        getPv();
        //酒店平均价格
        getHotelAvgPrice();
        //舆情监测
        getPublicOpinion();
        //游客平均停留时间
        getStayAvg();
        //游客满意度
        getSatisfaction();
    }

    //实时客流量
    function getDataReal(){
        $.get("<?php echo U('getDataReal');?>",function (res) {
            var GZHTotalChart = echarts.init(document.getElementById('GZHTotal') , 'westeros');
//            GZHTotalChart.clear();

            if(res.code == 1){
                var r = res.data;
                $('#total_user_num').text(r.total_user_num);
//                var GZHTotalChart = echarts.init(document.getElementById('GZHTotal') , 'westeros');

                GZHTotalChart.getOption();
                option = {
                    grid: [
                        {x: '15%', y: '16%', width: '76%', height: '60%'}
                    ],
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
                            data: r.s_time, //["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"]
                        }
                    ],
                    yAxis: [
                        {
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "客流",
                            type: "line",
                            smooth: true,
                            itemStyle:{
                                normal:{
                                    areaStyle: {
                                        type: "default",
                                        color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                            offset: 0,
                                            color: 'rgba(58,140,251,.6)'
                                        }, {
                                            offset: 1,
                                            color: 'rgba(58,140,251,.2)'
                                        }], false)
                                    }
                                }
                            },

                            data: r.user_num, //[40, 89, 126, 100, 187, 134, 124, 90, 60],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };

                GZHTotalChart.setOption(option);
            }
        });
        setTimeout("getDataReal()",30000);
//        setTimeout("baiduApi()",60000);
    }

    //重点区域客流排行（实时）
    function getRealTop() {
        $.get("<?php echo U('getRealScenicTop');?>",function (res) {
            if(res.code == 1) {
                var r = res.data;
                var str = '';
                str += '<table>';
                str += '<thead>';
                str += '<tr>';
                str += '<th>排名</th><th>区域名称</th><th>客流数</th><th>平均饱和度</th>';
                str += '</tr>';
                str += '</thead>';
                str += '<tbody  class="addbg">';
                for(var i=0;i<r.length;i++){
                    if(i == 0){
                        str += '<tr class="highLight active" onclick="getScenicSpot('+r[i].scenic_id +')" >';
//                        getScenicSpot(r[i].scenic_id);
                    }else if(i < 3 ){
                        str += '<tr class="highLight" onclick="getScenicSpot('+r[i].scenic_id +')" >';
                    }else {
                        str += '<tr  onclick="getScenicSpot('+r[i].scenic_id +')" >';
                    }
                    str += '<td>'+ r[i].rank +'</td><td class="getname" data-title="'+r[i].name+'">'+ r[i].name + '</td><td>'+ r[i].user_num +'</td><td>'+ r[i].saturation +'</td>';
                    str += '</tr>';
                }
                str += '</tbody>';
                str += '</table>';
                $('#scenic_real').append(str);
            }
        })
    }

    // 获取景区
    function getScenicSpot(scenic_id) {

        $.get("<?php echo U('getScenicSpot');?>",{scenic_id:scenic_id},function (res) {
//            var text = $(this).attr('td');
//            $("#spotid optgroup").html(text);
            if(res.code ==1){
                r = res.data;
                var option = '';
                option += '<optgroup id="optionspot">请选择</optgroup>';
                for(var i=0;i<r.length;i++){
                    option += '<option value="'+r[i].spot_id+'">'+ r[i].name+'</option>';
                }
                $('#spotid').html(option);
                getRealSpot(r[0].spot_id);
            }

        })

    }

    //重点区域客流排行-景点（实时）
    function getRealSpot(spotid) {

        $.get("<?php echo U('getRealSpot');?>",{spotid:spotid},function (res) {
            if(res.code ==1){
                var r = res.data;
                //重点区域客流排行（实时）
                var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');
                option = {
                    tooltip: {
                        trigger: "axis"
                    },
                    grid: [
                        {x: '15%', y: '10%', width: '76%', height: '60%'}
                    ],
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_time, //["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"],
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
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "游客人数",
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
        })
    }

    //未来7天
    function getFutureDays() {
        $.get("<?php echo U('getFutureDays');?>",function (res) {
            if(res.code ==1){
                var r= res.data;
                //未来7天客流预测
                var klForecastChart = echarts.init(document.getElementById('klForecast') , 'westeros');
                option = {
                    tooltip: {
                        trigger: "axis"
                    },
                    grid: [
                        {x: '15%', y: '15%', width: '76%', height: '70%'}
                    ],
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
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "客流",
                            type: "line",
                            smooth: true,
                            itemStyle:{
                                normal:{
                                    areaStyle: {
                                        type: "default",
                                        color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                            offset: 0,
                                            color: 'rgba(58,140,251,.6)'
                                        }, {
                                            offset: 1,
                                            color: 'rgba(58,140,251,.2)'
                                        }], false)
                                    }
                                }
                            },
                            data: r.user_num, //[40, 89, 126, 100, 187, 134, 124, 90, 60],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };

                klForecastChart.setOption(option);
            }
        });
    }

    //客户端迁移监控
    function getTransfer() {
        $.get("<?php echo U('getTransfer');?>",function (res) {
            //if (res.code == 1){
            var r = res.data;
            //客源迁移数据
            var myChart = echarts.init(document.getElementById('kyqy'));

            var obj={}
            for(var key  in r.name){
                obj[r.name[key]]=  r.point[key]//r.name[key]
            }
            var geoCoordMap = obj;
//            var geoCoordMap = {
//                '上海' : [121.4648, 31.2891],
//                '北京': [116.4551, 40.2539],
//                "扶风": [107.908753,34.381225],
//        };
            var myData = r.info;
//                var BJData = [
//                    [{
//                        name: '上海',
//                        value: 80
//                    }, {
//                        name: '扶风'
//                    }]
//                ];

            var convertData = function(data) {
                var res = [];
                for (var i = 0; i < data.length; i++) {
                    var dataItem = data[i];
                    var fromCoord = geoCoordMap[dataItem[0].name];
                    var toCoord = geoCoordMap[dataItem[1].name];
                    if (fromCoord && toCoord) {

                        res.push([{
                            coord: fromCoord,
                            value: dataItem[0].value
                        }, {
                            coord: toCoord,
                        }]);
                    }
                }
                return res;
            };

            // var color = ['#a6c84c', '#ffa022', '#46bee9'];
            var series = [];
            [
                ['扶风', myData]

            ].forEach(function(item, i) {
                series.push(

                    {
                        type: 'lines',
                        zlevel: 2,
                        effect: {
                            show: true,
                            period: 4,
                            trailLength: 0.02,
                            symbol: 'arrow',
                            symbolSize: 5,
                        },
                        lineStyle: {
                            normal: {
                                width: 1,
                                opacity: 0.6,
                                curveness: 0.2
                            }
                        },
                        data: convertData(item[1])
                    }, {
                        type: 'effectScatter',
                        coordinateSystem: 'geo',
                        zlevel: 2,
                        rippleEffect: {
                            period: 4,
                            brushType: 'stroke',
                            scale: 4
                        },
                        label: {
                            normal: {
                                show: true,
                                position: 'right',
                                offset: [5, 0],
                                formatter: '{b}'
                            },
                            emphasis: {
                                show: true
                            }
                        },
                        symbol: 'circle',
                        symbolSize: function(val) {
                            return 4 + val[2] / 10;
                        },
                        itemStyle: {
                            normal: {
                                show: false,
                                color: '#00ffff'
                            }
                        },
                        data: item[1].map(function(dataItem) {
                            return {
                                name: dataItem[0].name,
                                value: geoCoordMap[dataItem[0].name].concat([dataItem[0].value])
                            };
                        }),
                    },
                    //被攻击点
                    {
                        type: 'scatter',
                        coordinateSystem: 'geo',
                        zlevel: 2,
                        rippleEffect: {
                            period: 4,
                            brushType: 'stroke',
                            scale: 8
                        },
                        label: {
                            normal: {
                                show: true,
                                // position: 'right',
                                //			                offset:[5, 0],

                                formatter: '{b}',
                                textStyle: {
                                    color: "#fff"
                                }
                            },
                            emphasis: {
                                show: true
                            }
                        },
                        symbol: 'pin',
                        symbolSize: 60,
                        itemStyle: {
                            normal: {
                                show: true,
                                color: '#00ffff'
                            }
                        },
                        data: [{
                            name: item[0],
                            value: geoCoordMap[item[0]].concat([100]),
                        }],
                    }
                );
            });

            option3 = {
                visualMap: {
                    left: '8',
                    bottom: '40',
                    min: 0,
                    max: 100,
                    calculable: true,
                    color: ['#ff5400','#75e83c'],
                    itemWidth: 8,
                    itemHeight: 50,
                    textStyle: {
                        color: '#6da2f7'
                    }
                },
                geo: {
                    map: 'china',
                    label: {
                        emphasis: {
                            show: false
                        }
                    },
                    roam: true,
                    layoutCenter: ['50%', '40%'],
                    layoutSize: "100%",
                    itemStyle: {
                        normal: {
                            color: 'rgba(23, 53, 116, .2)',
                            borderColor: 'rgba(100,149,237,1)'
                        },
                        emphasis: {
                            color: 'rgba(0, 16, 57, .9)'
                        }
                    }
                },

                series: series
            };
            myChart.setOption(option3);
//            }
        });
    }

    //核心客源地TOP10（近一周）
    function getProvinceTop() {
        $.get("<?php echo U('getProvinceTop');?>",function (res) {
            if(res.code ==1 ){
                // var r = res.data;

//核心客源地TOP10（近一周）

                var coreSourceTop10Chart = echarts.init(document.getElementById('coreSourceTop10') , 'westeros');

                var saleDate=res.data;
//					[
//                    {name:'北京',value:132},
//                    {name:'陕西',value:321},
//                    {name:'江苏',value:452},
//                    {name:'广东',value:190},
//                    {name:'湖南',value:176},
//                    {name:'湖北',value:376},
//                    {name:'辽宁',value:387},
//                    {name:'山东',value:176},
//                    {name:'四川',value:376},
//                    {name:'福建',value:387}
//                ];
                //desc 倒序 asc 正序 固定写法 对 saleDate.age进行排序
//                saleDate.sort(getSortFun('asc','value'));
//                function getSortFun(order, sortBy) {
//                    var ordAlpah = (order == 'asc') ?'>' : '<';
//                    var sortFun = new Function('a', 'b', 'return a.'+ sortBy + ordAlpah + 'b.'+ sortBy + '?1:-1');
//                    return sortFun;
//                }
//                console.log(saleDate)
                var datale=[], datale2=[];
                for(var i=0; i<saleDate.length; i++){
                    datale.push(saleDate[i].name);
                    datale2.push(saleDate[i].value)
                }

                option= {
                    tooltip : {
                        trigger: 'axis',
                    },
                    grid: {
                        left: '0%',
                        right: '15%',
                        bottom: '3%',
                        top:'5%',
                        containLabel: true
                    },
                    yAxis : [
                        {
                            type : 'category',
                            data : datale,
                            textStyle:{
                                verticalAlign:'bottom',
                                lineHeight: 88
                            },
                            axisLabel: {
                                show: true,
                                margin: 45,
                                align: 'left',
                                color: '#6da2f7',
                                verticalAlign: 'middle',
                                // padding: [0, 0, 15, 0]
                            },
                            axisTick: {
                                show:false,
                                alignWithLabel: true
                            },
                            axisLine:{
                                show:false
                            },
                            splitLine: {
                                "show": false
                            }
                        }
                    ],
                    xAxis : [
                        {
                            type : 'value',
                            show:false
                        }
                    ],
                    series : [
                        {
                            type:'bar',
                            barWidth: '20%',
                            itemStyle:{
                                normal:{
                                    barBorderRadius:[5],
                                }
                            },
                            label: {
                                normal: {
                                    show: true,
                                    position:   "right"
                                }
                            },
                            data:datale2
                        }
                    ]
                };
                coreSourceTop10Chart.setOption(option);
            }
        })
    }

    //游客性别及年龄占比
    function getVisitorSex() {
        $.get("<?php echo U('getVisitorSex');?>",function (res) {
            if(res.code == 1){
                var r = res.data;
                //qwqwqw

                //游客性别占比
                var sexRatioChart = echarts.init(document.getElementById('sexRatio') , 'walden');
                var women = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACNElEQVRoge1Z0bGCMBC8EighkzRgB88SLMEyvPtKCXagJdCBdKAzCfqZ1wF24PtAFIVAiITwZtyZ/CHuJru5SwAICMNkYphMQv7H6DBMJprTTnEqtKCbFnRTnArNaTd7MTmjRZ34+1CcipzRIjbPVhgmky7ydRGzXAnFSfaRr4mQsfk2oDkaVwGa0zE23wacyd9HbL4N/HsBSmDmnAGBWWy+DeSC1q4CckHr2Hxb4bIKs5z9CobJRAtKOwSks6wB7zgLXGmBeyUwK1cF92eBq9i8rDBMJheGP0PGLFaiatyGbqG1ghavwbuTP3qTr1XlKCJGIR+rtRjSuDkXt6kavJzRYmzyjwI3xVlhVOtMbSWbdaq93p1sWSMmtZLNOorj1TCZKLZZOvudbZblCQ6vk1nJZp2qwg4VAFBV7Ams1LHrpI9nPAQAAGhL7zSalfqs83jOs50ObqU+6zxJ9N9I1Gb35WYimJVcrAMAkHPauu9A99nltH2ZqBBWapvVhnU+KGx1i9ispDgVXuQvbMP6rAMAoAUefAVogYf6u2w58m72NMdTp3UGBNcl0AAtx1KOJy/yAM8johKYvXt2aHBdAw1QZqqq7sFabZ/gugY6OEJ0pJPeWn8WXLdAB8MYwXUNdBAMuoUeOjia4AJsfcs4Aug3uIB7gNPq0upxedWsGV0zfWr8XlAa9fOTbzs9G3wFxMZXQGx8BcwBrgJi87RCd39eqkba/6ZIKA9AuG8/2+I1xAHlD4syumyld28JAAAAAElFTkSuQmCC';

                var men = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAABwElEQVRoge2ZwbGCMBCGLeFPKrAEOniWYAmWQAl0gJddj1KCJdDB87zLTOxAO/AdFEcBFRQMz8k/s6fMwP9lQzZLJpMBhdQBqcOQ7+hdSB0sydqQ7i3r0bIeDenekqxHDwOS6Np4NQzpHiSRb5+NQurwyPwNxBgzYUmTZ+YvQZr49luTYXFtAQzJr2+/NbWe/XP49lvTvwcwrHnrJcSa+/ZbE0gWbQFAsvDtt1FtsjDK2S91rgWbBzVgM8oaUBW4mFuWzLDmp6xIBi7mvn3dCCQRWH96iU8eL8DFvEvRar8ziRs8S112mldjsB0KKzcd2vwFYuWmvQNYKpafArBULHsH6FJp3/8eBqgVXwlgWHNLmhjSXWeTpDtLmtx77kcAysbkleyUJpsaoQAQAAJAAAgAAaB3AMuSVV9Unt/fATh1b9VxyXoHAEl0a0C2ZX/7FkDqYFi2NxMzVIcGksiSJmCNr5vz+wCSNWWuukyQOoA1tqSJl7/X9wCw0hlWOnsG4F0BwLcCgG8FAN8KAL4VAHzrawHK8dEDgDWuGSTdlONN105gjX16rgmssSHdGdaDZcmuj9tIHc5XTgdDuuvT/B/L5uw/gnvI3QAAAABJRU5ErkJggg==';

                var maxData = r.total_num;

                option = {

                    //性别
                    xAxis: {
                        show: false
                        // max: maxData,
                        // splitLine: {show: false},
                        // offset: 10,
                        // axisLine: {
                        //     lineStyle: {
                        //         color: '#999'
                        //     }
                        // },
                        // axisLabel: {
                        //     margin: 10
                        // }
                    },
                    yAxis: {
                        data: r.sex_text,//['男', '女'],
                        inverse: true,
                        axisTick: {show: false},
                        axisLine: {show: false},
                        axisLabel: {
                            margin: 10,
                            textStyle: {
                                color: '#c1d1f3',
                                fontSize: 14
                            }
                        },
                        splitLine: {           // 分隔线
                            show: false
                        }
                    },
                    grid: {
                        width: '50%' ,
                        top: 'center',
                        height: 70,
                        left: 40,
                        right: 100
                    },

                    series: [

                        //性别比例
                        {
                            // current data
                            type: 'pictorialBar',
                            symbolRepeat: 'fixed',
                            symbolMargin: '50%',
                            symbolClip: true,
                            symbolSize: 20,
                            symbolBoundingData: maxData,
                            data: [{value: r.male_num,symbol: men},{value: r.female_num,symbol: women}],
//                            data: [{value: 580, symbol: men},{value: 420,symbol: women}],
                            z: 10
                        }, {
                            // full data
                            type: 'pictorialBar',
                            itemStyle: {
                                normal: {
                                    opacity: 0.2
                                }
                            },
                            label: {
                                normal: {
                                    show: true,
                                    formatter: function (params) {
                                        return (params.value / maxData * 100).toFixed(1) + ' %';
                                    },
                                    position: 'right , bottom',
                                    offset: [200, 8],
                                    textStyle: {
                                        color: '#c1d1f3',
                                        fontSize: 14
                                    }
                                }
                            },
                            animationDuration: 0,
                            symbolRepeat: 'fixed',
                            symbolMargin: '50%',
                            symbolSize: 20,
                            symbolBoundingData: maxData,
                            data: [{value: r.male_num,symbol: men},{value: r.female_num,symbol: women}],
//                            data: [{value: 580, symbol: men},{value: 420,symbol: women}],
                            z: 5
                        }
                    ]
                };
                sexRatioChart.setOption(option);

                //游客年龄占比
                var AgeRatioChart = echarts.init(document.getElementById('AgeRatio') , 'westeros');
                var dataAll = r.age_value;
                var yAxisData = r.age_phase.reverse();
//                var dataAll = [389, 259, 262, 324, 232, 176];
//                var yAxisData = ['17岁及以下','18-24岁','25-30岁','36-40岁','41-50岁','50岁以上'];
                var option = {

                    grid: [
                        {x: '20%', y: '10%', width: '70%', height: '70%'}
                    ],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        },
                        formatter: "{a}{b}  <br/>占比： {c}%"
                    },
                    xAxis: [
                        {
                            gridIndex: 0,
                            axisTick: {show:false},
                            axisLabel: {show:false},
                            splitLine: {show:false},
                            axisLine: {show:false }}
                    ],
                    yAxis: [
                        {
                            gridIndex: 0,
                            interval:0,
                            data: yAxisData,
//                            data: yAxisData.reverse(),
                            axisTick: {show:false},
                            axisLabel: {show:true},
                            splitLine: {show:false},
                            axisLine: {
                                show:true,
                                lineStyle:
                                    {
                                        color:"#6173a3"
                                    }
                            }
                        }
                    ],
                    series: [
                        {
                            name: '游客年龄',
                            type: 'bar',
                            xAxisIndex: 0,
                            yAxisIndex: 0,
                            barWidth:'30%',
                            itemStyle:{
                                normal:{
                                    barBorderRadius:[0, 10, 10, 0],
                                    color: {
                                        type: 'bar',
                                        colorStops:[{
                                            offset: 0,
                                            color: '#0286de'
                                        }, {
                                            offset: .8,
                                            color: '#992cee'
                                        }],
                                        globalCoord: false
                                    }
                                }
                            },
                            label:{
                                normal: {
                                    barBorderRadius: [0, 30, 30, 0],
                                    show:true,
                                    position:"right",
                                    textStyle:{
                                        color: '#cedfff'
                                    }
                                }
                            },
                            data: dataAll.sort()
                        }

                    ]
                };
                AgeRatioChart.setOption(option);
            }
        })
    }

    //游客到访频次统计
    function getPv() {
        $.get("<?php echo U('getPv');?>",function (res) {
            if(res.code ==1){
                var r = res.data;
//游客到访频次统计
                var visitTimesChart = echarts.init(document.getElementById('visitTimes') , 'westeros');
                option = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a}{b} <br/>占比： {d}%"
//                        formatter: "{a}{b} <br/>数量： {c} <br/>占比： {d}%"
                    },
                    title:{
                        textStyle: {
                            fontSize: "14",
                            color: "#77a6ff"
                        }
                    },
                    legend: {
                        data: r.pv_phase, //['1次', '2次', '>3次'],
                        orient: 'vertical',
                        left: '4%',
                        icon: 'circle'
                    },
                    series: [
                        {
                            name: '游客到访',
                            type:'pie',
                            radius: ['50%', '65%'],
                            center: ['50%', '50%'],
                            avoidLabelOverlap: true,
                            label: {
                                emphasis: {
                                    show: true,
                                    textStyle: {
                                        fontSize: '14',
                                        fontWeight: 'bold'
                                    }
                                }
                            },
                            labelLine: {
                                normal: {
                                    show: true
                                }
                            },
                            data: r.pv_data
//								[
//                                {value:335, name:'1次'},
//                                {value:432, name:'2次'},
//                                {value:120, name:'>3次'}
//                            ]
                        }
                    ]
                };
                visitTimesChart.setOption(option);
            }
        })
    }

    //酒店平均价格监测
    function getHotelAvgPrice() {
        $.get("<?php echo U('getHotelAvgPrice');?>",function (res) {
            if(res.code ==1){
                var r = res.data;
                //酒店平均价格监测
                var hotelAveragePriceChart = echarts.init(document.getElementById('hotelAveragePrice') , 'westeros');

                option = {
                    grid: [
                        {x: '15%', y: '15%', width: '75%', height: '70%'},
                    ],
                    tooltip: {
                        trigger: "axis"
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_date, //["10月", "11月", "12月", "1月", "2月", "3月"],
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
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "价格",
                            type: "line",
                            smooth: true,
                            data: r.avg_price, //[700, 500, 550, 678, 887, 334],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };
                hotelAveragePriceChart.setOption(option);
            }
        })
    }

    //目的地舆情监测
    function getPublicOpinion() {
        $.get("<?php echo U('getPublicOpinion');?>",function (res) {
            if(res.code ==1){
                var r = res.data;
                //目的地舆情监测
                var publicOpinionChart = echarts.init(document.getElementById('publicOpinion') , 'westeros');

                option = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a}{b} <br/>数量： {c} <br/>占比： {d}%"
                    },
                    title:{
                        textStyle: {
                            fontSize: "14",
                            color: "#77a6ff"
                        }
                    },
                    legend: {
                        data: r.name, //['正面', '中面', '负面'],
                        orient: 'vertical',
                        icon: 'circle',
                        left: '3%'
                    },
                    series: [
                        {
                            name: '舆情：',
                            type:'pie',
                            radius: ['50%', '65%'],
                            center: ['50%', '50%'],
                            avoidLabelOverlap: true,
                            label: {
                                emphasis: {
                                    show: true,
                                    textStyle: {
                                        fontSize: '14',
                                        fontWeight: 'bold'
                                    }
                                }
                            },
                            labelLine: {
                                normal: {
                                    show: true
                                }
                            },
                            data: r.info
//								[
//                                {value:335, name:'正面'},
//                                {value:432, name:'中面'},
//                                {value:120, name:'负面'}
//                            ]
                        }
                    ]
                };
                publicOpinionChart.setOption(option);

            }
        })
    }

    //游客满意度
    function getSatisfaction() {
        $.get('getSatisfaction',function (res) {
            if(res.code ==1){
                var r = res.data;
                //游客满意度
                var satisfactionChart = echarts.init(document.getElementById('satisfaction') , 'westeros');
                var dataStyle = {
                    normal: {
                        label: {
                            show: false
                        },
                        labelLine: {
                            show: false
                        },
                        shadowBlur: 40,
                        shadowColor: 'rgba(40, 40, 40, 0.5)',
                    }
                };
                var placeHolderStyle = {
                    normal: {
                        color: 'rgba(44,59,70,1)',//未完成的圆环的颜色
                        label: {
                            show: false
                        },
                        labelLine: {
                            show: false
                        }
                    },
                    emphasis: {
                        color: 'rgba(44,59,70 ,1)'//未完成的圆环的颜色
                    }
                };
                option = {
                    title: {
                        text: '游客满意度',
                        subtext: '4.2分',
                        x: 'center',
                        y: '32%',
                        textStyle: {
                            fontWeight: 'normal',
                            color: "#77a6ff",
                            fontSize: 12
                        },
                        subtextStyle: {
                            fontWeight: 'normal',
                            color: "#edb053",
                            fontSize: 24
                        }
                    },
                    tooltip: {
                        show: false,
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    legend: {
                        show: false,
                        itemGap: 12,
                        data: ['01', '02']
                    },
                    toolbox: {
                        show: false,
                        feature: {
                            mark: {
                                show: true
                            },
                            dataView: {
                                show: true,
                                readOnly: false
                            },
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    series: [{
                        name: 'Line 1',
                        type: 'pie',
                        clockWise: false,
                        radius: [55, 60],
                        itemStyle: dataStyle,
                        hoverAnimation: false,

                        data: [{
                            value: 4.7,
                            name: '01',
                            itemStyle: {
                                normal: {
                                    color: {
                                        colorStops:[{
                                            offset: 0,
                                            color: '#92e452'
                                        }, {
                                            offset: .8,
                                            color: '#ec4317'
                                        }],
                                        globalCoord: false
                                    },
                                    shadowColor: {
                                        colorStops:[{
                                            offset: 0,
                                            color: '#92e452'
                                        }, {
                                            offset: .8,
                                            color: '#ec4317'
                                        }],
                                        globalCoord: false
                                    },
                                    shadowBlur: 10
                                }
                            }
                        }, {
                            value: 0.3,
                            name: 'invisible',
                            itemStyle: placeHolderStyle
                        }]
                    }
                    ]
                };
                satisfactionChart.setOption(option);
            }
        })
    }

    //游客平均驻留时间分析
    function getStayAvg() {
        $.get("<?php echo U('getStayAvg');?>",function (res) {
            if(res.code == 1){
                var r= res.data;
                //游客平均驻留时间分析
                var stayTimeChart = echarts.init(document.getElementById('stayTime') , 'westeros');
                option = {
                    grid: [
                        {x: '15%', y: '15%', width: '75%', height: '70%'}
                    ],
                    tooltip: {
                        trigger: "axis"
                    },
                    calculable: true,
                    xAxis: [
                        {
                            type: "category",
                            boundaryGap: false,
                            data: r.s_date, //["10月", "11月", "12月", "1月", "2月", "3月"],
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
                            name:'时间／天',
                            type: "value",
                            axisLine: {
                                show: true
                            }
                        }
                    ],
                    series: [
                        {
                            name: "天数",
                            type: "line",
                            smooth: true,
                            data: r.avg_day, //[2, 3, 2.5, 3, 2, 1],
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'}
                                ]
                            }
                        }
                    ]
                };
                stayTimeChart.setOption(option);
            }
        })
    }

</script>