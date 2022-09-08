<div id="myCarousel" class="carousel slide " data-bs-ride="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#btn-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#btn-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#btn-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo PART_IMAGES . 'slider/sea.jpg' ?>" class="d-block w-100 img-thumbnail img" alt="">
        </div>
        <div class="carousel-item">
            <img src="<?php echo PART_IMAGES . 'slider/leaf.jpg' ?>" class="d-block w-100 img-thumbnail img" alt="">
        </div>
        <div class="carousel-item">
            <img src="<?php echo PART_IMAGES . 'slider/road.jpg' ?>" class="d-block w-100 img-thumbnail img" alt="">
        </div>
    </div>
    <button class="left carousel-control-prev" type="button" data-bs-target="#btn-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="right carousel-control-next" type="button" data-bs-target="#btn-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>   
</div>
<script>
    jQuery(document).ready(function() {
        // Activate Carousel
        jQuery("#myCarousel").carousel({
            interval: 2000,
        });

        //Enable Carousel Controls
        jQuery(".left").click(function(){
            jQuery("#myCarousel").carousel("prev");
        });
        jQuery(".right").click(function(){
            jQuery("#myCarousel").carousel("next");
        });
    })
</script>