/**
 *
 * @authors Your Name (you@example.org)
 * @date    2017-12-23 10:13:10
 * @version 2.0
 */
require.config({
    paths: {
        "jquery": "https://cdn.bootcss.com/jquery/3.2.1/jquery.min",
        "jqueryLazyload": "https://cdn.bootcss.com/jquery_lazyload/1.9.7/jquery.lazyload.min",
        "canvasbg": "bannercanvas"
    },
    shim: {
        jqueryLazyload: {
            deps: ['jquery'],
            exports: '$'
        }
    }
});

require(['jquery', 'jqueryLazyload', 'canvasbg'], function($, $lazy, canvasbg) {

    var $window = $(window);
    var $document = $(document);
    var $body = $('body');
    var banner = bannerDisplay();

    $document.ready(readyDo);
    $window.resize(resizeDo);
    $window.scroll(function() {
        gotopIconShow();
    });

    function readyDo () {
        loadFinish();
        svgHeight();
        banner.bannerHeight();
        banner.textShow();
        banner.textHidden();
        singleLoad();
        $window.trigger('scroll');
    }

    function resizeDo () {
        svgHeight();
        gotopIconShow();
        banner.bannerHeight();
        banner.textHidden();
        $window.trigger('scroll');
    }

    //lazyload
    $("img.lazy").lazyload({
        //placeholder : "wp-content/themes/Bluegray/images/lazyload_bg.jpg", //用图片提前占位
        // placeholder,值为某一图片路径.此图片用来占据将要加载的图片的位置,待图片加载时,占位图则会隐藏
        effect: "fadeIn", // 载入使用何种效果
        // effect(特效),值有show(直接显示),fadeIn(淡入),slideDown(下拉)等,常用fadeIn
        threshold: 200, // 提前开始加载
        // threshold,值为数字,代表页面高度.如设置为200,表示滚动条在离目标位置还有200的高度时就开始加载图片,可以做到不让用户察觉
        // event: 'click',  // 事件触发时才加载
        // event,值有click(点击),mouseover(鼠标划过),sporty(运动的),foobar(…).可以实现鼠标莫过或点击图片才开始加载,后两个值未测试…
        // container: $("#container"),  // 对某容器中的图片实现效果
        // container,值为某容器.lazyload默认在拉动浏览器滚动条时生效,这个参数可以让你在拉动某DIV的滚动条时依次加载其中的图片
        //failurelimit : 10 // 图片排序混乱时
        // failurelimit,值为数字.lazyload默认在找到第一张不在可见区域里的图片时则不再继续加载,但当HTML容器混乱的时候可能出现可见区域内图片并没加载出来的情况,failurelimit意在加载N张可见区域外的图片,以避免出现这个问题.
    });

    //页面加载完成
    function loadFinish() {
        $("#loading-container").fadeOut(500);
        $body.removeClass('loading');
    }

    //绘制canvas背景
    (function() {
        if ($window.width() > 640) {
            var $indexCanvasContainer = $('#main'),
                $categoryCanvasContainer = $('.category-body'),
                $singleCanvasContainer = $('.single-body');
            if ($indexCanvasContainer.length > 0) {
                canvasbg.drawCanvas($indexCanvasContainer);
            } else if ($categoryCanvasContainer.length > 0) {
                canvasbg.drawCanvas($categoryCanvasContainer);
            } else if ($singleCanvasContainer.length > 0) {
                canvasbg.drawCanvas($singleCanvasContainer);
            }
        }

    })();

    //header定位
    (function() {
        var scrolltop = new Array();
        var i = 0;
        $window.on('scroll', function() {
            if ($window.scrollTop() > $window.height()) {
                $('header').css('background-color', '#666');
                $('header').addClass('fixed');
                i++;
                scrolltop[i] = $window.scrollTop();
                if (scrolltop[i] > scrolltop[i - 1]) {
                    $("header").css('top', -80 + 'px')
                    $('header').css('opacity', '0');
                } else {
                    $("header").css('top', '0')
                    $('header').css('opacity', '.9');
                }
            } else if ($window.scrollTop() > $window.height() * 0.3) {
                $('header').css('opacity', '0');

            } else {
                $('header').removeClass('fixed');
                $('header').css('background-color', '#0277bd');
                $('header').css('opacity', '1');
            }
        });

    })();

    //search翻转
    (function() {

        $('.head .contact li.query').on('click', function() {
            $('.head .contact .search').css('transform', 'rotateX(0deg)');
            $('.head .contact ul').css('transform', 'rotateX(-90deg)');
        });
        $('.head .search a.down').on('click', function() {
            $('.head .contact .search').css('transform', 'rotateX(90deg)');
            $('.head .contact ul').css('transform', 'rotateX(0deg)');
        });

    })();

    //svg
    function svgHeight() {
        windowW = $window.width();
        var svgHei = windowW * 150 / 1920;
        $('section.banner .svg-block').css('height', svgHei + 'px');
    }

    //banner
    function bannerDisplay() {

        var $banner = $('.banner'),
            $contnet = $banner.find('.content'),
            $show = $contnet.find('.show'),
            $title = $show.find('h1'),
            $text = $show.find('p'),
            $trans = $contnet.find('.show .trans');

        //banner高度自适应
        function bannerHeight() {
            var screenH = $window.height(),
                svgH = $('.banner .svg-block').height() * 2,
                containerH =screenH - svgH - 160;
            if (containerH < 80) {
                return
            }
            var windowH = $window.height(),
                contentH = windowH - 160 - $window.width() * 150 / 1920 * 2;

            $banner.css('height', windowH - 80 + 'px');
            $contnet.css('height', contentH + 'px');
        }

        //banner文字显示
        function textShow() {
            scale($title);
            translateX($text);
            scale($trans);
        }

        //banner文字隐藏
        function textHidden() {
            var showHeight = $show.height();

            if (showHeight < 120) {
                $text.hide();
                $trans.hide();
            } else if (showHeight < 180) {
                $text.hide();
                $trans.show();
            } else {
                $text.show();
                $trans.show();
            }
        }

        return {
            bannerHeight: bannerHeight,
            textShow: textShow,
            textHidden: textHidden
        }

    }

    //transition
    //scale
    function scale(obj) {
        obj.css('transform', 'scale(1)');
        obj.css('opacity', '1');
    }

    //translateX
    function translateX(obj) {
        obj.css('transform', 'translateX(0)');
        obj.css('opacity', '1');
    }

    //translateY
    function translateY(obj) {
        obj.css('transform', 'translateY(0)');
        obj.css('opacity', '1');
    }


    //gotop
    function gotopIconShow() {
        if ($window.scrollTop() > $window.height()) {
            $('.gotop').fadeIn();
        } else {
            $('.gotop').fadeOut();
        }
    }

    $('.gotop').on('click', function() {
        $('body,html').animate({ scrollTop: 0 }, 500);
    });


    //category
    (function() {

        //border
        var $article = $('.category-main .article-list article'),
            length = $article.length;
        for (var i = 0; i < length; i++) {
            $article.eq(i).html($article.eq(i).html() + "<i class='lefttop'></i><i class='topcenter'></i><i class='righttop'></i><i class='rightcenter'></i><i class='rightbottom'></i><i class='bottomcenter'></i><i class='leftbottom'></i><i class='leftcenter'></i>");
        }

        //single hover
        $article.hover(function() {
            var $this = $(this),
                awidth = parseFloat($this.innerWidth()),
                aHeight = parseFloat($this.innerHeight());
            $this.find('i.lefttop').css('width', awidth * 0.5 + 'px');
            $this.find('i.topcenter').css('width', awidth * 0.5 + 'px');
            $this.find('i.righttop').css('height', aHeight * 0.5 + 'px');
            $this.find('i.rightcenter').css('height', aHeight * 0.5 + 'px');
            $this.find('i.rightbottom').css('width', awidth * 0.5 + 'px');
            $this.find('i.bottomcenter').css('width', awidth * 0.5 + 'px');
            $this.find('i.leftbottom').css('height', aHeight * 0.5 + 'px');
            $this.find('i.leftcenter').css('height', aHeight * 0.5 + 'px');
            $this.find('i').css('opacity', '1');
        }, function() {
            var $this = $(this);
            $this.find('i.lefttop').css('width', '3px');
            $this.find('i.topcenter').css('width', '3px');
            $this.find('i.righttop').css('height', '3px');
            $this.find('i.rightcenter').css('height', '3px');
            $this.find('i.rightbottom').css('width', '3px');
            $this.find('i.bottomcenter').css('width', '3px');
            $this.find('i.leftbottom').css('height', '3px');
            $this.find('i.leftcenter').css('height', '3px');
            $this.find('i').css('opacity', '0');
        });

    })();

    //可视区域延时加载
    (function() {

        var screenHeight = window.innerHeight,
            $titles = $('.article-title'),
            $articles = $('.article-list article'),
            titleLength = $titles.length,
            articleLength = $articles.length;
        if ($titles.length > 0) {
            $window.scroll(function() {
                delayload();
            });
        }

        function delayload() {
            var scrollHeight = $window.scrollTop();
            for (let i = 0; i < titleLength; i++) {
                var $title = $titles.eq(i),
                    titleTop = $title.offset().top;
                if (scrollHeight + screenHeight > titleTop + 20) {
                    scale($title);
                }
            }
            for (let j = 0; j < articleLength; j++) {
                var $article = $articles.eq(j),
                    articleTop = $article.offset().top;
                if (scrollHeight + screenHeight > articleTop + 20) {
                    $article.addClass('show').css('animation-name', 'bounceInUp');
                }
            }
        }

    })();

    //single
    function singleLoad() {
        translateX($('.single-main .single-article'));
        translateX($('.category-article'));
        translateX($('aside'));
    }

    //侧边栏固定
    (function() {

        var $aside = $('.single-body aside');
        if ($aside.length > 0) {
            var $section = $('.single-body section'),
                sectionHeight = $section.height(),
                sideHeight = $aside.height(),
                initialSideTop = $aside.offset().top;

            $window.scroll(function() {
                sidebarFixed(sideHeight, initialSideTop);
            });

            function sidebarFixed(sideHeight, initialSideTop) {
                var scrollHeight = $window.scrollTop(),
                    screenHeight = window.innerHeight,
                    sideWidth = $aside.width(),
                    sideLeft = $aside.offset().left,
                    totalHeight = scrollHeight + screenHeight;
                if (totalHeight > sideHeight + initialSideTop) {
                    if (totalHeight > sectionHeight + initialSideTop) {
                        $aside.css({
                            'top': -(sideHeight - screenHeight) - (totalHeight - sectionHeight - initialSideTop)
                        });
                    } else {
                        $aside.css({
                            'position': 'fixed',
                            'top': -(sideHeight - screenHeight),
                            'left': sideLeft,
                            'width': sideWidth
                        });
                    }
                } else {
                    $aside.css({
                        'position': 'static',
                        'width': sideWidth
                    });
                }
            }
        }

    })();

    // pad side nav
    (function() {

        var $menuIcon = $('.header-container').find('.menu-icon'),
            $sideNav = $('.side-nav'),
            $backDrop = $('.backdrop');
        $menuIcon.on('click', function() {
            $sideNav.addClass('show');
            $backDrop.fadeIn();
            $body.addClass('loading');
        });
        $backDrop.on('click', function() {
            $sideNav.removeClass('show');
            $backDrop.fadeOut();
            $body.removeClass('loading');
        });

    })();

});