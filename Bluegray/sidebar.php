<aside class="fr">
    <div class="news">
        <h3>最新文章</h3>
        <ul>
            <?php query_posts('showposts=10 & cat=10'); ?>
            <?php while (have_posts()) : the_post(); ?>
                <li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_query(); ?>
        </ul>
    </div>
    <div class="comments">
        <h3>近期评论</h3>
        <ul>
            <?php bg_recent_comments(); ?>
        </ul>
    </div>
    <div class="tags">
        <h3>标签云</h3>
        <div class="item">
            <?php wp_tag_cloud('number=20&orderby=count&order=DESC&smallest=12&largest=16&unit=px'); ?>
        </div>
    </div>
</aside>

