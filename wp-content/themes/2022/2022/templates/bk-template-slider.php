<style>
    .border_box {
        margin: 0;
    }

    .box_skitter_large {
        height: 600px;
    }

    .container_skitter img {
        text-align: center;
    }

    .box_skitter {
        width: 100%;
    }

    .label_skitter {
        background-color: transparent !important;
    }

    .image_main {
        height: 600px;
        width: 100%;
    }
</style>

<?php mySlider('supervisors'); ?>

<!--  KHOI TAO VIEC CHAY SLIDER -->
<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {
        jQuery('.box_skitter_large').skitter({
            thumbs: false,
            theme: 'Minimalist',
            numbers_align: 'center',
            numbers: false,
            progressbar: false,
            dots: false,
            navigation: false,
            preview: false,
            interval: 8000 // thoi gian chuyen hinh]
        });
    });
</script>