<?php
$data = array(
    'company_name' => '',
    'contact_name' => '',
    'phone' => '',
    'cell_phone' => '',
    'setorder' => '',
    'group_id' => '',
    'industry_id' => '',
    'img' => '',
    'user_name' => '',
    'password' => '',
);

require_once (DIR_MODEL . 'admin-model-member-function.php');
$model = new Admin_Model_Member_Function();
$selectCateByGroupID = $model->getCategoryNameByGroupID();
$selectCateByIndustryID = $model->getCategoryNameByIndustryID();

if ((getParams('action')=='edit')) {
    $data = $model->get_item(getParams());
}
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
    <!-- username - password -->
    <div class="meta-row-two-column">
        <div class="col">
            <div class="title-cell">
                <label><?php echo __('User Name') ?><i class="error" id="username_merss"></i></label>
            </div>
            <div class="text-cell">
                <input type="text" name="txt-username" id="txt-username" class="type-text"  
                    value="<?php echo $data['user_name']; ?>"  />
            </div>
        </div>
        <div class="col">
            <div class="title-cell">
                    <label><?php echo __('Password') ?><i class="error" id="pass_merss"></i></label>
                </div>
                <div class="text-cell">
                    <input type="text" name="txt-password" id="txt-password" class="type-text"  
                        value="<?php echo $data['password']; ?>"  />
            </div>
        </div>
    </div>
    <!-- order -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Show Order') ?></label>
        </div>
        <div class="text-cell">
            <input type="text" name="txt-order" id="txt-order"  maxlength="4" class="type-number" 
                  placeholder="<?php echo __('The larger the number will show in front'); ?>"  
                    value="<?php echo $data['setorder']; ?>"  />
        </div>
    </div>
      <!-- company  -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Company Name'); ?><i class="error" id="company_merss"></i></label>
        </div>
        <div class="text-cell">
            <input class="type-text" type="text" name="txt-company-name" 
            id="txt-company-name" maxlength="90" value="<?php echo $data['company_name']; ?>" /> 
        </div>
    </div>   
    <!-- contact -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Contact'); ?></label>
        </div>
        <div class="text-cell">
            <input class="type-text" type="text" name="txt-contact-name" id="txt-contact-name" 
             maxlength="90"value="<?php echo $data['contact_name'] ?>"/> 
        </div>
    </div>   
    <!-- phone -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Phone'); ?></label>
        </div>
        <div class="text-cell">
            <input class="type-phone" type="text" name="txt-phone" id="txt-phone" 
             maxlength="90"value="<?php echo $data['phone'] ?>"/> 
        </div>
    </div> 
    <!-- cell phone -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Cell Phone'); ?></label>
        </div>
        <div class="text-cell">
            <input class="type-phone" type="text" name="txt-cell-phone" id="txt-cell-phone" 
             maxlength="90"value="<?php echo $data['cell_phone'] ?>"/> 
        </div>
    </div> 
    <!-- group -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Group') ?><i class="error" id="group_merss"></i></label>
        </div>
        <div class="text-cell">
            <select class="type-text" name="sel_group_id" id="sel_group_id">
            <option value="">Choose Group</option>
                <?php foreach( $selectCateByGroupID as $selects) : ?>
                <option value ="<?php echo $selects['ID'] ?>"<?php if($selects['ID'] == $data['group_id'] ): ?> 
                    selected= "selected" <?php endif; ?>>
                    <?php echo $selects['cate_name']?>
                </option>

                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <!-- industry -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Industry') ?><i class="error" id="industry_merss"></i></label>
        </div>
        <div class="text-cell">
            <select class="type-text" name="sel_industry_id" id="sel_industry_id">
            <option value="">Choose Industry</option>
                <?php foreach( $selectCateByIndustryID as $selects) : ?>
                <option value ="<?php echo $selects['ID'] ?>"<?php if($selects['ID'] == $data['industry_id'] ): ?> 
                    selected= "selected" <?php endif; ?>>
                    <?php echo $selects['cate_name']?>
                </option>

                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <!-- image -->
    <div class="meta-row">
        <div class="title-cell">
            <label><?php echo __('Image'); ?></label>
        </div>
        <div class="text-cell">
            <?php 
            if(empty($data['img'])) {
                $member_img = 'no-image.jpg';
            }else {
                $member_img = $data['img'];
            }
            ?>
            <div id="show-img" class="show-img" style=" background-image: url('<?php echo PART_IMAGES_MEMBER . $member_img; ?>');">
            </div>
            <input type="file" id="member_img" name="member_img" accept=".png, .jpg, .jpeg, .bmp"/>
            <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $data['img'] ?>"/> 
        </div>
    </div>
    <div style="clear: both"></div>
    <div class="button-row">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo __('Send') ?>"/>
    </div>
</form>

<script type="text/javascript">
    // show hinh anh truoc khi up len
    jQuery(document).ready(function () {

        jQuery('#btn-submit').click(function (e) {
            // KIEM TRA CAC TRUONG KHONG DC RONG 
            var serialVal = jQuery('#txt-company-name').val();
            if (serialVal === '') {
                jQuery('#company_merss').text('<?php echo __('please input the company name'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#sel_group_id').val();
            if (serialVal === '') {
                jQuery('#group_merss').text('<?php echo __('please input the group'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#sel_industry_id').val();
            if (serialVal === '') {
                jQuery('#industry_merss').text('<?php echo __('please input the industry'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#txt-username').val();
            if (serialVal === '') {
                jQuery('#username_merss').text('<?php echo __('please input the user name'); ?>');
                e.preventDefault();
            }

            var serialVal = jQuery('#txt-password').val();
            if (serialVal === '') {
                jQuery('#pass_merss').text('<?php echo __('please input the password'); ?>');
                e.preventDefault();
            }
        });

        jQuery("#member_img").on("change", function() {
            var files = !!this.files ? this.files : [];
            if(!files.length || !window.FileReader)
                return; // no file selected or no FileReader support
            
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function() { // set image data as background of div
                    jQuery("#show-img").css("background-image", "url(" + this.result + ")");
                };
                console.log(result);
            }
        });
        
    });

</script>