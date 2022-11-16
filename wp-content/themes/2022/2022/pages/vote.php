<?php
/*
  Template Name:  Vote
 */
if (!isset($_SESSION['voteLogin'])) {
    wp_redirect(home_url('vote-login'));
}
?>
<!DOCTYPE html>
<html id="main">

<head>
    <title>胡志明台灣商會 - 投票系統</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
    #main {
        margin-top: 0px !important;
    }

    /*
            */
    #main_bg {
        background-color: #FFF;
        background-image: url('');
        padding: 0px;
        font-size: calc(1em + 1vh);
        color: #666;
    }

    h2 {
        letter-spacing: 2px;
        color: #f97a05;
        font-size: 3vh;
        font-weight: bold;
    }

    .list_vote {
        border: 1px solid #ccc;
        border-radius: 5px;

    }

    .list_vote .list_item {
        padding: 2px;
        border-bottom: 1px solid #ccc;
        display: block;
        overflow: auto;
        line-height: 90px
    }

    .list_vote .list_item:nth-child(even) {
        background-color: #fafaf9;
    }

    .list_vote .list_item:hover {
        background-color: #fffef5;
    }

    .list_vote img {
        max-width: 19%;
        max-height: 19%
    }

    .vote-title-bg-sub {
        height: 40px;
        width: 100%;

        background-color: #ea6c05;
        display: block;
    }

    .vote-title-text-sub {
        font-size: 20px;
        color: white;
        letter-spacing: 2px;
        line-height: 40px;
        margin-left: 10px;
    }

    @media only screen and (max-width: 600px) {
        .vote-title-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            font-size: 1.3em;
            color: purple;
        }

    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {
        .vote-title-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
            font-size: 1.8em;
            color: orange;
        }

    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {
        .vote-title-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 12vh;
            font-size: 1.5em;
            color: black;
        }
    }

    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {
        .vote-title-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 17vh;
            font-size: 1.8em;
            color: green;
        }

    }

    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {
        .vote-title-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 12vh;
            font-size: 1.7em;
            color: red;
        }

    }

    @media only screen and (min-width: 1365px) {
        .vote-title-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 15vh;
            font-size: 1.8em;
            color: #002a80;
        }

    }
    </style>
</head>
<?php
$lishiList = getVoteListByKid(1);
$jianshiList = getVoteListByKid(2);
?>

