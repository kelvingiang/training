<div style="margin: 50px 0 0 20px ">
    <?php
    if (getParams('msg') == 1) {
    ?>
        <div class="msg-space">
            <h2> <?php _e('Face recognition data Import Success') ?> </h2>
        </div>
    <?php    }    ?>
    <form id="f_upload" name="f_upload" action="" method="post" enctype="multipart/form-data">
        <div>
            <h3>
                <?php _e('Import face recognition data into the Check-in system') ?>
            </h3>
        </div>
        <div>
            <label class="label-admin"><?php _e('Select the Excel file for face recognition registration', 'suite'); ?></label></br> </br>
            <input type="file" id="file-face" name="file-face" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
            <label id="mess"></label>
            <input type="hidden" value="<?php time() ?>" />
            <input type="submit" value="<?php _e('Submit', 'suite'); ?>" id="btn_changeImg" class="button button-primary">
        </div>
    </form>
</div>