/**
 *
 * @authors Your Name (you@example.org)
 * @date    2017-04-13 10:13:10
 * @version $Id$
 */

$(document).ready(function(){
    $('body').css('opacity','1');
});

//header
var scrolltop = new Array();
var i = 0;
$(window).scroll(function(){
    if( $(window).scrollTop() > $(window).height() ){
        $('header').css('background-color','#666');
        $('header').addClass('fixed');
        i++;
        scrolltop[i] = $(window).scrollTop();
        if (scrolltop[i] > scrolltop[i-1]) {
            $("header").css('top',-80 + 'px')
            $('header').css('opacity','0');
        }else{
            $("header").css('top','0')
            $('header').css('opacity','.8');
        }
    }else if( $(window).scrollTop() > $(window).height()*0.3 ){
        $('header').css('opacity','0');

    }else{
        $('header').removeClass('fixed');
        $('header').css('background-color','#6964ad');
        $('header').css('opacity','1');
    }
});

//nav
$('nav .menu-mainnav-container ul.menu li.menu-item-has-children a').mouseenter(function(){
    $(this).parent().find('ul.sub-menu li').css('transform','rotateY(0deg)');
    $(this).parent().find('ul.sub-menu li').css('opacity','1');
});
$('nav .menu-mainnav-container ul.menu li.menu-item-has-children').mouseleave(function(){
    $(this).parent().find('ul.sub-menu li').css('transform','rotateY(90deg)');
    $(this).parent().find('ul.sub-menu li').css('opacity','0');

});

//wechat
$('.head .contact ul li.wechat').hover(function(){
    scale($('.head .contact ul li.wechat img'));
},function(){
    $(this).find('img').css('transform','scale(0)');
    $(this).find('img').css('opacity','0');
});

$(window).resize(function(){
    var wid = $('.head .contact ul li.wechat').width(),
    left = wid*0.5-100;
    $('.head .contact ul li.wechat img').css('left',left + 'px');
});

//search
var searchVal = $('.head .contact .search input').val();
$('.head .contact .search input').focus(function(){
    if($(this).val() == searchVal){
        $(this).val('');
        $(this).css('color','#333');
    }
});
$('.head .contact .search input').blur(function(){
    if($(this).val() == ""){
        $(this).val(searchVal);
        $(this).css('color','#999');
    }
});

//search翻转
$('.head .contact ul li.query').click(function(){
    $('.head .contact .search').css('transform','rotateX(0deg)');
    $('.head .contact ul').css('transform','rotateX(-90deg)');
});
$('.head .contact .search a.down').click(function(){
    $('.head .contact .search').css('transform','rotateX(90deg)');
    $('.head .contact ul').css('transform','rotateX(0deg)');
});

//svg
$(document).ready(svgHeight);
$(window).resize(svgHeight);
function svgHeight(){
    windowW = $(window).width();
    var svgHei = windowW*150/1920;
    $('section.banner .svg-block').css('height',svgHei + 'px');
}

//banner
//banner高度自适应
$(document).ready(bannerHeight);
$(window).resize(bannerHeight);
function bannerHeight(){
    var windowH = $(window).height();
    var contentH = windowH-160-$(window).width()*150/1920*2;
    $('section.banner').css('height',windowH-80 + 'px')
    $('article.content').css('height',contentH + 'px');
}
//banner背景移位
$(window).scroll(function(){
    var scrollH = $(window).scrollTop();
    $('section.banner').css('background-position','50% '+ (-40+scrollH*0.5) + 'px');
});

//banner文字显示
$(document).ready(function(){
    scale($('article.content .show h1'));
    translateX($('article.content .show p'));
    scale($('article.content .show .trans'));
});

//banner文字隐藏
$(window).resize(textHidden);
$(document).ready(textHidden);
function textHidden(){
    if($(window).height() < 480){
        $('article.content .show p').hide();
        $('article.content .show .trans').hide();
    }else if($(window).height() < 520){
        $('article.content .show p').hide();
        $('article.content .show .trans').show();
    }else{
        $('article.content .show p').show();
        $('article.content .show .trans').show();
    }
}


//main
//hover-shadow
$('.main .article-list article').hover(function(){
    $(this).find('a img').css('transform','scale(1.2)');
},function(){
    $(this).find('a img').css('transform','scale(1)');
});
//.hoverup{transform: scale(1.2); box-shadow: 0 3px 10px 0 #666;}
//
function getTopHeight(obj){
    var h = 0;
    while(boj){
        h += obj.position().top;
        obj = obj.parent();
    }
    return h;
}

