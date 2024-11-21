<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"/Users/d/Desktop/php/niuniu/application/game/view/result/index.html";i:1501172184;s:76:"/Users/d/Desktop/php/niuniu/application/game/view/douniuplaywjy/ranking.html";i:1501074402;}*/ ?>
<!DOCTYPE>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
    <meta name="description" content="不超过150个字符"/>
    <meta name="keywords" content="">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="index,follow"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="HandheldFriendly" content="true">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- <link rel="stylesheet" type="text/css" href="__STATIC__/game/css/play.css"> -->
    <style>
        *{margin:0;padding: 0;}
        body{background: #140C09;}
        body>img{position: absolute;top:0;left: 0;width: 100%;z-index: -1;}
        .content{width: 74%;margin-left: 13%;margin-top: 30%;text-align: center;}
        .times{display: inline-block;background:#5B5211; border-radius: 0.6rem;height: 1.2rem;line-height:1.2rem;font-size: 0.6rem;color:#D6BC71;padding: 0 0.3rem;border:1px solid #ccc;}
        ul{width: 90%;margin-left: 5%;margin-top: 1.2rem;}
        ul li{background:#1C1606;color: white;list-style: none;width: 96%;margin-left: 2%;margin-top: 2%;height: 2.2rem;line-height: 2.2rem;font-size: 0.8rem;opacity: 0.9;}
        ul li span:first-child{float: left;margin-left: 2rem;max-width: 5rem;overflow: hidden; text-overflow:ellipsis;white-space:nowrap;}
        ul li span:last-child{float: right;margin-right: 2rem;}
        .add{color:#F5D203!important;}
        .win{background: url(__STATIC__/game/img/win.png) left top no-repeat;background-size: 12%;}
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body onclick="mp3play('bau');">
<img src="__STATIC__/game/img/list.png"><div class="content">
    <p class="times">房间号：<span style="margin-right:0.6rem;"><?php echo $room['room_num']; ?></span><span><?php echo date('Y-m-d H:i',$room['taipaitime']); ?></span></p>
    <ul>



<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="<?php if($vo['money'] > '0'): ?>add<?php endif; if($key == '0'): ?> win<?php endif; ?>"><span><?php echo $vo['nickname']; ?></span><span><?php if($vo['money'] > '0'): ?>+<?php else: ?>-<?php endif; ?><?php echo abs($vo['money']); ?></span></li>

<?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
</div>






<script src="__STATIC__/game/js/jquery-1.12.1.js"></script>
<audio id="bau" autoplay="autoplay" loop="loop" src="__STATIC__/game/video/background.mp3"></audio>

<script>
    function mp3play(id){
        document.getElementById(id).play();
    }




</script>
</body>
</html>
