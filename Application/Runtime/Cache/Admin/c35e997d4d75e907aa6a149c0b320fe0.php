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
<head>
	<!--<link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all">-->

</head>
<body onload="aTim();onLoad();" class="GZHSJbody KLCountBody hotelBody">
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

	<div class="main hotel-main">
		<div class="onelineOne">
			<div class="box-content">
				<span class="left-top"></span>
				<span class="right-top"></span>
				<span class="left-bottom"></span>
				<span class="right-bottom"></span>
				<div class="box-content-top">
					<h4>酒店价格监测</h4>
				</div>
				<div class="search-option">
					<ul>
						<li class="putList">
							<div class="search-name">
								<p>酒店级别：</p>
							</div>
							<div class="checkboxDiv">
								<label for="bx">
									<input type="checkbox" id="bx" class="hidden-input">
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">不限</span>
								</label>
							</div>
							<div class="checkboxDiv">
								<label for="ms">
									<input type="checkbox" id="ms" class="hidden-input" name="level" value="1" >
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">名宿</span>
								</label>
							</div>
							<div class="checkboxDiv">
								<label for="yxj">
									<input type="checkbox" id="yxj" class="hidden-input" name="level" value="6">
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">客栈</span>
								</label>
							</div>
							<div class="checkboxDiv">
								<label for="exj">
									<input type="checkbox" id="exj" class="hidden-input" name="level" value="2" >
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">经济型</span>
								</label>
							</div>
							<div class="checkboxDiv">
								<label for="sanxj">
									<input type="checkbox" id="sanxj" class="hidden-input" name="level" value="3" >
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">三星级</span>
								</label>
							</div>
							<div class="checkboxDiv">
								<label for="sixj">
									<input type="checkbox" id="sixj" class="hidden-input" name="level" value="4" >
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">四星级</span>
								</label>
							</div>
							<div class="checkboxDiv">
								<label for="wxj">
									<input type="checkbox" id="wxj" class="hidden-input" name="level" value="5" >
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">五星级</span>
								</label>
							</div>
						</li>
						<li class="putList">
							<div class="search-name">
								<p>酒店位置：</p>
							</div>
							<div class="checkboxDiv">
								<label for="wzbx">
									<input type="checkbox" id="wzbx" class="hidden-input">
									<span class=""></span>
									<i class="fa fa-check"></i>
									<span class="labelSpan">不限</span>
								</label>
							</div>
							<?php if(is_array($region_list)): $i = 0; $__LIST__ = $region_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="checkboxDiv">
									<label for="fms<?php echo ($vo["id"]); ?>">
										<input type="checkbox" id="fms<?php echo ($vo["id"]); ?>"  name="region_name" value="<?php echo ($vo["id"]); ?>" class="hidden-input">
										<span class=""></span>
										<i class="fa fa-check"></i>
										<span class="labelSpan"><?php echo ($vo["name"]); ?></span>
									</label>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>

							<!--<div class="checkboxDiv">-->
								<!--<label for="ndj">-->
									<!--<input type="checkbox" id="ndj" class="hidden-input">-->
									<!--<span class=""></span>-->
									<!--<i class="fa fa-check"></i>-->
									<!--<span class="labelSpan">南大街</span>-->
								<!--</label>-->
							<!--</div>-->
							<!--<div class="checkboxDiv">-->
								<!--<label for="xzf">-->
									<!--<input type="checkbox" id="xzf" class="hidden-input">-->
									<!--<span class=""></span>-->
									<!--<i class="fa fa-check"></i>-->
									<!--<span class="labelSpan">县政府</span>-->
								<!--</label>-->
							<!--</div>-->
							<!--<div class="checkboxDiv">-->
								<!--<label for="lcq">-->
									<!--<input type="checkbox" id="lcq" class="hidden-input">-->
									<!--<span class=""></span>-->
									<!--<i class="fa fa-check"></i>-->
									<!--<span class="labelSpan">老城区</span>-->
								<!--</label>-->
							<!--</div>-->
							<!--<div class="checkboxDiv">-->
								<!--<label for="xcq">-->
									<!--<input type="checkbox" id="xcq" class="hidden-input">-->
									<!--<span class=""></span>-->
									<!--<i class="fa fa-check"></i>-->
									<!--<span class="labelSpan">新城区</span>-->
								<!--</label>-->
							<!--</div>-->
						</li>
					</ul>
				</div>
				<div class="hotel-main-top-left">
					<div class="box-content-top-select clearfix">
						<form>
							<input id="keyword" name="keyword" value="">
							<input type="button" value="搜索" onclick="getHotel(1);" class="submit-btn">
						</form>

					</div>
					<table>
						<thead>
						<tr><th>序号</th><th>酒店名称</th><th>酒店级别</th><th>所属区域</th><th>操作</th></tr>
						</thead>
						<tbody id="getHotel">
						<!--<tr><td>1</td><td>佛光阁酒店（法门寺店）</td><td>三星级</td><td>南大街</td><td><span class="cancel-link"><i class="fa fa-minus"></i>取消对比</span></td></tr>
						<tr><td>3</td><td>佛光阁酒店（东大街店）</td><td>三星级</td><td>南大街</td><td><span class="add-link"><i class="fa fa-plus"></i>加入分析</span></td></tr>-->
						</tbody>
					</table>
					<div class="page-contain" ID="pageJump">
						<a class="active">首页</a><a>上一页</a><a class="active">1</a><a>下一页</a><a>末页</a><span>跳至第<input value="" placeholder="1">页</span>
						<!--<a class="active">首页</a><a>上一页</a><a class="active">1</a><a>2</a><a>3</a><a>下一页</a><a>末页</a><span>跳至第<input value="" placeholder="1/3">页</span>-->

					</div>

				</div>
				<div class="hotel-main-top-right">
					<h3>酒店价格对比分析</h3>
					<ul class="hotelvs">
						<!--<li>
							<span>佛光阁酒店（法门寺店）</span><a><i class="fa fa-minus-circle"></i></a>
						</li>-->
					</ul>
					<div class="contrast-div">
						<a id="contrastID" onclick="contrast()">对比</a>
					</div>
				</div>
				<div class="clear"></div>
				<div class="hotel-main-bot">
					<div class="title">
						<p>佛光阁酒店（观光路店）</p>
					</div>
					<table>
						<thead>
						<tr>
							<th>序号</th><th>销售渠道</th><th>当天价格（元）</th><th>T+1天价格（元）</th><th>T+2天价格（元）</th>
							<th>T+3天价格（元）</th><th>T+4天价格（元）</th><th>T+5天价格（元）</th><th>T+6天价格（元）</th>
						</tr>
						</thead>
						<tbody>
						<!--<tr>-->
							<!--<td>1</td><td>去哪儿</td><td>140</td><td>148<span class="goUp">+10%</span></td><td>148<span class="goUp">+10%</span></td><td>148<span class="goUp">+10%</span></td>-->
							<!--<td>148<span class="goUp">+10%</span></td><td>148<span class="goDown">-10%</span></td><td>148<span class="goUp">+10%</span></td>-->
						<!--</tr>-->

						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>

