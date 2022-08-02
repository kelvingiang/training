<form action="" method="post" enctype="multipart/form-data" id="f-schedule" name="f-schedule" >
    <div class="title-row">
        <h2> <?php echo __('Commerce Setting') ?></h2>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Commerce Name'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-name" id="txt-name" value="<?php echo get_option('commerce_name') ?>"  /> 
        </div>
    </div>   
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address'); ?><i class="error" id="event_title_merss"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-address" id="txt-address" value="<?php echo get_option('commerce_address') ?>"  /> 
        </div>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Mobile'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-mobile" id="txt-mobile" class="type-phone" value="<?php echo get_option('commerce_mobile') ?>"  /> 
        </div>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Phone'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-phone" id="txt-phone" class="type-phone" value="<?php echo get_option('commerce_phone') ?>"  /> 
        </div>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Fax'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-fax" id="txt-fax"  class="type-phone" value="<?php echo get_option('commerce_fax') ?>"  /> 
        </div>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Email'); ?><i id="error-email" class="error"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-email" id="txt-email" class="email" value="<?php echo get_option('commerce_email') ?>"  /> 
        </div>
    </div>
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Maps X'); ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-map-x" id="txt-map-x" class="type-number-dot" value="<?php echo get_option('commerce_map_x') ?>" /> 
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Map Y'); ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-map-y" id="txt-map-y" class="type-number-dot" value="<?php echo get_option('commerce_map_y') ?>" /> 
            </div>
        </div>
    </div>   
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Chamber of Commerce'); ?><i id="error-email" class="error"></i></label>
        </div>
        <div class="text-cell">
            <?php wp_editor(get_post_meta('1', '_info_charter', TRUE), 'info_charter', array('wpautop' => false, 'editor_height' => '300px')); ?>
        </div>
    </div>
    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Application for membership'); ?><i id="error-email" class="error"></i></label>
        </div>
        <div class="text-cell">
            <?php wp_editor(get_post_meta('1', '_info_apply', TRUE), 'info_apply', array('wpautop' => false, 'editor_height' => '300px')); ?>
        </div>
    </div>


    <div class="button-row">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
    </div>


</form>
