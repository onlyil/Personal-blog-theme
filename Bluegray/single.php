    <?php get_header(); ?>


    <!-- main开始 -->
    <div class="single-main clearfix">
        <section class="single-article fl">
            <article>
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <div class="header">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <div class="time fr">
                        <span><?php the_author(); ?></span>发布于<span><?php the_time('y-m-d H:i') ?></span>
                        <span class="fa fa-comment">&nbsp;<?php $id=$post->ID; echo get_post($id)->comment_count;?> </span>
                        <span class="fa fa-eye">&nbsp;<?php setPostViews(get_the_ID());echo getPostViews( get_the_ID() ); ?></span>
                    </div>
                </div>
                <div class="content">
                    <?php the_content(); ?>
                </div>
                <!-- 标签 -->
                <div class="tag clearfix">
                    <strong class="fa fa-tags"><?php the_tags('', ', ', ''); ?></strong>
                </div>
                <?php endif; ?>

                <!-- 点赞 -->





                <!-- 分享 -->
                <div class="bshare-custom icon-medium">
                    <span>分享到</span>
                    <a title="分享到QQ好友" class="bshare-qqim" href="javascript:void(0);"></a>
                    <a title="分享到微信" class="bshare-weixin" href="javascript:void(0);"></a>
                    <a title="分享到新浪微博" class="bshare-sinaminiblog" href="javascript:void(0);"></a>
                    <a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
                </div>
            </article>
            <div class="comments">
                <?php comments_template(); ?>
            </div>
        </section>
        <?php get_sidebar(); ?>
    </div>
    <!-- main结束 -->

    <?php get_footer(); ?>
    <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
    <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
</body>
</html>
