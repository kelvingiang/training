<?php
$action = $_GET['action'];
$id = $_GET['id'];
$title = $action == 'add' ? '新增候選' : '修改-更新';
if ($action == "add") {
    $voteAgree = 0;
    $voteAnti = 0;
    $voteFail = 0;
} else {
    include_once DIR_MODEL . 'model_vote.php';
    $model = new Admin_Model_Vote();
    $item = $model->getItem($id);
}
?>
<style>
    .err {
        color: red;
        font-size: 12px;
        font-style: italic;
    }
</style>
<div style="padding-top: 20px">
    <div style=" margin:  0 30px;">
        <h2 style="color:  #0364c5;  letter-spacing: 5px"><?php echo $title ?></h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data" id="f-vote" name="f-vote">
        <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $item['ID'] ?>">
        <input type="hidden" id="hid_img" name="hid_img" value="<?php echo $item['img'] ?>">
        <div class="row-one-column">

            <div class="cell-title "><label class="label-admin"> <?php _e('Image') ?> </label></div>
            <div class="cell-text">
                <?php
                if (empty($item['img'])) {
                    $vote_img = 'no-image.jpg';
                } else {
                    $vote_img = $item['img'];
                }
                ?>
                <div id="show-img" style="background-image: url('<?php echo PART_IMAGES_VOTE . $vote_img; ?>')"></div>
                <input type="file" id="vote_img" name="vote_img" accept=".png, .jpg, .jpeg, .bmp" />
            </div>

        </div>



        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">候選職位</label>
            </div>
            <div class="cell-text">
                <select id="sel_kid" name="sel_kid">
                    <option value="0">選擇職位</option>
                    <option value="1" <?php echo $item['kind'] == 1 ? 'selected' : '' ?>>總會長</option>
                    <option value="2" <?php echo $item['kind'] == 2 ? 'selected' : '' ?>>監事長</option>
                </select>
                <label id="err_kid" class="err"></label>
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title "><label class="label-admin">當選職位</label></div>
            <div class="cell-text">
                <select id="sel_position" name="sel_position">
                    <option value="0">選擇職位</option>
                    <option value="1" <?php echo $item['position'] == 1 ? 'selected' : '' ?>>總會長</option>
                    <option value="2" <?php echo $item['position'] == 2 ? 'selected' : '' ?>>監事長</option>
                </select>
                <label id="err_position" class="err"></label>
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">姓名</label>
            </div>
            <div class="cell-text">
                <label id="err_name" class="err"></label>
                <input type="text" id="txt_name" name="txt_name" class="my-input" value="<?php echo $item['name'] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">公司名稱</label>
            </div>
            <div class="cell-text">
                <input type="text" id="txt_company" name="txt_company" class="my-input" value="<?php echo $item['company'] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">同意票數</label>
            </div>
            <div class="cell-text">
                <input type="text" id="txt_agree" name="txt_agree" class="type-number" value="<?php echo $item['agree'] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">不同意票數</label>
            </div>
            <div class="cell-text">
                <input type="text" id="txt_not_agree" name="txt_not_agree" class="type-number" value="<?php echo $item['not_agree'] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">廢票數</label>
            </div>
            <div class="cell-text">
                <input type="text" id="txt_illegal" name="txt_illegal" class=" type-number" value="<?php echo $item['illegal'] ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title ">
                <label class="label-admin">總票數</label>
            </div>
            <div class="cell-text">
                <input type="text" id="txt_total" name="txt_total" class=" type-number" value="<?php echo $item['total'] ?>" />
            </div>
        </div>


        <div style=" text-align: left">
            <button type="button" id="submitBtn" class="button button-primary"> <?php _e('Submit') ?></button>
        </div>
    </form>
</div>
<script type="text/javascript">
    function countTotal() {
        var agree = Number(jQuery('#txt_agree').val());
        var not_agree = Number(jQuery('#txt_not_agree').val());
        var illegal = Number(jQuery('#txt_illegal').val());
        var total = agree + not_agree + illegal;
        jQuery('#txt_total').val(total);
    }

    jQuery(document).ready(function() {

        jQuery('#txt_agree').change(function() {
            countTotal();
        });
        jQuery('#txt_not_agree').change(function() {
            countTotal();
        });
        jQuery('#txt_illegal').change(function() {
            countTotal();
        });



        jQuery('#submitBtn').on("click", function() {
            var err = [];
            jQuery('#err_kid').html('');
            jQuery('#err_name').html('');

            if (jQuery("#sel_kid").val() === "0") {
                err[1] = "請選上候選者職稱";
            }

            if (jQuery("#txt_name").val() === '') {
                err[2] = '姓名不能為空';
            }

            if (err.length > 0) {
                jQuery('#err_kid').html(err[1]);
                jQuery('#err_name').html(err[2]);
                // err.splice();
            } else {
                jQuery('#f-vote').submit();
            }
        });
    });



    // show hinh anh truoc khi up len
    jQuery(function() {
        jQuery("#vote_img").on("change", function() {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support

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