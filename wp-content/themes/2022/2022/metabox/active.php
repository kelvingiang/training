<?php

class Admin_Metabox_active
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        global $post;
        $id = 'forum-meta-box';
        $title = '啟 用 狀 態';
        $callback = array($this, 'display');
        $screen = array('forum'); // CAC POST VA CUSTOMER POST CHO PHEP METABOX NAY HIEN THI
        add_meta_box($id, $title, $callback, $screen, 'normal', 'high');
    }

    public function display($post)
    {
        $f_active = get_post_meta($post->ID, 'f_active', true);
?>

        <div class="content">
            <label for="f_active" class="label-admin" style="font-weight: bold; "><?php _e('啟 用  ', 'suite'); ?></label>
            <input type="checkbox" name="f_active" id="f_active" <?php echo checked($f_active, 'on', false); ?> style="margin-top: 10px" />
        </div>

<?php
    }

    public function save($post_is)
    {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (is_admin()) {
            if (isset($_POST['f_active'])) {
                update_post_meta($post_is, 'f_active', $_POST['f_active']);
            } else {
                update_post_meta($post_is, 'f_active', 'off');
            }
            add_action('redirect_post_location', 'custom_redirect');
        }
    }
}
