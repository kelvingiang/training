<div class="group-border">
    <div class="group-title"> <label><?php _e('Sponsor'); ?></label></div>
    <div>
        <?php
        $arr = array(
            'post_type' => 'sponsor',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'meta_key' => '_metabox_link_order',
                //  'cat' => 16
        );
        $my_query = new WP_Query($arr);
        ?>
        <ul id="flexisel">
            <?php
            if ($my_query->have_posts()) {
                while ($my_query->have_posts()) {
                    $my_query->the_post();
                    $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                    $objImageData = get_post(get_post_thumbnail_id(get_the_ID()));
                    $strAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                    ?>
                    <li>      
                        <a href="<?php echo get_post_meta(get_the_ID(), '_metabox_link', true) ?>" target="_blank">
                            <div class="box">
                                <div style="height: 170px;  margin: 0 auto; line-height: 170px">
                                    <img  src="<?php echo $images[0]; ?>"  alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                                </div>
                                <div class="nbs-flexisel-title" style=" line-height: 100px">
                                    <label style="height: 150px;  font-size: 13px; text-align: left; margin: 0 5px"><?php the_title(); ?></label> 
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php
                }
                wp_reset_postdata();
                wp_reset_query();
            }
//            if (is_page()) {
//                $item = 4;
//            } else {
//                $item = 4;
//            }
            ?>
        </ul>
        <div class="clearout"></div>
        <script type="text/javascript">
            var item;
            jQuery(document).ready(function () {
                var item ;
                var maxwidth = jQuery('#wrapper').css('width');
                var ww = maxwidth.slice(0,-2);
                if(ww <= 1170 ){
                    item=3;
                }


                jQuery("#flexisel").flexisel({
                    visibleItems:item ,
                    animationSpeed: 1000,
                    autoPlay: false,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    vertical: false,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 1
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 2
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 3
                        }
                    }
                });
            });
        </script>    
    </div>
</div>