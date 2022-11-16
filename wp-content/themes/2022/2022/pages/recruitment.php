<?php
/*
  Template Name: Recruitments Page
 */
?>
<?php
if (!isset($_SESSION['login'])) {
    wp_redirect(home_url());
}
?>
<?php
ob_start();  // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
get_header();
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php get_template_part('templates/template', 'advertising'); ?>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <?php
        // PHAN TRANG PHAN 1
        global $suite, $postCount;
        //===1  phan trang B ==========
        $intNumArticlePerPage = $postCount; // xac dinh so tin 
        if (isset($suite['intNumArticlePerPage'])) {
            $intNumArticlePerPage = $suite['intNumArticlePerPage'];
        }


        $arrRec = array(
            'post_type' => 'recruitment',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'recruitment_category' => 'ungtuyen',
            'meta_query' => array(
                array('key' => '_recruit_status', 'value' => 'on')
            ),
        );
        $recQuery = new WP_Query($arrRec);
        if (!$recQuery->have_posts()) {
            die();
        }
        // ===== 2 PHAN TRANG XAC DI SO TRANG  B==============
        $intPage = ceil(count($recQuery->posts) / $intNumArticlePerPage);
        if ($_GET['wp']) {
            $intCurrentPage = $_GET['wp'] - 1;
        } else {
            $intCurrentPage = 0;
        }

        // LAY CAC THONG TIN TRONG POST TYPE FORUM VA VI TRI LAY DONG THONG TIN
        $argsforum = array(
            'post_type' => 'recruitment',
            'posts_per_page' => $intNumArticlePerPage,
            'offset' => $intCurrentPage * $intNumArticlePerPage,
            'recruitment_category' => 'ungtuyen',
            'meta_query' => array(
                array(
                    'key' => '_recruit_status',
                    'value' => 'on',
                )
            ),
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $myQuery = new WP_Query($argsforum);

        //===== 2 phan trang xac dinh so trang E========
        ?>

        <ul class="recruiter-list">
            <?php
            global $post;
            if ($myQuery->have_posts()) :
                while ($myQuery->have_posts()) :
                    $myQuery->the_post();
            ?>
                    <li>
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        <label>發布 : <?php echo substr($post->post_date, 0, 10) ?></label>
                    </li>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </ul>

        <?php
        // 08-07-2022 FUNCTION PHAN TRANG ===========================
        $strUrlArticle = $wp_query->query['pagename'];
        my_paging($intPage, $intCurrentPage, $strUrlArticle);
        // ====================================================== 
        ?>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar() ?>
    </div>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
