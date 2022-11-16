<?php
global $post;
$terms = get_the_terms($post->ID, 'event_category');
$postName = 'event';
$postCate = $terms[0]->slug;
$postcateName = 'event_category';
$mainPostID = $post->ID;
?>
<!--  
    phan nay kiem tra bang ajax, code xu ky ajax dc viet tai file js va dc add vao o dau trang (checkajax.js)
-->
<div class="blue-group ">
    <div class="blue-title">
    </div>
    <div>
        <?php

        // LAY CAC DU LIEU CO BAN
        $arr = array(
            'post_type' => $postName,
            $postcateName => $postCate,
            'post_status' => 'publish',
            'posts_per_page' => COUNT_POST_ANOTHER,
            'meta_query' => array(
                array(
                    'key'       => '_metabox_language',
                    'value'     =>  $_SESSION['languages'],
                    'compare'   => '=',
                ),
            ),
        );
        $myQuery = new WP_Query($arr);

        //===== 2 phan trang xac dinh so trang E========

        if ($myQuery->have_posts()) : ?>
            <ul id="data-list" class="article-list">
                <?php $stt = 1;
                while ($myQuery->have_posts()) :
                    $myQuery->the_post();
                    if ($mainPostID == get_the_ID()) {
                        continue;
                    }
                ?>
                    <li data-id="<?php echo $stt ?>">
                        <a class="link-style" href="<?php the_permalink(); ?>?wp=<?php echo $_GET['wp'] == '' ? 1 : $_GET['wp']; ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
                <?php
                    $stt += 1;
                endwhile;
                ?>
            </ul>
            <div id="load-more">
                <i class="fa fa-angle-double-down" aria-hidden="true"></i>
            </div>
        <?php
        endif;
        wp_reset_query();
        ?>

        <div style="clear: both"></div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery('#load-more').click(function() {
            var lastID = jQuery("#data-list > li:last-child").attr("data-id");
            var mainPostID = '<?php echo $mainPostID ?>';
            var post = '<?php echo $postName ?>';
            var category = '<?php echo $postCate ?>';
            var categoryName = '<?php echo $postcateName ?>';
            var language = '<?php echo $_SESSION['languages'] ?>';

            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/load-custom-category-more.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post', //                data: $(this).serialize(),
                data: {
                    lastID: lastID,
                    mainPostID: mainPostID,
                    post: post,
                    category: category,
                    categoryName: categoryName,
                    language: language,
                },
                dataType: 'json',
                success: function(
                    data) { // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'done') {
                        jQuery("#data-list").append(data.html);
                    } else if (data.status === 'empty') {
                        jQuery("#load-more").hide();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.reponseText);
                    //console.log(data.status);
                }
            });
        });
    });
</script>