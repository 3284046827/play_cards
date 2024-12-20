<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"/Users/d/Desktop/php/niuniu/application/game/view/index/index.html";i:1501228972;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="__STATIC__/game/css/play.css">

    <style>
         body{background: url(__STATIC__/game/img/bg1.png) repeat;}
         .header{width: 100%;height: 4.5rem;border-bottom: 1px solid #ccc;}
         .overlay{background: rgba(0,0,0,0.4);position: absolute;top: 0;left: 0;bottom: 0;right:0;z-index: 100000;display: none;}
         .setact>img{width: 2.2rem;position: absolute;top: 12.5%;right: 3.2%;z-index: 107001;}
        .setact .cons{width: 85%;padding-bottom: 1rem;border:1px solid #ccc;z-index: 107000;position: absolute; top: 15%;left: 50%;margin-left: -42.5%;background: #7A8B9B;border-radius: 0.6rem;}
        .setact .cons h2{text-align: center;text-decoration: underline;font-weight: bold;color: #7fe4cb;line-height: 2.3rem;text-shadow: 2px 1px #472205;margin-top: 0.2rem;}
        .setact .cons ul.tabs-con{background: #1B2D31;width: 95%;margin-left: 2.5%;padding-top: 0.1rem;border-radius: 0.3rem;border:1px solid #aaa;}
        .setact .cons ul.tabs-con p{font-size: 0.8rem;text-align: center;color: #84C8DD;line-height: 2rem;margin:0.1rem 0;background: #143844;}
        .setact .cons ul.tabs-con li{background: #B3CEE9;margin-top: 0.25rem;padding:0.6rem;font-size: 0.9rem;list-style: none;height: 1.2rem;}
        /*.setact .cons ul.tabs-con li:visible:nth-child(3),.setact .cons ul.tabs-con li:visible:nth-child(4){height: 2.5rem;}*/
        .setact .cons ul.tabs-con li span{font-size: 0.9rem;margin-left: 1.3rem;}
        .setact .tabs{width: 95%;margin-left:2.5%;height: 3rem;display: flex;justify-content: space-between;}
        .setact .tabs li{float: left;list-style: none;border:1px solid #E8C007;text-align: center;color: #7F7244;background: url(__STATIC__/game/img/bg2.png) repeat;text-align: center;width: 18.5%;}
        .setact .tabs li span{width:2rem;font-size: 0.8rem;height: 1rem;display: inline-block;margin-top: 0.35rem;}
        .cur{background: url(__STATIC__/game/img/bg3.png) repeat!important;color: #70420E!important;}
        .selections{width: 85%;float: right;}
        .selections label{font-size: 0.9rem;margin-left: 0.5rem;}
        .confirms{text-align: center;}
        .confirms img{width: 7rem;margin-top: 0.6rem;}

        .header>img{width: 3.2em;margin:0.6rem 0 0 1rem;vertical-align: middle;}
        .header>span{display: inline-block;padding:0.2rem 1.2rem 0.4rem 0.4rem;background:#564C4A;color: #eee;font-size: 1rem;line-height:1rem;border-top-right-radius: 0.9rem;border-bottom-right-radius: 0.9rem;border: 1px solid #666;vertical-align: bottom;margin-bottom: 0.8rem;font-size: 0.8rem;}
        .header p{float: right;}
        .header p img{width: 1.7em;margin:1.2rem 0 0 1rem;vertical-align: middle;}
        .header p span{display: inline-block;padding:0.2rem 1.2rem 0.2rem 0.4rem;background:#564C4A;color: #eee;font-size: 1rem;line-height:1rem;border-top-right-radius: 0.9rem;border-bottom-right-radius: 0.9rem;border: 1px solid #666;vertical-align: bottom;margin-bottom: 0.4rem;margin-right: 1rem;font-size: 0.8rem;}

        .setroom{width: 40%;border:2px solid white;border-radius: 1rem;overflow:hidden;margin-left: 30%;margin-top: 35%;box-shadow: 0px 0px 4rem #8e8e8e;}
        .setroom img{width: 100%;margin-left: 0%;margin-top: 0%;}
    </style>
    <!--[if lt IE 9]>      
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="overlay"></div>
    <div class="header">
        <img src="<?php echo $memberinfo['photo']; ?>" style=""><span><?php echo $memberinfo['nickname']; ?></span>
        <p>
            <img src="__STATIC__/game/img/roomCard.png"><span><?php echo $memberinfo['cards']; ?></span>
        </p>
    </div>
    <p class="setroom">
        <img src="__STATIC__/game/img/6666.jpg">
    </p>
    <div class="setact" style="display: none;">
        <img src="__STATIC__/game/img/closes.png">
        <div class="cons">
            <form id="createfrom" action="<?php echo url('Douniuplaywjy/roomcreate'); ?>" method="post" callback="none1">

                <input type="hidden" name="gametype" id="gametype" value="1">


              <h2>创建房间</h2>
              <ul class="tabs">
                   <li onclick="$('#gametype').val(1);" class="cur"><span>牛牛上庄</span></li>
                   <li onclick="$('#gametype').val(2);"><span>固定庄家</span></li>
                   <li onclick="$('#gametype').val(3);"><span>自由抢庄</span></li>
                   <li onclick="$('#gametype').val(4);"><span>明牌抢庄</span></li>
                   <li onclick="$('#gametype').val(5);"><span>通比牛牛</span></li>
              </ul>
              <ul class="tabs-con">
                  <p>创建房间,游戏未进行,不消耗房卡</p>
                  <li class="zero">底分:<div class="selections">
                    <label><input name="score" id="inputfirst" type="radio" checked="checked" value="1" />1分 </label>
                    <label><input name="score" type="radio" value="3" />3分 </label>
                    <label><input name="score" type="radio" value="5" />5分 </label>
                  </div></li>
                  <li class="forth" style="display: none;">底分:<div class="selections">
                    <label><input id="forthinputfirst" name="score" type="radio" value="5" />5分 </label>
                    <label><input name="score" type="radio" value="10" />10分 </label>
                    <label><input name="score" type="radio" value="20" />20分 </label>
                  </div></li>
                  <li>规则:<div class="selections">
                    <label style="display: block;"><input name="rule" type="radio" checked="checked" value="1" />牛牛x3 牛九x2 牛八x2 </label>
                    <label style="display: block;"><input name="rule" type="radio" value="2" />牛牛x4 牛九x3 牛八x2 牛七x2</label>
                  </div></li>
                  <li>牌型:<div class="selections">
                    <label><input name="types[1]" type="checkbox" value="5" />五花牛(5倍)</label>
                    <label><input name="types[2]" type="checkbox" value="6" />炸弹牛(6倍)</label>
                    <label style="display: block;"><input name="types[3]" type="checkbox" value="8" />五小牛(8倍)</label>
                  </div></li>
                  <li>局数:<div class="selections">
                    <label><input name="gamenum" type="radio" checked="checked" value="10:1" />10局x1房卡</label>
                    <label><input name="gamenum" type="radio" value="20:2" />20局x2房卡</label>
                  </div></li>
                  <li class="oneth" style="display: none;">上庄:<div class="selections">
                    <label><input name="openroom" type="radio" value="0" />无</label>
                    <label><input name="openroom" type="radio" value="100" />100</label>
                    <label><input name="openroom" type="radio" value="300" />300</label>
                    <label><input name="openroom" type="radio" value="500" />500</label>
                  </div></li>
              </ul>
              <div class="confirms">
                  <img onclick="$('#createfrom').submit();" type="sub" src="__STATIC__/game/img/qd.png">
              </div>
            </form>
        </div>
    </div>
    
    <script src="__STATIC__/game/js/jquery-1.12.1.js" type="text/javascript"></script>
    <script src="__STATIC__/js/setajax.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".setroom").click(function(){
               $(".overlay,.setact").show();
            })
            $(".setact .cons ul.tabs-con li").eq(3).css("height","2.5rem").end().eq(2).css("height","2.5rem");
            $(".tabs li").click(function(){
               $(this).addClass("cur").siblings().removeClass("cur");
                $("input[name='score']").prop('checked', false);
                $("input[name='openroom']").prop('checked', false);

               $("#inputfirst").prop('checked', true);
               switch($(this).index()){
                case 1:
                    $(".zero").show();
                    $(".oneth").show();
                    $("input[name='openroom']").first().prop('checked', false);
                    $(".forth").hide();break;
                case 4:
                    $(".zero").hide();
                    $(".forth").show();
                    $("#forthinputfirst").prop('checked', true);
                    $(".oneth").hide();break;
                default:
                    $(".zero").show();
                    $(".forth").hide();
                    $(".oneth").hide();
               }
            })
            $(".setact>img").click(function(){
                $(".setact").add(".overlay").hide();
            })


        })

        $('#createfrom').ajaxsubmit({success:function(ret){
            window.location.href=ret.url;
        }});
    </script>
</body>
</html>
