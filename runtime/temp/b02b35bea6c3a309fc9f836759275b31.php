<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:47:"D:\www/application/admin\view\redbag\index.html";i:1500523425;s:45:"D:\www/application/admin\view\public\top.html";i:1499225307;s:46:"D:\www/application/admin\view\public\left.html";i:1500521691;s:48:"D:\www/application/admin\view\public\header.html";i:1499837461;s:48:"D:\www/application/admin\view\public\bottom.html";i:1499225307;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>AdminX</title>

  <!--icheck-->
  <link href="__STATIC__/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="__STATIC__/js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="__STATIC__/js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="__STATIC__/js/iCheck/skins/square/blue.css" rel="stylesheet">
  <link href="__STATIC__/js/iCheck/skins/square/green.css" rel="stylesheet">

  <!--dashboard calendar-->
  <link href="__STATIC__/css/clndr.css" rel="stylesheet">


  <!--common-->
  <link href="__STATIC__/css/style.css" rel="stylesheet">
  <link href="__STATIC__/css/style-responsive.css" rel="stylesheet">

  <link href="__STATIC__/js/dropzone/css/dropzone.css" rel="stylesheet"/>
 

  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="__STATIC__/js/html5shiv.js"></script>
  <script src="__STATIC__/js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    
 <!-- left side start-->
    <div class="left-side sticky-left-side" id="leftmenu">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="__STATIC__/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="__STATIC__/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="__STATIC__/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">John Doe</a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <!--<li class="menu-list"><a href="index.html"><i class="fa fa-bookmark"></i> <span>权限管理</span></a>-->
                    <!--<ul class="sub-menu-list">-->
                        <!--<li><a href="<?php echo url('User/index'); ?>">用户管理</a></li>-->
                        <!--<li><a href="<?php echo url('Node/index'); ?>">节点管理</a></li>-->
                        <!--<li><a href="<?php echo url('Role/index'); ?>">角色管理</a></li>-->
                    <!--</ul>-->
                <!--</li>-->

                <!--<li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>订单管理</span></a>-->
                    <!--<ul class="sub-menu-list">-->
                        <!--<li><a href="<?php echo url('Order/index'); ?>">全部订单</a></li>-->
                        <!--<li><a href="<?php echo url('Delivery/index'); ?>"> 发货管理</a></li>-->
                        <!--<li><a href="<?php echo url('Service/index'); ?>"> 售后管理</a></li>-->
                    <!--</ul>-->
                <!--</li>-->
                <!--<li class="menu-list"><a href=""><i class="fa fa-gift"></i> <span>商品管理</span></a>-->
                    <!--<ul class="sub-menu-list">-->
                        <!--<li><a href="<?php echo url('Product/index'); ?>">全部商品</a></li>-->
                        <!--<li><a href="<?php echo url('Category/index'); ?>">商品分类</a></li>-->
                        <!--<li><a href="<?php echo url('Comment/index'); ?>"> 商品评论</a></li>-->
                    <!--</ul>-->
                <!--</li>-->
                <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>会员管理</span></a>
                    <ul class="sub-menu-list">
                        <!--<li> <a href="<?php echo url('Level/index'); ?>"> 会员等级</a></li>-->
                        <li><a href="<?php echo url('Member/index'); ?>"> 全部会员</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>红包管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo url('Redbag/index'); ?>"> 红包管理</a></li>
                        <!--<li><a href="<?php echo url('Article/index'); ?>"> 全部文章</a></li>-->
                    </ul>
                </li>

                <!--<li class="menu-list"><a href=""><i class="fa fa-cogs"></i> <span>系统设置</span></a>-->
                    <!--<ul class="sub-menu-list">-->
                        <!--<li><a href="<?php echo url('Config/index'); ?>"> 基本设置</a></li>-->
                        <!--<li><a href="<?php echo url('Pay/index'); ?>"> 支付接口</a></li>-->
                        <!--<li><a href="<?php echo url('Shipping/index'); ?>"> 配送方式</a></li>-->
                        <!--<li><a href="<?php echo url('Nav/index'); ?>"> 导航管理</a></li>-->
                        <!--<li><a href="<?php echo url('Ad/index'); ?>"> 广告管理</a></li>-->
                        <!--<li><a href="<?php echo url('Login/logout'); ?>"> 退出登录</a></li>-->
                    </ul>
                </li>       
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
       <!-- header section start-->
        <div class="header-section">

          
            <div class="menu-right">
                <ul class="notification-menu">
                   
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="__STATIC__/images/photos/user-avatar.png" alt="" />
                            <?php echo $userinfo['nickname']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="<?php echo url('Login/logout'); ?>"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->

        <!-- header section end-->
       <!--body wrapper start-->
    <div class="wrapper">
      <div class="panel">
      
      <header class="panel-heading">
          全部红包

     </header>
        <div class="panel-body">
        <table class="table table-hover table-bordered">
        <tbody>
          <thead>
            <th>ID</th>
            <th>创建id</th>
            <th>创建人昵称</th>
            <th>创建时间</th>
            <th>领取id</th>
            <th>领取时间</th>
            <th>房卡数量</th>
            <th>领取状态</th>
          </thead>
          <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <tr>
            <td><?php echo $vo['id']; ?></td>
            <td><?php echo $vo['create_id']; ?></td>
            <td><?php echo getnickname($vo['create_id']); ?></td>
            <td><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></td>
            <td><?php echo $vo['receive_id']; ?></td>
            <td><?php echo date('Y-m-d H:i:s',$vo['receive_time']); ?></td>
              <td><?php echo $vo['cards_num']; ?></td>
              <td><?php if($vo['status'] == '0'): ?>未领取<?php endif; if($vo['status'] == '1'): ?>领取<?php endif; if($vo['status'] == '-1'): ?>退回<?php endif; ?>

              </td>
            <!--<td><a onClick="return confirm('您确定要删除吗？');" href="<?php echo url('delete', array('id' => $vo['id'])); ?>" class="btn btn-danger btn-sm">删除</a> <a href="<?php echo url('modify', array('id' => $vo['id'])); ?>" class="btn btn-success btn-sm">修改</a></td>-->
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <tr>
            <td colspan="5" align="center"><?php echo $pages; ?></td>
          </tr>
        </tbody>
      </table>
     </div>
    </div>
</div>
        <!--body wrapper end-->
  <!--footer section start-->
        
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="__STATIC__/js/jquery-1.10.2.min.js"></script>
<script src="__STATIC__/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="__STATIC__/js/jquery-migrate-1.2.1.min.js"></script>
<script src="__STATIC__/js/bootstrap.min.js"></script>
<script src="__STATIC__/js/modernizr.min.js"></script>
<script src="__STATIC__/js/jquery.nicescroll.js"></script>


<!--icheck -->
<script src="__STATIC__/js/iCheck/jquery.icheck.js"></script>
<script src="__STATIC__/js/icheck-init.js"></script>

<script src="__STATIC__/js/dropzone/dropzone.js"></script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/lang/zh-cn/zh-cn.js"></script>

<!--common scripts for all pages-->
<script src="__STATIC__/js/scripts.js"></script>
<script src="__STATIC__/js/setajax.js"></script>
<script>
$('#leftmenu .sub-menu-list a').each(function(index, element) {
            if(window.location.href.indexOf($(this).attr('href')) >= 0){
				$(this).parent('li').addClass('active');
				$(this).parent('li').parent('ul').parent('li').addClass('nav-active');
			}
        });
$('form').ajaxsubmit();
</script>
</body>
</html>

