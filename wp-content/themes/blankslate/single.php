<?php get_header(); ?>
<div class="row">
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs-">
        <section id="content" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <h3 class="h3-title"><?php the_title(); ?></h3> 
                    <?php the_content(); ?>
                    <?php // get_template_part( 'entry' ); ?>
                    <?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
                    <?php
                endwhile;
            endif;
            ?>
            <footer class="footer">
                <?php //get_template_part('nav', 'below-single'); ?>
            </footer>
        </section>
        <hr />
        <?php

        $cat = get_the_category();

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 20,
            'post__not_in' => array(get_the_ID()),
            'cat' => $cat[0]->cat_ID,
        );

        $wp_query = new WP_Query($args);
        ?>
        <ul class="article-list">
            <?php
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                    <li> <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title() ?></a></li>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </ul>
            <div style="text-align: right; margin-right: 15px; margin-top: 30px">
                <a class="btn btn-primary "  
                   href="<?php echo get_term_link($cat[0]->slug, $cat[0]->taxonomy) ?>"> 
                    <?php _e('More') ?></a>
            </div>

    </div>
    <div class="last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('mobile'); ?>
    </div>
</div>
<?php get_footer();
