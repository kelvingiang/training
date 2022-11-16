<?php
/*
  Template Name: Forum Page
 */
ob_start();  // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();

//===1  phan trang E ==========
?>
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <div class='head-title'>
            <div class="title">
                <h2 class="head"> <?php _e('留言區 ', 'suite'); ?> </h2>

            </div>
        </div>
        <!--LAY TAT CAC CATEGORY VA DUA VA CATEGORY DO LAY MOT CATEGORY 5 DONG DU LIEU-->
        <?php
        // PHAN LAY ALL CATEGORY IN FORUM TYPE
        $arrCate = array(
            'type' => 'post',
            'taxonomy' => 'forum_category',
        );
        $forum_cate = get_categories($arrCate);
        echo '<ul>';
        foreach ($forum_cate as $item) {
            ?>
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <div class="blue-group" style="display: block">
                            <div class="blue-title"><label><?php echo $item->name ?></label></div>
                            <div class="article-list">
                                <?php
                                $arr_1 = array(
                                    'post_type' => 'forum',
                                    'forum_category' => $item->slug,
                                    'posts_per_page' => '5',
                                    'orderby' => 'date',
                                    'order' => 'DECS',
                                    'meta_query' => array(
                                        array(
                                            'key' => 'f_active',
                                            'value' => 'on',
                                        // 'compare' => 'IN',
                                        ))
                                );
                                $myQuery_1 = new WP_Query($arr_1);
                                if ($myQuery_1->have_posts()):
                                    while ($myQuery_1->have_posts()):
                                        $myQuery_1->the_post();
                                        /* LAY CATEGORY CUA CUSTOMPOST */
                                        $id1 = get_the_ID();
                                        $term1 = wp_get_post_terms($id1, 'forum_category');
                                        if (count($term1) > 0) {
                                            $slug1 = $term1[0]->slug;
                                        }
                                        $url_link = get_permalink() . '/p/0/' . $slug1;
                                        /*   $url_link= get_permalink(); */
                                        ?>
                                <div style="min-height: 30px; border-bottom: 1px dotted #333; padding-left: 5px; line-height: 30px">
                                            <a href="<?php echo $url_link; ?>" style="text-decoration: none; font-weight: bold; display: block"> <?php the_title(); ?>  </a>
                                        </div>
                                        <?php
                                    endwhile;
                                endif;
                                wp_reset_query();
                                ?>
                            </div>
                                <!--TAO PATH LINK CO THAN THIEN VA KHONG THAN THIEN QUA VIET PAGENAME-->
                                <?php
                                /* PHAN CHO PHAN TRANG KIEU CU
                                  //      $url =   home_url('forum-cate').'/p/0/'.$slug1;
                                  //      PHAN CHO PHAN TRANG KIEU MOI */
                                $url = home_url('forum-cate') . '/c/' . $slug1;
                                ?>
                                <div style="margin: 5px 10px; text-align: right" >
                                    <a  href="<?php echo $url; ?>" style=" text-decoration: none"><?php _e('More') ?></a>
                                </div>
                            </div>   
                        </div>    
                    </div>
                    <div style="clear: both; padding-top: 30px"></div>   
            </li>    
        <?php } echo '</ul>'; ?>

    </div>

    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar() ?>
    </div>
</div>
<?php
get_footer();
ob_flush();
?>



