<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-top: 2rem;">
    <div class="slider-multi-head"><h1></h1></div>
    <div class="slider-multi-list" id="news-travel-list">
    <?php
        $wp_query = new WP_Query(getPostTypeNews('news', 2, 8, '', 1));
        $itemCount = 1;
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="slider-multi-item col-md-6" data_id = "<?php echo $itemCount++; ?>">
                    <div class="slider-multi-img">
                        <?php 
                        // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        if($url != '') {?>
                            <img src="<?php echo $url[0]; ?>" class="w-100 img" title="<?php the_title() ?>"/>
                        <?php } else{ ?>
                            <img src="<?php echo PART_IMAGES . 'no-image.jpg'; ?>" class="w-100 img" title="<?php the_title() ?>" />
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
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        //biến dùng kiểm tra xem page đã scroll chưa
        var alreadyScroll = true;
        jQuery(window).scroll(function() {
            scroll_load_more_news(2, 8, "#news-travel-list", alreadyScroll);
        })
    })
</script>
