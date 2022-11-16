<?php
/*
  Template Name: Forum Cate  Page
 */
ob_start();  // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();
if (get_query_var('cate')) {
    $_SESSION['cate'] = get_query_var('cate');
}

$arrname = array(
    'post_type' => 'forum',
    'forum_category' => $_SESSION['cate'],
);
$myQueryname = new WP_Query($arrname);
if ($myQueryname->have_posts()):
    while ($myQueryname->have_posts()):
        $myQueryname->the_post();
        //LAY CATEGORY CUA CUSTOMPOST
        $id = get_the_ID();
        $term = wp_get_post_terms($id, 'forum_category');
        if (count($term) > 0) {
            $name = $term[0]->name;
        }
    endwhile;
endif;
wp_reset_query();
//===1  phan trang E ==========
?>
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">

        <div>
            <ul>
                <li class='back-link'><a href='<?php echo home_url('the-forum'); ?>'>留言區</a></li>
            </ul>
        </div>
        <div style="clear: both; height: 20px;"></div>
        <!-- LAY BAI TRONG FORUM THEO NHOM     -->
        <div class="blue-group">
            <div class="blue-title">
                <label><?php echo $name ?>
            </div>
            <!-- LAY TAT CA CAC THONG TIN TRONG FORUUM-->
            <ul class="article-list">
                <?php
                global $suite, $postCount;
                //===1  phan trang B ==========
                $intNumArticlePerPage = $postCount; // xac dinh so tin 
                if (isset($suite['intNumArticlePerPage'])) {
                    $intNumArticlePerPage = $suite['intNumArticlePerPage'];
                }

// LAY CAC DU LIEU CO BAN
                $arr = array(
                    'post_type' => 'forum',
                    'forum_category' => $_SESSION['cate'],
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'f_active',
                            'value' => 'on',
                        ),
                    )
                );
                $myQue = new WP_Query($arr);
// ===== 2 PHAN TRANG XAC DI SO TRANG  B==============
                $intPage = ceil(count($myQue->posts) / $intNumArticlePerPage);
                if (get_query_var('page')) {
                    $intCurrentPage = get_query_var('page') - 1;
                } else {
                    $intCurrentPage = 0;
                }
                if ($intCurrentPage >= $intPage) {
                    wp_redirect(get_page_permalink('Forum Page'));
                }
// LAY CAC THONG TIN TRONG POST TYPE FORUM VA VI TRI LAY DONG THONG TIN
                $argsforum = array(
                    'post_type' => 'forum',
                    'forum_category' => $_SESSION['cate'],
                    'posts_per_page' => $intNumArticlePerPage,
                    'offset' => $intCurrentPage * $intNumArticlePerPage,
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

                if ($myQuery->have_posts()):
                    while ($myQuery->have_posts()):
                        $myQuery->the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink();
                echo '/p/0/' . $_SESSION['cate'];
                        ?>">
        <?php the_title() ?>
                            </a>
                        </li>
                        <?php
                    endwhile;
                endif;
                wp_reset_query();

// ==== phan cac link cho cac trang va so trang
                if ($intPage > 1) {
                    ?>
                </ul>

                <ul class="pro-pagination">
                    <?php
                    $strUrlArticle = get_page_permalink('Forum Page');
                    /* << */
                    if ($intCurrentPage >= 1) {
                        echo '<li> <a href="' . $strUrlArticle . '"> << </a> </li> ';
                    } else {
                        echo ' ';
                    }
                    /* < */
                    if ($intPage > 1) {
                        if ($intCurrentPage >= 1) {
                            if ($intCurrentPage == 1) {
                                echo '<li><a href="' . $strUrlArticle . '"><</a></li> ';
                            } else {
                                echo '<li><a href="' . $strUrlArticle . '/' . $intCurrentPage . '"><</a> </li>';
                            }
                        } else {
                            echo ' ';
                        }
                    }

                    /* Same page */
                    if ($intCurrentPage == $intPage - 1) {
                        $intMin = $intCurrentPage - 1;
                        if ($intPage == 2) {
                            $intMin = $intCurrentPage;
                        }
                        for ($i = $intMin; $i < $intCurrentPage + 2; $i++) {
                            if ($i == $intPage) {
                                echo '<li class="selected">' . $i . '</li>';
                            } else {
                                echo ' <li><a href="' . $strUrlArticle . '/' . $i . '">' . $i . '</a> </li>';
                            }
                        }
                    } elseif ($intCurrentPage == 0) {
                        if ($intPage == 2) {
                            $intMax = 3;
                        } elseif ($intPage == 1) {
                            $intMax = 2;
                        } else {
                            $intMax = 4;
                        }

                        for ($i = $intCurrentPage + 1; $i < $intMax; $i++) {
                            if ($i == 1) {
                                echo '<li class="selected" >' . $i . '</li> ';
                            } else {
                                echo '<li><a href="' . $strUrlArticle . '/' . $i . '">' . $i . '</a> </li>';
                            }
                        }
                    } elseif ($intCurrentPage > 0 && $intCurrentPage < $intPage - 1) {
                        for ($i = $intCurrentPage; $i < $intCurrentPage + 3; $i++) {
                            if ($i == $intCurrentPage + 1) {
                                echo '<li class="selected" >' . $i . '</li> ';
                            } else {
                                echo '<li><a href="' . $strUrlArticle . '/' . $i . '">' . $i . '</a> </li>';
                            }
                        }
                    }

                    /* > */
                    if ($intPage > 1) {
                        if ($intCurrentPage < $intPage - 1) {
                            echo '<li><a href="' . $strUrlArticle . '/' . ($intCurrentPage + 2) . '">></a></li> ';
                        } else {
                            echo '';
                        }
                    }

                    /* >> */
                    if ($intCurrentPage < $intPage - 1) {
                        echo '<li><a href="' . $strUrlArticle . '/' . $intPage . '">>></a> </li>';
                    } else {
                        echo ' ';
                    }
                    ?>
                </ul>
                <?php
                // ==== phan cac link cho cac trang va so trang
            }
            ?>
        </div>
        <div style="float: right;margin-top: 10px">
            <?php
            echo $intPage;
            _e('頁, 的第', 'suite');
            echo $intCurrentPage + 1;
            _e('頁', 'suite');
            ?> 
        </div>

    </div>

    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
<?php get_sidebar() ?>
    </div>
</div>
<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
?>



