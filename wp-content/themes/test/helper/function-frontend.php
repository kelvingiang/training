<?php

//======================== POST TYPE ==========================
function getPostType($postType, $showNum, $cateID, $offset, $paged)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'orderby' => '_metabox_order',
        'order' => 'DESC',
        'cat' => $cateID,
        // 'meta_query' => array(
        //     array(
        //         'key' => '_metabox_show_at_home',
        //         'value' => '1',
        //         'compare' => '='
        //     )
        // )    
        'orderby' => 'ID',
        'order' => 'DESC',
        'offset' => $offset,
        'paged' => $paged, 
    );
    return $args;
}

function getPostTypeNews($postType ,$showNum , $cateID, $offset, $paged)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'orderby' => '_metabox_order',
        'order' => 'DESC',
        //'meta_query' => array(
            //array(
                //'key' => '_metabox_show_at_home',
                //'value' => '1',
                //'compare' => '='
            //)
        //) 
        'tax_query' => array(
            array(
                'taxonomy' => 'news_category',
                'field' => 'term_id',
                'terms'    => $cateID
            ),
        ),
        'offset' => $offset, //lấy bài viết đầu tiên   
        'paged' => $paged,
    );
    return $args;
}

function getPostTypeSlider($postType,$cateID, $showNum)
{
    $args = array(
        'post_type' => $postType,
        'posts_per_page' => $showNum,
        'post_status' => 'publish',
        'orderby' => '_metabox_order',
        'order' => 'DESC',
        //'slide-cat' => $cateID,
        'tax_query' => array(
            array(
                'taxonomy' => 'slide_category',
                'field' => 'term_id',
                'terms' => $cateID,
            ),
        ),
    );
    return $args;
}

//========================= RELATE POST =====================
function getRelatePostNews($postType, $showNum, $cateID)
{
    // $term = ''; 
    // $terms = get_the_terms( get_the_ID() , 'news_category' );
    // foreach ( $terms as $term ) {
    // $term = $term->slug;
    // }
    global $post;
    $args = array(
        'post_type' => $postType,
        'posts_per_page'=> $showNum,
        'post_status' => 'publish',
        'orderby' => '_metabox_order',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'news_category',
                'field' => 'id',
                'terms' => $cateID,
            )
        ),
        'post__not_in'  => array($post->ID),
    );
    return $args;
}

//====================== LOAD MORE =========================
//Xu ly loadmore theo button phia server
add_action( 'wp_ajax_nopriv_loadmore', 'prefix_load_more' );
add_action( 'wp_ajax_loadmore', 'prefix_load_more' );
function prefix_load_more(){
    $offset = !empty($_POST['offset']) ? intval( $_POST['offset'] ) : ''; //lay du lieu gui len client 
    $showNum = 3;
    $cateID = $_POST['cateID'];
    if($offset) {
        $wp_query = new WP_Query(
            $args = array(
                'post_type' => 'news',
                'posts_per_page' => $showNum,
                'post_status' => 'publish',
                'offset' => $offset,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'news_category',
                        'field' => 'term_id',
                        'terms'    => $cateID
                    ),
                ),
            )
        );
        if($wp_query->have_posts()) : 
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?><div class="slider-multi-item col-md-4">
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
    }
    die();
}

//Xu ly loadmore theo scroll phia server
add_action( 'wp_ajax_nopriv_scrolling_loadmore', 'prefix_scrolling_load_more' );
add_action( 'wp_ajax_scrolling_loadmore', 'prefix_scrolling_load_more' );
function prefix_scrolling_load_more(){
    $paged = $_POST['page'];
    $offset = $_POST['id'];
    $cateID = $_POST['cateID'];
    $showNum = 2;
    $wp_query = new WP_Query(
        $args = array(
            'post_type' => 'news',
            'posts_per_page' => $showNum,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'news_category',
                    'field' => 'term_id',
                    'terms'    => $cateID
                ),
            ),
            'paged' => $paged,
        )
    );
    if($paged){
        if ($wp_query->have_posts()):
            while ($wp_query->have_posts()):
                $wp_query->the_post();
                ?>
                <div class="slider-multi-item col-md-6" data_id = "<?php echo ++$offset; ?>">
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
    }
    die();
}

//======================== GET SLIDER ======================
function mySlider($cateID)
{
    ?>
        <div class="skitter skitter-large with-dots skitters" style="max-width:initial;">
            <ul>
                <?php
                $wp_query = new WP_Query(getPostTypeSlider('slider', $cateID, 5));
                if ($wp_query->have_posts()):
                    while ($wp_query->have_posts()):
                        $wp_query->the_post();
                        ?>
                        <li>
                            <a href="#cubeStop"></a>
                            <?php 
                            // [0]: url, [1]: width, [2]: height, [4]:is_intermediate
                            $url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                ?>
                            <img src="<?php echo $url[0]; ?>" class="cubeStop image-skitter"/> 
                        </li>
                        <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                wp_reset_query();
            ?>
            </ul>
        </div>
    <?php
}