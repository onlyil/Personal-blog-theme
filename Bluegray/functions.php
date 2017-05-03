<?php
register_nav_menus(array(
    'MainNav' => '主导航'
));


/* 获取文章的评论数  */
function zfunc_comments_users($postid=0,$which=0) {
    $comments = get_comments('status=approve&type=comment&post_id='.$postid); //获取文章的所有评论
    if ($comments) {
        $i=0; $j=0; $commentusers=array();
        foreach ($comments as $comment) {
            ++$i;
            if ($i==1) { $commentusers[] = $comment->comment_author_email; ++$j; }
            if ( !in_array($comment->comment_author_email, $commentusers) ) {
                $commentusers[] = $comment->comment_author_email;
                ++$j;
            }
        }
        $output = array($j,$i);
        $which = ($which == 0) ? 0 : 1;
        return $output[$which]; //返回评论人数
    }
    return 0; //没有评论返回0
}



// 浏览量
 /**
* getPostViews()函数
* 功能：获取阅读数量
* 在需要显示浏览次数的位置，调用此函数
* @Param object|int $postID   文章的id
* @Return string $count          文章阅读数量
*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
/**
* setPostViews()函数
* 功能：设置或更新阅读数量
* 在内容页(single.php，或page.php )调用此函数
* @Param object|int $postID   文章的id
* @Return string $count          文章阅读数量
*/
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// 分页
function custom_posts_per_page($query){
    if(is_home()){
    $query->set('posts_per_page',8);//首页每页显示8篇文章
    }
    if(is_search()){
        $query->set('posts_per_page',-1);//搜索页显示所有匹配的文章，不分页
    }
    if(is_archive()){
        $query->set('posts_per_page',9);//archive每页显示9篇文章
}//endif
}//function
add_action('pre_get_posts','custom_posts_per_page');


//近期评论
function bg_recent_comments($no_comments = 8, $comment_len = 50, $avatar_size = 48) {
  $comments_query = new WP_Comment_Query();
    $comments = $comments_query->query( array( 'number' => $no_comments ) );
    $comm = '';
    if ( $comments ) : foreach ( $comments as $comment ) :
        $comm .= '<li>' . get_avatar( $comment->comment_author_email, $avatar_size );
        $comm .= '<p>' . get_comment_author( $comment->comment_ID ) . ':</p> ';
        $comm .= '<a href="' . get_permalink( $comment->comment_post_ID ) . ' "title="查看' . get_the_title($comment->comment_post_ID) . '">' . strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, $comment_len ) ) . '</a></li>';
    endforeach; else :
        $comm .= '暂无评论';
    endif;
    echo $comm;
}


// 面包屑导航
function dimox_breadcrumbs() {
    $delimiter = '&raquo;';
    $name = '首页'; //text for the 'Home' link
    $currentBefore = '<span>';
    $currentAfter = '</span>';
    if ( !is_home() && !is_front_page() || is_paged() ) {
        echo '<div id="crumbs">';
        global $post;
        $home = get_bloginfo('url');
        echo '' . $name . ' ' . $delimiter . ' ';
        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $currentBefore . 'Archive by category &#39;';
            single_cat_title();
            echo '&#39;' . $currentAfter;
        } elseif ( is_day() ) {
            echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
            echo '' . get_the_time('F') . ' ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('d') . $currentAfter;
        } elseif ( is_month() ) {
            echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('F') . $currentAfter;
        } elseif ( is_year() ) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;
        } elseif ( is_single() ) {
            $cat = get_the_category(); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif ( is_page() && !$post->post_parent ) {
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '' . get_the_title($page->ID) . '';
            $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif ( is_search() ) {
            echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
        } elseif ( is_tag() ) {
            echo $currentBefore . 'Posts tagged &#39;';
            single_tag_title();
            echo '&#39;' . $currentAfter;
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
        } elseif ( is_404() ) {
            echo $currentBefore . 'Error 404' . $currentAfter;
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</div>';
    }
}




//评论表情路径修改
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
return get_bloginfo('template_directory').'/images/smilies/'.$img;
}



//禁用emoji
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param    array  $plugins
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}


//恢复WordPress 4.2之前图片表情
function smilies_reset() {
    global $wpsmiliestrans, $wp_smiliessearch;

    // don't bother setting up smilies if they are disabled
    if ( !get_option( 'use_smilies' ) )
        return;

    $wpsmiliestrans = array(
    '/龇牙' => 'icon_mrgreen.gif',
    '/哈欠' => 'icon_neutral.gif',
    '/发怒' => 'icon_twisted.gif',
      '/擦汗' => 'icon_arrow.gif',
      '/发呆' => 'icon_eek.gif',
      '/微笑' => 'icon_smile.gif',
        '/撇嘴' => 'icon_confused.gif',
       '/酷' => 'icon_cool.gif',
       '/抠鼻' => 'icon_evil.gif',
       '/坏笑' => 'icon_biggrin.gif',
       '/得意' => 'icon_idea.gif',
       '/可爱' => 'icon_redface.gif',
       '/调皮' => 'icon_razz.gif',
       '/白眼' => 'icon_rolleyes.gif',
       '/鼓掌' => 'icon_wink.gif',
        '/大哭' => 'icon_cry.gif',
        '/惊讶' => 'icon_surprised.gif',
        '/赞' => 'icon_good.gif',
        '/咒骂' => 'icon_mad.gif',
        '/伤心' => 'icon_sad.gif',
        '8-)' => 'icon_cool.gif',
        '8-O' => 'icon_eek.gif',
        ':-(' => 'icon_sad.gif',
        ':-)' => 'icon_smile.gif',
        ':-?' => 'icon_confused.gif',
        ':-D' => 'icon_biggrin.gif',
        ':-P' => 'icon_razz.gif',
        ':-o' => 'icon_surprised.gif',
        ':-x' => 'icon_mad.gif',
        ':-|' => 'icon_neutral.gif',
        ';-)' => 'icon_wink.gif',
        '8O' => 'icon_eek.gif',
        ':(' => 'icon_sad.gif',
        ':)' => 'icon_smile.gif',
        ':?' => 'icon_confused.gif',
        ':D' => 'icon_biggrin.gif',
        ':P' => 'icon_razz.gif',
        ':o' => 'icon_surprised.gif',
        ':x' => 'icon_mad.gif',
        ':|' => 'icon_neutral.gif',
        ';)' => 'icon_wink.gif',
        '/吓' => 'icon_exclaim.gif',
        '/疑问' => 'icon_question.gif',
    );
}
smilies_reset();
