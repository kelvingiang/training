<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-top: 2rem;">
    <div class="slider-multi-head"><h1></h1></div>
    <div class="slider-multi-list" id="news-slider">
        <?php
        $itemCount = 1;
        $wp_query = new WP_Query(getPostTypeNews('news', 3, 7, 0, ''));
        //$counts = $wp_query->found_posts; //đếm sô bài viết vừa gọi
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?><div class="slider-multi-item col-md-4"  data_id = "<?php echo $itemCount++; ?>">
                    <div class="slider-multi-img">
                        <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                            if($url != '') {?>
                                <img src="<?php echo $url[0]; ?>" class="w-100 img" />
                            <?php } else{ ?>
                                <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img" />
                        <?php } ?> 
                    </div>
                    <div class="slider-multi-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </div>
                    <div class="slider-multi-content">
                        <span ><?php the_content() ?></span>
                    </div>
                    <div class="slider-multi-read-more">
                        <a href="<?php echo get_the_permalink()?>"><?php esc_html_e('Đọc thêm', 'ntl-csw') ?></a>
                    </div>
                </div>
                <?php
            endwhile;
            endif;
        wp_reset_postdata();
        wp_reset_query();
    ?>
    </div>
    <div id="load-more">
        <!-- <a href="#!" class="btn ">Load more <i class="fas fa-chevron-double-down"></i></a> -->
        <svg style=" font-size: 35px; color: #999; height: 50px;" 
            class="svg-inline--fa fa-angle-double-down fa-w-10" 
            aria-hidden="true" focusable="false" data-prefix="fa" 
            data-icon="angle-double-down" role="img" xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 320 512" data-fa-i2svg="">
            <path fill="currentColor" d="M143 256.3L7 120.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 
                33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0L313 86.3c9.4 9.4 9.4 
                24.6 0 33.9l-136 136c-9.4 9.5-24.6 9.5-34 .1zm34 192l136-136c9.4-9.4 9.4-24.6 
                0-33.9l-22.6-22.6c-9.4-9.4-24.6-9.4-33.9 0L160 352.1l-96.4-96.4c-9.4-9.4-24.6-9.4-33.9 
                0L7 278.3c-9.4 9.4-9.4 24.6 0 33.9l136 136c9.4 9.5 24.6 9.5 34 .1z">
            </path>
        </svg>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#load-more').click(function(){
            button_load_more_news(7, "#news-slider");
        })
    });
</script>
