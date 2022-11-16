<?php
global $post;
foreach (get_the_category($post->ID) as $cat) {
    $catSlug = $cat->slug;
    $catName = $cat->name;
};
?>
<!--  
    phan nay kiem tra bang ajax, code xu ky ajax dc viet tai file js va dc add vao o dau trang (checkajax.js)
-->
<div style="height: 20px"></div>
<div class="blue-group ">
    <div class="blue-title">
        <label><?php echo $catName; ?> </label>
    </div>  
    <div style=" margin-top: 1px">
        <ul class="link-list">
            <?php
            global $suite;
            //===1  phan trang B ==========
            $intNumArticlePerPage = 10; // xac dinh so tin 
            if (isset($suite['intNumArticlePerPage'])) {
                $intNumArticlePerPage = $suite['intNumArticlePerPage'];
            }
            // LAY CAC DU LIEU CO BAN
            $arr = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'category_name' => $catSlug,
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
                'post_type' => 'post',
                'posts_per_page' => $intNumArticlePerPage,
                'offset' => $intCurrentPage * $intNumArticlePerPage,
                'category_name' => $catSlug,
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
                        <a style=" text-decoration: none" href="<?php the_permalink(); ?>/<?php echo get_query_var('page') == '' ? 1 : get_query_var('page'); ?>">
                    <?php the_title(); ?>
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
            <hr>
            <ul class="single-pagination">

                <?php
                $strUrlArticle = get_page_permalink('Forum Page');
                /* << */
                if ($intCurrentPage >= 1) {
                    echo '<li> <a href="' . $strUrlArticle . '"> |<  </a> </li> ';
                } else {
                    echo ' ';
                }
                /* < */
                if ($intPage > 1) {
                    if ($intCurrentPage >= 1) {
                        if ($intCurrentPage == 1) {
                            echo '<li><a href="' . $strUrlArticle . '"> < </a></li> ';
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
                            echo '<li class="selected2">' . $i . '</li>';
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
                            echo '<li class="selected2" >' . $i . '</li> ';
                        } else {
                            echo '<li><a href="' . $strUrlArticle . '/' . $i . '">' . $i . '</a> </li>';
                        }
                    }
                } elseif ($intCurrentPage > 0 && $intCurrentPage < $intPage - 1) {
                    for ($i = $intCurrentPage; $i < $intCurrentPage + 3; $i++) {
                        if ($i == $intCurrentPage + 1) {
                            echo '<li class="selected2" >' . $i . '</li> ';
                        } else {
                            echo '<li><a href="' . $strUrlArticle . '/' . $i . '">' . $i . '</a> </li>';
                        }
                    }
                }

                /* > */
                if ($intPage > 1) {
                    if ($intCurrentPage < $intPage - 1) {
                        echo '<li><a href="' . $strUrlArticle . '/' . ($intCurrentPage + 2) . '"> > </a></li> ';
                    } else {
                        echo '';
                    }
                }

                /* >> */
                if ($intCurrentPage < $intPage - 1) {
                    echo '<li><a href="' . $strUrlArticle . '/' . $intPage . '"> >| </a> </li>';
                } else {
                    echo ' ';
                }
                ?>
            </ul>
            <?php
            // ==== phan cac link cho cac trang va so trang
        }
        ?>

        <div style="clear: both"></div>
    </div>
</div>           