<script src="/Application/Admin//Public/Admin/js/ff/hotel.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/pop.js"></script>

<script type="text/javascript">
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

    });

    function onLoad() {
        getHotel(1);
    }

    //地区选择
    function checkbox(name) {
        var str=document.getElementsByName(name);
        var objarray=str.length;
//        var chestr="";
        var chearr= [];
        for (i=0;i<objarray;i++)
        {
            if(str[i].checked == true)
            {
//                chestr+=str[i].value+",";
                chearr.push(str[i].value);
            }
        }
       return chearr.join(',');
        //return chestr;
    }

    /**`
	 * 获取酒店信息
     */
    function getHotel(page) {
		var region = checkbox('region_name');
		var level = checkbox('level');
        //关键字搜索
        var keyword = document.getElementById("keyword").value;
        $.get('/index.php/Admin/Hotel/getHotel',{levelId:level,regionId:region,page:page,keyword:keyword},function (res) {
            $('#getHotel').empty();
            if(res.code == 1){
                var r = res.data;
                var str = '';
                $(r.list).each(function (k, v) {
                    if(k < 1){
                        getHotelRate(v.id,v.name);
                        str += '<tr class="gethotelall active"; onclick="getHotelRate('+v.id +','+'\''+v.name+'\''+');" "><td>'+(k+1)+'</td><td>'+ v.name+'</td><td>'+v.level+'</td><td>'+v.region+'</td><td><span class="add-link"  onclick="HotelPk(this,' +
                            k+','+ v.id +')" ><i class="fa fa-plus"></i>加入分析</span></td></tr>';
					}else {
                        str += '<tr class="gethotelall "; onclick="getHotelRate('+v.id+','+'\''+v.name +'\''+')"><td>'+(k+1)+'</td><td>'+ v.name+'</td><td>'+v.level+'</td><td>'+v.region+'</td><td><span class="add-link"  onclick="HotelPk(this,' +
                            k+','+ v.id +')" ><i class="fa fa-plus"></i>加入分析</span></td></tr>';
					}
                })
               $('#getHotel').append(str);
                //                impCancel();
                // cancelv2();
			}
        });
    }



    function HotelPk(obj,index,ids) {
//        console.log(obj);
//        if ($(obj).hasClass('cancel-link')) {
//
//            $(obj).context.innerHTML ="<i class='fa fa-plus'></i>加入分析";
//        } else {
//
//        }
        $(obj).parent().html('<span class=\"cancel-link\" onclick="impCancel(' + index + ','+ids+')"><i class=" fa fa-minus"  ></i>取消对比</span>');
        var str = '';
        str +='<li class="cancel'+ ids +'" data-id="'+ids+'" onclick="getHotelRate('+ids+');">' +
            '<span>'+ $('#getHotel tr').eq(index).children('td').eq(1).text() +'</span>' +
            '<a><i class="fa fa-minus-circle" onclick="impCancel(' + index + ','+ids+')"></i></a>' +
				'<input type="hidden" name="hotelid[]" value="'+ids +' ">'+
            '</li>';
        $('.hotelvs').append(str);
		$(obj).toggleClass("cancel-link");
        $(obj).toggleClass("add-link");

        //
//        $('.contrast-div').empty();
//		var data_va = new Array()
//		var data_va = data_va.push(ids);
//        var vs = '<a id="contrastID" onclick="ckContrast('+ data_va +');">对比</a>';
//        $('.contrast-div').append(vs);
    };
	function impCancel(index,ids) {
	    var textcontent = '<span class="add-link" onclick="HotelPk(this,' + index + ','+ids+')"><i class=" fa fa-plus"  ></i>加入分析</span>';
        $('#getHotel tr').eq(index).children('td').eq(4).html(textcontent)
		$('.hotelvs .cancel'+ids).remove();
    }



