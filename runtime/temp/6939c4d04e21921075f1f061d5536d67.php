<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:64:"E:\qipai\html5FKQPASRC/application/admin\view\member\modify.html";i:1554999046;s:61:"E:\qipai\html5FKQPASRC/application/admin\view\public\top.html";i:1554999046;s:62:"E:\qipai\html5FKQPASRC/application/admin\view\public\left.html";i:1554999046;s:64:"E:\qipai\html5FKQPASRC/application/admin\view\public\header.html";i:1554999046;s:64:"E:\qipai\html5FKQPASRC/application/admin\view\public\bottom.html";i:1554999046;}*/ ?>
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
   <section class="panel">
      <header class="panel-heading">
          修改会员信息
        <span class="pull-right">
           <a href="<?php echo url('index'); ?>" class="btn btn-success btn-sm">
           <i class="fa fa-reply"></i> 返回会员列表</a>
        </span>                            
      </header>
                  <div class="panel-body">
                      <form action="<?php echo url('update'); ?>" class="form-horizontal" method="post">
<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                          <div class="form-group">
                              <label class="control-label col-md-3">昵称</label>
                              <div class="col-md-4 col-xs-11">
                                  <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="<?php echo $info['nickname']; ?>" name="nickname">
                                  
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="control-label col-md-3">头像</label>
                              <div class="col-md-4 col-xs-11">
                                 <!--<a href="##" class="btn btn-success btn-sm" id="dropzphoto">选择文件上传</a>
<div class="dropzonebox dropzoneboxphoto">
<?php if(strpos($info['photo'],",")){
			$list5ae0c1c8a5260bc7b6648f6fbd115c35 = explode(",", $info['photo']);
		}else{
			$list5ae0c1c8a5260bc7b6648f6fbd115c35[0] = $info['photo'];
		}

		if($list5ae0c1c8a5260bc7b6648f6fbd115c35[0] == "" && count($list5ae0c1c8a5260bc7b6648f6fbd115c35) == 1){
			$list5ae0c1c8a5260bc7b6648f6fbd115c35 = array();
		}

		foreach($list5ae0c1c8a5260bc7b6648f6fbd115c35 as $v){
			?>
			<div style="position:relative;" class="preview processing image-preview success">
  <div class="details">
   <div class="filename"><span>图片</span></div>
  <div class="size"></div><img alt="图片" src="<?php echo $v;?>"></div>
  <div class="progress"><span class="upload" style="width: 100%;"></span></div>
  <div class="success-mark"><span>✔</span></div>
  <div class="error-mark"><span>✘</span></div>
  <div class="error-message"><span></span></div>
<a href="##" class="close">x</a><input type="hidden" name="photo" value="<?php echo $v;?>"></div>
		<?php }?>

</div>
         
		 <script>
		 
		 function photoaddLoadEventtagUpload(func) { 
			var oldonload = window.onload; 
				if (typeof window.onload != 'function') { 
				    window.onload = func;
				} else { 
				window.onload = function() { 
				    oldonload();
				func(); 
				} 
			} 
		}
		 photoaddLoadEventtagUpload(function(){
			 
			 
			  $("#dropzphoto").dropzone({
        url: "<?php echo url('Index/upload'); ?>", //必须填写
        method:"post",  //也可用put
        paramName:"upfile", //默认为file
        maxFiles:1,//一次性上传的文件数量上限
        maxFilesize: 20, //MB
        acceptedFiles: ".jpg,.gif,.png", //上传的类型
        previewsContainer:".dropzoneboxphoto", //显示的容器
        parallelUploads: 3,
        dictMaxFilesExceeded: "您最多只能上传1个文件！",
        dictResponseError: '文件上传失败!',
        dictInvalidFileType: "你不能上传该类型文件,文件类型只能是*.jpg,*.gif,*.png。",
        dictFallbackMessage:"浏览器不受支持",
        dictFileTooBig:"文件过大上传文件最大支持.",
        previewTemplate: '<div style="position:relative;" class=\"preview file-preview\">\n  <div class=\"details\">\n   <div class=\"filename\"><span></span></div>\n  </div>\n  <div class=\"progress\"><span class=\"upload\"></span></div>\n  <div class=\"success-mark\"><span>✔</span></div>\n  <div class=\"error-mark\"><span>✘</span></div>\n  <div class=\"error-message\"><span></span></div>\n<a href="##" class="close">x</a><input type="hidden" name="photo"></div>',//设置显示模板
		success(file,dataUrl){
			file.previewTemplate.addClass("success");
			file.previewTemplate.find('input').val(dataUrl);
			file.previewTemplate.find('.close').click(function(){
				if(!confirm("确定要移除吗？")){
					return false;
				}
				$(this).parent().remove();
			});
		},
        init:function(){
            
            }});
			 
			 
			 $(".dropzoneboxphoto").find('.close').click(function(){
				if(!confirm("确定要移除吗？")){
					return false;
				}
				$(this).parent().remove();
			});
		});
		 
   

</script>
		 
		 
		 

-->
                                  <img src = "<?php echo $info['photo']; ?>" style="height:100px;weight:100px;">
                              </div>
                          </div>
                          <div class="form-group">
                                <div class="form-group">
                              <label class="control-label col-md-3">原先房卡数</label>&nbsp;<b style="font:14px;color:red;"><?php echo $info['cards']; ?></b>

                              </div>
                          </div>
                           <div class="form-group">
                              <label class="control-label col-md-3">修改房卡数</label>
                              <div class="col-md-4 col-xs-11">
                                  <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="" name="cards">

                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3">修改得胜率</label>
                              <div class="col-md-4 col-xs-11">
                                  <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="" name="rate" placeholder="0">

                              </div>
                          </div>
                              <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-4 col-xs-11">
                                    <button class="btn btn-success" type="submit"> 保存</button>
                              </div>
                          </div>

                      </form>
                  </div>
              </section>
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


