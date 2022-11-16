<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="blue-group">
    <div class="blue-title">
        <h3 class="blue-title-text"> <?php echo _('理監事成員'); ?> </h3>
    </div> 
    <div style=" margin-top: 10px">
        <ul>
            <?php
            $speacilArr = array(
                'post_type' => 'supervisor',
                'posts_per_page' => -1,
                'meta_query' => array(array('key' => '_admin_metabox_special', 'value' => 'on',))
            );
            $query_special = new WP_Query($speacilArr);
            if ($query_special->have_posts()) {
                while ($query_special->have_posts()) {
                    $query_special->the_post();
                    $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                    $objImageData = get_post(get_post_thumbnail_id(get_the_ID()));
                    $strAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                    ?>
                    <li style=" border-bottom: 1px solid #D8D8D8">      
                        <div class="box">
                            <a class="showpopup" data-source="<?php echo $images[0]; ?>" 
                               data-title="<?php echo get_the_title() ?>" 
                               data-name="<?php echo get_the_content(); ?>" 
                               data-toggle="modal" 
                               data-target="#PopupImg" >
                                <img src="<?php echo $images[0]; ?>"  alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                            </a>
                            <div class="nbs-flexisel-title">
                                <label class=' label-title'><?php echo get_the_title(); ?></label> </br>
                                <label style='font-size: 12px'><?php the_content() ?></label>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                wp_reset_query();
                wp_reset_postdata();
            }
            ?>
        </ul>

        <?php
        $arr = array(
            'post_type' => 'supervisor',
            'posts_per_page' => -1,
            'meta_query' => array(array('key' => '_admin_metabox_special', 'value' => 'off',))
        );
        $my_query = new WP_Query($arr);
        if ($my_query->have_posts()) {
            ?>
            <div id ='MyCarousel'>
                <ul>
                    <?php
                    while ($my_query->have_posts()) {
                        $my_query->the_post();
                        $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        $objImageData = get_post(get_post_thumbnail_id(get_the_ID()));
                        $strAlt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                        $meta = get_post_meta(get_the_ID(), '_admin_metabox_special');
                        ?>
                        <li style=" border-bottom:  1px solid #D8D8D8; margin-top: 10px"> 
                            <div class="box">
                                <a class="showpopup" data-source="<?php echo $images[0]; ?>" 
                                   data-title="<?php echo get_the_title() ?>" 
                                   data-name="<?php echo get_the_content(); ?>" 
                                   data-toggle="modal" 
                                   data-target="#PopupImg" >
                                    <img src="<?php echo $images[0]; ?>"  alt="<?php echo $strAlt; ?>" title="<?php echo $objImageData->post_title; ?>" />
                                </a>
                                <div class="nbs-flexisel-title">
                                    <label class=' label-title'><?php the_title(); ?></label> </br>
                                    <label style='font-size: 12px'><?php the_content() ?></label>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    wp_reset_query();
                    wp_reset_postdata();
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!--THEM PHAN LIGHTBOX IMG (SHOW POPUP CHO IMG ) 05-05-2016 -->
<div class="modal fade" id="PopupImg" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog popup-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div style=" clear: both"></div>
            </div>

            <div class="modal-body">
                <img id="popupImg"  scr="" />
            </div>

            <div class="modal-footer">
                <label id="popupTitle" style=" font-weight: bold; font-size: 18px"> </label>
                </br>
                <label id="popupName"> </label>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .popup-width{
        /*width: 123px  !important;;*/
        width:  35em !important;
        display: table;
    }
    #popupImg{
        width: 100%;
    }
    .modal-footer{
        text-align:  center;
    }
    .showpopup{
        cursor:  pointer;
    }
    .showpopup img{
        border-radius: 3px;
    }
    .showpopup:hover img{
        opacity: 0.8;
    }
</style>
<script type='text/javascript'>
    jQuery('a.showpopup').click(function() {
        var src = jQuery(this).data('source');
        var title = jQuery(this).data('title');
        var name = jQuery(this).data('name');
console.log();

        jQuery('img#popupImg').prop('src', src);
        jQuery('#popupTitle').text(title);
        jQuery('#popupName').text(name);
    });

    jQuery(function() {
        $("#MyCarousel").jCarouselLite({
            //        btnNext: ".bounceout .next",
            //        btnPrev: ".bounceout .prev",
            visible: 2, // so item hien thi

            // CAC HIEU UNG
            //  easing: "easeOutBounce",  // hieu ung khi chuyen dong
            auto: 1500 * 2,
            speed: 2000,
            circular: true, // xoay vong lai item khi xem
            autoWidth: true,
            responsive: true,
            vertical: true, // hinh thi kieu ngang hay doc
            hoverPause: true,
        });

    });

</script>

