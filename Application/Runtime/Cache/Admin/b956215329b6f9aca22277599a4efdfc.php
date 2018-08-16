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
  
    <div class="main-title">
        <h2><?php if(isset($data)): ?>[ <?php echo ($data["title"]); ?> ] 子<?php endif; ?>菜单管理 </h2>
    </div>
    <div class="device-condition">
        <input type="button" url="<?php echo U('add',array('pid'=>I('get.pid',0)));?>" id="add-menu" class="btn btn-default btn-add " value="新增"/>
        <input type="button" url="<?php echo U('del');?>" class="btn btn-default ajax-post confirm" target-form="ids" value="删除"/>
        <!--<input type="button" url="<?php echo U('import',array('pid'=>I('get.pid',0)));?>" class="btn btn-default btn-add" id="import" value="导入"/>-->
        <input type="button" url="<?php echo U('sort',array('pid'=>I('get.pid',0)),'');?>" class="btn btn-default list_sort" value="排序"/> 
    </div>
    <table class="device-list">
        <thead>
            <tr>
            <th class="row-selected">
                <input class="checkbox check-all" type="checkbox">
            </th> 
                <th>ID</th>
                <th>名称</th>
                <th>上级菜单</th>
                <th>分组</th>
                <th>URL</th>
                <th>排序</th>
                <th>仅开发者模式显示</th>
                <th>隐藏</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><tr>
                <td><input class="ids row-selected" type="checkbox" name="id[]" value="<?php echo ($menu["id"]); ?>"></td>
                <td><?php echo ($menu["id"]); ?></td>
                <td>
                    <a href="<?php echo U('index?pid='.$menu['id']);?>"><?php echo ($menu["title"]); ?></a>
                </td>
                <td><?php echo ((isset($menu["up_title"]) && ($menu["up_title"] !== ""))?($menu["up_title"]):'无'); ?></td>
                <td><?php echo ($menu["group"]); ?></td>
                <td><?php echo ($menu["url"]); ?></td>
                <td><?php echo ($menu["sort"]); ?></td>
                <td>
                    <a href="<?php echo U('toogleDev',array('id'=>$menu['id'],'value'=>abs($menu['is_dev']-1)));?>" class="ajax-get confirm">
                    <?php echo ($menu["is_dev_text"]); ?>
                    </a>
                </td>
                <td>
                    <a href="<?php echo U('toogleHide',array('id'=>$menu['id'],'value'=>abs($menu['hide']-1)));?>" class="ajax-get confirm">
                    <?php echo ($menu["hide_text"]); ?>
                    </a>
                </td>
                <td>
                    <a title="编辑" href="<?php echo U('edit?id='.$menu['id']);?>">编辑</a>
                    <a class="confirm ajax-get" title="删除" href="<?php echo U('del?id='.$menu['id']);?>">删除</a>
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


<script type="text/javascript">
$(function() {
    //点击排序
    $('.list_sort').click(function(){
        var url = $(this).attr('url');
        var ids = $('.ids:checked');
        var param = '';
        if(ids.length > 0){
            var str = new Array();
            ids.each(function(){
                str.push($(this).val());
            });
            param = str.join(',');
        }

        if(url != undefined && url != ''){
            window.location.href = url + '/ids/' + param;
        }
    });
});
</script>
 
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
</body>
</html>