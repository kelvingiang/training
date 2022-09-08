<?php get_header(); ?>
<div class="row" style="margin: 90px">
    <div>
        <h1 style="font-size: 30px; font-weight:bold; text-align:center; margin-bottom:20px;">Welcome to home page</h1>
    </div>
    <div class="second-space col-lg-3 col-md-4 col-sm-12 ">
        <ul class="list-group">
            <li class="list-group-item active" aria-current="true"> </li>
            <li  class="list-group-item">
                <!-- gọi đến single.php -->
                <a style="font-size: 20px;"  href="<?php echo home_url('2022/08/09/hello-wordpress/'); ?>">Post</a>
            </li>
            <li class="list-group-item">
                <!-- gọi đến template-member.php -->
                <a style="font-size: 20px;"  href="<?php echo home_url('members'); ?>">Member </a>
            </li>
            <li class="list-group-item">
                <!-- gọi đến template-product-login.php -->
                <a style="font-size: 20px;"  href="<?php echo home_url('product-login'); ?>">Product Login </a>
            </li>
        </ul>    
    </div>
    <div class="col-lg-5 col-md-4 col-sm-12 ">
        <img src="<?php echo PART_IMAGES . 'slider/big_bunny_fake.jpg'?>" class="w-100 img-thumnail img" alt="" />   
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <iframe width="510" height="287" src="https://www.youtube.com/embed/AzX14t-kX4w" title="Giới thiệu về công ty phần mềm Digiwin" 
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; 
            gyroscope; picture-in-picture" allowfullscreen>
        </iframe>  
    </div>
</div>
<?php get_footer(); ?>