function ckbg() {
    $(".hotel-main-top-left tbody tr").click(function () {
        $("body .hotel-main-top-left tbody tr").removeClass("active");
        $(this).addClass("active");
    });
}


    //酒店价格对比弹窗
    function contrast(){
		var objarr = [];
		var hotelId = '';
        $('.hotelvs li').each(function(k,v){
            var dataid = $(v).data('id');
			objarr.push(dataid);
        })
        hotelId = objarr.join(',');
        var level =' '; var keyword = '';
        $.get('/index.php/Admin/Hotel/getHotelRate',{level:level,keyword:keyword,hotelId:hotelId},function (res) {

			if(res.code == 1){
			    var r = res.data;
                html = '';

                 html += "<div class='contrastPop'>" +
                    "<div class=\"search-option\">" +
//					 "<ul>" +
//                    "<li class=\"putList\">" +
//                    "<div class=\"search-name\"><p>酒店级别：</p></div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popbx\"><input type=\"checkbox\" id=\"popbx\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">不限</span></label>" +
//                    "</div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popms\"><input type=\"checkbox\" id=\"popms\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">名宿</span></label>" +
//                    "</div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popyxj\"><input type=\"checkbox\" id=\"popyxj\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">一星级</span></label>" +
//                    "</div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popexj\"><input type=\"checkbox\" id=\"popexj\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">二星级</span></label>" +
//                    "</div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popsanxj\"><input type=\"checkbox\" id=\"popsanxj\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">三星级</span></label>" +
//                    "</div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popsixj\"><input type=\"checkbox\" id=\"popsixj\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">四星级</span></label>" +
//                    "</div>" +
//                    "<div class=\"checkboxDiv\"><label for=\"popwxj\"><input type=\"checkbox\" id=\"popwxj\" class=\"hidden-input\">" +
//                    "<span class=\"\"></span><i class=\"fa fa-check\"></i><span class=\"labelSpan\">五星级</span></label>" +
//                    "</div>" +
//                    "</li>" +
//                    "</ul>" +
//                    "<div class='input-contain clearfix'>" +
//                    "<div class='box-content-top-right'><span class='fx'>房型：</span><input value='不限'>" +
//                    "<ul style='display: none'><li>不限</li><li>双人</li><li>套房</li><li>单人</li></ul><span class='triangle drop-down-span'></span></div>" +
//                    "<form class='clearfix'><input class='search-input'><input type='submit' value='搜索' class='submit-btn'></form>" +
//                    "</div>" +
//                    "</div>" +

                    "<table>" +
                    "<thead>" +
                    "<tr><th>序号</th><th>酒店名称</th><th>销售渠道</th><th>当天价格（元）</th><th>T+1天价格（元）</th><th>T+2天价格（元）</th><th>T+3天价格（元）</th><th>T+4天价格（元）</th><th>T+5天价格（元）</th><th>T+6天价格（元）</th></tr>" +
                    "</thead>";
                $(r.list).each(function (r,val) {
                    html += '<tbody>' +
                        '<tr>' +
                        '<td rowspan="1">'+val.rank+'</td>' +
                        '<td rowspan="1">'+ val.hotel_name +'</td>' +
                        '<td>'+ val.channel_name +'</td>' +
                        '<td>'+val.daily_rate+'</td>';
							for(var i=1; i<7;i++){
								var keys = 'rate_t'+i;
								var t = 't'+i;
								html += '<td>'+val[keys];
								if( val[keys] > val.daily_rate){
                                    html += '<span class="goUp">+';
								}else {
                                    html += '<span class="goDown">';
								}
                                html += val[t]+'%</span></td>';
							}
                    html += '</tr>';
//                        '<td>'+val.rate_t1+'<span class="goUp">+10%</span></td>' +
//                        '<td>'+ val.rate_t2+'<span class="goUp">+10%</span></td>' +
//                        '<td>'+ val.rate_t3+'<span class="goUp">+10%</span></td>' +
//                        '<td>'+ val.rate_t4+'<span class="goUp">+10%</span></td>' +
//                        '<td>'+ val.rate_t5+'<span class="goDown">-10%</span></td>' +
//                        '<td>'+ val.rate_t6+'<span class="goUp">'+ '+ val.t2+'+'</span></td>' +
//                        '</tr>';
                    html += '</tbody>';
                })
                html +=  '</table></div>';

            }else {
			    html = '暂无数据';
			}

            var button ="<input type='button' value='关闭' class='popCancelBtn' />";

            var win = new Window({

                width : 1000, //宽度
                height : 650, //高度
                title : '酒店价格对比', //标题
                content : html, //内容
                isMask : true, //是否遮罩
                buttons : button, //按钮
                isDrag: true, //是否移动
            });
        });


    };

