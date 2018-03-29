<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="max-age=7200">
<meta name="author" content="木泽">
<meta name="contact" content="life@muzerblog.com">
<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, user-scalable=no">
<meta name="description" content="木泽个人博客,前端笔记与案例展示,学习和交流!">
<meta name="keywords" content="木泽,木泽个人博客,muze,muzeblog,html5,html,css3,css,JavaScript,jquery,web前端,web前端博客">
<title><?php if ( is_home() ) {
        bloginfo('name'); echo " - Web前端笔记";
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();
    } elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?></title>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.png">
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/common.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/media.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/loading.css" rel="stylesheet">
<link href="<?php bloginfo('template_url'); ?>/css/codecolorer.css" rel="stylesheet">
</head>
<?php flush(); ?>
<body class="loading">

<!-- loading -->
<div id="loading-container">
  <div class="loading-wrapper">
    <div class="loading-absolute">
        <div class="object" id="object_one"></div>
        <div class="object" id="object_two"></div>
        <div class="object" id="object_three"></div>
        <div class="object" id="object_four"></div>
    </div>
  </div>
</div>

<!-- backdrop -->
<div class="backdrop cl-lg-hide"></div>

<!-- 头部开始 -->
<div class="header-container">
    <header>
        <div class="head clearfix">
            <strong class="fl cl-md-hide"><a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" width="121" height="75" alt="木泽个人博客"></a></strong>
            <nav class="cl-md-hide">
                <?php wp_nav_menu( array( 'theme_location' => 'MainNav' ) ); ?>
            </nav>
            <div class="menu-icon fl cl-lg-hide"><p></p></div>
            <div class="contact fr">
                <div class="search">
                    <form role="search" method="get" id="searchform" class="searchform clearfix" action="<?php echo home_url( '/' ); ?>">
                        <input class="fl" type="text" name="s" id="s" placeholder="">
                        <input class="cl-md-hide" type="submit"  id="searchsubmit" value="搜索">
                        <i class="search-icon fa fa-search cl-lg-hide"></i>
                    </form>
                    <a class="down cl-md-hide" href="javascript:void(0)"><i class="fa fa-arrow-down"></i></a>
                </div>
                <ul class="cl-md-hide">
                    <li><a href="http://wpa.qq.com/msgrd?v=3&uin=513969548&site=qq&menu=yes" target="_blank"><i class="fa fa-qq"></i></a></li>
                    <li class="wechat">
                        <a href="javascript:void(0)"><i class="fa fa-weixin"></i></a>
                        <img class="" src="<?php bloginfo('template_url'); ?>/images/qrcode.png" width="100" height="100">
                    </li>
                    <li><a href="mailto:life@muzerblog.com?subject=Hello Muze Blog"><i class="fa fa-envelope"></i></a></li>
                    <li><a href="https://github.com/LifeMuze" target="_blank"><i class="fa fa-github"></i></a></li>
                    <li class="query">
                        <a href="javascript:void(0)" title="搜索"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
            </div>
            <h1 class="cl-lg-hide cl-sm-hide">Muze Blog</h1>
        </div>
    </header>
</div>
<nav class="side-nav cl-lg-hide">
    <div class="bg"></div>
    <div class="side-nav-content">
        <strong class=""><a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" width="121" height="75" alt="木泽个人博客"></a></strong>
        <?php wp_nav_menu( array( 'theme_location' => 'MainNav' ) ); ?>
    </div>
</nav>
<!-- 头部结束 -->
