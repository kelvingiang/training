<?php get_header(); ?>
<div class="row" style="padding-top: 30px" >
    <div class=" first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs12">

        <div class="group-border">
            <div class="group-title">
                <label><?php _e("Search Result ") ?></label>
            </div>
            <div>
                <ul class="article-list">
                    <?php
                    $s = get_query_var('s');
                    if (!empty($s)) {
                        global $wp_query;
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => -1,
                            's' => $s,
                            'post_status' => 'publish',
                            'orderby' => 'title',
                            'order' => 'ASC'
                        );
                        $wp_query = new WP_Query($args);


                        if ($wp_query->have_posts()) {
                            while ($wp_query->have_posts()):
                                $wp_query->the_post();
                                ?>
                                <li>
                                    <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                </li>
                                <?php
                            endwhile;
                        }else {
                            ?>
                            <li> <?php _e('search not found anything data') ?> </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li> <?php _e('search not found anything data') ?> </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>

    </div>

    <div class=" last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
<?php get_sidebar('mobile'); ?>
    </div>

</div>
<?php
get_footer();
