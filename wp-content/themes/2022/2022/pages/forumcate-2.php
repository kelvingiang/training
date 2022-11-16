<?php
/*
  Template Name: Forum Cate  Page
 */
ob_start();  // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();
if (get_query_var('cate')) {
    $_SESSION['cate'] = get_query_var('cate');
}
?>
<div class="row">
    <div class="col-md-8">

        <div>
            <ul>
                <li class='back-link'><a href='<?php echo home_url('the-forum'); ?>'>留言區</a></li>
            </ul>
        </div>
        <div style="clear: both; height: 20px;"></div>
        <!-- LAY BAI TRONG FORUM THEO NHOM     -->
        <div class="blue-title">
            <h3 class="blue-title-text"><?php echo $name ?></h3>
        </div>
        <!-- LAY TAT CA CAC THONG TIN TRONG FORUUM-->
        <ul class="article-list">
            <?php
            $paged = max(1, get_query_var('paged'));
            $showNum = 9;
            $offset = ($paged - 1) * $showNum;
            // LAY CAC THONG TIN TRONG POST TYPE FORUM VA VI TRI LAY DONG THONG TIN
            $argsforum = array(
                'post_type' => 'forum',
                'forum_category' => $_SESSION['cate'],
                'posts_per_page' => $showNum,
                'offset' => $offset,
                'paged' => $paged,
                'meta_query' => array(
                    array(
                        'key' => 'f_active',
                        'value' => 'on',
                    )
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $myQuery = new WP_Query($argsforum);

            //===== 2 phan trang xac dinh so trang E========

            if ($myQuery->have_posts()) :
                while ($myQuery->have_posts()) :
                    $myQuery->the_post();
            ?>
            <li>
                <a href="<?php the_permalink();
                                    echo '/p/0/' . $_SESSION['cate']; ?>">
                    <?php the_title() ?>
                </a>
            </li>
            <?php
                endwhile;
            endif;
            wp_reset_query();
            echo ' </ul>';
            // PHAN TRANG      
            require_once(DIR_CODES . 'paging.php');
            $new_paging = new Codes_Paging;
            echo '<div class="pagination">' . $new_paging->show_paging($myQuery) . '</div>';
            ?>
    </div>


    <div class="col-md-4">
        <?php get_sidebar() ?>
    </div>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by