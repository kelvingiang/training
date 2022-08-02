<?php get_header(); ?>
<div class="row" style="padding-top: 30px" >
    <div class=" first-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php get_sidebar('category'); ?>
    </div>
    <div class="second-space col-lg-9 col-md-8 col-sm-12 col-xs12">
        <div class="group-border">
            <div class="group-title">
                <label><?php echo $wp_query->queried_object->name ?></label>
            </div>
            <div>
                <ul id="list">
                    <?php $pagamCate = get_query_var('cat'); ?>
                    <?php
                    global $wp_query;
                    $showNum = 30;
                    ?>

                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $showNum,
                        'orderby' => 'ID',
                        'order' => 'DESC',
                        'cat' => $pagamCate,
                    );
                    $wp_query = new WP_Query($args);
                    $itemCount = 1;
                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            ?>
                            <li class="itemRow" data_id ="<?php echo $itemCount++; ?>">
                                <a class="article-title" href="<?php the_permalink() ?>"><?php the_title(); ?> </a>
                            </li>   
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class=" last-space col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <?php// get_sidebar('mobile'); ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        // Biến dùng kiểm tra xem page đã scroll chưa
        var alreadyScroll = false;
        jQuery(window).scroll(function () {
            // Lấy ID cuối cùng của danh sách
            var lastID = jQuery('.itemRow:last').attr('data_id');
            var cateName = <?php echo $pagamCate ?>;
            var docHeight = jQuery(document).height();
            var winHeight = jQuery(window).height();
            // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện tải thêm dữ liệu.
            if (jQuery(window).scrollTop() === docHeight - winHeight && alreadyScroll === false) {

                // Gán page đã scroll
                //  alreadyScroll = true;
                jQuery.ajax({
                    url: ' <?php echo get_template_directory_uri() . '/ajax/load_news.php' ?>', // lay doi tuong chuyen sang dang array
                    type: "post",
                    data: {id: lastID, cate: cateName},
                    dataType: 'json',
                    cache: false,
                    //  contentType: false, // TAT DI 2 PHAN NAY GIA TRI POST MOI CHUYEN DI DC
                    //  processData: false,
                    success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                        if (data.status === 'done') {
                            jQuery('#list').append(data.html);
                            // location.reload();
                        } else if (data.status === 'error') {
                            jQuery('#mess').text(data.message);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.reponseText);
                    }
                });
            }
        });
    });
</script>
<?php
get_footer();
