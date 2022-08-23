<?php
$data = array(
    'company_name' => '',
    'contact_name' => '',
    'phone' => '',
    'cell_phone' => '',
    'setorder' => '',
    'group_id' => '',
    'industry_id' => ''
);

$selectCateByGroupID = getCategoryNameByGroupID();
$selectCateByIndustryID = getCategoryNameByIndustryID();


if ((getParams('action')=='edit')) {
    require_once (DIR_MODEL . 'admin-model-member.php');
    $model = new Admin_Model_Member();
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
        });

        
    });

</script>