<?php
global $post;
// lay phan header
get_header();
wp_link_pages();
$postMeta = get_post_meta($post->ID);
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var map;
    function initialize() {
        // read json chuyen thanh du lien cua javacsript 

        var position = new google.maps.LatLng(<?php echo get_post_meta($post->ID, 'b_x', TRUE) ?>, <?php echo get_post_meta($post->ID, 'b_y', TRUE) ?>);
        var myOptions = {
            zoom: 16,
            center: position,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
                myOptions);

        var marker = new google.maps.Marker({
            position: position,
            map: map
        });

        var myWindowOptions = {
            content: '<?php echo get_the_title() ?>'
        };

        var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);

        //google.maps.event.addListener(marker, 'click', function() {
        myInfoWindow.open(map, marker);
        //});

        map.setCenter(position);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script> 

<!-- DANG KY BANG GMAIL DE SU DUNG GOOGLEMAPS https://developers.google.com/maps/documentation/javascript/adding-a-google-map#key-->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAV4v2qSBuCA1Rn7NPd09exwP4smcjW_g&callback=initMap">
</script>
<!-- phan noi dung of trang index --------------------------------------- -->
<div class="row">
    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
        <div class="orange-group" style="margin-top: 10px">
            <div class="orange-title">
                <label class="orange-title-text">  <?php the_title(); ?></label>
            </div>
            <div  class="info-bg">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <label class="label-title"> 會長 : </label> 
                        <label><?php echo $postMeta['b_contact'][0]; ?></label>
                    </div>

                    <div class="col-md-12">
                        <label class="label-title"> 手機 : </label> 
                        <label><?php echo $postMeta['b_phone'][0]; ?></label> 
                    </div>

                    <div class="col-md-12">
                        <label class="label-title"> 電話  : </label>
                        <label><?php echo $postMeta['b_tel'][0]; ?></label> 
                    </div>

                    <div class="col-md-12">
                        <label class="label-title"> 傳真 : </label>
                        <label><?php echo $postMeta['b_fax'][0]; ?></label>
                    </div>

                    <div class="col-md-12">
                        <label class="label-title"> E-mail  : </label>
                        <label><?php echo $postMeta['b_email'][0]; ?></label>  
                    </div>

                    <div class="col-md-12">
                        <label class="label-title"> 臉書  : </label>
                        <a style="font-weight: bold" href="<?php echo $postMeta['b_fanpage'][0]; ?>" target="_bank">
                            <?php echo $postMeta['b_fanpage'][0]; ?>
                        </a>
                    </div>


                    <div class="col-md-12">
                        <label class="label-title"> 地址 : </label>
                        <label><?php echo $postMeta['b_address'][0]; ?></label> 
                    </div>

                    <div class="col-md-12" style="margin: 3rem 1rem">
                        <?php the_content(); ?>
                    </div>

                    <div class="col-md-12" style="margin-top: 20px;">
                        <div id="map_canvas" style="position: relative; z-index: 28 ; height: 450px;  width: 100%;" ></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
        <?php get_sidebar() ?>
    </div>
</div>

<script>
    jQuery(document).ready(function () {

        jQuery('body,html').stop(false, false).animate({
            scrollTop: 500
        }, 1000);
    });
</script>



<?php
// lay phan footer
get_footer();
