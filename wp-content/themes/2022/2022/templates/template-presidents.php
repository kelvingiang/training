<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class='head-title'>
            <h2 class="head"> 歷 屆 會 長 </h2>
        </div>

        <?php
        require_once DIR_CODES . 'my-list.php';
        $myList = new Codes_My_List();
        $countryList = $myList->countryList();

        foreach ($countryList as $key => $val) {

            $args = array(
                'post_type' => 'president',
                'posts_per_page' => -1,
                'meta_query' => array(
                    'relation' => 'AND',
                    'event_start_branch' => array(
                        'key' => '_president_branch',
                        'value'   => $key,
                        'compare' => 'EXISTS',
                    )

                ),
                'orderby' => array(
                    'event_start_branch' => 'ASC',
                    'event_start_year' => 'DESC',
                ),
            );
            $wp_query = new WP_Query($args);

            if ($wp_query->have_posts()) :
        ?>

                <div class="president-list" data-target="<?php echo $key ?>">
                    <h4 class="branch-name" data-target="<?php echo $key ?>"><?php echo $val ?></h4>
                    <?php
                    while ($wp_query->have_posts()) :
                        $wp_query->the_post();
                    ?>
                        <div class=" president-list-item <?php echo $key ?>">
                            <div class="row  my_list  ">
                                <div class=" col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                    <label style="margin-left: 10px; font-size: 18px"> <?php the_title(); ?></label>
                                </div>
                                <div class=" col-md-3 col-lg-3 col-sm-3 col-xs-6">
                                    <label style="margin-left: 10px"> <?php echo get_post_meta(get_the_ID(), '_president_year', true); ?> 年 度 </label>
                                </div>
                                <div class=" col-md-3 col-lg-3 col-sm-3 col-xs-6">
                                    <label style="margin-left: 10px"> 第 <?php echo get_post_meta(get_the_ID(), '_president_term', true); ?> </label>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>
                </div>
        <?php
            endif;
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery('.0001').slideDown();

        jQuery('.branch-name').click(function() {
            var _showClass = jQuery(this).data('target');
            var ss = "." + _showClass;
            jQuery(ss).slideToggle();
        });
    });
</script>