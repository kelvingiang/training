<div style="margin: 50px 0 0 20px ">
 <form id="f_upload" name="f_upload" action="" method="post" enctype="multipart/form-data">
        <div>
            <label class="label-admin"><?php _e('請選擇會員的 Excel 檔', 'suite'); ?></label></br> </br>
            <input type="file" id="myfile" name="myfile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
            <label id="mess"></label>
            <input type="hidden" value="<?php time() ?>" />
            <input type="submit" value="<?php _e('Submit', 'suite'); ?>"  id="btn_changeImg"  class="button button-primary" >
        </div>
    </form>
</div>  

