<?php
global $post;
$args = array(
    'post_type' => 'news',
    'posts_per_page' => 2,
    'post_status' => 'publish',
    'news_category' => 'Travel',
    // 'meta_query' => array(
    //     array(
    //         'key' => '_metabox_show_at_home',
    //         'value' => '1',
    //         'compare' => '='
    //     )
    // )    
    'paged' => 1,
    
);
$wp_query = new WP_Query($args);
?>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="slider-multi-head"><h1></h1></div>
    <div class="slider-multi-list" id="news-travel-list">
    <?php
        $itemCount = 1;
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="multi-item col-md-6" data_id = "<?php echo $itemCount++; ?>">
                    <div class="slider-multi-img">
                        <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                        ?>
                        <img src="<?php echo $url[0]; ?>" class="w-100 img" />
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
    var page = 2;
    jQuery(document).ready(function() {
        //biến dùng kiểm tra xem page đã scroll chưa
        var alreadyScroll = true;
        jQuery(window).scroll(function() {
            //lấy id cuối cùng của danh sách
            var lastID = jQuery('.slider-multi-item-travel:last').attr('data_id');
            var docHeight = jQuery(document).height();
            var winHeight = jQuery(window).height();
            //nếu màn hình đang ở dưới cuối thẻ thực hiển tải thêm dữ liệu
            if(jQuery(window).scrollTop() > (docHeight - winHeight) && alreadyScroll == true){
                jQuery.ajax({
                    //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: "post",
                    dataType: 'html',
                    cache: false,
                    data: {
                        id: lastID,
                        action: 'scrolling_loadmore',
                        page: page,
                    },
                    success: function(res) {
                        jQuery('#news-travel-list').append(res);
                        page++;
                        var $target = jQuery('html,body');
                        $target.animate({
                            scrollTop: $target.height()
                        }, 2000);
                    },
                    error: function (xhr) {
                        console.log(xhr.reponseText);
                    }
                })
            }
        })
    })
</script>
