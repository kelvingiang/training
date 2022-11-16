<?php
if (!empty($_POST)) {
    update_post_meta(1, '_introduction_cn', $_POST['txt_introduction_cn']);
    update_post_meta(1, '_regulation_cn', $_POST['txt_regulation_cn']);

    update_post_meta(1, '_introduction_en', $_POST['txt_introduction_en']);
    update_post_meta(1, '_regulation_en', $_POST['txt_regulation_en']);

    update_post_meta(1, '_introduction_vn', $_POST['txt_introduction_vn']);
    update_post_meta(1, '_regulation_vn', $_POST['txt_regulation_vn']);
}
?>
<div id='tabs' style="width: 80%">
    <form id="f-about" name="f-about" method="post" action="">
        <ul>
            <li><a href="#tabs-1">中文</a></li>
            <li><a href="#tabs-2">英文</a></li>
            <li><a href="#tabs-3">越文</a></li>
        </ul>
        <div id="tabs-1">
            <div>
                <h2>商會簡介(中文) </h2>
            </div>
            <div style="min-height: 400px; overflow:  hidden">
                <?php wp_editor(get_post_meta('1', '_introduction_cn', true), 'txt_introduction_cn', array('wpautop' => TRUE, 'editor_height' => '350px')); ?>
            </div>
            <hr>
            <div>
                <h2>商會章程(中文) </h2>
            </div>
            <div style="min-height: 400px; overflow:  hidden">
                <?php wp_editor(get_post_meta('1', '_regulation_cn', true), 'txt_regulation_cn', array('wpautop' => TRUE, 'editor_height' => '350px')); ?>
            </div>
        </div>


        <div id="tabs-2">
            <div>
                <h2>商會簡介(英文) </h2>
            </div>
            <div style="min-height: 400px; overflow:  hidden">
                <?php wp_editor(get_post_meta('1', '_introduction_en', true), 'txt_introduction_en', array('wpautop' => TRUE, 'editor_height' => '350px')); ?>
            </div>
            <hr>
            <div>
                <h2>商會章程(英文) </h2>
            </div>
            <div style="min-height: 400px; overflow:  hidden">
                <?php wp_editor(get_post_meta('1', '_regulation_en', true), 'txt_regulation_en', array('wpautop' => TRUE, 'editor_height' => '350px')); ?>
            </div>
        </div>

        <div id="tabs-3">
            <div>
                <h2>商會簡介(越文) </h2>
            </div>
            <div style="min-height: 400px; overflow:  hidden">
                <?php wp_editor(get_post_meta('1', '_introduction_vn', true), 'txt_introduction_vn', array('wpautop' => TRUE, 'editor_height' => '350px')); ?>
            </div>
            <hr>
            <div>
                <h2>商會章程(越文) </h2>
            </div>
            <div style="min-height: 400px; overflow:  hidden">
                <?php wp_editor(get_post_meta('1', '_regulation_vn', true), 'txt_regulation_vn', array('wpautop' => TRUE, 'editor_height' => '350px')); ?>
            </div>
        </div>

        <div class="admin-btn-space">
            <input class="button button-primary" type="submit" value="發 佈" />
        </div>
    </form>
</div>

<script>
    jQuery(function() {
        jQuery("#tabs").tabs();
    });
</script>