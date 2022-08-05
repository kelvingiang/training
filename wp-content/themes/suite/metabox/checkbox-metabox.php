<?php

class Checkbox_Metabox
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        $id = 'tw-metabox-checkbox';
        $title = translate('Checkbox');
        $callback = array($this, 'display');
        $screen = array('member'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen);
        // FUNCTION NAY DE O DAY, DE KHI NAO DUNG DE METABOX THI TA MOI GOI FILE CSS NAY VO 
        //  add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
    }

    public function display($post)
    {
        //        echo __METHOD__;
        // thanh an nham bao mat trong wp
        $action = 'dn-metabox-data';
        $name = 'dn-metabox-data-nonce';
        wp_nonce_field($action, $name);


        // Tao text box
        if(get_post_meta($post->ID, '_metabox_member_black_list', true) == 1){ //1: show, 0: hide
            ?> <label class="checkbox-label"> Black List </label>
            <div class="form-check">
                <label class="form-check-label stretched-link mr-3" for="metabox-member_black_list">  </label>
                <input class="form-check-input" type="checkbox" id=" metabox-member_black_list" name="metabox-member_black_list" value="1" checked />
            </div>
            <?php
        }else{
            ?> <label class="checkbox-label"> Black List </label>
            <div class="form-check">
                <label class="form-check-label stretched-link mr-3" for="metabox-member_black_list"> <?php translate('Black list') ?> </label>
                <input class="form-check-input" type="checkbox" id=" metabox-member_black_list" name="metabox-member_black_list" value="1" />
            </div>
            <?php
        }   

    }

    public function save($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (is_admin()) {
            if (@$_POST['post_type'] == 'member') {

                if (isset($_POST['metabox-member_black_list'])) {
                    update_post_meta($post_id, '_metabox_member_black_list', $_POST['metabox-member_black_list']);
                }
            }
        }
    }
}