//transition
//scale
function scale(obj){
    obj.css('transform','scale(1)');
    obj.css('opacity','1');
}
//translateX
function translateX(obj){
    obj.css('transform','translateX(0)');
    obj.css('opacity','1');
}
//translateY
function translateY(obj){
    obj.css('transform','translateY(0)');
    obj.css('opacity','1');
}


//gotop

$(document).ready(gotop);
$(window).scroll(gotop);
function gotop(){
    if( $(window).scrollTop() > $(window).height() ){
        $('.gotop').fadeIn();
    }else{
        $('.gotop').fadeOut();
    }
}

$('.gotop').click(function(){
    $('body,html').animate({scrollTop:0},500);
});


//category
//border
for(var i=0;i<9;i++){
    $('.category-main .category-article .article-list article').eq(i).html($('.category-main .category-article .article-list article').eq(i).html() + "<i class='lefttop'></i><i class='topcenter'></i><i class='righttop'></i><i class='rightcenter'></i><i class='rightbottom'></i><i class='bottomcenter'></i><i class='leftbottom'></i><i class='leftcenter'></i>");
}

//single hover
$('.category-article .article-list article').hover(function(){
    var awidth = parseFloat($('.category-article .article-list article').innerWidth());
        aHeight = parseFloat($('.category-article .article-list article').innerHeight());
    $(this).find('i.lefttop').css('width',awidth*0.5+'px');
    $(this).find('i.topcenter').css('width',awidth*0.5+'px');
    $(this).find('i.righttop').css('height',aHeight*0.5+'px');
    $(this).find('i.rightcenter').css('height',aHeight*0.5+'px');
    $(this).find('i.rightbottom').css('width',awidth*0.5+'px');
    $(this).find('i.bottomcenter').css('width',awidth*0.5+'px');
    $(this).find('i.leftbottom').css('height',aHeight*0.5+'px');
    $(this).find('i.leftcenter').css('height',aHeight*0.5+'px');
    $(this).find('i').css('opacity','1');
},function(){
    $(this).find('i.lefttop').css('width','3'+'px');
    $(this).find('i.topcenter').css('width','3'+'px');
    $(this).find('i.righttop').css('height','3'+'px');
    $(this).find('i.rightcenter').css('height','3'+'px');
    $(this).find('i.rightbottom').css('width','3'+'px');
    $(this).find('i.bottomcenter').css('width','3'+'px');
    $(this).find('i.leftbottom').css('height','3'+'px');
    $(this).find('i.leftcenter').css('height','3'+'px');
    $(this).find('i').css('opacity','0');
});




//可视区域延时加载
$(document).ready(lazyload);
$(window).scroll(lazyload);
function lazyload(){
    var screenbottomH = parseInt($(window).height()) + parseInt($(window).scrollTop()),  //屏幕底部高度
        screentopH = parseInt($(window).scrollTop()), //屏幕顶部高度
        showH = screenbottomH - parseInt($(window).height())*0.2;
        articletitleH = [],
        articleH = [];
    for(var i=0;i<$('.article-title').length;i++){
        articletitleH[i] = parseInt($('.article-title').eq(i).offset().top);
        if(articletitleH[i] >= screentopH && articletitleH[i] <= showH){
            scale($('.article-title').eq(i));
        }
    }
    for(var j=0;j<$('.article-list article').length;j++){
        articleH[j] = parseInt($('.article-list article').eq(j).offset().top);
        if(articleH[j] >= screentopH && articleH[j] <= showH){
            $('.article-list article').eq(j).addClass('show');
            $('.article-list article').eq(j).css('animation-name','bounceInUp');
        }
    }
}


//sidebar
$('aside .news ul li').hover(function(){
    $(this).css('text-indent','3px');
    console.log(1);
},function(){
    $(this).css('text-indent','0');
});



//single
$(document).ready(function(){
    translateX($('.single-main .single-article'));
    translateX($('aside'));
});


//评论头像
$('.commentlist .comment').hover(function(){
    $(this).css('background','#c7dffc');
    $(this).find('.gravatar a').show();
    $(this).find('.gravatar img').css('transform','rotateZ(720deg)');
    $(this).find('.gravatar img').css('border-radius','50%');
},function(){
    $(this).css('background','#fff');
    $(this).find('.gravatar a').hide();
    $(this).find('.gravatar img').css('transform','rotateZ(0deg)');
    $(this).find('.gravatar img').css('border-radius','0');
});
