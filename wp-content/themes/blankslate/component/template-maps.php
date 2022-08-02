<div style="padding-top: 113px">
    <div class="fluid_container">
        <div id="map_canvas" style="position: relative; z-index: 28 ; height: 450px;  width: 100%; "></div>
    </div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var map;
    function initialize() {
        // read json chuyen thanh du lien cua javacsript 

        var position = new google.maps.LatLng(<?php echo get_option('commerce_map_x') ?>,<?php echo get_option('commerce_map_y') ?> );
        var myOptions = {
            zoom: 17,
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
            content: '<?php echo get_option('commerce_name') ?>'
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
<style type="text/css">
    .gm-style-iw-c{
        width: 150px;
        height: 80px;
        text-align: center;
        line-height: 50px;
        letter-spacing: 3px;
        color:  #04599b;
    }
    .gm-style-iw-d div{
        font-weight: bold;
    }
</style>

