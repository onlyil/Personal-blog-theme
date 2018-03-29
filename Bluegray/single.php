<?php get_header(); ?>


    <!-- main开始 -->
    <div class="single-body">
        <div class="single-main clearfix">
        <section class="single-article">
            <article>
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <div class="header">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <div class="time">
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
            </article>
            <div class="comments">
                <?php comments_template(); ?>
            </div>
        </section>
        <?php get_sidebar(); ?>
        </div>
    </div>
    <!-- main结束 -->

    <?php get_footer(); ?>
</body>
</html>
