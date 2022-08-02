<?php
require_once (DIR_CONTROLER . 'check-in-setting-controler.php');
$dd = Check_In_Setting_Controler::$errors;
?>
<div>
    <div>
        <h3><?php echo __('Import Meeting Member') ?></h3>
    </div>
    <?php if (!empty($dd)) { ?>
        <div style="background-color:  #f6a2a2; color: white; height: 50px">
            <?php foreach ($dd as $d) { ?>
                <label style="margin: 10px; padding: 20px; line-height: 50px"><?php echo __($d) ?></label>       
            <?php } ?>
        </div>
    <?php } ?>
    <form id="f_upload" name="f_upload" action="" method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 10px"><label class="error"></label></div>
        <div>
            <input type="file" id="member" name="member" accept=".xlsx, .xls, .csv"/>
        </div>   
        <div>
            <input type="submit" id="btn-submit" name="btn-submit" 
                   class="button button-primary" 
                   style="margin-top: 30px; letter-spacing: 3px"
                   value="<?php echo __('Submit') ?>"
        </div>
    </form>
</div>
        <div class="my-waiting">
            <img src="<?php echo get_image('loading_pr2.gif')  ?>"  style=" width: 150px" />
        </div>
<script type="text/javascript">
    jQuery(document).ready(function (){
        
        jQuery('#btn-submit').click(function(){
            jQuery('.my-waiting').css('display', 'block');
        });
        
        
        
        jQuery('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                 var fileType = fileName.split(".");
                var type = ["xls", "xlsx", "csv"];
               if(fileType[1] === "xls" || fileType[1] === "xlsx"|| fileType[1] === "csv"){
                   jQuery('#btn-submit').prop('disabled', false);
                   jQuery('.error').text('');
               }else{
                   jQuery('#btn-submit').prop('disabled', true);
                   jQuery('.error').text('<?php echo  __('extension not allowed, please choose an excel file') ?>');
               }
        });
    });
</script>


