<?php
/*
  Template Name: Successive
 */
?>
<?php get_header(); ?>

<div class="row" style="padding-top: 30px" >
    <div class="first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
       <?php get_sidebar(); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="group-border">
            <div class="group-title">
                <label><?php _e('Successive President') ?></label>
            </div>
            <div style="padding: 10px">
                <section id="content" style=" text-align: center">
                    <ul class="successvice-list">
                        <?php
                        $args = array(
                            'post_type' => 'executive',
                            'posts_per_page' => -1,
                            'orderby' => 'meta_value',
                            'order' => 'DESC',
                            'meta_key' => '_metabox_order',
                            'meta_query' => array(
                                array(
                                    'key' => '_metabox_successive',
                                    'value' => '1',
                                    'compare' => '='
                                )
                            )
                        );
                        $wp_query = new WP_Query($args);

                        if ($wp_query->have_posts()):
                            while ($wp_query->have_posts()):
                                $wp_query->the_post();
                                ?>
                                <li>
                                    <div>     
                                        <?php //the_post_thumbnail('thumbnail');  ?>
                                        <?php if (has_post_thumbnail()): ?>
                                            <img src="<?php the_post_thumbnail_url() ?>" srcset="<?php the_post_thumbnail_url() ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div> <label style="color:  #055b8d"> <?php the_title(); ?></label></div>
                                    <div><label style="font-size: 12px; color: #666"><?php echo get_post_meta($post->ID, '_metabox_company', true); ?></label></div>
                                    <div><label style="font-size: 12px; color: #666"><?php echo get_post_meta($post->ID, '_metabox_prorogue', true); ?></label></div>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        wp_reset_query();
                        ?>
                    </ul>
                </section>  
            </div>
        </div>    
         <div><?php get_template_part('component/template', 'multi-silder') ?></div>
    </div>
       <div class="last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
       <?php get_sidebar('mobile'); ?>
    </div>
</div>
<style type="text/css">
    .successvice-list li{
        width: 240px;
        display: inline-block;
        text-align: center;
        border: 1px #ccc solid;
        margin: 5px;
        border-radius: 3px;
    }
    .successvice-list li img{
        width: 95%;
        padding: 5px;

    }
</style>
<?php get_footer(); ?>