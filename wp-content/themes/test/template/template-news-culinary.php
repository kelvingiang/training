<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-top: 2rem;">
    <div class="slider-multi-head"><h1></h1></div>
    <?php
        global $wp_query;
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) { //'page' is used instead of 'paged' on Static Front Page
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $showNum = 2;
        $offset = ($paged - 1) * $showNum;
        $_SESSION['offset'] = $offset;
        $wp_query = new WP_Query(getPostTypeNews('news', $showNum, 9, $offset, $paged));
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="slider-multi-item col-md-6">
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
        numeric_pagination($paged);
        wp_reset_postdata();
        wp_reset_query();
    ?>
</div>
