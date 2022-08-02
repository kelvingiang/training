<?php
global $post;
$args = array(
    'post_type' => 'friendlylink',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'meta_key' => '_metabox_link_order',
);
$wp_query = new WP_Query($args);
?>
<div class="group-border">
    <div class="group-title">
        <label> <?php _e("Friendly Link") ?></label>
    </div>
    <div>
        <ul class="article-list">
            <?php
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                    <li>
                        <a class="article-title" href="<?php echo get_post_meta(get_the_ID(), '_metabox_link', true) ?>" target="blank"><?php the_title() ?></a>
                    </li>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>





