<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo ($meta_title); ?> | 中智尚联</title>
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome/css/font-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome-4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/ffcommon.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/fuFengStyle.css">
	<!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">-->

    <!-- 百度插件 -->
    <script src="/Application/Admin//Public/Admin/js/ff/echarts.min.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/china.js"></script>

    <script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
</head>
<body onload="aTim();onLoad(1);" class="GZHSJbody KLCountBody">
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

	<div class="main holiday-main">
		<div class="secondLevelNav">
			<div class="nav-select">
				<input value="国庆节">
				<ul style="display: none" id="holidayid">
					<li onclick="getHolidayall(1)">国庆节</li>
					<li  onclick="getHolidayall(2)">端午节</li>
					<li  onclick="getHolidayall(3)">劳动节</li>
					<li  onclick="getHolidayall(4)">中秋节</li>
				</ul>
				<!--<ul style="display: none">-->
				<!--<li>国庆节</li>-->
				<!--<li>中秋节</li>-->
				<!--<li>端午节</li>-->
				<!--<li>五一节</li>-->
				<!--</ul>-->
				<span class="drop-down-span"></span>
			</div>
			<ul>
	<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li>
			<?php if($sub_menu["class"] != 'on'): ?><a href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["name"]); ?></a>
			<?php else: ?>
				<a href="javascript:;" class="active"><?php echo ($sub_menu["name"]); ?></a><?php endif; ?>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
			<!--<ul class="clearfix">-->
			<!--<li><a href="passengerFlow.html">客流统计</a></li>-->
			<!--<li><a href="javascript:;" class="active">假日客流</a></li>-->
			<!--<li><a href="accommodationAnalysis.html">住宿分析</a></li>-->
			<!--<li><a href="travelAgencySupervision.html">旅行社监管</a></li>-->
			<!--<li><a href="complaintAnalysis.html">投诉分析</a></li>-->
			<!--<li><a href="consumptionAnalysis.html">消费分析</a></li>-->
			<!--</ul>-->
		</div>

		<div class="onelineTwo">
			<ul class="clearfix">
				<li>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top clearfix">
							<h4>国庆假日客流统计</h4>
							<div class="box-content-top-right">
								<!--<select>
                                    <option>国庆节</option>
                                    <option>端午节</option>
                                    <option>五一节</option>
                                    <option>中秋节</option>
                                </select>-->
								<input value="国庆节">
								<ul style="display: none">
									<li onclick="getHolidayTotal(1)">国庆节</li>
									<li  onclick="getHolidayTotal(2)">端午节</li>
									<li  onclick="getHolidayTotal(3)">劳动节</li>
									<li  onclick="getHolidayTotal(4)">中秋节</li>
								</ul>

								<span class="drop-down-span"></span>
							</div>
						</div>
						<div id="jiari">

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
							<h4>重点区域客流排行</h4>
							<div class="box-content-top-right">
								<!--<select>
                                    <option>国庆节</option>
                                    <option>端午节</option>
                                    <option>五一节</option>
                                    <option>中秋节</option>
                                </select>-->
								<!--<input value="国庆节">-->
								<!--<ul style="display: none">-->
								<!--<li>国庆节</li>-->
								<!--<li>中秋节</li>-->
								<!--<li>端午节</li>-->
								<!--<li>五一节</li>-->
								<!--</ul>-->
								<input value="国庆节" readonly="readonly">
								<ul style="display: none">
									<li onclick="getHolidayScenicTop(1)">国庆节</li>
									<li  onclick="getHolidayScenicTop(2)">端午节</li>
									<li  onclick="getHolidayScenicTop(3)">劳动节</li>
									<li  onclick="getHolidayScenicTop(4)">中秋节</li>
								</ul>
								<span class="drop-down-span"></span>
							</div>
						</div>
						<div id="scenic-top">

						</div>
						<div class="char-plate">
							<div id="GZHNew" style="width: 550px; height:260px;"></div>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<div class="onelineOne">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>
						国庆假日前后客流走势对比
					</h4>
					<div class="box-content-top-right">
						<!--<select>
                            <option>国庆节</option>
                            <option>端午节</option>
                            <option>五一节</option>
                            <option>中秋节</option>
                        </select>-->

						<input value="国庆节" readonly="readonly">
						<ul style="display: none">
							<li onclick="getHolidayVs(1)">国庆节</li>
							<li  onclick="getHolidayVs(2)">端午节</li>
							<li  onclick="getHolidayVs(3)">劳动节</li>
							<li  onclick="getHolidayVs(4)">中秋节</li>
						</ul>
						<span class="drop-down-span"></span>
					</div>
				</div>
				<div class="char-plates">
					<div id="holidayBeforeAndAfter" style="width: 1200px; height:350px;"></div>
				</div>
			</div>
		</div>

		<div class="onelineOne onelineThree">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top clearfix">
					<h4>客源地分析</h4>
					<div class="box-content-top-right">
						<!--<select>
                            <option>国庆节</option>
                            <option>端午节</option>
                            <option>五一节</option>
                            <option>中秋节</option>
                        </select>-->
						<input value="国庆节" readonly="readonly">
						<ul style="display: none">
							<li onclick="getHolidayTop(1)">国庆节</li>
							<li  onclick="getHolidayTop(2)">端午节</li>
							<li  onclick="getHolidayTop(3)">劳动节</li>
							<li  onclick="getHolidayTop(4)">中秋节</li>
						</ul>
						<span class="drop-down-span"></span>
					</div>
				</div>
				<div class="char-plates">
					<ul class="clearfix">
						<li>
							<div id="provinceTop10" style="width: 380px; height:300px;"></div>
						</li>
						<li>
							<div id="cityTop10" style="width: 380px; height:300px;"></div>
						</li>
						<li>
							<div id="provinceAnalysis" style="width: 380px; height:300px;"></div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="onelineOne onelineThree">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>旅游类APP使用行为分析</h4>
					<div class="box-content-top-right">
						<!--<select>
                            <option>国庆节</option>
                            <option>端午节</option>
                            <option>五一节</option>
                            <option>中秋节</option>
                        </select>-->
						<input value="国庆节" readonly="readonly">
						<ul style="display: none">
							<li onclick="getVisitorApp(1)">国庆节</li>
							<li  onclick="getVisitorApp(2)">端午节</li>
							<li  onclick="getVisitorApp(3)">劳动节</li>
							<li  onclick="getVisitorApp(4)">中秋节</li>
						</ul>
						<span class="drop-down-span"></span>
					</div>
				</div>
				<div class="char-plates">
					<ul class="clearfix">
						<li style="width: 780px;">
							<div id="Usage" style="width: 780px; height:300px;"></div>
						</li>
						<li>
							<div id="UseAPPTop5" style="width: 350px; height:300px;"></div>
						</li>
					</ul>
				</div>
			</div>
		</div>


	</div>