//酒店价格
	function getHotelRate(hotelId,hotelName) {
        ckbg();
		$.get('getHotelRate',{hotelId:hotelId},function (res) {
			if(res.code == 1){
			    var r = res.data;
                $('.hotel-main-bot table tbody').empty();
                $('.hotel-main-bot  .title p').text(hotelName);
                var rateHtml = '';
				$(r.list).each (function(k,v){
					rateHtml = '';
                    rateHtml += '<tr><td>'+v.rank+'</td><td>'+v.channel_name+'</td><td>';
                    rateHtml += v.daily_rate +'</td>';
					for(var i=1; i<7 ;i++){
                        var keys = 'rate_t'+i;
                        var t = 't'+i;
                        rateHtml += '<td>'+v[keys];
                        if( v[keys] > v.daily_rate){
                            rateHtml += '<span class="goUp">+';
                        }else {
                            rateHtml += '<span class="goDown">';
                        }
                        rateHtml += v[t]+'%</span></td>';
					}
                    rateHtml += '</tr>';
                    $('.hotel-main-bot table tbody').append(rateHtml);
				})
			}
        })
    }
</script>

<script src="/Public/static/layui/layui.js"></script>
<script>
    var region = checkbox('region_name');
    var level = checkbox('level');
    //关键字搜索
    var keyword = document.getElementById("keyword").value;
    $.get('/index.php/Admin/Hotel/getHotel',{levelId:level,regionId:region,page:1,keyword:keyword},function (res) {
       var  r = res.data;
        getPage(r.page, r.count);
    });
	function getPage(page,count) {
        layui.use('laypage', function(){
            var laypage = layui.laypage;
            //执行一个laypage实例
            laypage.render({
                elem: 'pageJump' //注意，这里的ID，不用加 # 号
                ,count: count //数据总数，从服务端得到
                ,curr: location.hash.replace('#!page=', '') //获取起始页
                ,hash: 'page' //自定义hash值
                ,first: '首页'
                ,last:'尾页'
                ,layout:['count','prev','page','next','skip']
//                ,layout: ['count', 'prev', 'page', 'next', 'limit', 'refresh', 'skip']
                ,theme:'active'
                ,jump: function(obj, first){
                    //obj包含了当前分页的所有参数，比如：
//                    console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
//                    console.log(obj.limit); //得到每页显示的条数
//                    getHotel(0,0,obj.curr);
                    //分页
                    getHotel(obj.curr);
                    var atext = '<a href="javascript:;" data-page= "'+obj.curr+'" class="active"  > '+obj.curr+'</a>';
//                    $('#pageJump .layui-laypage .layui-laypage-curr').html(atext);
                    $('#pageJump .layui-laypage .layui-laypage-curr').replaceWith(atext);
                    $('.layui-laypage-btn').css("border",'1px solid #0d8efc');
                    $('.layui-laypage-btn').css("border-radius",'20px');
                    $('.layui-laypage-btn').css("color",' #abbbda');
                    $('.layui-laypage-btn').css("font-size",'12px');
                    $('.layui-laypage-btn').css("height:",'15px');
                    $('.layui-laypage-btn').css("margin",'3px');
                    $('.layui-laypage-btn').css("padding",'3px');
//                    $('#pageJump .layui-laypage .layui-laypage-curr').html(atext);
                    //首次不执行
                    if(!first){
                        //do something
                    }
                }

            });
        });
    }


</script>
</html>