<?php
if (!empty(getParams('id'))) {
    require_once (DIR_MODEL . 'check_in_model.php');
    $model = new Check_In_Model();
    $data = $model->get_item(getParams());
}
?>
<?php
require_once (DIR_MODEL . 'check_in_model.php');
$model = new Check_In_Model();
$error = $model->saveItem();
if (!empty($error)) {
    ?>
    <div style="  background-color: #FFADAD; color: white; min-height: 50px; margin-left: -20px; margin-bottom: 50px; padding-left: 20px; padding-top: 5px">
        <?php
        foreach ($error as $err) {
            echo "<label style='font-weight:  bold;color: white;'>$err</label>";
        }
        ?>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data" id="f_member" name="f_member" >
    <div class="title-row">
        <?php
        $action = getParams('action');
        if ($action == 'edit') {
            $title = __('Update Member Info');
        } elseif ($action == 'add') {
            $title = __('Add New Member');
        }
        ?>
        <h2> <?php echo $title; ?></h2>
    </div>
    <div class="meta-row-two-column" style="height: 230px">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Picture') ?></label>
            </div>
            <div class="text-cell">
                <?php $guest_img = $data['img'] == "" ? 'no-image.jpg' : $data['img'] ?>
                <div id="show-img" style=" background-image: url('<?php echo get_image("/guests/" . $guest_img); ?>');"></div>  
                <input type="file" id="guests_img" name="guests_img" accept=".png, .jpg, .jpeg, .bmp" style="line-height: 200px; margin-left: 50px"/>
                <input type="hidden" id="hidden_img" name="hidden_img" value="<?php echo $data['img']; ?>"/>
                <input type="hidden" id="hidden_code" name="hidden_code" value="<?php echo $data['code']; ?>"/>
            </div>
        </div>
        <div class="col">
          <?php if($action == 'edit') { ?>
            <div class="title-cell">
                <label><?php echo  __('Barcode')  ?></label>
            </div>
            <div class="text-cell">
                <a href="<?php echo get_qrcode_img($data['code']) ?>"
                   download="<?php echo $data['name'].'_' .$data['code'].'.png' ?>"
                   style="margin: 10px 15px 0px;text-decoration:none "
                   title="<?php echo __('Click can download  QR code file') ?>"
                   id="download_qrcode"
                   >
                    <image src="<?php echo PART_QRCODE . $data['code'] . '.png'; ?>" style="width:80px; height: 80px; margin: 5px"/><br>
                    <i style=" padding-left: 15px; color:  #999" ><?php echo $data['code'] ?></i>
                </a>
            </div>
          <?php } ?>
        </div>
    </div>
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Serial'); ?><i class="error" id="serial_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-serial" id="txt-serial"  value="<?php echo $data['serial'] ?>" /> 
            </div>
        </div>
    </div>    
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Full Name'); ?><i class="error" id="name_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-name" id="txt-name" value="<?php echo $data['name'] ?>" /> 
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Regency'); ?><i class="error" id="regency_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-position" id="txt-position" value="<?php echo $data['position'] ?>" /> 
            </div>
        </div>
    </div>    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Company Name'); ?><i class="error" id="company_merss"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-company" id="txt-company" value="<?php echo $data['company'] ?>"/> 
        </div>
    </div>       
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-address" id="txt-address" value="<?php echo $data['address'] ?>"/> 
        </div>
    </div>    
    <div class="meta-row-three-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Mobile') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-mobile" id="txt-mobile" class="type-phone" maxlength="20" value="<?php echo $data['mobile'] ?>"/>
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Phone') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-phone" id="txt-phone" class="type-phone" maxlength="20" value="<?php echo $data['phone'] ?>" />
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Fax') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-fax" id="txt-fax" class="type-phone" maxlength="20" value="<?php echo $data['fax'] ?>" />
            </div>
        </div>
    </div>
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Email') ?> <i id="error-email" class="error"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-email" id="txt-email" class="type-email" value="<?php echo $data['email'] ?>"/>
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Web Site') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-website" id="txt-website" class="website" value="<?php echo $data['website'] ?>" />
            </div>
        </div>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Note'); ?></label>
        </div>
        <div class="text-cell">
            <textarea name="txt-note" id="txt-note" rows="4"  style="width: 80%"><?php echo $data['note'] ?></textarea>
        </div>
    </div>    
    <div class="button-row">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
    </div>
</form>
<style type="text/css">
    #show-img{
        background-position: center center;
        float: left;
        margin-bottom: -2px     ;
        border: 1px solid #999999;
        border-radius: 3px;
        background-size: cover;
        display: inline-block;
        height: 200px;
        width: 200px;
    }

</style>
<script type="text/javascript">
    // show hinh anh truoc khi up len
    jQuery(document).ready(function () {

        jQuery('#btn-submit').click(function (e) {
            // KIEM TRA CAC  TRUONG KHONG DC RONG 
            var serialVal = jQuery('#txt-serial').val();
            if (serialVal === '') {
                jQuery('#serial_merss').text('<?php echo __('please input the serial number'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#txt-company').val();
            if (serialVal === '') {
                jQuery('#company_merss').text('<?php echo __('please input the company name'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#txt-name').val();
            if (serialVal === '') {
                jQuery('#name_merss').text('<?php echo __('please input the contact name'); ?>');
                e.preventDefault();
            }
        });

    });


    // show hinh anh truoc khi up len
    jQuery(function () {
        jQuery("#guests_img").on("change", function ()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    jQuery("#show-img").css("background-image", "url(" + this.result + ")");
                };
                console.log(result);
            }
        });
    });
    
      jQuery(function() {
    jQuery('#download_qrcode').tooltip();
  } );
</script>
