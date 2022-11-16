<?php
/*
  Template Name: Recruiter Page
 */
ob_start();  // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
get_header();
?>
<div class="row">
    <div>
        <?php get_template_part('templates/template', 'advertising'); ?>
    </div>

    <?php
    if (!isset($_SESSION['login'])) {
        wp_redirect(home_url());
    }

    $place_url = get_query_var('place', '');
    $career_url = get_query_var('cat', '');

    global $post, $postCount;
    //===1  phan trang B ==========
    $intNumArticlePerPage = $postCount; // xac dinh so tin 

    if (isset($suite['intNumArticlePerPage'])) {
        $intNumArticlePerPage = $suite['intNumArticlePerPage'];
    }
    ?>

    <div>
        <?php
        $arrRec = array(
            'post_type' => 'recruitment',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'recruitment_category' => 'dangtuyen',
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

        if (isset($_GET['wp'])) {
            $intCurrentPage = $_GET['wp'] - 1;
        } else {
            $intCurrentPage = 0;
        }
        //        if ($intCurrentPage >= $intPage) {
        //            wp_redirect(get_page_permalink('Forum Page'));
        //        }
        // LAY CAC THONG TIN TRONG POST TYPE FORUM VA VI TRI LAY DONG THONG TIN
        if (!empty($place_url) && empty($career_url)) {
            // echo '  lay du lieu theo place';
            $argsforum = array(
                'post_type' => 'recruitment',
                'posts_per_page' => $intNumArticlePerPage,
                'offset' => $intCurrentPage * $intNumArticlePerPage,
                'recruitment_category' => 'dangtuyen',
                'meta_query' => array(
                    array(
                        'key' => '_recruit_status',
                        'value' => 'on',
                    ),
                    array(
                        'key' => '_recruit_place',
                        'value' => $place_url,
                    )
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif (empty($place_url) && !empty($career_url)) {
            //echo 'lay du lieu theo career';
            $argsforum = array(
                'post_type' => 'recruitment',
                'posts_per_page' => $intNumArticlePerPage,
                'offset' => $intCurrentPage * $intNumArticlePerPage,
                'recruitment_category' => 'dangtuyen',
                'meta_query' => array(
                    array(
                        'key' => '_recruit_status',
                        'value' => 'on',
                    ),
                    array(
                        'key' => '_recruit_career',
                        'value' => $career_url,
                    )
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif (!empty($place_url) && !empty($career_url)) {
            //         echo 'lay du lieu theo 2 phan  place va career';
            $argsforum = array(
                'post_type' => 'recruitment',
                'posts_per_page' => $intNumArticlePerPage,
                'offset' => $intCurrentPage * $intNumArticlePerPage,
                'recruitment_category' => 'dangtuyen',
                'meta_query' => array(
                    array(
                        'key' => '_recruit_status',
                        'value' => 'on',
                    ),
                    array(
                        'key' => '_recruit_place',
                        'value' => $place_url,
                    ),
                    array(
                        'key' => '_recruit_career',
                        'value' => $career_url,
                    )
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } else {
            $argsforum = array(
                'post_type' => 'recruitment',
                'posts_per_page' => $intNumArticlePerPage,
                'offset' => $intCurrentPage * $intNumArticlePerPage,
                'recruitment_category' => 'dangtuyen',
                'meta_query' => array(
                    array(
                        'key' => '_recruit_status',
                        'value' => 'on',
                    ),
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        }
        $myQuery = new WP_Query($argsforum);

        //===== 2 phan trang xac dinh so trang E========
        ?>
        <div class="my-loading">
            <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>


        <div class="row" style="color:#666">
            <?php
            require_once DIR_CODES . 'my-list.php';
            $myList = new Codes_My_List;
            $placeList = $myList->PlaceList();
            $careerList = $myList->CareerList();
            ?>
            <div class="col-lg-3 form-group">
                <label>
                    <?php _e('Search By Area') ?>
                </label>
                <select id="sel_place" name="sel_place" class="form-select">
                    <?php foreach ($placeList as $key => $val) { ?>
                        <option value="<?php echo $key ?>" <?php echo $place_url == $key ? 'selected="selected"' : '' ?>>
                            <?php echo $val ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-lg-3">
                <label>
                    <?php _e('Search By Job Title') ?>
                </label>
                <select id="sel_career" name="sel_career" class="form-select">
                    <?php foreach ($careerList as $key => $val) { ?>
                        <option value="<?php echo $key ?>" <?php echo $career_url == $key ? 'selected="selected"' : '' ?>>
                            <?php echo $val ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <ul class="recruiter-list" style=" padding-left: 10px; width: 100%; margin-top:1rem">
            <?php
            if ($myQuery->have_posts()) {
                while ($myQuery->have_posts()) :
                    $myQuery->the_post();
                    $placeMeta = get_post_meta($post->ID, '_recruit_place', TRUE);
            ?>
                    <li>
                        <a href="<?php the_permalink() ?>">
                            <?php the_title() ?>
                        </a>
                        <label>
                            <?php echo __('Post Date') . ' : ' .  substr($post->post_date, 0, 10); ?>
                        </label>
                    </li>
                <?php
                endwhile;
                ?>
        </ul>
    <?php
                // 08-07-2022 FUNCTION PHAN TRANG ===========================
                $strUrlArticle = $wp_query->query['pagename'];
                my_paging($intPage, $intCurrentPage, $strUrlArticle);
                // ======================================================         
            } else {
    ?>
        <div style=' display: flex; justify-content: center;  align-items:flex-start; letter-spacing: 1px'>
            <h2> <?php _e('Can not find any data') ?></h2>
        </div>
    <?php
            }
            wp_reset_postdata();
    ?>
    </div>


</div>

<script>
    jQuery('document').ready(function() {
        var cc = "<?php echo $career_url ?>";
        var pp = "<?php echo $place_url ?>";
        var my_url = '';
        // if (window.location.origin === 'http://localhost') {
        //     my_url = window.location.origin + '/ctcvn.vn/';
        // } else {
        my_url = '<?php echo HOME_LINK ?>';
        // }

        jQuery('#sel_place').on('change', function() {
            //            alert(window.location.origin);
            jQuery('.my-loading').css('display', 'block');
            var pageURL = '';
            if (cc === ' ') {
                pageURL = my_url + 'recruiter?place=' + jQuery(this).val();
            } else {
                if (jQuery(this).val() === '00') {
                    pageURL = my_url + 'recruiter?cat=' + cc;
                } else {
                    pageURL = my_url + 'recruiter?place=' + jQuery(this).val() + '&cat=' + cc;
                }
            }
            window.location.href = pageURL;
            //  jQuery('.my-waiting').css('display', 'none');
        });

        jQuery('#sel_career').on('change', function() {
            jQuery('.my-loading').css('display', 'block');
            var pageURL = '';
            if (pp === ' ') {
                pageURL = my_url + 'recruiter?cat=' + jQuery(this).val();
            } else {
                if (jQuery(this).val() === '00') {
                    pageURL = my_url + 'recruiter?place=' + pp;
                } else {
                    pageURL = my_url + 'recruiter?place=' + pp + '&cat=' + jQuery(this).val();
                }
            }
            window.location.href = pageURL;
        });
    });
</script>

<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information – headers already sent by