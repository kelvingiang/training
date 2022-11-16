<?php
/*
  Template Name:  Vote Jian shi
 */

if (isPost()) {
    if (count($_POST['chkvote']) > 0) {
        foreach ($_POST['chkvote'] as $val) {
            updateVoteCount($val);
        }
        VoteTotalLishi();
    } else {
        VoteTotalLishi();
        VoteTotalLishifail();
    }
}
$Votetotal = get_option('_vote_total_lishi');
$VotetotalFail = get_option('_vote_total_lishi_fail');
?>
<html id="main">

<head>
    <title>越南台灣商會聯合總會- 投票系統</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <div id="main_bg">
        <div class=" container-fluid ">
            <div class="row">
                <div class="col-lg-12"
                    style=" background-color: #f65900;  text-align: center; letter-spacing: 5px; color:#fff; font-size: 18px">
                    <h1>越南台灣商會聯合總會</h1>
                </div>
                <div class="col-lg-12">
                    <?php
                    get_template_part('templates/template', 'vote-title');
                    $lishiList = getVoteResult(2);
                    ?>
                </div>

                <div class="col-lg-12 title-space" style="text-align: left;margin-top: 2px">
                    <h2 style="letter-spacing: 3px; font-size: 19px; color: #0173FD; font-weight: bold"> 監事長投票結果</h2>
                    <i style="color: #6d6f72;font-size: 15px"> 總票數：<?php echo $Votetotal ?></i> ,
                    <i style="color: #999; font-size: 15px">廢票數： <?php echo $VotetotalFail ?> </i>
                </div>
                <div class="col-lg-12">
                    <form id='f-vote' name='f-vote' action="" method="post">
                        <ul class="vertical-list">
                            <?php
                            foreach ($lishiList as $val) {
                            ?>
                            <li style='width: 10%'>
                                <div class="name-cell">
                                    <label><?php echo $val['name'] ?></label>
                                </div>
                                <div class="img-cell">
                                    <img style="height: 180px" src="<?php echo PART_IMAGES_VOTE . $val['img'] ?>" />
                                </div>
                                <div class='company-cell'>
                                    <label><?php echo $val['company'] ?></label>
                                </div>
                                <div class="total-cell">
                                    <label><?php echo $val['total'] ?></label>
                                </div>
                                <div class="percent-cell"> <?php
                                                                if ($val['vote_total'] > 0 && $Votetotal > 0) {
                                                                    // TINH % TREN CAC PHIEU THANH CONG
                                                                    // $success = $Votetotal - $VotetotalFail;
                                                                    // TINH % TREN TAT CA CAC PHIEU
                                                                    $success = $Votetotal;
                                                                    echo round($val['vote_total'] * 100 / $success, 2) . '%';
                                                                }
                                                                ?>
                                </div>
                                <div class="check-cell">
                                    <input type="checkbox" name="chkvote[]" id='chkvote[]'
                                        value="<?php echo $val['ID'] ?>" />
                                    <label for="checkboxFiveInput"></label>
                                </div>
                                <div class="number-cell">
                                    <label><?php echo $val['number'] ?></label>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div style="float: right">
                            <input type="button" name="all-check" id='all-check' value="全 選"
                                class="btn btn-primary btn-large" />
                            <input type="button" name="btn-submit" id='btn-submit' value="確 定"
                                class="btn btn-danger btn-large" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
jQuery(document).ready(function() {

    jQuery(".check-cell").on('click', function() {
        if (jQuery(this).children("input[type='checkbox']").prop('checked')) {
            jQuery(this).children("input[type='checkbox']").prop('checked', false);
            jQuery(this).parent().removeClass('seleted');
            jQuery(this).css('background-color', '#eeeeef');
        } else {
            jQuery(this).children("input[type='checkbox']").prop('checked', true);
            jQuery(this).parent().addClass('seleted');
            jQuery(this).css('background-color', '#fff');
        }
    });

    jQuery('#btn-submit').on('click', function() {
        jQuery('#f-vote').submit();
    });

    jQuery('#all-check').on('click', function() {
        var ss = jQuery(this).val();
        if (ss === '全 選') {
            jQuery(this).val('取 消');
            jQuery('form#f-vote input:checkbox').each(function() {
                jQuery(this).prop('checked', true);
            });
            jQuery('.vertical-list li').addClass('seleted');
            jQuery('.check-cell').css('background-color', '#fff');
        }

        if (ss === '取 消') {
            jQuery(this).val('全 選');
            jQuery('form#f-vote input:checkbox').each(function() {
                jQuery(this).prop('checked', false);
            });
            jQuery('.vertical-list li').removeClass('seleted');
            jQuery('.check-cell').css('background-color', '#eeeeef');
        }
    });
});
</script>

</html>