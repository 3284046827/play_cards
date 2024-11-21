$(function(){  

//	showNav
	$('.showNav').on('click',function(){
		$('.wxNav').addClass('show');
//		$('body').css('position','fixed');
	});
	
	var navBlanks = $('.wxNav').not('div');
	$('.hideNav').on('click',function(){	
		$('.wxNav').removeClass('show');
//		$('body').css('position','static');
	});
	navBlanks.on('click',function(){	
		$('.wxNav').removeClass('show');
//		$('body').css('position','static');
	});
    var obtn = $("#backTop");
        //可视页面的height
    var clientHeight =document.documentElement.clientHeight;
    var timer = null;
    var isTop = true;
    window.onscroll = function()
        {
            var osTop = document.documentElement.scrollTop || document.body.scrollTop;
            	if(osTop>=clientHeight)
                {
                    obtn.css({"display":"block"});
                }
                else
                {
                    obtn.css({"display":"none"});
                }
                if(!isTop)
                {
                    clearInterval(timer);
                }
                isTop = false;
            };
            obtn.on("click",function(){
                timer = setInterval(function(){
                    var osTop = document.documentElement.scrollTop || document.body.scrollTop;
                    var ispeed = Math.floor(-osTop/6);
                    document.documentElement.scrollTop = document.body.scrollTop = osTop+ispeed;
                    isTop =true;
                    if (osTop == 0)
                    {
                        clearInterval(timer);
                    }
                },30)
            });
});
