<?php
if ((getParams('action')=='edit')) {
    require_once (DIR_MODEL . 'member_model.php');
    $model = new Member_Model();
    $data = $model->get_item(getParams());
   
}
require_once (DIR_MODEL . 'member_industry_model.php');
$industryModel = new Member_Industry_Model();
$industryList = $industryModel->getData();


?>

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
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Serial'); ?><i class="error" id="serial_merss"></i></label>
            </div>
            <div class="text-cell">
                <?php if ($action == 'edit') { ?>
                    <h3 style="margin: 10px 15px 0px"><?php echo $data['serial'] ?></h3>
                <?php } else { ?>
                    <input type="text" name="txt-serial" id="txt-serial"  value="<?php echo $data['serial'] ?>" /> 
                <?php } ?>
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Show Order') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-order" id="txt-order"  maxlength="4" class="type-number" placeholder="<?php echo __('The larger the number will show in front'); ?>"  
                       value="<?php echo $data['order'] ?>" />
            </div>
        </div>
    </div>    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Company Name Chinese'); ?><i class="error" id="company_merss"></i></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-company-cn" id="txt-company-cn" maxlength="90" value="<?php echo $data['company_cn'] ?>" /> 
        </div>
    </div>    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Company Name Vietnam'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-company-vn" id="txt-company-vn" maxlength="90" value="<?php echo $data['company_vn'] ?>"/> 
        </div>
    </div>       
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address Chinese'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-address-cn" id="txt-address-cn"  maxlength="190"value="<?php echo $data['address_cn'] ?>"/> 
        </div>
    </div>    
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Address Vietnam'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-address-vn" id="txt-address-vn" maxlength="190" value="<?php echo $data['address_vn'] ?>"/> 
        </div>
    </div>    

    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Full Name') ?><i class="error" id="contact_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-contact" id="txt-contact" value="<?php echo $data['contact'] ?>" 
                       />
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Regency') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-position" id="txt-position" value="<?php echo $data['position'] ?>" />
            </div>
        </div>
    </div>
    <div class="meta-row-three-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Mobile') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-mobile" id="txt-mobile" class="type-phone" maxlength="50" value="<?php echo $data['mobile'] ?>"/>
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Phone') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-phone" id="txt-phone" class="type-phone" maxlength="50" value="<?php echo $data['phone'] ?>" />
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('Fax') ?></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-fax" id="txt-fax" class="type-phone" maxlength="50" value="<?php echo $data['fax'] ?>" />
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
                <input type="text" name="txt-website" id="txt-website" class="type-website" value="<?php echo $data['website'] ?>" />
            </div>
        </div>
    </div>
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Region'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-region" id="txt-region" value="<?php echo $data['region'] ?>"/> 
        </div>
    </div> 
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Service List'); ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-service" id="txt-service" value="<?php echo $data['service'] ?>"/> 
        </div>
    </div>    
    <div class="meta-row">
 <?php echo $data['industry'] ?>

        <div class="title-cell" style="margin-bottom: 10px">
            <label><?php echo __('Industry'); ?></label>
        </div>
        <div class="text-cell">
            <?php foreach ($industryList as $val) {
                $pos = strripos($data['industry_id'],  ','.$val['ID'].','); // tim ky tu co trong chuoi
                ?>
            <div style="width: 40%; float: left; height: 30px;">
                <input type="checkbox" name="industry_id[]" id="industry_id[]" value="<?php echo $val['ID'] ?>" 
                    <?php echo  $pos === false  ?'': 'checked' ?>  />
                <?php echo $val['name'] ?>
            </div> 
            <?php } ?>
        </div>
    </div> 
    <div style="clear: both"></div>
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

            var serialVal = jQuery('#txt-company-cn').val();
            if (serialVal === '') {
                jQuery('#company_merss').text('<?php echo __('please input the company name'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#txt-contact').val();
            if (serialVal === '') {
                jQuery('#contact_merss').text('<?php echo __('please input the contact name'); ?>');
                e.preventDefault();
            }
        });


        jQuery('#txt-serial').focusout(function (e) {
            var urlPath = '<?php echo get_template_directory_uri() . '/ajax/admin/checkemail.php' ?>';
            jQuery.ajax({
                url: urlPath, // lay doi tuong chuyen sang dang array
                type: 'post',
                data: jQuery(this).serialize(),
                dataType: 'json',
                success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'error') {
                        jQuery('#serial_merss').text(data.message);
                        jQuery("#btn-submit").prop('disabled', true);
                    } else if (data.status === 'done') {
                        jQuery('#serial_merss').text('');
                        if (jQuery('#serial_merss').text() === '') {
                            jQuery("#btn-submit").prop('disabled', false);
                        }
                    }
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                }
            });
            e.preventDefault();
        });

    });

</script>
