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

	<div class="main">
		<div class="secondLevelNav">
			<ul>
	<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li>
			<?php if($sub_menu["class"] != 'on'): ?><a href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["name"]); ?></a>
			<?php else: ?>
				<a href="javascript:;" class="active"><?php echo ($sub_menu["name"]); ?></a><?php endif; ?>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
			<!--<ul>-->
				<!--<li><a href="javascript:;" class="active">客流统计</a></li>-->
				<!--<li><a href="holidayPassengerFlow.html">假日客流</a></li>-->
				<!--<li><a href="accommodationAnalysis.html">住宿分析</a></li>-->
				<!--<li><a href="travelAgencySupervision.html">旅行社监管</a></li>-->
				<!--<li><a href="complaintAnalysis.html">投诉分析</a></li>-->
				<!--<li><a href="consumptionAnalysis.html">消费分析</a></li>-->
			<!--</ul>-->
		</div>
		<div class="onelineOne">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>扶风旅游客流量统计</h4>

					<p class="clearfix">
						<span class="active" onclick="getTouristFlow(1)">7天</span>
						<span onclick="getTouristFlow(2)">30天</span>
						<span onclick="getTouristFlow(3)">90天</span>
						<span onclick="getTouristFlow(4)">半年</span>
						<span onclick="getTouristFlow(5)">一年</span>
					</p>
				</div>
				<div class="char-plate">
					<div id="KLCount" style="width: 1200px; height:350px;"></div>
				</div>
			</div>
		</div>

		<div class="onelineTwo">
			<ul class="clearfix">
				<li>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top">
							<h4>景区客流对标分析</h4>
							<!--<p class="clearfix"><span class="active">7天</span><span>30天</span><span>90天</span><span>半年</span><span>一年</span></p>-->
							<p class="clearfix scenicvs-p">
								<span class="active" onclick="getScenicVs(1,scenicarrays)" data-id="1">7天</span>
								<span onclick="getScenicVs(2,scenicarrays)" data-id="2">30天</span>
								<span onclick="getScenicVs(3,scenicarrays)" data-id="3">90天</span>
								<span onclick="getScenicVs(4,scenicarrays)" data-id="4">半年</span>
								<span onclick="getScenicVs(5,scenicarrays)" data-id="5">一年</span>
							</p>
						</div>
						<div class="box-content-mid">
							<!--<div class="box-content-mid-left">-->
								<!--<span>景区:</span>-->
								<!--<select>-->
									<!--<option>法门寺</option>-->
									<!--<option>景区一</option>-->
									<!--<option>景区二</option>-->
									<!--<option>景区三</option>-->
								<!--</select>-->
							<!--</div>-->
							<div class="box-content-mid-right clearfix" style="width:530px">
								<span>对标景区:</span>
								<p class="float-left" id="scenic-p"  style="width:460px">
									<!--<span><a>景区一景区一</a></span>-->
									<!--<span><a>景区一景区一</a></span>-->
									<span class="addBtnSpan"><a>+</a></span>
								<div class="chose-box" id="scenic">
									<!--<label><input type="checkbox">法门寺法门寺</label>-->
									<!--<label><input type="checkbox">景区一</label>-->
									<!--<label><input type="checkbox">景区二</label>-->
									<!--<label><input type="checkbox">景区三</label>-->
									<!--<label><input type="checkbox">法门寺</label>-->
									<!--<label><input type="checkbox">景区一</label>-->
									<!--<label><input type="checkbox">景区二</label>-->
									<!--<label><input type="checkbox">景区三</label>-->
									<!--<label><input type="checkbox">法门寺</label>-->
									<!--<label><input type="checkbox">景区一</label>-->
									<!--<label><input type="checkbox">景区二</label>-->
									<!--<label><input type="checkbox">景区三</label>-->
								</div>
								</p>

							</div>
						</div>
						<div class="char-plate">
							<div id="DBFX" style="width: 550px; height:350px;"></div>
						</div>
					</div>
				</li>
				<li>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top clearfix">
							<h4>重点区域客流统计</h4>
							<p class="clearfix">
								<span class="active" onclick="getkeyAreaTop(1)">7天</span>
								<span onclick="getkeyAreaTop(2)">30天</span>
								<span onclick="getkeyAreaTop(3)">90天</span>
								<span onclick="getkeyAreaTop(4)">半年</span>
								<span onclick="getkeyAreaTop(5)">一年</span>
							</p>
						</div>
						<div class="keyAreaTop">

						</div>
						<div class="char-plate">
							<div id="GZHNew" style="width: 550px; height:260px;"></div>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<div class="onelineOne onelineThree">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top clearfix">
					<h4>客源地分析</h4>
					<!--<p><span class="active">7天</span><span>30天</span><span>90天</span><span>半年</span><span>一年</span></p>-->
					<p class="clearfix">
						<span class="active" onclick="getProvince(1)">7天</span>
						<span onclick="getProvince(2)">30天</span>
						<span onclick="getProvince(3)">90天</span>
						<span onclick="getProvince(4)">半年</span>
						<span onclick="getProvince(5)">一年</span>
					</p>
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
	</div>
