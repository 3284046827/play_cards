<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\qipai\html5FKQPASRC/application/game\view\login\index.html";i:1554999046;}*/ ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>用户登录</title>
    <link rel="stylesheet" type="text/css" href="__CSS__/app.min.1.css"/>
    <link rel="stylesheet" href="__CSS__/font-awesome.min.css" />
    <link rel="stylesheet" href="__CSS__/animate.min.css" />
    <link rel="stylesheet" href="__CSS__/weixiaoqu.css" />
    <style>
        .container { max-width: 1170px; height: 100%; text-align: left }
        a.logo { background-size: cover;  display: inline-block; width: 100%; line-height: 50px; font-size: 14px; color: #0fb478; height: 50px; position: relative }
        nav { float: right }
        nav ul li { float: left; margin: 10px; list-style: none }
        nav ul li a { display: block; padding: 5px 15px; color: #666; transition: all .6s }
        nav ul li a:hover { color: #49FAB9 }
        @media (max-width:665px) {
            .login-header nav { display: none }
            .container { text-align: center }
        }
        @media (max-width:400px) {
            .lc-block:not(.lcb-alt) { padding: 35px 10px }
        }
    </style>
</head>
<body class="login-content">
<div class="login-header">
    <div class="container"><a href="<?php echo url('user/index/login'); ?>" class="logo">用户登录</a>
    </div>
</div>
<div class="lc-block toggled" id="l-login">
    <form method="post" class="form">
        <div class="input-group msg-error m-b-10">
            <div class=""><i class="fa fa-minus-circle"></i><span></span></div>
        </div>
        <div class="input-group m-b-20"><span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <div class="fg-line">
                <input type="text" name="username" class="form-control user" value="" placeholder="手机号">
            </div>
        </div>
        <div class="input-group m-b-20"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <div class="fg-line">
                <input type="password"name="password" class="form-control" value="" placeholder="设置密码">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="m-t-20">
            <button type="button" class="btn btn-block btn-lg btn-primary tijiao" ><!--  onclick='javascript:window.location.href="/index/mail_ver.html";'-->
                立即登录 </button>
        </div>
    </form>
</div>
<div class="v-copy"></div>
<script src="__JS__/jquery.min.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script src="__JS__/waves.min.js"></script>
<!--<script src="js/sweet-alert.min.js"></script>-->
<script type="text/javascript">			(function(){
    Waves.attach('.btn:not(.btn-icon):not(.btn-float)');
    Waves.attach('.btn-icon, .btn-float', ['waves-circle', 'waves-float']);
    Waves.init();
})();

$(function(){
    if($('.fg-line')[0]) {
        $('body').on('focus', '.form-control', function(){
            $(this).closest('.fg-line').addClass('fg-toggled');
        })

        $('body').on('blur', '.form-control', function(){
            var p = $(this).closest('.form-group');
            var i = p.find('.form-control').val();

            if (p.hasClass('fg-float')) {
                if (i.length == 0) {
                    $(this).closest('.fg-line').removeClass('fg-toggled');
                }
            }
            else {
                $(this).closest('.fg-line').removeClass('fg-toggled');
            }
        });
    }

    if($('.fg-float')[0]) {
        $('.fg-float .form-control').each(function(){
            var i = $(this).val();

            if (!i.length == 0) {
                $(this).closest('.fg-line').addClass('fg-toggled');
            }

        });
    }


    $('.tijiao').click(function(){
        $(this).attr('disabled',true);
        $('.msg-error div').show();
        $('.msg-error span').html('提交中...');
        var url="<?php echo url('game/login/dologin'); ?>";

        $.post(url,$('.form').serialize(),function(msg){
            if(msg.code == 0){
                $('.tijiao').attr('disabled',false);
                $('.msg-error div').show();
                $('.msg-error span').html(msg.msg);
                setTimeout(function(){$('.msg-error div').hide();},2000);
            }
            if(msg.code == 1){
                $('.msg-error div').show().css({'color':'#0FB478','border':'1px solid #0FB478','background':'#fff'}).find('i').removeClass('fa-minus-circle').addClass('fa-check');
                $('.msg-error span').html('登录成功，等待跳转...');
                setTimeout(function(){window.location.href=msg.url},2000);
            }

        });
    });


})
</script>
</body>
</html>