<body id="main_bg">
    <div class=" container-fluid">
        <form name="vote-f" id="vote-f" action="<?php echo home_url('vote-submit') ?>" method="post">
            <div class="row">
                <div class=" col-lg-12" style=" height: 135px; margin-top: 15px">
                    <?php get_template_part('templates/template', 'vote-title') ?>
                </div>
                <div class="col-lg-12">
                    <div class="vote-title-bg-sub">
                        <label class="vote-title-text-sub">會長候選明單</label>
                    </div>
                    <div class="col-lg-12">
                        <div id="lishiSpace" class="list_vote row">
                            <div class="col-lg-12" style="height:35px; background-color: #666; 
                                     color: white; font-size: 17px; padding-left: 1px">
                                <div class=" col-lg-1 col-md-1 col-sm-1 col-xs-1"
                                    style=" height:  inherit;  border-right: 1px #fff solid; padding-top: 8px;">
                                    <input type="checkbox" style="width: 100%;" class="lishiAllcheck"
                                        name="lishiAllcheck" id="lishiAllcheck">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3"
                                    style=" height:  inherit; border-right: 1px solid #fff; padding-top: 8px;">
                                    <label>姓名</label>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-5"
                                    style=" height:  inherit;  border-right: 1px #fff solid; padding-top: 8px;">
                                    <label>公司</label>
                                </div>
                            </div>
                            <?php
                            foreach ($lishiList as $item) {
                            ?>
                            <div class="list_item col-lg-12">
                                <div class=" col-lg-1 col-md-1 col-sm-1 col-xs-1"
                                    style=" text-align: center; background-color:#f5f2f2 ">
                                    <input type="checkbox" style="width: 100%; cursor: pointer" class="lishi"
                                        name="<?php echo $item['ID'] ?>" id="<?php echo $item['ID'] ?>">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                    <?php echo $item['name'] ?>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-5">
                                    <?php echo $item['company'] ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                    <img src="<?php echo PART_IMAGES_VOTE  . $item['img'] ?>" />
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style=" height: 30px"></div>
                <div class="col-lg-12">
                    <div class="vote-title-bg-sub">
                        <label class="vote-title-text-sub">監事長候選明單</label>
                    </div>
                    <div class="col-lg-12">
                        <div id="jianshiSpace" class="list_vote row">
                            <div class="col-lg-12" style="height:35px; background-color: #666; 
                                     color: white; font-size: 17px; padding-left: 1px">
                                <div class=" col-lg-1 col-md-1 col-sm-1 col-xs-1"
                                    style=" height:  inherit;  border-right: 1px #fff solid; padding-top: 8px;">
                                    <input type="checkbox" style="width: 100%;" class="lishi" name="jianshiAllcheck"
                                        id="jianshiAllcheck">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3"
                                    style=" height:  inherit; border-right: 1px solid #fff; padding-top: 8px;">
                                    <label>姓名</label>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-5"
                                    style=" height:  inherit;  border-right: 1px #fff solid; padding-top: 8px;">
                                    <label>公司</label>
                                </div>
                            </div>
                            <?php
                            foreach ($jianshiList as $item) {
                            ?>
                            <div class="list_item col-lg-12">
                                <div class=" col-lg-1 col-md-1 col-sm-1 col-xs-1"
                                    style=" text-align: center; background-color:#f5f2f2 ">
                                    <input type="checkbox" style="width: 100%; cursor: pointer"" class=" jianshi"
                                        name="<?php echo $item['ID'] ?>" id="<?php echo $item['ID'] ?>">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                    <?php echo $item['name'] ?>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-5">
                                    <?php echo $item['company'] ?>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-3">
                                    <img src="<?php echo PART_IMAGES_VOTE . $item['img'] ?>" />
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12"
                    style=" height: 100px; text-align: right; padding-right: 50px; padding-top: 20px">
                    <button type="button" name="btn-submit" id="btn-submit" class="btn btn-primary btn-large"
                        style=" font-size: 20px; font-weight: bold"> 投 票 </button>
                </div>
            </div>
        </form>
        <div id="dialog" title="提醒注意">
            <p>This is an animated dialog which is useful for displaying information. The dialog window can be moved,
                resized and closed with the 'x' icon.</p>
        </div>
    </div>
    </div>
</body>

</html>
<style>
#dialog {
    background-color: red;
    color: #FFF;
    font-weight: bold;
}
</style>


<script>
jQuery(document).ready(function() {

    // KIEM TRA KHI CHECK CHO LISHI
    // KHI lishiAllcheck CHECK SE CHON HET TAT CA lishi
    jQuery('#lishiAllcheck').on('click', function() {
        if (this.checked === true) {
            jQuery('#lishiSpace .lishi').prop('checked', true);
        } else {
            jQuery('#lishiSpace .lishi').prop('checked', false);
        }
    });
    // KIEM TRA KHI 1 TRONG CAC lishi KHONG DUOC CHON THI  SE KHONG DC CHON VA NGUOC LAI
    jQuery('.lishi').on('change', function() {
        var flag;
        jQuery('#lishiSpace .lishi').each(function() {
            if (jQuery(this).prop('checked') === false) {
                flag = false;
                return false;
            } else {
                flag = true;
            }
        });
        if (flag === false) {
            jQuery('#lishiAllcheck').prop('checked', false);
        } else {
            jQuery('#lishiAllcheck').prop('checked', true);
        }
    });

    // KIEM TRA KHI CHECK  CHO  JIANSHI
    // KHI jianshiAllcheck CHECK  SE CHON TAT CA CAC  jianshi 
    jQuery('#jianshiAllcheck').on('click', function() {
        if (this.checked === true) {
            jQuery('#jianshiSpace .jianshi').prop('checked', true);
        } else {
            jQuery('#jianshiSpace .jianshi').prop('checked', false);
        }
    });
    // KIEM TRA KHI 1 TRONG CAC jianshi KHONG DUOC CHON THI SE  KHONG DUOC CHON
    jQuery('.jianshi').on('change', function() {
        var flag;
        jQuery('#jianshiSpace .jianshi').each(function() {
            if (jQuery(this).prop('checked') === false) {
                flag = false;
                return false;
            } else {
                flag = true;
            }
        });
        if (flag === false) {
            jQuery('#jianshiAllcheck').prop('checked', false);
        } else {
            jQuery('#jianshiAllcheck').prop('checked', true);
        }
    });

    // =-======== GIOI HAN  SO LUONG  CHCK CHON CUA CHECKBOX
    var liShiCount = 0;
    var jianShiCount = 0;
    // GIOI HAN CHECK CHON CHO LISHI
    jQuery('input.lishi[type="checkbox"]').click(function() {
        if (jQuery(this).is(":checked")) {
            liShiCount++;
            if (liShiCount > 5) {
                jQuery("#dialog").dialog("open");
                jQuery("#dialog p").text("您勾選投票理事，人數已超過五位");
                jQuery(this).attr("checked", false);
                liShiCount--;
            }
        } else if (jQuery(this).is(":not(:checked)")) {
            liShiCount--;
            console.log(liShiCount);
        }
    });
    // GIOI HAN CHECK CHON CHO JIANSHI
    jQuery('input.jianshi[type="checkbox"]').click(function() {
        if (jQuery(this).is(":checked")) {
            jianShiCount++;
            if (jianShiCount > 3) {
                jQuery("#dialog").dialog("open");
                jQuery("#dialog p").text("您勾選投票監事，人數已超過三位 ");
                jQuery(this).attr("checked", false);
                jianShiCount--;
            }
            console.log("+" + jianShiCount);
        } else if (jQuery(this).is(":not(:checked)")) {
            jianShiCount--;
            console.log("-" + jianShiCount);
        }
    });

    // SHOW BANG THONG BAO KHI CHON QUA MUC CHO PHEP CHON
    jQuery(function() {
        jQuery("#dialog").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });

    });

    // PHAN SUBMIT  FORM 
    jQuery("#btn-submit").on("click", function() {
        jQuery("#vote-f").submit();
    });
});
</script>