</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/dateAnalysisJS/passengerFlow.js"></script>-->

</html>
<script>
    var scenicarrays = [];
    //初始化
    var url = "<?php echo U('getScenicInfo');?>";
    //	var dataJson = {};
    $.get(url, function (data) {
        var r =data.data;
        if (data.code == 1)
        {
            var html = ' ';
//            var html = ``;
            $.each(r, function (k, v) {
                if(k < 3){
                    scenicarrays.push(r[k].scenic_id);

                    //  console.log(scenicarrays);
                    html += '<label><input type="checkbox"  checked="checked" class="scenicClass" value="'+r[k].scenic_id +'">'+r[k].name+'</label>';
                }else {
                    html += '<label><input type="checkbox"  class="scenicClass" value="'+r[k].scenic_id +'">'+r[k].name+'</label>';
                }


//				html += '<label><input checked="checked" type="checkbox">'+r[k].name+'</label>';
            })
            $('#scenic').html(html);
            getscenic();
            removescenic();
        }
    })

    function  getscenic() {
        $('#scenic  label').each(function (k, v) {
            //   console.log(k);
            if (k < 3)
            {
                var labelText = $(v).text();
                var input = $(v).find('input');
                var inputVal = input.val();
                input.attr('checked', true);
                var html = '<span id="removeId'+inputVal+'"><a>'+labelText+'</a></span>';
//                var html = `<span id="removeId${inputVal}"><a>${labelText}</a></span>`;
                $('#scenic-p').append(html);
                //
                //  scenicarrays.push(inputVal);
            }
        })

        // console.log(scenicarrays);
        var day = $('.scenicvs-p .active').attr('data-id');
        getScenicVs(day,scenicarrays);
    }



    //移除
    function removescenic(){
        $('.scenicClass').click(function () {
            var val = $(this).val();
            if ($(this).is(':checked') === false)
            {
                //说明之前是选中，现在是取消
                $('#removeId'+val).remove();
                //
                scenicarrays.splice($.inArray(val,scenicarrays),1);
            }
            else
            {
                //现在是选中
                var parentText = $(this).parent().text();
                var html = '<span id="removeId'+val+'"><a>'+ parentText +'</a></span>';
//                var html = `<span id="removeId${val}"><a>${parentText}</a></span>`;
                $('#scenic-p').append(html)

                //
                scenicarrays.push(val);
            }
            //   console.log(scenicarrays);
            var day = $('.scenicvs-p .active').attr('data-id');
            getScenicVs(day,scenicarrays);
        });

    }


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
    $(document).ready(function () {
        $('.addBtnSpan').click(function () {
            $('.chose-box').slideToggle(150);
        });
        $(".box-content tbody tr").click(function () {
            $(".box-content tbody tr").removeClass("active");
            $(this).addClass("active");
        });

    })

    function onLoad(s_day) {
        //重点区域
        getkeyAreaTop(s_day);
        //客源地分析
        getProvince(s_day);
        //流量
        getTouristFlow(s_day); //11
        ///景区客流对标分析
        getScenicVs(s_day); //22

    };


    function getProvince(s_day) {
        getProvinceTop(s_day);
        getCityTop(s_day);
        getProvinceVs(s_day);
    }



    //景区客流统计
    function getTouristFlow(s_day) {
        $.get("<?php echo U('getTouristFlow');?>",{s_day:s_day},function (res) {
//            if(res.code == 1){
            var r = res.data;
            var KLCountChart = echarts.init(document.getElementById('KLCount') , 'westeros');
            KLCountChart.clear();
            KLCountChart.getOption();
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
                        data: r.s_date, //["9.14", "9.15", "9.16", "9.17", "9.18", "9.19", "9.20"]
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
                        data: r.user_num,  //[40, 89, 126, 100, 187, 134, 124, 90, 60],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'}
                            ]
                        }
                    }
                ]
            };

            KLCountChart.setOption(option);
