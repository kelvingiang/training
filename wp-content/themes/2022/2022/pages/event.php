<?php
/*
  Template Name: Eventsss  Page
 */
?>

<?php
global $suite, $postCount;
ob_start();  // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
get_header();
?>
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <div class='head-title'>
            <div class="title">
                <h2> <?php _e('本會活動') ?> </h2>
            </div>
        </div>
        <div>
            <?php
            $argsevent = array(
                'post_type' => 'event',
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_query' => array(array('key' => 'e_show', 'value' => 'on',))
            );
            $wp_query = new WP_Query($argsevent);
            if ($wp_query->have_posts()) :
                while ($wp_query->have_posts()) :
                    $wp_query->the_post();
            ?>
                    <div class="blue-group">
                        <div class="blue-title">
                            <label> <?php the_title() ?> </label>
                        </div>
                        <div style="margin:10px 5px"><?php the_content_feed(); ?></div>
                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>

        <div style="height: 20px; clear: both; border-bottom: 3px #0066cc solid"></div>
        <ul id="data-list" class="article-list">
            <?php
            // lay cac tin trong ban 
            $argsforum = array(
                'post_type' => 'event',
                'posts_per_page' => $postCount,
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $myQuery = new WP_Query($argsforum);

            //===== 2 phan trang xac dinh so trang E========

            if ($myQuery->have_posts()) :
                $stt = 1;
                while ($myQuery->have_posts()) :
                    $myQuery->the_post();
            ?>
                    <li data-id="<?php echo $stt ?>">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
            <?php
                    $stt += 1;
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </ul>
        <div id="load-more">
            <i class="fa fa-angle-double-down" aria-hidden="true"></i>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar() ?>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('#load-more').click(function() {
            var lastID = jQuery("#data-list > li:last-child").attr("data-id");
            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/load-event.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post', //                data: $(this).serialize(),
                data: {
                    lastID: lastID
                },
                dataType: 'json',
                success: function(data) { // set ket qua tra ve  data tra ve co thanh phan status va message
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


<?php
get_footer();
ob_flush();   // neu bao loi PHP Warning: Cannot modify header information – headers already sent by
