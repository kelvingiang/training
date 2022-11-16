<?php

class Admin_Metabox_Language
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        $id = 'admin-metabox-language';
        $title = __('Language');
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('post', 'event', 'slide'));
    }

    public function display($post)
    {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);
?>
        <div class="row-one-column">
            <div class="col">
                <div class="cell-title">
                    <label style="margin-right: 15px"><?php echo __('Choice Language'); ?></label>
                </div>
                <div class="cell-text radio-space">
                    <?php $check = get_post_meta($post->ID, '_metabox_language', TRUE) ?>
                    <div>
                        <input type="radio" id="radio-cn" name="radio-lang" value="cn" <?php echo $check == 'cn' ? 'checked' : '' ?> checked />
                        <label><?php _e('Chinese') ?></label>
                    </div>
                    <div>
                        <input type="radio" id="radio-vn" name="radio-lang" value="vn" <?php echo $check == 'vn' ? 'checked' : '' ?> />
                        <label><?php _e('Vietnamese') ?></label>
                    </div>
                    <div>
                        <input type="radio" id="radio-en" name="radio-lang" value="en" <?php echo $check == 'en' ? 'checked' : '' ?> />
                        <label><?php _e('English') ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
<?php
    }

    public function save($post_id)
    {
        // kiem thanh phan an bao mat cua wp
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id
        //        if (!isset($_POST['admin-metabox-data-nonce']))
        //            return$post_id;
        // NEU HAM NAY TRA VE GIA TRI  LA TRUE THUC HIEN TIEP CAC PHAN DUOI , CON TRA VE FLASE return VE $post_id 
        //        if (wp_verify_nonce('admin-metabox-data-nonce', 'admin-metabox-data'))
        //            return $post_id;
        // HAM TU DONG LUU KHI DE QUA LAU NEU TRA VE FLASE return $post_id
        //        if (define('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        //            return $post_id;
        //
        //        if (!current_user_can('edit_post', $post_id))
        //            return$post_id;
        // 4 BON PHAN TREN DUNG DE BAO MAT KHI LUU METABOX TRONG WP
        if (isset($_POST['radio-lang'])) {
            update_post_meta($post_id, '_metabox_language', $_POST['radio-lang']);
        }
    }
}
