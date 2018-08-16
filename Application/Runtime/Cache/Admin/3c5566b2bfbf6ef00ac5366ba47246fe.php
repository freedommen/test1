<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>欢迎您登录<?php echo C('WEB_SITE_TITLE');?>管理后台</title>
        <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/new/common.css" media="all">
        <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/new/sign-in.css" media="all">
        <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
        <script src="/Application/Admin//Public/Admin/js/new/common.js"></script>
 
    </head>
    <body id="login-page">
        <div class="log-title"><h2>扶风旅游大数据系统</h2></div>
        <div class="sign-kuang">
            <form action="<?php echo U('login');?>" method="post">
                <!--<p class="js">
                    <span>选择角色</span>
                    <input type="radio" id="ad" name="type" checked value="common"/><label name="ad" class="checked" for="ad">大众版</label>
                    <input type="radio" id="ios" name="type" value="custom"/><label name="ios" for="ios">店员版</label>
                </p>-->
                <p><input type="text" name="username" placeholder="请输入用户名"/></p>
                <p><input type="password" name="password" placeholder="请输入密码"/></p>
                <p class="yzm"><input type="text" name="verify" placeholder="请输入验证码"/><img class="verifyimg reloadverify" style="cursor:pointer;cursor:hand;" alt="点击切换" title="点击切换" src="<?php echo U('Public/verify');?>"></p>
                <!--<p class="ma">
                    <input type="checkbox" id="wjmm" name="wjmm" value="" checked/>
                    <label name="wjmm" class="checked" for="wjmm">记住密码</label>
                </p>-->
                <p style="margin-top:30px;margin-bottom:5px;">
                    <input style="cursor:pointer;" type="submit" value="登录"/>
                </p>
                <div class="check-tips" style="text-align:center;color:#C30D32;"></div>
            </form>
            <!--[if lt IE 8.1]>
            <p style="margin-top:-50px; font-size:14px; color: red">为了更好的访问体验，
                建议您升级到：<a style='color: #3986d6; font-size:16px;'  href='https://support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads' mce_href='https://support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads' target='_blank'> ie9.0及以上版本</a >
                或使用以下浏览器： <a style='color: #3986d6; font-size:16px;'  href='http://www.firefox.com.cn/download/' mce_href='http://ff.xiaomaiquan.cn' target='_blank'>Firefox</a > / <a style='color: #3986d6; font-size:16px;'  href='https://www.google.cn/chrome/' mce_href='http://ff.xiaomaiquan.cn' target='_blank'>Chrome</a >
            </p >
            <![endif]-->
        </div>
        <footer>技术支持：中智尚联（北京）科技有限公司</footer>
    <script type="text/javascript">

        //表单提交
        $(document)
            .ajaxStart(function(){
                $("button:submit").addClass("log-in").attr("disabled", true);
            })
            .ajaxStop(function(){
                $("button:submit").removeClass("log-in").attr("disabled", false);
            });

        $("form").submit(function(){
            var self = $(this);
            $.post(self.attr("action"), self.serialize(), success, "json");
            return false;

            function success(data){
                if(data.status){
                    window.location.href = data.url;
                } else {
                    self.find(".check-tips").text(data.info);
                    //刷新验证码
                    $(".reloadverify").click();
                }
            }
        });

        $(function(){
            //初始化选中用户名输入框
            $("input[name=username]").focus();
            //刷新验证码
            var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });

            //placeholder兼容性
            //如果支持 
            function isPlaceholer(){
                var input = document.createElement('input');
                return "placeholder" in input;
            }
                //如果不支持
            if(!isPlaceholer()){
                $(".placeholder_copy").css({
                    display:'block'
                })
                $("#itemBox input").keydown(function(){
                    $(this).parents(".item").next(".placeholder_copy").css({
                        display:'none'
                    })                    
                })
                $("#itemBox input").blur(function(){
                    if($(this).val()==""){
                        $(this).parents(".item").next(".placeholder_copy").css({
                            display:'block'
                        })                      
                    }
                })
            }
        });
    </script>
</body>
</html>