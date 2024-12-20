<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"E:\qipai\html5FKQPASRC/application/admin\view\login\index.html";i:1554999046;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="ThemeBucket">
<link rel="shortcut icon" href="#" type="image/png">
<title>管理员登录</title>
<link href="__STATIC__/css/style.css" rel="stylesheet">
<link href="__STATIC__/css/style-responsive.css" rel="stylesheet">

<!--<link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">
<div class="container">
  <form onSubmit="return dologin(this);" class="form-signin" style="position:relative;" action="<?php echo url('dologin'); ?>">
    <div class="form-signin-heading text-center">
      <h1 class="sign-title">管理员登录</h1>
      <img src="__STATIC__/images/login-logo.png" alt=""/> </div>
    <div id="errormsgbox" class="alert hidden alert-block alert-danger fade in" style="position:absolute; width:100%; z-index:2; top:0;"> <strong>错误：</strong> <span id="errormsg"></span> </div>
    <div class="login-wrap">
      <input type="text" class="form-control" placeholder="用户名" autofocus name="account">
      <input type="password" class="form-control" placeholder="密码" name="admin_pass">
      <div class="row">
        <div class="col-sm-5">
          <input type="text" maxlength="4" class="form-control" placeholder="验证码" name="verify">
        </div>
        <div class="col-sm-7"><img style="border:1px solid #ccc; border-radius:4px;" width="100%" src="<?php echo url('verify'); ?>" onClick="this.src = '<?php echo url('verify', array('rand' => 'timer')); ?>'.replace('timer',new Date().getTime());"></div>
      </div>
      <button class="btn btn-lg btn-login btn-block" type="submit" name="submit"> 登录 </button>
      <label class="checkbox">
        <input type="checkbox" value="remember-me">
        记住密码 <span class="pull-right"> <a data-toggle="modal" href="#myModal">忘记密码?</a> </span> </label>
    </div>
  </form>
</div>
<script src="__STATIC__/js/jquery-1.10.2.min.js"></script> 
<script src="__STATIC__/js/bootstrap.min.js"></script> 
<script src="__STATIC__/js/modernizr.min.js"></script> 
<script>
    function dologin(form){
		
		var data = $(form).serialize();
		$.ajax({
			url:$(form).attr('action'),
			data:data,
			type:'POST',
			dataType:"json",
			success: function(ret){
				if(ret.code == 1){
					window.location.href = '<?php echo url('Member/index'); ?>';
				}else{
					$('#errormsg').html(ret.msg);
					$('#errormsgbox').removeClass('hidden');
					setTimeout(function(){
						$('#errormsgbox').addClass('hidden');
					}, 1000);
					$(form).find('img').click();
				}
			}
		});
		return false;
	}
</script>
</body>
</html>
