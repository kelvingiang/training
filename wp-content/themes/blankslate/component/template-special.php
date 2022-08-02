<?php
global $post;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
     'meta_query' => array(
                array(
                    'key' => '_metabox_prioritize',
                    'value' => '1',
                    'compare' => '='
                )
            )
);
$wp_query = new WP_Query($args);
?>
<div class="group-border">
    <div class="group-title">
        <label><?php _e('Latest News');?></label>
    </div>
    <div>
        <ul class="article-list">
            <?php
            if ($wp_query->have_posts()) :
                while ($wp_query->have_posts()):
                    $wp_query->the_post();
                    $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    ?>
                    <li>
                        <div>
                            <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        </div> 
                        <div>
                            <?php if (!empty($url)) { ?>
                                <img src="<?php echo $url[0] ?>" style="width: 30%; float: left; margin: 10px"/>
                            <?php } ?>
                            <?php the_content_feed(); ?>  
                        </div>
                        <div class="clear"></div>
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

