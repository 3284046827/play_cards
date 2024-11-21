function freeLi(obj){
    $(obj).find("ul").animate({
        marginTop : "-34px"
    },500,function(){
        $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
    });
}
function setCookie(name,value)
{
var Days = 30;
var exp = new Date();
exp.setTime(exp.getTime() + Days*24*60*60);
document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
$(function(){
    $('.wxq_ad_c').on('click',function(){
        $.post('/wxq/index',{
            'id':$(this).attr('data-id'),'zid':$(this).attr('data-zid')
        },function(msg){},'json');
    });
    
    //广告
        
    
    $('.close_gg').click(function(e){
        e.preventDefault();
        setCookie('close_type_'+$(this).attr('data-type'),1);
        $(this).parents('.gg-area').remove();
        
        $('.page-group').css('top',0);
        $('.bg-lter #wrap').css('marginTop','0px');
    });
    
    $('.right-gg-toggle').click(function(){
        $('.right-gg-area').toggleClass('r-open');
    });
    
    if(document.getElementById('top-gg-area')){
        $('.xq_shop').addClass('shop_top');  
        $('.bg-lter #wrap').css('marginTop','60px');
    }
    
    if(document.getElementById('top-bottom-area')){
        $('.xq_shop').addClass('shop_bottom');     
        $('.sg-bg').addClass('sgbottom');     
    }
    
    if(document.getElementById('right-gg-area')){
        var rtH = $('.right-gg-toggle').height()+20;
        var rcH = $('.right-gg-content').find('li').size()*42;
        var rHei = (rcH - rtH)/2;
        
        if(rcH>rtH){
            $('.right-gg-toggle').css('marginTop',rHei);   
        }        
        
    }
    
    var copsize = $('.copyright li').size();
    
    if($('.copyright li').size()>1){
        setInterval('freeLi(".copyright")',3000);     
    }
    
});