</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>-->
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/dateAnalysisJS/holidayPassengerFlow.js"></script>

</html>
<script>

    $("body input").attr("readonly","readonly");
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
        /*$('.DBAdd-more-btn').click(function () {
            $('.chose-box').addClass('opened-chose-box')
        })*/
        $(".box-content tbody tr").click(function () {
            $(".box-content tbody tr").removeClass("active");
            $(this).addClass("active");
        });

    })
</script>

<script type="application/javascript">

    function onLoad(s_day) {
        getHolidayTotal(s_day); //11
        getHolidayScenicTop(s_day); //22
        getHolidayVs(s_day);
        getHolidayTop(s_day);
        getVisitorApp(s_day);
    };

    function getHolidayall(holidayid){
        var text = $('#holidayid option:selected').text();//选中的文本
//        var holidayid= $('#holidayid option:selected') .val();//选中的值
        $('.holidaytag').text(text);
        $('.holidayall').empty();
        var option = '';
        var holiday = '';
        if(holidayid == 1){
            holiday = '国庆节';
            option += '<option value="1"  selected >国庆节 </option>';
            option += '<option value="2"  >端午节 </option>';
            option += '<option value="3"  >劳动节 </option>';
            option += '<option value="4" >中秋节 </option>';
            $('.holidayall').append(option);
        }else if(holidayid == 2){
            holiday = '端午节';
            option += '<option value="1" >国庆节 </option>';
            option += '<option value="2" selected >端午节 </option>';
            option += '<option value="3"  >劳动节 </option>';
            option += '<option value="4" >中秋节 </option>';
            $('.holidayall').append(option);
        }else if(holidayid == 3){
            holiday = '劳动节';
            option += '<option value="1" >国庆节 </option>';
            option += '<option value="2" >端午节 </option>';
            option += '<option value="3" selected >劳动节 </option>';
            option += '<option value="4" >中秋节 </option>';
            $('.holidayall').append(option);
        }else{
            holiday = '中秋节';
            option += '<option value="1" >国庆节 </option>';
            option += '<option value="2" >端午节 </option>';
            option += '<option value="3"  >劳动节 </option>';
            option += '<option value="4" selected >中秋节 </option>';

            $('.holidayall').append(option);
        }
        $('input').val(holiday);
        onLoad(holidayid);
//        $('.holiday option:selected') .val()
    }

    function isHoliday(s_day) {
        if(s_day == 1) return '国庆节';
        else if(s_day == 2) return '端午节';
        else if(s_day == 3)	return '劳动节';
        else   return '中秋节';
    }

    //国庆假日客流统计
    function getHolidayTotal(s_day) {
        $('.holidayTotal').text(isHoliday(s_day));
        $.get("<?php echo U('getHolidayTotal');?>",{s_day:s_day},function (res) {
            $('#jiari').empty();
            if(res.code == 1){
                var r = res.data.arr;
                var rs = res.data;
                var str = '';
                str += '<table>';
                str += '<thead>';
                str += '<tr>';
                str += '<th>日期</th><th>客流量('+rs.unit+'人次)</th><th>同比</th><th>环比</th>';
                str += '</tr>';
                str += '</thead>';
                str += '<tbody>';
                for(var i=0;i<r.length;i++){
                    str += '<tr>';
                    str += '<td>'+ r[i].s_date +'</td><td>'+ r[i].user_num + '</td><td>'+ r[i].increase +'</td><td>'+ r[i].ratio +'</td>';
                    str += '</tr>';
                }
                str += '</tbody>';
                str += '<tfoot>';
                str += '<tr>';
                str += ' <td>累计</td><td>'+ rs.total_num +'</td><td>'+ rs.total_increase + '%</td><td>'+ rs.total_ratio+'%</td>'
                str += '</tr>';
                str += ' </tfoot>';
                str += '</table>';
                $('#jiari').append(str);
            }
        });
    }

    //国庆假日客流统计
    function getHolidayScenicTop(s_day) {

        $.get("<?php echo U('getHolidayScenicTop');?>",{s_day:s_day},function (res) {
            $('#scenic-top').empty();
            if(res.code == 1){
                var r = res.data;
                var str = '';
                str += '<table> <thead>';
                str += '<tr>';
                str += ' <th>排名</th><th>区域名称</th><th>客流数</th><th>平均饱和度</th>';
                str += '</tr>';
                str += ' </thead><tbody>';
                for(var i=0; i<r.length;i++){
                    if(i <3){
                        str += '<tr class="highLight">';
                    }else {
                        str += '<tr>';
                    }
                    str += ' <td>'+r[i].ranking+'</td><td>'+r[i].name+'</td><td>'+r[i].user_num +'</td><td> '+r[i].saturation+'</td>';
                    str += ' </tr>';
                }
                str += ' </tbody></table>';
                $('#scenic-top').append(str);
            }
        });

    }

    //国庆假日前后客流走势对比
    function getHolidayVs(s_day) {
        $('.holidayVs').text(isHoliday(s_day));
        $.get("<?php echo U('getHolidayVs');?>",{s_day:s_day},function (res) {
//            if(res.code == 1){
            var r = res.data;
            var holidayBeforeAndAfterChart = echarts.init(document.getElementById('holidayBeforeAndAfter') , 'westeros');
            option = {
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
                        data: r.s_date, //["9.25", "9.26", "9.27", "9.28", "9.29", "9.30", "10.1", "10.2", "10.3", "10.4", "10.5", "10.6", "10.7", "10.8", "10.9", "10.10", "10.11", "10.12", "10.13", "10.14"]
                    }
                ],
                yAxis: [
                    {
                        type: "value",
                        name: "万人次",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "客流量",
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
                        data: r.user_num,//[40, 89, 126, 100, 187, 134, 124, 90, 60, 40, 89, 126, 100, 187, 134, 124, 90, 60,40, 89],
                        /*markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }*/
                    }
                ]
            };
            holidayBeforeAndAfterChart.setOption(option);
//            }
        });

    }

    //客源地分析-省市
    function getHolidayTop(s_day) {
        var holiday_text = isHoliday(s_day);
        $.get("<?php echo U('getHolidayTop');?>",{s_day:s_day},function (res) {
            if (res.code ==1){
                var r = res.data;
                //客源地省份top10
                var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');

                // 指定图表的配置项和数据
                option = {
                    title:{
                        text: holiday_text+'假日客源地省份Top10',
                        textStyle: {
                            fontSize: "12",
                            color: "#77a6ff"
                        }
                    },
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            splitLine: {           // 分隔线
                                show: false
                            },
                            data : r.province , //['省份一', '省份二', '省份三', '省份四', '省份五', '省份六', '省份七', '省份八', '省份九', '省份十'],
                            axisTick: {
                                alignWithLabel: true
                            },
                            axisLabel: {rotate: 50, interval: 0}
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'客流量',
                            type:'bar',
                            barWidth: '30%',
                            data: r.province_user_num, //[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                        }
                    ]
                };
                provinceTop10Chart.setOption(option);



                //本省客源地城市top10
                var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');

                // 指定图表的配置项和数据
                option = {
                    title:{
                        text: holiday_text+'客源地城市top10',
                        textStyle: {
                            fontSize: "12",
                            color: "#77a6ff"
                        }
                    },
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            splitLine: {           // 分隔线
                                show: false
                            },
                            data : r.city, // ['城市1', '城市2', '城市3', '城市4', '城市5', '城市6', '城市7', '城市8', '城市9', '城市10'],
                            axisTick: {
                                alignWithLabel: true
                            },
                            axisLabel: {rotate: 50, interval: 0}
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'客流量',
                            type:'bar',
                            barWidth: '30%',
                            data: r.city_user_num,//[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                        }
                    ]
                };
                cityTop10Chart.setOption(option);


                //外省与本省客源分析
                var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis') , 'westeros');
                option = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
                    },
                    title:{
                        text: holiday_text+'假日外省与本省客源分析',
                        textStyle: {
                            fontSize: "12",
                            color: "#77a6ff"
                        }
                    },
                    series: [
                        {
                            type:'pie',
                            radius: ['50%', '65%'],
                            center: ['50%', '50%'],
                            avoidLabelOverlap: false,
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
                            data: r.province_vs, //[{value:335, name:'外省'}, {value:432, name:'本省'}]
                        }
                    ]
                };
                provinceAnalysisChart.setOption(option);
            }
        });

    }

    //旅游类APP使用情况走势（按小时）
    function getVisitorApp(s_day) {
        var holiday_text = isHoliday(s_day);
        $.get("<?php echo U('getVisitorApp');?>",{s_day:s_day},function (res) {
//            if (res.code == 1) {
            var r = res.data;
            var UsageChart = echarts.init(document.getElementById('Usage'), 'westeros');
            option = {
                title: {
                    text: '旅游类APP使用情况走势（按小时）',
                    textStyle: {
                        fontSize: "12",
                        color: "#77a6ff"
                    }
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
                        data: r.s_time,//["00:00", "04:00", "08:00", "12:00", "16:00", "20:00", "24:00"]
                    }
                ],
                yAxis: [
                    {
                        type: "value",
                        name: "万人次",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "客流量",
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
                        data: r.user_num, //[40, 89, 126, 100, 187, 134, 124]
                        /*markPoint: {
                        data: [
                            {type: 'max', name: '最大值'}
                        ]
                    }*/
                    }
                ]
            };

            UsageChart.setOption(option);
//            }
//        });


            //国庆假日旅游APP使用TOP5
//		$.get("<?php echo U('getVisitorApp');?>",{s_day:s_day},function (res) {
//            if(res.code == 1){
//			    var r=res.data;
            var UseAPPTop5Chart = echarts.init(document.getElementById('UseAPPTop5') , 'westeros');

            // 指定图表的配置项和数据
            option = {
                title:{
                    text:  holiday_text+'假日旅游APP使用TOP5',
                    textStyle: {
                        fontSize: "12",
                        color: "#77a6ff"
                    }
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                yAxis : [
                    {
                        type : 'category',
                        splitLine: {           // 分隔线
                            show: false
                        },
                        data : r.app,
//                        data : ['5.携程', '4.途牛', '3.携程', '2.途牛', '1.途牛'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        // axisLabel: {rotate: 50, interval: 0}
                    }
                ],
                xAxis : [
                    {
                        show: false,
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'用户数',
                        type:'bar',
                        barWidth: '30%',
                        data: r.app_user_num,
//                        data:  ['330', 629, 700, 828, 930]
                    }
                ]
            };
            UseAPPTop5Chart.setOption(option);

//            }
        })
    }

</script>