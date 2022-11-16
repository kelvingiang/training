<?php
$argsevent = array(
    'post_type' => 'event',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(array('key' => 'e_show', 'value' => 'on',))
);
$myQuery = new WP_Query($argsevent);
if ($myQuery->have_posts()):
    while ($myQuery->have_posts()):
        $myQuery->the_post();
        ?>

        <div class="brown-group">
            <div class="brown-title">
                <label> <?php the_title() ?> </label>
            </div>
            <div style="margin:10px 5px"><?php the_content_feed(); ?></div>
            <!--<div style=" margin: 0 10px 10px ; text-align: right"><a href="<?php the_permalink(); ?>" class="btn-sm"><?php _e('More'); ?></a></div>-->
        </div>
        <?php
    endwhile;
                    endif;
                    
