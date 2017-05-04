    <?php get_header(); ?>

    <!-- banner开始 -->
    <section class="banner">
        <div class="svg-block">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1920 150">
                <path d="M 0,150 0,0 1920,0"></path>
            </svg>
        </div>
        <article class="content">
        <div class="show">
            <h1 class="scale"><?php bloginfo('name'); ?></h1>
            <p>永远相信美好的事情即将发生</p>
            <p>不，正在发生！</p>
            <div class="trans">
                <div class="animation">
                    <div id="cube">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
        </article>
        <div class="svg-block">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1920 150">
                <path d="M 1920,0 1920,150 0,150"></path>
            </svg>
        </div>
        <div class="sym"></div>
    </section>
    <!-- banner结束 -->

    <!-- main开始 -->
    <div class="main">
        <canvas id="canvas"></canvas>
        <section class="news">
            <section class="article-title scale">
                <h2>最新文章</h2>
                <span>Articles</span>
            </section>
            <section class="article-list clearfix">
                <?php query_posts('showposts=6 & cat=10'); ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article>
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail() ?></a>
                        <div class="con">
                            <h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <p class="time">
                                <span><?php the_time('y-m-d H:i') ?></span>
                                <span class="fa fa-comment">&nbsp;<?php $id=$post->ID; echo get_post($id)->comment_count;?> </span>
                                <span class="fa fa-eye">&nbsp;<?php echo getPostViews(get_the_ID()); ?></span>
                            </p>
                            <?php the_excerpt(); ?>
                            <p class="review"><a href="<?php the_permalink(); ?>" rel="bookmark">阅读全文</a></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_query(); ?>
            </section>
            <div class="more"><a href="/category/news">查看更多>></a></div>
        </section>
        <section class="demos">
            <section class="article-title scale">
                <h2>案例展示</h2>
                <span>Demos</span>
            </section>
            <section class="article-list clearfix">
                <?php query_posts('showposts=9 & cat=11'); ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article>
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail() ?></a>
                        <div class="con">
                            <h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <p class="time">
                                <span><?php the_time('y-m-d H:i') ?></span>
                                <span class="fa fa-comment">&nbsp;<?php $id=$post->ID; echo get_post($id)->comment_count;?> </span>
                                <span class="fa fa-eye">&nbsp;<?php echo getPostViews(get_the_ID()); ?></span>
                            </p>
                            <?php the_excerpt(); ?>
                            <p class="review"><a href="<?php the_permalink(); ?>" rel="bookmark">阅读全文</a></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_query(); ?>
            </section>
            <div class="more"><a href="/category/demos">查看更多>></a></div>
        </section>
        <section class="notes">
            <section class="article-title scale">
                <h2>前端笔记</h2>
                <span>Notes</span>
            </section>
            <section class="article-list clearfix">
                <?php query_posts('showposts=9 & cat=4'); ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article>
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail() ?></a>
                        <div class="con">
                            <h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <p class="time">
                                <span><?php the_time('y-m-d H:i') ?></span>
                                <span class="fa fa-comment">&nbsp;<?php $id=$post->ID; echo get_post($id)->comment_count;?> </span>
                                <span class="fa fa-eye">&nbsp;<?php echo getPostViews(get_the_ID()); ?></span>
                            </p>
                            <?php the_excerpt(); ?>
                            <p class="review"><a href="<?php the_permalink(); ?>" rel="bookmark">阅读全文</a></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_query(); ?>
            </section>
            <div class="more"><a href="/category/notes">查看更多>></a></div>
        </section>
    </div>
    <!-- main结束 -->

    <?php get_footer(); ?>

</body>
</html>
