<h2>Info member <?php the_title(); ?></h2>
<section id="content" role="main">
    <div class="">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('Contact'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox_member_contact',true); ?></span>
            </div>
        </div> 
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('Address'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox_member_address',true); ?></span>
            </div>
        </div>
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('Phone'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox_member_phone',true); ?></span>
            </div>
        </div>
        <div class="meta-row">
            <div class="title-cell">
                <label><?php echo __('District'); ?>: </label> 
                <span><?php echo get_post_meta(get_the_ID(),'_metabox-member_district',true); ?></span>
            </div>
        </div> 

            <?php  //get_template_part( 'entry' ); ?>
            <?php  //if ( ! post_password_required() ) comments_template( '', true ); ?>
            <?php
            endwhile;
        endif;
        ?>
    </div>
    <footer class="footer">
        <?php //get_template_part('nav', 'below-single'); ?>
    </footer>
</section>

<style>
    .title-row {
    padding-top: 15px; }
    .title-row h2 {
        font-size: 30px;
        font-weight: bold; }

    .title-cell {
    padding-top: 15px; }
    .title-cell label {
        font-size: 18px;
        font-weight: bold;
        color: #f7b2a0;
        padding: auto;
        text-align: left; }
    .title-cell span {
        font-size: 20px;
        color: gray; }

    .type, .text-cell .type-text, .text-cell .type-number, .text-cell .type-phone, .text-cell .type-email, .text-cell .type-number-dot {
    width: 50%;
    height: 40px;
    border-radius: 2px;
    box-shadow: 1px 2px #888888;
    border: 1px lavender solid; }
</style>