//            }

        });

    }


    //景区客流对标分析
    function getScenicVs(s_day,scenicids) {
      //  console.log(scenicids);
        scenicids = scenicids.join(",");

        $.get("<?php echo U('getScenicVs');?>",{s_day:s_day,scenicids:scenicids},function (res) {

//            if(res.code == 1){

            var r = res.data;
            var DBFXChart = echarts.init(document.getElementById('DBFX') , 'westeros');
            DBFXChart.clear();
            DBFXChart.getOption();
            option = {
                legend: {
                    x: 'right',
                    y: 'top',
                    data: r.scenic_name //['法门寺','景区一','景区二']
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
                        type: "value",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series:r.series
//                    series: []
            };
            DBFXChart.setOption(option);
//            }
        });

    }

    //重点区域排行榜
    function getkeyAreaTop(s_day) {
        $.get("<?php echo U('getkeyAreaTop');?>",{s_day:s_day},function (res) {
            $('.keyAreaTop').empty();
            if(res.code == 1){
                var r = res.data;
                var str = '';
                str += '<table>';
                str += '<thead>';
                str += '<tr>';
                str += '<th>排名</th><th>重点区域</th><th>游客数量</th><th>占比</th>';
                str += '</tr>';
                str += '</thead>';
                str += '<tbody>';
                for(var i=0;i<r.length;i++){
                    if(i ==0){
                        str += '<tr class="active"  onclick="getKeyAreaDay('+s_day+ ','+r[i].scenic_id+')">';
                    }else {
                        str += '<tr  onclick="getKeyAreaDay('+s_day+ ','+r[i].scenic_id+')">';
                    }
                    str += '<td>'+ r[i].ranking +'</td><td>'+ r[i].name + '</td><td>'+ r[i].user_num +'</td><td>'+ r[i].saturation +'</td>';
                    str += '</tr>';
                }
                str += '</tbody>';
                str += '</table>';
                $('.keyAreaTop').append(str);
                getKeyAreaDay(s_day,r[0].scenic_id);
            }
            var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');
            GZHNewChart.clear();
            GZHNewChart.setOption();
            $(function(){
                $(".keyAreaTop tbody tr").click(function(){
                    $(this).addClass("active");
                    $(this).siblings().removeClass("active");
                });
            });
        })
    }

    //重点区域客流统计
    function getKeyAreaDay(s_day,scenic_id) {

        $(function(){
            $(".keyAreaTop tbody tr").click(function(){
                $(this).addClass("active");
                $(this).siblings().removeClass("active");
            });
        });

        $.get("<?php echo U('getKeyAreaDay');?>",{s_day:s_day,scenic_id:scenic_id},function (res) {
            var GZHNewChart = echarts.init(document.getElementById('GZHNew') , 'westeros');
            GZHNewChart.clear();
            if(res.code == 1){
            var r = res.data;

            option = {
                /*legend: {
                    x: 'right',
                    y: 'top',
                    data:['新增人数']
                },*/
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
                        type: "value",
                        axisLine: {
                            show: true
                        }
                    }
                ],
                series: [
                    {
                        name: "游客数量",
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
            GZHNewChart.setOption();
        });
    }

    //客源地省份top10
    function getProvinceTop(s_day) {

        $.get("<?php echo U('getProvinceTop');?>",{s_day:s_day},function (res) {
            var provinceTop10Chart = echarts.init(document.getElementById('provinceTop10') , 'westeros');
            provinceTop10Chart.clear();
            if(res.code == 1){
            var r =res.data;

            // 指定图表的配置项和数据
            option = {
                title:{
                    text: '客源地省份Top10',
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
                        data :r.province,  //['省份一', '省份二', '省份三', '省份四', '省份五', '省份六', '省份七', '省份八', '省份九', '省份十'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLabel: {rotate: 50, interval: 0}
                    }
                ],
                yAxis : [
                    {
                        name:'人数',
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'客流量',
                        type:'bar',
                        barWidth: '30%',
                        itemStyle:{
                            normal:{
                                barBorderRadius: [30, 30, 0, 0],
                                color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0,
                                    color: '#0286de'
                                }, {
                                    offset: .8,
                                    color: '#992cee'
                                }], false)
                            }
                        },
                        data: r.user_num, //[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                    }
                ]
            };
            provinceTop10Chart.setOption(option);
            }
        });
    }

    //客源地城市top10
    function getCityTop(s_day) {
        $.get("<?php echo U('getCityTop');?>",{s_day:s_day},function (res) {
            var cityTop10Chart = echarts.init(document.getElementById('cityTop10') , 'westeros');
            cityTop10Chart.clear();
            if(res.code == 1){
            var r = res.data;

            // 指定图表的配置项和数据
            option = {
                title:{
                    text: '客源地城市Top10',
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
                        data : r.city, //['城市1', '城市2', '城市3', '城市4', '城市5', '城市6', '城市7', '城市8', '城市9', '城市10'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLabel: {rotate: 50, interval: 0}
                    }
                ],
                yAxis : [
                    {
                        name:'人数',
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'客流量',
                        type:'bar',
                        barWidth: '30%',
                        itemStyle:{
                            normal:{
                                barBorderRadius: [30, 30, 0, 0],
                                color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0,
                                    color: '#0286de'
                                }, {
                                    offset: 0.8,
                                    color: '#992cee'
                                }], false)
                            }
                        },
                        data: r.user_num//[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
                    }
                ]
            };
            cityTop10Chart.setOption(option);
            }
        });

    }

    //外省与本省客源分析
    function getProvinceVs(s_day) {
        //外省与本省客源分析
        $.get("<?php echo U('getProvinceVs');?>",{s_day:s_day},function (res) {
            var provinceAnalysisChart = echarts.init(document.getElementById('provinceAnalysis'), 'westeros');
            provinceAnalysisChart.clear();
//            if(res.code == 1) {
            var r = res.data;
            option = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a}{b} <br/>客流： {c} <br/>占比： {d}%"
                },
                title: {
                    text: '外省与本省客源分析',
                    textStyle: {
                        fontSize: "12",
                        color: "#77a6ff"
                    }
                },
                series: [
                    {
                        type: 'pie',
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
                        data: r //[{value: 335, name: '外省'}, {value: 432, name: '本省'}]
                    }
                ]
            };
            provinceAnalysisChart.setOption(option);
//            }
        });
    }

</script>