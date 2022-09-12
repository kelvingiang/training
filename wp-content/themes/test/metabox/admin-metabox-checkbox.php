<?php

class Admin_Metabox_Checkbox
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
        $screen = array('post','news'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
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
        if(get_post_meta($post->ID, '_metabox_show_at_home', true) == 1){ //1: show, 0: hide
            ?> <label class="checkbox-label"> Show at Home </label>
            <div class="form-check">
                <label class="form-check-label stretched-link mr-3" for="metabox_show_at_home"> <?php translate('Show at Home') ?> </label>
                <input class="form-check-input" type="checkbox" id=" metabox_show_at_home" name="metabox_show_at_home" value="1" checked />
            </div>
            <?php
        }else{
            ?> <label class="checkbox-label"> Show at Home </label>
            <div class="form-check">
                <label class="form-check-label stretched-link mr-3" for="metabox_show_at_home"> <?php translate('Show at Home') ?> </label>
                <input class="form-check-input" type="checkbox" id=" metabox_show_at_home" name="metabox_show_at_home" value="1" />
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
            $check = 1;
            //su dung cho nhieu trang
            if (isset($_POST['metabox_show_at_home']) == $check) {
                update_post_meta($post_id, '_metabox_show_at_home', $_POST['metabox_show_at_home']);
            }else{
                update_post_meta($post_id, '_metabox_show_at_home', $_POST['metabox_show_at_home']);
            }
        }
    }
}
