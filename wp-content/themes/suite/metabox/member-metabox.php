<?php

class Member_Metabox {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create() {
        $id = 'tw-metabox-member';
        $title = translate('Member');
        $callback = array($this, 'display');
        $screen = array('member'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
        // FUNCTION NAY DE O DAY, DE KHI NAO DUNG DE METABOX THI TA MOI GOI FILE CSS NAY VO 
        //  add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
    }

    public function display($post) {
        //        echo __METHOD__;
        // thanh an nham bao mat trong wp
        $action = 'dn-metabox-data';
        $name = 'dn-metabox-data-nonce';
        wp_nonce_field($action, $name);

        $m_district = get_post_meta($post->ID, '_metabox-member_district',true);
        
        // TAO TEXTBOX TITLE
        //contact
        echo '<div class="meta-row">
            <div class="title-cell"><label for ="metabox-member_contact">'. translate('Contact') .'</label></div>
            <div class="text-cell" >
            <input class="type-text" type="text" id="metabox-member_contact" name="metabox-member_contact" maxlength="100"
                placeholder = ' . translate('Contact ') .
                'value= ' . get_post_meta($post->ID, '_metabox_member_contact', true)
            .'></div>
        </div>';
        //address
        echo '<div class="meta-row">
            <div class="title-cell"><label for ="metabox-member_address">' .translate('Address') .'</label></div>
            <div class="text-cell" >
                <input class="type-text" type="text" id="metabox-member_address" name="metabox-member_address" maxlength="100"
                    placeholder = '. translate('Address ') .
                    'value=  ' . get_post_meta($post->ID, '_metabox_member_address', true) 
                .'></div>
        </div>';
        //phone
        echo '<div class="meta-row">
            <div class="title-cell"><label for ="metabox-member_phone">' . translate('Phone') . '</label></div>
            <div class="text-cell" >
                <input class="type-number" id="metabox-member_phone" name="metabox-member_phone" maxlength="50"
                placeholder = ' . translate('Phone ')  .
                'value= ' . get_post_meta($post->ID, '_metabox_member_phone', true) 
                .'></div>
        </div>';
        //district
        ?><div class="meta-row">
            <div class="title-cell"><label for ="metabox-member_district"> District </label></div>
            <div class="text-cell" >
                <select class="type-text" name="metabox-member_district" id="metabox-member_district" maxlength="50">
                    <option value="">Choose District</option>
                    <option value='1' <?php echo $m_district == 1 ? 'selected' : '' ?>>District 1</option>
                    <option value='2' <?php echo $m_district == 2 ? 'selected' : '' ?>>District 2</option>
                    <option value='3' <?php echo $m_district == 3 ? 'selected' : '' ?>>District 3</option>
                </select></div>
            </div>
        <?php 
    }

    public function save($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            if (@$_POST['post_type'] == 'member') {  

                if (isset($_POST['metabox-member_contact'])) {
                    update_post_meta($post_id, '_metabox_member_contact', esc_attr($_POST['metabox-member_contact']));
                }
                if (isset($_POST['metabox-member_address'])) {
                    update_post_meta($post_id, '_metabox_member_address', esc_attr($_POST['metabox-member_address']));
                }
                if (isset($_POST['metabox-member_phone'])) {
                    update_post_meta($post_id, '_metabox_member_phone', esc_attr($_POST['metabox-member_phone']));
                }

                if(isset($_POST['metabox-member_district'])) {
                    update_post_meta($post_id, '_metabox-member_district', esc_attr($_POST['metabox-member_district']));
                }

            }
        }
    }

}
