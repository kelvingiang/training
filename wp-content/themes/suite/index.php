<?php get_header(); ?>
<div class="row" style="margin-top: 100px">
    <div>
        <h1 style="font-size: 30px; font-weight:bold; text-align:center">Welcome to home page</h1>
    </div>
    <div class="second-space col-lg-3 col-md-4 col-sm-12 ">
        <div class="row">
            <div>
                <!-- gọi đến single.php -->
                <a style="font-size: 20px;"  href="<?php echo home_url('2022/08/09/hello-wordpress/'); ?>">Post</a>
            </div>
            <div>
                <!-- gọi đến template-member.php -->
                <a style="font-size: 20px;"  href="<?php echo home_url('members'); ?>">Member </a>
            </div>
        </div>    
    </div>
</div>
<?php get_footer(); ?>