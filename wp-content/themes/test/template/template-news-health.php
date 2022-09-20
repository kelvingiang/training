<?php
global $post;
$args = array(
    'post_type' => 'news',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'news_category' => 'Health',
    //'meta_query' => array(
        //array(
            //'key' => '_metabox_show_at_home',
            //'value' => '1',
            //'compare' => '='
        //)
    //) 
    'offset' => 0, //lấy bài viết đầu tiên   

);
$wp_query = new WP_Query($args);
?>
<div class="row" >
    <?php
        $counts = $wp_query->found_posts; //đếm sô bài viết vừa gọi
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?><div class="col-md-6" id="news-slider">
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
    <div id="load-more">
        <a href="#!" class="btn ">Load more <i class="fas fa-chevron-double-down"></i></a>
    </div>
</div>
<?php if($counts > 3) : ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#load-more').click(function(){
            var offset = 3; //số lượng bài viết ban đầu
            jQuery.ajax({
                type: 'post',
                url: '<?php echo admin_url('admin-ajax.php') ?>',
                dataType: 'html',
                data: {
                    action: "loadmore", // tên action, dữ liệu gửi lên server
                    offset: offset,
                },
                success: function(res) {
                    jQuery('#news-slider').append(res);
                    offset = offset + 3; //tăng bài viết hiển thị
                    if(offset >= <?php echo $counts ?> ){
                        jQuery('#load-more').hide(); //ẩn button khi không còn bài viết hiển thị
                    }
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                }
            });
        })
    });
</script>
<?php endif ?>
