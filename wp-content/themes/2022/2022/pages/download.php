<?php
/*
  Template Name: Download Page
 */

// neu bao loi PHP Warning: Cannot modify header information ??headers already sent by
get_header();
?>

<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <div class='head-title'>
            <!-- <div class="title">
                <h2 class="head"> <?php // _e('Chamber of Commerce Bulletin') 
                                    ?> </h2>
            </div> -->
        </div>
        <div>
            <img src="<?php echo PART_IMAGES . 'download-panner.jpg' ?>" style=" width: 99%;" />
        </div>

        <?php
        $table = $wpdb->prefix . 'download';
        $sql = "SELECT * FROM $table WHERE kind = 1 AND trash = 0";
        $downloadList = $wpdb->get_results($sql, ARRAY_A);
        ?>
        <div class="download-space">
            <?php
            foreach ($downloadList as $val) {
                downloadItem($val);
            }
            ?>
        </div>

    </div>

    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar() ?>
    </div>
</div>
<div>
    <?php get_template_part('templates/template', 'footer') ?>
</div>
<?php
get_footer();
  // neu bao loi PHP Warning: Cannot modify header information ??headers already sent by