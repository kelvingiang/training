<?php 
$page = getParams('page'); 
$msg = getParams('msg');
switch ($msg){
    case '2':
        $mess='Data import Success';
        break;
    case '3':
        $mess='Data reset Success';
        break;
}
?>       
<div  id="mess-space" style=" display:  <?php echo $msg ==' ' ? 'none' : 'block' ?>">
    <label><?php echo __($mess) ?></label>
    <p class="notice-dismiss mess-close"></p>
</div>
<ul>
    <li>
        <a class="button  button-hero btn-export btn" 
           href="<?php echo "admin.php?page=$page&action=export-check-in" ?>"> <?php echo __('Export Check In Detail') ?></a>
    </li>
    <li>
        <a class="button button-hero btn-export btn" 
           href="<?php echo "admin.php?page=$page&action=export-meeting-member" ?>"> <?php echo __('Export Meeting Member') ?></a>
    </li>
    <li>
        <a class="button button-hero btn-export btn" 
           href="<?php echo "admin.php?page=$page&action=export-member" ?>"> <?php echo __('Export Member') ?></a>
    </li>
</ul>
<hr>
<ul>
    <li>
        <a class="button button-hero btn-import btn" 
           href="<?php echo "admin.php?page=$page&action=import-member" ?>"> <?php echo __('Import Member') ?></a>
    </li>
    <li>
        <a class="button button-hero btn-import btn" 
           href="<?php echo "admin.php?page=$page&action=import-meeting-member" ?>"> <?php echo __('Import Meeting Member') ?></a>
    </li>
</ul>
<hr>
<ul>
    <li>
        <a class="button button-hero btn-chang btn " onclick="myFunction('<?php echo __('do you sure to delete the check-in record') ?>', 'reset-check-in')" > 
            <?php echo __('Reset Check In') ?>
        </a>
    </li>
    <li>
        <a class="button button-hero btn-chang btn" onclick="myFunction('<?php echo __('Generate a new QR-code filename containing the name, the old one will be deleted') ?>', 'create-QR-name')">
            <?php echo __('Generate QR-code have full name') ?>
        </a>
        <label style="padding-top: 20px; color: #b9b8b8"><?php echo __('Remember check again file name'); ?></label>    
    </li>
</ul>
<style>
    #mess-space{
        height: 50px;
        background-color: #999;
        margin: 10px 5px ;
        border-radius: 5px;
    }
    #mess-space label{
        color:  #fff;
        line-height: 50px;
        padding-left: 30px;
    }
    #mess-space .mess-close{
        float: right;
        margin: 3px;
    }

    .btn-export{
        background-color:#1167a0 !important;
        color: white !important;
        letter-spacing: 4px;
        opacity: 0.8
    }

    .btn-import{
        background-color: #003a14 !important;
        color: white !important;
        letter-spacing: 4px;
        opacity: 0.8
    }

    .btn-chang{
        background-color:#852b01 !important;
        color: white !important;
        letter-spacing: 4px; 
        opacity: 0.8
    }
    .btn:hover {
        opacity: 1;
        font-weight:  bold;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function (){
        jQuery('.mess-close').click(function(){
            jQuery(this).parent().slideUp();
        });
        setTimeout(function(){ jQuery('#mess-space').slideUp() }, 4000);
    });

    function myFunction($mess, $action) {
        if (confirm($mess)) {
            location.href = "<?php echo "admin.php?page=$page&action=" ?>" + $action;
        } else {
            window.stop();
        }
    }
</script>

