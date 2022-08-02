<?php
global $post;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'category_name' => 'news',
    'meta_query' => array(
        array(
            'key' => '_metabox_prioritize',
            'value' => '0',
            'compare' => '='
        )
    )
);
$wp_query = new WP_Query($args);
?>
<div class="group-border">
    <div class="group-title">
        <label> <?php _e('News') ?></label>
    </div>

    <div>
        <ul class="article-list">
            <?php
            if ($wp_query->have_posts()):
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    ?>
                    <li>
                        <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
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

