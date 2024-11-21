<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/Users/d/Desktop/php/niuniu/application/game/view/douniuplaywjy/index.html";i:1503650748;s:72:"/Users/d/Desktop/php/niuniu/application/game/view/douniuplaywjy/mp3.html";i:1502376220;s:72:"/Users/d/Desktop/php/niuniu/application/game/view/douniuplaywjy/img.html";i:1500606572;}*/ ?>
<!DOCTYPE>
<html>
<head>
    <title>牛牛房间<?php echo $room['room_num']; ?>【<?php if($gamerule['gametype'] == '1'): ?>牛牛上庄<?php endif; if($gamerule['gametype'] == '2'): ?>固定庄家<?php endif; if($gamerule['gametype'] == '3'): ?>自由抢庄<?php endif; if($gamerule['gametype'] == '4'): ?>明牌抢庄<?php endif; if($gamerule['gametype'] == '5'): ?>通比牛牛<?php endif; ?>】</title>
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
    <link rel="stylesheet" type="text/css" href="__STATIC__/game/css/play.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/game/css/opentip.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->
</head>
<body>

<style>
    .photo{display: none;}
    .msgshow{
        position: fixed;
        bottom:0;
        left:0;
        right:0;
        background: rgba(0,0,0,0.8);
        color: #fff;
        padding:5px;
        font-size: 12px;
    }

    .cardsbox{position: relative; display: none;}
    .cards .poker{width:12%; display: inline-block;}
    .cards .poker img{width:100%; vertical-align: bottom;}
    .cardsbox .poker {width: 40px; display:inline-block;}
    .cardsbox .poker img{width:100%;}
    .cardsbox .box1 {position: absolute; left: 0px; z-index: 1;}
    .cardsbox .box2 {position: absolute; left: 10px; z-index: 1;}
    .cardsbox .box3 {position: absolute; left: 20px; z-index: 1;}
    .cardsbox .box4 {position: absolute; left: 30px; z-index: 1;}
    .cardsbox .box5 {position: absolute; left: 40px; z-index: 1;}
    .niuname{position: absolute; display: none; z-index: 5; top:15px; font-size: 14px; width:100%; text-align: center; color:#f00;}
    .niuname img{width: 80px;}
    .last-time{display: none;}
    .tanpai{display:none;}
    .cards{display: none;}
    .photo{position: relative;}
    .readyimg{width:50px !important; height: auto !important; position: absolute; display: none;}
    .xiazhubox{position: absolute;
        top: -20px;
        width: 80px;}
    .xiazhubox img{width:20px; display:none;}
    .xiazhubox img.bankerimg{width:35px;}
    .zhuangimg{width: 20px;
        position: absolute;
        left: 0;
        top: 0; display: none;}
    .gameret{color: #F6C312;
        text-shadow: -2px -2px 1px #734E10;
        font-size: 16px;
        font-weight: bold; display: none; position: absolute;}



    .tanpai{position: static; margin-left:0; width:auto !important; margin-bottom: 5px;}
    /* 弹窗显示排名的样式 */
    .window{position: absolute; z-index: 10;
        top:0; bottom: 0;
        left:0; right:0; background: #fff; display: none;background: #140C09;}


    .window .content{width: 74%;margin-left: 13%;margin-top: 30%;text-align: center;}
    .window .times{display: inline-block;background:#5B5211; border-radius: 0.6rem;height: 1.2rem;line-height:1.2rem;font-size: 0.6rem;color:#D6BC71;padding: 0 0.3rem;border:1px solid #ccc;}
    .window ul{width: 90%;margin-left: 5%;margin-top: 1.2rem;}
    .window ul li{background:#1C1606;color: white;list-style: none;width: 96%;margin-left: 2%;margin-top: 2%;height: 2.2rem;line-height: 2.2rem;font-size: 0.8rem;opacity: 0.9;}
    .window ul li span:first-child{float: left;margin-left: 2rem;max-width: 5rem;overflow: hidden; text-overflow:ellipsis;white-space:nowrap;}
    .window ul li span:last-child{float: right;margin-right: 2rem;}
    .window .add{color:#F5D203!important;}
    .window>img{position: absolute;top:0;left: 0;width: 100%;z-index: -1;}
    .window .win{background: url(__STATIC__/game/img/win.png) left top no-repeat;background-size: 12%;}
</style>

<div class="window">
    <iframe src="" frameborder="0" scrolling="no" style="position: fixed; width:100%; top: 0; left: 0; right: 0; bottom: 0;"></iframe>
</div>


<!-- 游戏准备按钮 -->
<img id="gameready" onclick="gameready1(1);" src="__STATIC__/game/img/init.png" style="position:absolute;top: 50%; left: 50%; z-index: 3; margin-left:-50px; width: 100px; <?php if($memberinfo['gamestatus'] == '1'): ?>display:none;<?php endif; ?>">









<div class="overlay"></div>
<div class="rules" style="display: none;">
    <img src="__STATIC__/game/img/closes.png">

    <div class="cons">
        <h2>游戏规则</h2>
        <ul>

            <p>创建房间,游戏未进行,不消耗房卡</p>
            <li>模式:<span>
                <?php if($gamerule['gametype'] == '1'): ?>牛牛上庄<?php endif; if($gamerule['gametype'] == '2'): ?>固定庄家<?php endif; if($gamerule['gametype'] == '3'): ?>自由抢庄<?php endif; if($gamerule['gametype'] == '4'): ?>明牌抢庄<?php endif; if($gamerule['gametype'] == '5'): ?>通比牛牛<?php endif; ?>
            </span></li>
            <li>底分:<span><?php echo $gamerule['score']; ?>分</span></li>

            <li>规则:<span>
                <?php if($gamerule['rule'] == '1'): ?>
                牛牛x3 牛九x2 牛八x2
                <?php endif; if($gamerule['rule'] == '2'): ?>
                牛牛x4 牛九x3 牛八x2 牛七x2
                <?php endif; ?>
            </span></li>

            <li>牌型:<span>
                <?php if(!(empty($gamerule['types'][1]) || (($gamerule['types'][1] instanceof \think\Collection || $gamerule['types'][1] instanceof \think\Paginator ) && $gamerule['types'][1]->isEmpty()))): ?>
                五花牛(5倍)
                <?php endif; if(!(empty($gamerule['types'][2]) || (($gamerule['types'][2] instanceof \think\Collection || $gamerule['types'][2] instanceof \think\Paginator ) && $gamerule['types'][2]->isEmpty()))): ?>
                炸弹牛(6倍)
                <?php endif; if(!(empty($gamerule['types'][3]) || (($gamerule['types'][3] instanceof \think\Collection || $gamerule['types'][3] instanceof \think\Paginator ) && $gamerule['types'][3]->isEmpty()))): ?>
                五小牛(8倍)
                <?php endif; ?>
            </span></li>
            <li>局数:<span>
<?php if($gamerule['gamenum'] == '10:1'): ?>
                10局x1房卡
<?php endif; if($gamerule['gamenum'] == '20:2'): ?>
                20局x2房卡
<?php endif; ?>
            </span></li>
        </ul>
    </div>
</div>



<div class="rules" style="display: none;">
    <img src="__STATIC__/game/img/closes.png">

    <div class="cons">
        <h2>声音控制</h2>
        <ul style="text-align: center;">

            <li><label><input checked type="radio" onclick="mp3play('background');" name="audioclose" class=""> 打开</label></li>
            <li><label><input type="radio" onclick="mp3playandpause('background');" name="audioclose" class=""> 关闭</label></li>
        </ul>
    </div>
</div>







<div class="invite" style="position: absolute;top: 1rem;width: 100%;z-index: 100000;display: none;">
    <img src="__STATIC__/game/img/arrow.png" style="width: 5rem;float: right;">
    <p style="color: white;margin:7rem auto;width: 16rem;">
        <span style="display: inline-block;width: 1.5rem;height: 1.5rem;border-radius: 50%;background: red;color: white;text-align: center;line-height: 1.5rem;margin-right: 0.3rem;">1</span>请点击右上角<img src="__STATIC__/game/img/ico1.png" style="width: 1.5rem;vertical-align: middle;margin:0 0.3rem;">按钮<br/><br/>
        <span style="display: inline-block;width: 1.5rem;height: 1.5rem;border-radius: 50%;background: red;color: white;text-align: center;line-height: 1.5rem;margin-right: 0.3rem;">2</span>选择<img src="__STATIC__/game/img/ico2.png" style="width: 1.5rem;vertical-align: middle;margin:0 0.3rem;">发送给朋友来要请好友<br/><br/>
        <span style="color: #E6A43F;">本产品仅供娱乐，禁止用于赌博</span>
    </p>
</div>

<div class="container">
    <div class="header">
        <img src="__STATIC__/game/img/tb.png" width="100%" style="position: absolute;z-index: -1;height: 3.2rem;">
        <img src="__STATIC__/game/img/roomCard.png"
             style="width: 2em;margin:0.3rem 0 0 1rem;vertical-align: middle;"><span
            style="display: inline-block;padding:0.3rem 0.6rem 0.3rem 0.4rem;background:#564C4A;color: #eee;font-size: 1rem;line-height:1rem;border-top-right-radius: 0.9rem;border-bottom-right-radius: 0.9rem;border: 1px solid #666;vertical-align: bottom;margin-bottom: 0.4rem;"><span id="roomcards"><?php echo $room['room_cards_num']; ?></span>张</span>

        <p class="round"><span id="playcount"><?php echo $room['playcount']; ?></span>/<span>10</span>&nbsp;局</p>

        <p class="msg-action"><img src="__STATIC__/game/img/guize.png" class="rule"><img class="audiobtn"
                src="__STATIC__/game/img/audiobtn.png"><img class="inviteico" src="__STATIC__/game/img/invite.png"></p>
    </div>
    <div class="desk">
        <div class="players1">
            <div class="photo" id="player_1">
                <img src="__STATIC__/game/img/33.png" style="width: 2.5rem;height: 2.5rem;">
                <img style="right:66px;bottom:34px;" class="readyimg" src="__STATIC__/game/img/ready1.png" style="width: 2.5rem;height: 2.5rem;">
                <img class="zhuangimg" src="__STATIC__/game/img/zhuang.png">
                <p><span style="max-width: 2.2rem;font-size: 0.6rem;" class="nickname">不一样的烟火不一样的烟火</span><br/><span class="money">34</span></p>
                <span class="gameret"></span>
                <div class="cardsbox" style="bottom:45px; right:85px;">
                    <div class="poker box1"><img class="pic1" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box2"><img class="pic2" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box3"><img class="pic3" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box4"><img class="pic4" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box5"><img class="pic5" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="niuname">未知</div>
                    <div class="xiazhubox"><img class="bankerimg" src="__STATIC__/game/img/qiangzhuang.png"><img src="__STATIC__/game/img/X-1.png" class="multipleimg">  </div>
                </div>
            </div>
            <div class="photo" id="player_2">
                <img src="__STATIC__/game/img/33.png" style="width: 2.5rem;height: 2.5rem;">
                <img style="right:66px;bottom:34px;" class="readyimg" src="__STATIC__/game/img/ready1.png" style="width: 2.5rem;height: 2.5rem;">
                <img class="zhuangimg" src="__STATIC__/game/img/zhuang.png">
                <p><span style="max-width: 2.2rem;font-size: 0.6rem;" class="nickname">不一样的烟火不一样的烟火</span><br/><span class="money">34</span></p>
                <span class="gameret"></span>
                <div class="cardsbox" style="bottom:45px; right:85px;">
                    <div class="poker box1"><img class="pic1" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box2"><img class="pic3" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box3"><img class="pic4" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box4"><img class="pic5" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box5"><img class="pic5" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="niuname">未知</div>
                    <div class="xiazhubox"><img class="bankerimg" src="__STATIC__/game/img/qiangzhuang.png"><img src="__STATIC__/game/img/X-1.png" class="multipleimg"> </div>
                </div>
            </div>
        </div>
        <div class="players2">
            <div class="photo"  id="player_3">
                <img src="__STATIC__/game/img/33.png" style="width: 2.5rem;height: 2.5rem;">
                <img style="left:73px;bottom:30px;" class="readyimg" src="__STATIC__/game/img/ready1.png" style="width: 2.5rem;height: 2.5rem;">
                <img class="zhuangimg" src="__STATIC__/game/img/zhuang.png">
                <p><span style="max-width: 2.2rem;font-size: 0.6rem;" class="nickname">不一样的烟火不一样的烟火</span><br/><span class="money">34</span></p>

                <span class="gameret"></span>
                <div class="cardsbox" style="bottom:45px; left:50px;">
                    <div class="poker box1"><img class="pic1" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box2"><img class="pic2" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box3"><img class="pic3" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box4"><img class="pic4" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box5"><img class="pic5" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="niuname">未知</div>
                    <div class="xiazhubox"><img class="bankerimg" src="__STATIC__/game/img/qiangzhuang.png"><img src="__STATIC__/game/img/X-1.png" class="multipleimg"> </div>
                </div>


            </div>
            <div class="photo"  id="player_4">
                <img src="__STATIC__/game/img/33.png" style="width: 2.5rem;height: 2.5rem;">
                <img style="left:73px;bottom:30px;" class="readyimg" src="__STATIC__/game/img/ready1.png" style="width: 2.5rem;height: 2.5rem;">
                <img class="zhuangimg" src="__STATIC__/game/img/zhuang.png">
                <p><span style="max-width: 2.2rem;font-size: 0.6rem;" class="nickname">不一样的烟火不一样的烟火</span><br/><span class="money">34</span></p>
                <span class="gameret"></span>
                <div class="cardsbox" style="bottom:45px; left:50px;">
                    <div class="poker box1"><img class="pic1" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box2"><img class="pic2" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box3"><img class="pic3" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box4"><img class="pic4" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box5"><img class="pic5" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="niuname">未知</div>
                    <div class="xiazhubox"><img class="bankerimg" src="__STATIC__/game/img/qiangzhuang.png"><img src="__STATIC__/game/img/X-1.png" class="multipleimg"> </div>
                </div>

            </div>
        </div>
        <div class="players3" style="top:-70px;">
            <div class="photo" id="player_0">
                <img src="__STATIC__/game/img/33.png" style="width: 2.5rem;height: 2.5rem;">
                <img style="left:0px; bottom: -39px;" class="readyimg" src="__STATIC__/game/img/ready1.png" style="width: 2.5rem;height: 2.5rem;">
                <img class="zhuangimg" src="__STATIC__/game/img/zhuang.png">
                <p><span style="max-width: 2.2rem;font-size: 0.6rem;" class="nickname">不一样的烟火不一样的烟火</span><br/><span class="money">34</span></p>
                <span class="gameret"></span>
                <div class="cardsbox" style="bottom: -20px;
    left: -17px;">
                    <div class="poker box1"><img class="pic1" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box2"><img class="pic2" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box3"><img class="pic3" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box4"><img class="pic4" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="poker box5"><img class="pic5" src="__STATIC__/game/img/pai/0.png"></div>
                    <div class="niuname">未知</div>
                    <div class="xiazhubox"><img class="bankerimg" src="__STATIC__/game/img/qiangzhuang.png"><img src="__STATIC__/game/img/X-1.png" class="multipleimg"> </div>
                </div>
            </div>
        </div>
        <p class="last-time"><span class="text" style="margin-top:0; width:100%; font-size: 14px;">等待摊牌</span><span class="int">15</span></p>





        <img style="margin: -25px;
    left: 50%;
    bottom: 100px;" class="readyimg" id="myreadyimg" src="__STATIC__/game/img/ready1.png" style="width: 2.5rem;height: 2.5rem;">


        <div class="cards">
            <p style="color:#fff; margin-bottom: 12px; display: none;">等待闲家下注</p>
            <p style="color:#fff; margin-bottom: 12px;display: none;">点击牌面看牌</p>
            <img src="__STATIC__/game/img/tanpai.png" onclick="tanpai(); mp3play('mp3xiazhu');" class="tanpai">



            <div class="xiazhu" style="display: none; margin-top:12px;">
                <img onclick="setmultiple(1);" src="__STATIC__/game/img/one.png">
                <img onclick="setmultiple(2);" src="__STATIC__/game/img/two.png">
                <img onclick="setmultiple(3);" src="__STATIC__/game/img/three.png">
            </div>
            <div class="qiang" style="display: none; margin-top:12px;">
                <img onclick="setbanker(1);" src="__STATIC__/game/img/one.png">



                <img onclick="setbanker(2);" src="__STATIC__/game/img/two.png">
                <img onclick="setbanker(4);" src="__STATIC__/game/img/4.png">

                <img onclick="setbanker(0);" src="__STATIC__/game/img/buqiang.png">
            </div>
            <div class="pai">

                <div class="poker box1" onclick="poker.ajaxshow('<?php echo url('showone'); ?>',0,'__STATIC__/game/img/pai/',this,function(){ mp3play('mp3fapai');});"><img class="pk" src="__STATIC__/game/img/pai/0.png"></div>
                <div class="poker box2" onclick="poker.ajaxshow('<?php echo url('showone'); ?>',1,'__STATIC__/game/img/pai/',this,function(){ mp3play('mp3fapai');});"><img class="pk" src="__STATIC__/game/img/pai/0.png"></div>
                <div class="poker box3" onclick="poker.ajaxshow('<?php echo url('showone'); ?>',2,'__STATIC__/game/img/pai/',this,function(){ mp3play('mp3fapai');});"><img class="pk" src="__STATIC__/game/img/pai/0.png"></div>
                <div class="poker box4" onclick="poker.ajaxshow('<?php echo url('showone'); ?>',3,'__STATIC__/game/img/pai/',this,function(){ mp3play('mp3fapai');});"><img class="pk" src="__STATIC__/game/img/pai/0.png"></div>
                <div class="poker box5" onclick="poker.ajaxshow('<?php echo url('showone'); ?>',4,'__STATIC__/game/img/pai/',this,function(){ mp3play('mp3fapai');});"><img class="pk" src="__STATIC__/game/img/pai/0.png"></div>
            </div><div class="niuname">未知</div>
        </div>
    </div>
    <div class="msg" id="player_99">
        <div class="photo member__<?php echo $memberinfo['id']; ?>" style="display: block;">
            <img src="<?php echo $memberinfo['photo']; ?>" style="width: 3.5rem;height: 3.5rem;">
            <img class="zhuangimg" src="__STATIC__/game/img/zhuang.png">
            <p><span><?php echo $memberinfo['nickname']; ?></span><br/><span class="moneybox"><?php echo $memberinfo['money']; ?></span></p>


            <span style="top: -34px;" class="gameret"></span>

            <div class="xiazhubox"><img class="bankerimg" src="__STATIC__/game/img/qiangzhuang.png"><img src="__STATIC__/game/img/X-1.png" class="multipleimg"> </div>
        </div>
        <div class="base-bet">
            <p>底注：<span><?php echo $gamerule['score']; ?></span>分</p>
        </div>
        <img src="__STATIC__/game/img/xiaoxi.png" style="width: 2.6rem;height: 2.2rem;">
        <ul>
            <li onclick="sendmsg('我出去叫人','message1');">我出去叫人</li>
            <li onclick="sendmsg('你的牌好靓哇','message2');">你的牌好靓哇</li>
            <li onclick="sendmsg('我当年横扫澳门五条街','message3');">我当年横扫澳门五条街</li>
            <li onclick="sendmsg('算你牛逼','message4');">算你牛逼</li>
			<li onclick="sendmsg('输得裤衩都没了','message5');">输得裤衩都没了</li>
			<li onclick="sendmsg('港澳赌神在此','message6');">港澳赌神在此</li>
			<li onclick="sendmsg('谢谢老板','message7');">谢谢老板</li>
			<li onclick="sendmsg('放工资啦','message8');">放工资啦</li>
			<li onclick="sendmsg('别跟我抢庄','message9');">别跟我抢庄</li>
			<li onclick="sendmsg('让我教你输字怎么写','message10');">让我教你输字怎么写</li>
        </ul>
    </div>
</div>
<script src="__STATIC__/game/js/jquery-1.12.1.js"></script>
<script src="//cdn.bootcss.com/socket.io/1.3.7/socket.io.js"></script>
<script src="__STATIC__/game/js/lib/opentip.js"></script>
<script src="__STATIC__/js/countdown.js"></script>
<script src="__STATIC__/game/js/lib/adapter-jquery.js"></script>

<script src="__STATIC__/game/js/jquery-ui.min.js"></script>
<script src="__STATIC__/game/js/jquery.flip.min.js"></script>

<script src="__STATIC__/js/pokershow.js?v=1.20"></script>
<script src="__STATIC__/js/gold-fly.js?v=1.6"></script>
<!--微信分享开始-->

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $jsconfig; ?>);
    wx.ready(function () {
        var shareData = {
            title: '好友约你牛牛（房间号：<?php echo $room['room_num']; ?>）',
            desc: '模式：<?php if($gamerule['gametype'] == '1'): ?>牛牛上庄<?php endif; if($gamerule['gametype'] == '2'): ?>固定庄家<?php endif; if($gamerule['gametype'] == '3'): ?>自由抢庄<?php endif; if($gamerule['gametype'] == '4'): ?>明牌抢庄<?php endif; if($gamerule['gametype'] == '5'): ?>通比牛牛<?php endif; ?> 底分：<?php echo $gamerule['score']; ?>分 规则:<?php if($gamerule['rule'] == '1'): ?>牛牛x3 牛九x2 牛八x2<?php endif; if($gamerule['rule'] == '2'): ?>牛牛x4 牛九x3 牛八x2 牛七x2<?php endif; ?>',
            link: '',
            imgUrl: 'http://iis.gdxiaoe.com/niu.png',
            success: function () {
                //分享成功
            }
        };
        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareTimeline(shareData);
    });
</script>

<!--微信分享结束-->


<script type="text/javascript">

    function tanpaicountdown1(initcount){
        $('.qiang').hide();
        if(initcount == 0){
            $('.last-time').hide();
            return false;
        }
        $('.last-time span.text').html('闲家下注');
        $('.last-time span.int').countdown({initcount:initcount,end:function(){
            $('.last-time').hide();

            setmultiple(1);
        }});
        $('.last-time').show();
    }

    function tanpaicountdown(initcount){
        $('.qiang').hide();
        if(initcount == 0){
            $('.last-time').hide();
            return false;
        }
        $('.last-time span.text').html('等待摊牌');
        $('.last-time span.int').countdown({initcount:initcount,end:function(){
            $('.last-time').hide();
            tanpai();
        }});
        $('.last-time').show();
    }

    function fapaicountdown(initcount){
        if(initcount == 0){
            $('.last-time').hide();
            return false;
        }
        $('.last-time span.text').html('准备开始');
        $('.last-time span.int').countdown({initcount:initcount,end:function(){
            $('.last-time').hide();
            gamestart();
        }});
        $('.last-time').show();
    }

    function setbankercountdown(initcount){
        $('.qiang').show();
        if(initcount == 0){
            $('.last-time').hide();
            return false;
        }
        $('.last-time span.text').html('抢庄');
        $('.last-time span.int').countdown({initcount:initcount,end:function(){
            $('.last-time').hide();
            setbanker(0);
        }});

        $('.last-time').show();
    }

    $(function () {
        $(".msg>img").click(function () {
            $(".msg ul").toggle();
        })
        $(".rule").click(function () {
            $(".rules:eq(0)").add(".overlay").show();
        })
        $(".rules:eq(0)>img").click(function () {
            $(".rules:eq(0)").add(".overlay").hide();
        })


        $(".audiobtn").click(function () {
            $(".rules:eq(1)").add(".overlay").show();
        })
        $(".rules:eq(1)>img").click(function () {
            $(".rules:eq(1)").add(".overlay").hide();
        })


        $(".inviteico").click(function(){
            $(".overlay").addClass("overlay1");
            $(".invite").add(".overlay1").show();

            $(".overlay1,.invite").click(function(){
                $(".invite,.overlay1").hide();
                $(".overlay").removeClass("overlay1");
            })
        })



    })

    function strToJson(str) {

        var json = eval('(' + str + ')');
        return json;
    }
    $(document).ready(function () {
        // 连接服务端
        var socket = io('http://' + document.domain + ':2120');
        // 连接后登录
        socket.on('connect', function () {
            $.post('<?php echo url('comein', array('room_id' => input('room_id'))); ?>', { }, function (ret) {
                socket.emit('login', <?php echo $memberinfo['id']; ?>);
            }, 'json'
            );

        });

        socket.on('update_online_count', function (userlist) {
            //有人加入时更新界面，服务器发来所有用户数据

            $.post('<?php echo url('allmember'); ?>', {userlist:userlist}, function (ret) {

            }, 'json'
            );
        });
        socket.on('update_offline', function (userid) {
            //有人退出\断线时
            $.post('<?php echo url('comeout'); ?>', {memberid:userid}, function (ret) {
                //$('.member__'+userid).hide();
            }, 'json'
            );

        });

        // 后端推送来消息时
        socket.on('new_msg', function (msg) {
            var ret = strToJson(msg);
            //msg.type 1是接收用户发送的信息
            if (ret.type == 1) {
                msgshow(ret.info, ret.from,ret.msgid);
            }
            if (ret.type == 999) {
                console.log(ret.data);
                if(ret.end == 1){
                    $('#gameready').remove();
                }
                $.jinbiflyall('<img style="border-radius: 20px;" width="15" src=\'__STATIC__/game/img/jinbi.png\'>','.member__',ret.data,function(){
                    $('.cardsbox').hide();
                    $('.pai .poker img').css('opacity', 0);
                    $('.poker').css({'background-color':'rgba(0,0,0,0)'});
                    $('.niuname').hide();
                    //移除准备按钮，不能再开始游戏了

                    if(ret.end == 1){
                        setTimeout(function(){

                            $('.window iframe').attr('src', window.location.href);
                            $('.window').show();
                            $('.window iframe').height($(window).height());

                            //window.location.reload();
                        },2000);
                    }

                },function(){
                    mp3play('mp3gold');
                })
            }

            //传来房间中其它会员的信息，得到后加入到界面中显示出来，数据是一个json数组
            if(ret.type == 4) {

                $('#playcount').html(ret.room['playcount']);
                //更新房卡
                $('#roomcards').html(ret.room['room_cards_num']);

                $('.moneybox').text(ret.money);
                $('.zhuangimg').hide();
                if(ret.isbanker == 1){
                    if(ret.issetbanker == 1){

                        if (ret.room.rule.gametype != 5) {
                            $('.member__<?php echo $memberinfo['id']; ?>').find('.zhuangimg').show();
                        }
                        if(ret.room.rule.gametype != 1 && ret.room.rule.gametype != 5 && ret.room.rule.gametype != 2){
                            $('.member__<?php echo $memberinfo['id']; ?>').find('.bankerimg').show();
                            $('.member__<?php echo $memberinfo['id']; ?>').find('.multipleimg').attr('src', '__STATIC__/game/img/X-' + ret.multiple + '.png').show();
                        }


                    }
                }else{
                    $('.member__<?php echo $memberinfo['id']; ?>').find('.bankerimg').hide();
                    $('.member__<?php echo $memberinfo['id']; ?>').find('.zhuangimg').hide();
                    if(ret.issetmultiple == 1) {
                        if (ret.room.rule.gametype != 5) {
                            $('.member__<?php echo $memberinfo['id']; ?>').find('.multipleimg').attr('src', '__STATIC__/game/img/X-' + ret.multiple + '.png').show();
                        }
                    }else{
                        $('.member__<?php echo $memberinfo['id']; ?>').find('.multipleimg').hide();
                    }
                }



                //准备发牌
                if (ret.room.gamestatus == 1) {
                    $('.xiazhubox img').hide();
                    $('input.bankerconfirm').remove();
                    fapaicountdown(ret.room.starttime);
                }



                if(ret.gamestatus == 1) {
                    $('#myreadyimg').show();
                    $('#gameready').hide();
                }
                if (ret.room.gamestatus == 0) {
                    if(ret.gamestatus == 0) {
                        $('#gameready').show();
                    }
                    poker.init('.poker');
                    $('.tanpai').hide();
                    $('.xiazhu').hide();
                    $('.xiazhubox img').hide();
                    $('.zhuangimg').hide();
                    $('#cardsshowplay').remove();
                    $('.tanpaishowplay').remove();
                }
                //开始抢庄
                if (ret.room.gamestatus >= 2 && ret.gamestatus > 0) {

                    //刚准备好，发牌完毕
                    $('.cards').show();
                    $('.readyimg').hide();
                    $('#gameready').hide();
                    poker.fanpaiall($('.cards .poker'), '__STATIC__/game/img/pai/', ret.pai, function(){
                        mp3play('mp3fapai');
                    });


                    //点击过了，不再显示

                    setbankercountdown(ret.room.qiangtime);
                    if(ret.issetbanker == 1){
                        $('.qiang').hide();
                    }


                    if(ret.room.gamestatus >= 3){
                        var showall = true;
                        for(var k=0;k<ret.pai.length; k++){
                            if(ret.pai[k] == 0){
                                showall = false;
                            }
                        }
                        if(!showall){
                            $('.tanpai').hide();
                            //已经下注才显示这行字
                            if(ret.issetmultiple == 1){
                                $('.tanpai').prev().show();
                            }
                            if(ret.isbanker == 1 && ret.room.rule.gametype != 5){
                                if(ret.room.gamestatus == 3){
                                    $('.tanpai').prev().prev().show();
                                }else{
                                    $('.tanpai').prev().prev().hide();
                                    $('.tanpai').prev().show();
                                }

                            }
                        }else{
                            if(ret.gamestatus != 2){
                                $('.tanpai').show();
                            }

                            $('.tanpai').prev().hide();
                            $('.tanpai').prev().prev().hide();
                        }
                    }


                }


                if (ret.room.gamestatus == 3) {


                    if(ret.issetmultiple == 0){
                        //$('.tanpai').hide();
                    }


                    //抢庄动画
                    if($('input.bankerconfirm').length == 0){
                        for (var b = 0; b < ret.banker.length; b++) {
                            setflash($('.member__' + ret.banker[b]).find('img:eq(0)'));
                        }
                        $('<input type="hidden" class="bankerconfirm">').appendTo('body');
                    }
                    if(ret.gamestatus == 2) {
                        //$('.tanpai').hide();
                        $('.cards .niuname').html('<img width="120" src="__STATIC__/game/img/niu' + ret.info + '.png" >').show();
                    }else{
                        if(ret.issetmultiple == 0){
                            if(ret.isbanker == 0 && ret.gamestatus > 0){
                                //$('.tanpai').hide();
                                $('.xiazhu').show();
                            }

                        }else{
                            $('.xiazhu').hide();
                        }


                    }
                    tanpaicountdown1(ret.room.xiazhutime);


                }
                if(ret.gamestatus == 2) {
                    //$('.tanpai').hide();
                    if ($('#cardsshowplay').length == 0) {
                        var cardsshowplay = $('<input type="hidden" id="cardsshowplay">');
                        mp3play('mp3niu' + ret.info);
                        cardsshowplay.appendTo('body');
                    }
                }
                //闲家下注，摊牌倒计时
                if (ret.room.gamestatus == 4) {

                    tanpaicountdown(ret.room.taipaitime);
                    if(ret.gamestatus == 2) {


                        $('.cards .niuname').html('<img width="120" src="__STATIC__/game/img/niu' + ret.info + '.png" >').show();
                    }else{
                        // $('.tanpai').show();
                        if(ret.issetmultiple == 0){

                            if(ret.isbanker == 0){
                                //$('.tanpai').hide();
                                $('.xiazhu').show();
                            }
                        }else{
                            $('.xiazhu').hide();
                        }



                    }




                }




                for(var i =0; i < ret.data.length; i++) {
                    $('#player_' + i).find('img').eq(0).attr('src', ret.data[i].photo);
                    $('#player_' + i).find('.nickname').html(ret.data[i].nickname);
                    $('#player_' + i).find('.money').html(ret.data[i].money);
                    $('.member__' + ret.data[i].id).removeClass('member__' + ret.data[i].id);
                    $('#player_' + i).addClass('member__' + ret.data[i].id);
                    $('#player_' + i).show();
                    if(ret.data[i].gamestatus == 1){
                        $('.member__' + ret.data[i].id + ' .readyimg').show();
                        //把
                    }
//显示抢庄倍数

                    if (ret.data[i].issetbanker == 1 && ret.room.gamestatus >= 2) {
                        if (!(ret.room.rule.gametype == 1 || ret.room.rule.gametype == 5)) {

                            $('.member__' + ret.data[i].id).find('.bankerimg').show();
                            $('.member__' + ret.data[i].id).find('.multipleimg').attr('src', '__STATIC__/game/img/X-' + ret.data[i].multiple + '.png').show();

                        }
                    }


                    if (ret.room.gamestatus >= 3) {
                        $('.bankerimg').hide();

                        if (ret.data[i].banker == 1 && ret.room.rule.gametype != 5) {

                            $('.member__' + ret.data[i].id).find('.zhuangimg').show();


                        } else {

                            if (ret.room.rule.gametype != 5) {
                                //console.log(ret.data[i].issetmultiple);
                                if (ret.data[i].issetmultiple == 1) {
                                    $('.member__' + ret.data[i].id).find('.multipleimg').attr('src', '__STATIC__/game/img/X-' + ret.data[i].multiple + '.png').show();
                                } else {
                                    $('.member__' + ret.data[i].id).find('.multipleimg').hide();
                                }
                            }

                        }
                    }
                    if(ret.room.rule.gametype == 2 && ret.data[i].banker == 1){
                        $('.member__' + ret.data[i].id).find('.multipleimg').hide();

                    }
                    if(ret.data[i].gamestatus == 0){
                        $('.member__' + ret.data[i].id).find('.multipleimg').hide();

                    }

                    if (ret.room.gamestatus == 0) {
                        //当前会员未准备状态，重置游戏界面，把准备按钮显示出来，合理的这里其实是一个再来一局的按钮，没关系
                        if(ret.gamestatus == 0){
                            $('#gameready').show();
                        }

                        continue;
                    }

                    if (ret.data[i]['gamestatus'] > 0 && ret.room.gamestatus > 1) {

                        $('.member__' + ret.data[i].id + ' .readyimg').hide();
                        if (ret.data[i]['gamestatus'] == 2) {
                            if($('.member__' + ret.data[i].id+' .tanpaishowplay').length == 0){
                                var tanpaishowplay = $('<input type="hidden" class="tanpaishowplay">');
                                mp3play('mp3niu'+ret.data[i]['info']);
                                tanpaishowplay.appendTo('.member__' + ret.data[i].id);
                            }


                            $('#player_' + i).find('.cardsbox .niuname').html('<img width="120" src="__STATIC__/game/img/niu' + ret.data[i]['info'] + '.png" >');
                            $('#player_' + i).find('.cardsbox .niuname').show();
                        }
                        $('#player_' + i).find('.cardsbox').show();


                        poker.fanpaiall($('#player_' + i+' .poker'), '__STATIC__/game/img/pai/', ret.data[i]['pai'],function(){
                            mp3play('mp3fapai');
                        });
                    }


                }


            }

        });



    });


    function msgshow(msg, memberid,msgid){
        var playerid =$('.member__'+memberid).attr('id');
        var myInput = $('.member__'+memberid);
        var config = {};



mp3play(msgid);



        switch (playerid){
            case 'player_0' : config = {target:true, hideDelay:0.2, tipJoint:"center top",removeElementsOnHide:true}; break;
            case 'player_1' : config =  {target:true, hideDelay:0.2, tipJoint:"right",removeElementsOnHide:true}; break;
            case 'player_2' : config =  {target:true, hideDelay:0.2, tipJoint:"right", removeElementsOnHide:true}; break;
            case 'player_3' : config =   {target:true, hideDelay:0.2, tipJoint:"left",removeElementsOnHide:true}; break;
            case 'player_4' : config =  {target:true, hideDelay:0.2, tipJoint:"left",removeElementsOnHide:true}; break;
        }
        var inputOpentip = new Opentip(myInput, config);
        inputOpentip.show();
        inputOpentip.setContent(msg);
        setTimeout(function(){
            inputOpentip.hide();
        },1500);
    }

    function sendmsg(msg,id) {

mp3play(id);
        var inputOpentip1 = new Opentip($('.member__<?php echo $memberinfo['id']; ?>'), {target:true, hideDelay:0.2, tipJoint:"left bottom", removeElementsOnHide:true});
        inputOpentip1.show();
        inputOpentip1.setContent(msg);
        setTimeout(function(){
            inputOpentip1.hide();
        },1500);

        $('.msg ul').hide();
        $.post('<?php echo url('sendmsg'); ?>', {data:msg,id:id}, function (ret) {

        }, 'json'
    )
        ;
    }

    function gameready1(gameready){

        $('.niuname').hide();
        $('.cards').hide();
        $('.tanpai').hide();
        $('.cardsbox').hide();
        $.post('<?php echo url('gameready'); ?>', {gameready:gameready}, function (ret) {

            $('#gameready').hide();


        }, 'json'
    )
        ;
    }


    function gamestart(){

        $('.niuname').hide();
        $('.cards').hide();
        $('.tanpai').hide();
        $('.cardsbox').hide();
        $.post('<?php echo url('gamestart'); ?>', { }, function (ret) {

        }, 'json'
    )
        ;
    }

    //抢庄
    function setbanker(multiple){
        $('.last-time span.int').countdown(0);
        $('.qiang').hide();
        mp3play('mp3xiazhu');
        $.post('<?php echo url('setbanker'); ?>', {multiple:multiple}, function (ret) {

            // $('.last-time').hide();
        }, 'json'
    )
        ;
    }

    //闲家下注
    function setmultiple(multiple){
        $('.last-time span.int').countdown(0);
        $('.xiazhu').hide();
        mp3play('mp3xiazhu');
        //$('.tanpai').show();
        $.post('<?php echo url('setmultiple'); ?>', {multiple:multiple}, function (ret) {

            //$('.last-time').hide();
        }, 'json'
    )
        ;
    }







    //摊牌
    function tanpai(){
        $('.last-time span.int').countdown(0);
        $.post('<?php echo url('showall'); ?>', {}, function (ret) {
            $('.tanpai').hide();
            //$('.last-time').hide();
        }, 'json'
    )
        ;
    }


    function setflash(img){
        $(img).css({"boxShadow":"0 0px 20px orange","transition":"boxShadow 3s ease-in-out"});
        setTimeout(function(){
            $(img).css({"boxShadow":"none","transition":"boxShadow 3s ease-in-out"})
        },600);
        setTimeout(function(){
            $(img).css({"boxShadow":"0 0px 20px orange","transition":"boxShadow 3s ease-in-out"});
            setTimeout(function(){
                $(img).css({"boxShadow":"none","transition":"boxShadow 3s ease-in-out"})
            },600);
        },950);
    }



    function fanpai(pai){
        var _this = pai;
        _this.flip({
            direction: 'lr',
            content: '',
            speed: 200,
            onEnd: function(){
                _this.addClass('open');
            }
        });
    }




</script>
<audio onended="mp3playandpause('mp3niu0');" id="mp3niu0" src="__STATIC__/game/video/nv_niu0.mp3"></audio>
<audio onended="mp3playandpause('mp3niu1');" id="mp3niu1" src="__STATIC__/game/video/nv_niu1.mp3"></audio>
<audio onended="mp3playandpause('mp3niu2');" id="mp3niu2" src="__STATIC__/game/video/nv_niu2.mp3"></audio>
<audio onended="mp3playandpause('mp3niu3');" id="mp3niu3" src="__STATIC__/game/video/nv_niu3.mp3"></audio>
<audio onended="mp3playandpause('mp3niu4');" id="mp3niu4" src="__STATIC__/game/video/nv_niu4.mp3"></audio>
<audio onended="mp3playandpause('mp3niu5');" id="mp3niu5" src="__STATIC__/game/video/nv_niu5.mp3"></audio>
<audio onended="mp3playandpause('mp3niu6');" id="mp3niu6" src="__STATIC__/game/video/nv_niu6.mp3"></audio>
<audio onended="mp3playandpause('mp3niu7');" id="mp3niu7" src="__STATIC__/game/video/nv_niu7.mp3"></audio>
<audio onended="mp3playandpause('mp3niu8');" id="mp3niu8" src="__STATIC__/game/video/nv_niu8.mp3"></audio>
<audio onended="mp3playandpause('mp3niu9');" id="mp3niu9" src="__STATIC__/game/video/nv_niu9.mp3"></audio>
<audio onended="mp3playandpause('mp3niu10');" id="mp3niu10" src="__STATIC__/game/video/nv_niuniu.mp3"></audio>
<audio onended="mp3playandpause('mp3niu11');" id="mp3niu11" src="__STATIC__/game/video/nv_wuhua.mp3"></audio>
<audio onended="mp3playandpause('mp3niu12');" id="mp3niu12" src="__STATIC__/game/video/nv_zha.mp3"></audio>
<audio onended="mp3playandpause('mp3niu13');" id="mp3niu13" src="__STATIC__/game/video/nv_wuxiao.mp3"></audio>

<audio onended="mp3playandpause('mp3daojishi');" id="mp3daojishi" src="__STATIC__/game/video/daojishi.mp3"></audio>
<audio onended="mp3playandpause('mp3gold');" id="mp3gold" src="__STATIC__/game/video/gold.mp3"></audio>
<audio onended="mp3playandpause('mp3kaiju');" id="mp3kaiju" src="__STATIC__/game/video/kaiju.mp3"></audio>
<audio onended="mp3playandpause('mp3xiazhu');" id="mp3xiazhu" src="__STATIC__/game/video/xiazhu.mp3"></audio>
<audio onended="mp3playandpause('mp3fapai');" id="mp3fapai" src="__STATIC__/game/video/fapai.mp3"></audio>

<audio onended="mp3playandpause('message1');" id="message1" src="__STATIC__/game/message/message1.m4a"></audio>
<audio onended="mp3playandpause('message2');" id="message2" src="__STATIC__/game/message/message2.m4a"></audio>
<audio onended="mp3playandpause('message3');" id="message3" src="__STATIC__/game/message/message3.m4a"></audio>
<audio onended="mp3playandpause('message4');" id="message4" src="__STATIC__/game/message/message4.m4a"></audio>
<audio onended="mp3playandpause('message5');" id="message5" src="__STATIC__/game/message/message5.m4a"></audio>
<audio onended="mp3playandpause('message6');" id="message6" src="__STATIC__/game/message/message6.m4a"></audio>
<audio onended="mp3playandpause('message7');" id="message7" src="__STATIC__/game/message/message7.m4a"></audio>
<audio onended="mp3playandpause('message8');" id="message8" src="__STATIC__/game/message/message8.m4a"></audio>
<audio onended="mp3playandpause('message9');" id="message9" src="__STATIC__/game/message/message9.m4a"></audio>
<audio onended="mp3playandpause('message10');" id="message10" src="__STATIC__/game/message/message10.m4a"></audio>
<audio onended="mp3playandpause('message11');" id="message11" src="__STATIC__/game/message/message11.m4a"></audio>
<audio onended="mp3playandpause('message12');" id="message12" src="__STATIC__/game/message/message12.m4a"></audio>

<audio id="background" autoplay="autoplay" loop="loop" src="__STATIC__/game/video/background.mp3" autoplay preload></audio>

<script>
    function mp3play(id){
        document.getElementById(id).play();
    }
    function mp3pause(id){
        document.getElementById(id).pause();
    }

    function mp3playandpause(id){
        mp3play(id);
        mp3pause(id);
    }

</script>
<script>
    function audioAutoPlay(id){
        var audio = document.getElementById(id),
                play = function(){
                    audio.play();
                };
        document.addEventListener("WeixinJSBridgeReady", function () {
            play();
            mp3pause(id);
        }, false);
        document.addEventListener('YixinJSBridgeReady', function() {
            play();
            mp3pause(id);
        }, false);
    }

    audioAutoPlay('mp3niu0');
    audioAutoPlay('mp3niu1');
    audioAutoPlay('mp3niu2');
    audioAutoPlay('mp3niu3');
    audioAutoPlay('mp3niu4');
    audioAutoPlay('mp3niu5');
    audioAutoPlay('mp3niu6');
    audioAutoPlay('mp3niu7');
    audioAutoPlay('mp3niu8');
    audioAutoPlay('mp3niu9');
    audioAutoPlay('mp3niu10');
    audioAutoPlay('mp3niu11');
    audioAutoPlay('mp3niu12');
    audioAutoPlay('mp3niu13');
    audioAutoPlay('background');

    audioAutoPlay('mp3daojishi');
    audioAutoPlay('mp3gold');
    audioAutoPlay('mp3kaiju');
    audioAutoPlay('mp3xiazhu');

    audioAutoPlay('mp3fapai');



    audioAutoPlay('message1');
    audioAutoPlay('message2');
    audioAutoPlay('message3');
    audioAutoPlay('message4');
    audioAutoPlay('message5');
    audioAutoPlay('message6');
    audioAutoPlay('message7');
    audioAutoPlay('message8');
    audioAutoPlay('message9');
    audioAutoPlay('message10');
    audioAutoPlay('message11');
    audioAutoPlay('message12');



setTimeout(function(){
    mp3play('background');
},2000)



</script>


<div style="display: none;"> <img src="__STATIC__/game/img/pai/1.png">
<img src="__STATIC__/game/img/pai/2.png">
<img src="__STATIC__/game/img/pai/3.png">
<img src="__STATIC__/game/img/pai/4.png">
<img src="__STATIC__/game/img/pai/5.png">
<img src="__STATIC__/game/img/pai/6.png">
<img src="__STATIC__/game/img/pai/7.png">
<img src="__STATIC__/game/img/pai/8.png">
<img src="__STATIC__/game/img/pai/9.png">
<img src="__STATIC__/game/img/pai/10.png">
<img src="__STATIC__/game/img/pai/11.png">
<img src="__STATIC__/game/img/pai/12.png">
<img src="__STATIC__/game/img/pai/13.png">
<img src="__STATIC__/game/img/pai/14.png">
<img src="__STATIC__/game/img/pai/15.png">
<img src="__STATIC__/game/img/pai/16.png">
<img src="__STATIC__/game/img/pai/17.png">
<img src="__STATIC__/game/img/pai/18.png">
<img src="__STATIC__/game/img/pai/19.png">
<img src="__STATIC__/game/img/pai/20.png">
<img src="__STATIC__/game/img/pai/21.png">
<img src="__STATIC__/game/img/pai/22.png">
<img src="__STATIC__/game/img/pai/23.png">
<img src="__STATIC__/game/img/pai/24.png">
<img src="__STATIC__/game/img/pai/25.png">
<img src="__STATIC__/game/img/pai/26.png">
<img src="__STATIC__/game/img/pai/27.png">
<img src="__STATIC__/game/img/pai/28.png">
<img src="__STATIC__/game/img/pai/29.png">
<img src="__STATIC__/game/img/pai/30.png">
<img src="__STATIC__/game/img/pai/31.png">
<img src="__STATIC__/game/img/pai/32.png">
<img src="__STATIC__/game/img/pai/33.png">
<img src="__STATIC__/game/img/pai/34.png">
<img src="__STATIC__/game/img/pai/35.png">
<img src="__STATIC__/game/img/pai/36.png">
<img src="__STATIC__/game/img/pai/37.png">
<img src="__STATIC__/game/img/pai/38.png">
<img src="__STATIC__/game/img/pai/39.png">
<img src="__STATIC__/game/img/pai/40.png">
<img src="__STATIC__/game/img/pai/41.png">
<img src="__STATIC__/game/img/pai/42.png">
<img src="__STATIC__/game/img/pai/43.png">
<img src="__STATIC__/game/img/pai/44.png">
<img src="__STATIC__/game/img/pai/45.png">
<img src="__STATIC__/game/img/pai/46.png">
<img src="__STATIC__/game/img/pai/47.png">
<img src="__STATIC__/game/img/pai/48.png">
<img src="__STATIC__/game/img/pai/49.png">
<img src="__STATIC__/game/img/pai/50.png">
<img src="__STATIC__/game/img/pai/51.png">
<img src="__STATIC__/game/img/pai/52.png">

<img src="__STATIC__/game/img/niu0.png">
<img src="__STATIC__/game/img/niu1.png">
<img src="__STATIC__/game/img/niu2.png">
<img src="__STATIC__/game/img/niu3.png">
<img src="__STATIC__/game/img/niu4.png">
<img src="__STATIC__/game/img/niu5.png">
<img src="__STATIC__/game/img/niu6.png">
<img src="__STATIC__/game/img/niu7.png">
<img src="__STATIC__/game/img/niu8.png">
<img src="__STATIC__/game/img/niu9.png">
<img src="__STATIC__/game/img/niu10.png">
<img src="__STATIC__/game/img/niu11.png">
<img src="__STATIC__/game/img/niu12.png">
<img src="__STATIC__/game/img/niu13.png"></div>
</body>
</html>
