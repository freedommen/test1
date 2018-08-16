<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="使用 thinkPHP 和 bootstrap 管理系统">
<meta name="author" content="">
<title><?php echo ($meta_title); ?> | 中智尚联</title>
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/scenic/common.css" /> 
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/scenic/saim.css" />
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/map/ghmap_3d.css" />
<script type="text/javascript" src="/Application/Admin//Public/Admin/css/map/ghmap_3d.min.pc-1.0.js"></script>
<script type="text/javascript" src="/Application/Admin//Public/Admin/css/map/map.js"></script>
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/scenic/font-awesome-4.7.0/css/font-awesome.min.css" />

<script type="text/javascript" src="/Application/Admin//Public/Admin/js/new/jquery.js"></script>
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/new/common.js"></script>

<!-- 弹出提示框，ajax用 css start-->
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/sb/messenger.css" />
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/sb/messenger-theme-block.css" />
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/sb/alert_confirm_prompt.css" /> 
<!-- 弹出提示框，ajax用 css end-->




<?php echo hook('pageHeader');?>
</head>
<body>
<header>
	<nav class="clearfix">
<div class="logo">
	<h2 class="color-1 logo-text">景区综合管理系统</h2>
	<span>Web</span>
</div>
<ul class="nav-list">
    <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><span><?php echo ($menu["title"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<div class="account">
	<span class="user-name">欢迎您，<?php echo get_username();?></span>
	<a class="account-quit" href="<?php echo U('Public/logout');?>" title="退出">
		<span class="fa fa-sign-out"></span>
	</a>
</div>
<div class="clear clearfix"></div>
</nav>
</header>
<section class="content-box">
	<div class="container clearfix"> 
			
<aside>
<ul class="main-nav">
<?php if(is_array($__MENU__["child"])): $k = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($k % 2 );++$k; if(!empty($sub_menu)): ?><li class="main-nav-item <?php if($sub_menu['class'] == 'on'): ?>bjxs<?php endif; ?>">
			<a href="javascript:;"><img src='/Application/Admin//Public/Admin/images/icon/<?php echo ($k-1); ?>.png'><?php echo ($sub_menu['name']); ?></a>
		</li>
		<div class="main-nav-list" <?php if($sub_menu['class'] == 'on'): ?>style="display:block"<?php endif; ?> >
			<?php if(is_array($sub_menu["data"])): $i = 0; $__LIST__ = $sub_menu["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if($menu["hide"] == 0): ?><li <?php if($menu['class'] == 'on'): ?>class="active"<?php endif; ?>><a href="<?php echo (u($menu["url"])); ?>">&nbsp;&nbsp;<?php echo ($menu["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</ul>
</aside>

		<article>
<section class="jqgl">
  
    <table class="device-list">
        <thead>
            <tr>                    
                <!--<th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>-->
                <th class="">UID</th>
                <th class="">昵称</th>
                <th class="">登录次数</th>
                <th class="">最后登录时间</th>
                <th class="">最后登录IP</th>
                <th class="">状态</th>
                <th class="">操作</th>        
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <!--<td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>-->
                <td><?php echo ($vo["id"]); ?> </td>
                <td><?php echo ($vo["nickname"]); ?></td>
                <td><?php echo ($vo["login"]); ?></td>
                <td><span><?php echo (time_format($vo["last_login_time"])); ?></span></td>
                <td><span><?php echo long2ip($vo['last_login_ip']);?></span></td>
                <td><?php echo ($vo["status_text"]); ?></td>
                <td>
                    <a href="<?php echo U('User/updatePassword?uid='.$vo['id']);?>" class="authorize">修改密码</a>
                    <a href="<?php echo U('User/updateNickname?uid='.$vo['id']);?>" class="authorize">修改昵称</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <?php if(($_page) != ""): ?><div class="page">
        <?php echo ((isset($_page) && ($_page !== ""))?($_page):''); ?>
    </div><?php endif; ?>
 
</section>
</article>
	
	</div>
</section>
  <!--  页脚，版权信息   ================================================== -->     

  <!--  /页脚，版权信息   ================================================== -->  

  <div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
  </div>

<!-- Core Scripts - Include with every page -->
<!--<script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/bootstrap.min.js"></script> 
<!-- Page-Level Plugin Scripts - 侧边栏 -->
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/plugins/metisMenu/jquery.metisMenu.js"></script>  
<!-- 弹出提示框，ajax用 js -->
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/plugins/messenger/messenger.min.js"></script> 
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/alert_confirm_prompt.js"></script> 
<!-- Page-Level Plugin Scripts - Tables 表格-->
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/plugins/dataTables/jquery.dataTables.js"></script> 
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/plugins/dataTables/dataTables.bootstrap.js"></script>  

<!-- 页面通用的  js -->
<!--  think JS   ================================================== -->  
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/think.js"></script>
<script type="text/javascript" src="/Application/Admin//Public/Admin/js/sb/common.js"></script> 
<!--   

-->

<!-- 用于加载js代码 --> 
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
</body>
</html>