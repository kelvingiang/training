<?php
$args = array(
    'post_type' => 'executive',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'meta_key' => '_metabox_order',
    'meta_query' => array(
        array(
            'key' => '_metabox_current',
            'value' => '1',
            'compare' => '='
        )
    )
);
$wp_query = new WP_Query($args);
?>

<div class="group-border">
    <div class="group-title">
        <label><?php echo _e('Staff member') ?></label> 
    </div>
    <div>
        <?php
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="president">
                    <?php if (has_post_thumbnail()): ?>
                        <img src="<?php the_post_thumbnail_url() ?>" />
                    <?php endif; ?>
                    <h4><?php the_title() ?> <i style="font-size: 13px; color: #999"><?php echo get_post_meta(get_the_ID(), '_metabox_job_title', TRUE); ?></i></h4>  
                    <label style="font-weight:  normal;  color: #999"><?php echo get_post_meta(get_the_ID(), '_metabox_company', TRUE) ?> </label>
                </div>    
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</div>