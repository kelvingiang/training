<?php

class Admin_Metabox_Special
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        $id = 'admin-metabox-special';
        $title = '特別顯示';
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('supervisor', 'event'));
    }

    public function display($post)
    {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);
        $objhtml = new MyHtml();
        // TAO CHECKBOX STATUS
        $inputID = 'admin-metabox-special';
        $inputName = 'admin-metabox-special';
        //  $value                   =1;
        $getvalue = get_post_meta($post->ID, '_admin_metabox_special', true);
        $inputvalue = 'on';
        $arr = array('id' => $inputID);
        $options = array('current_value' => $getvalue);
        echo '<p><label for ="' . $inputID . '">特別顯示 : </label>'
            . $objhtml->checkbox($inputName, $inputvalue, $arr, $options)
            . '</p>';
    }

    public function save($post_id)
    {
        // kiem thanh phan an bao mat cua wp
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id
        // if (!isset($_POST['admin-metabox-data-nonce']))
        // return $post_id;
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id 
        // if (wp_verify_nonce('admin-metabox-data-nonce', 'admin-metabox-data'))
        //return $post_id;
        // HAM TU DONG LUU KHI DE QUA LAU NEU TRA VE FLASE return $post_id
        // if (define('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        //     return $post_id;

        // if (!current_user_can('edit_post', $post_id))
        //  return $post_id;
        // 4 BON PHAN TREN DUNG DE BAO MAT KHI LUU METABOX TRONG WP 


        // if (isset($_POST['admin-metabox-special'])  !== false) {

        if ($_POST['admin-metabox-special'] == 'on') {
            $active = 'on';
        } else {
            $active = 'off';
        }
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // die();
        update_post_meta($post_id, '_admin_metabox_special', $active);
        // }
    }
}
