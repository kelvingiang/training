<?php
/*
  Template Name:  Vote Result
 */
?>
<html id="main">

<head>
    <title>ctcvn vote system</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<style>
.list_style {
    display: flex;
    justify-content: center;
    width: 80%;

}

.list_style li {
    width: 50%;
    text-align: center;
    justify-content: center;
    font-weight: bold;
    color: #666;
    font-size: 1.2em;
}

.list_style li:nth-child(odd) {
    /*background-color:#fafbfc;*/
}

.list_style li div img {
    border: 2px solid #fff;
    width: 90%;
    border-radius: 5px;
    box-shadow: 5px 3px 8px 3px #888888;
}

.vote-title {
    height: 60px;
    text-align: center;
    font-size: 33px;
    padding-top: 40px;
    color: #fff;
    letter-spacing: 3px;
    font-weight: bold;
}

.vote-count {
    text-align: left;
    border-bottom: 1px solid #e1dfde;
    font-size: 0.8em
}

.vote-count div {
    text-align: left;
    padding-left: 10px;
    padding-top: 3px;
    border-bottom: 1px solid #e2dfdd;
}

#main_bg {
    background-color: #fff;
    background-image: url();
    width: 100vw;
    margin: auto;
}
</style>

<body id="main_bg">

    <div class="row" style=" margin: 0">
        <div class="col-lg-12 vote-title" style="background-color:  #fc5108; height: 130px ">台商投票系統</div>
        <!--<div class="col-lg-6 vote-title" style=" background-color:  #002a80">監事長候選名單</div>-->
        <?php
        $lishiList = getVoteResult(1);
        $vote_lishi_total = get_option('_vote_total_lishi');
        ?>
        <div class="col-lg-6"
            style="text-align: center; font-size: 2rem; padding-top: 2rem; border-right: 2px #d6d3d2 solid ">
            <?php // if ($lishiList[0]['total'] > 0) { 
            ?>
            <label> 會長總票 : <?php echo get_option('_vote_total_lishi'); ?> 票 </label><br>
            <!--<label> 廢票 : <?php // echo $lishiList[0]['illegal'];    
                                ?> 票 </label>-->
            <? php // } 
            ?>
            &ensp;
        </div>
        <div class="col-lg-6" style=" text-align: center; font-size: 2rem;margin-top: 2rem">
            <?php //if ($lishiList[0]['total'] > 0) { 
            ?>
            <label> 監事長總票 : <?php echo get_option('_vote_total_jianshi'); ?> 票 </label><br>
            <!--<label> 廢票 : <?php // echo $lishiList[0]['illegal'];    
                                ?> 票 </label>-->
            <?php //} 
            ?>
            &ensp;
        </div>
        <div class="col-lg-12" style=" display: flex; justify-content: center;">
            <ul class="list_style col-lg-6" style="border-right: 2px  #d6d3d2 solid">
                <?php
                foreach ($lishiList as $val) {
                ?>
                <li style="position: relative; color: #651c0e;background-color: #efc0b6">
                    <div style=" margin: 10px 0; font-size: 25px;"><?php echo $val['name'] ?></div>
                    <div> <img src="<?php echo PART_IMAGES_VOTE . $val['img'] ?>" /></div>
                    <div style=" margin:20px 0"><?php echo $val['company'] ?></div>
                    <div class="vote-count" style=" width: 100%; text-align: center">
                        <div style="text-align: center; font-size: 20px"> <label><?php echo $val['agree'] ?> 票 </label>
                        </div>
                        <?php if ($val['agree'] > 0) { ?>
                        <!--                                    <div style="text-align: center; font-size: 20px"> <label>//<?php echo $val['agree'] ?> 票 </label></div>
                                                                     <div><label style=" width: 30%">同意票數 : </label><label>//<?php //echo $val['agree']           
                                                                                                                                ?></label></div>
                                                                     <div><label style=" width: 30%">不同意票數 : </label><label>//<?php // echo $val['not_agree']             
                                                                                                                                ?></label></div>
                                                                    <div><label style=" width: 30%">廢票票數 : </label><label><?php // echo $val['illegal']             
                                                                                                                            ?></label></div>
                                                                    <div><label style=" width: 30%">總票數 : </label><label><?php // echo $val['total']             
                                                                                                                            ?></label></div>-->

                        <?php } ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <!--  PHAN  HIEN THI  GIAM SU TRUONG======================================================================-->
            <ul class="list_style col-lg-6">
                <?php
                $jianshiList = getVoteResult(2);
                $vote_jianshi_total = get_option('_vote_total_jianshi');
                ?>
                <?php
                foreach ($jianshiList as $val) {
                ?>
                <li style="position: relative; color: #13396c;background-color: #a4cff7">
                    <div style=" margin: 10px 0; font-size: 25px;"><?php echo $val['name'] ?></div>
                    <div> <img src="<?php echo PART_IMAGES_VOTE . $val['img'] ?>" /></div>
                    <div style=" margin: 20px 0"><?php echo $val['company'] ?></div>
                    <div class="vote-count" style=" width: 100%; text-align: center">
                        <div style="text-align: center; font-size: 20px"> <label><?php echo $val['agree'] ?> 票 </label>
                        </div>

                        <!--                                <div><label style=" width: 30%">同意票數 : </label><label><?php // echo $val['agree']             
                                                                                                                        ?></label></div>
                            <div><label style=" width: 30%">不同意票數 : </label><label><?php //echo $val['not_agree']             
                                                                                    ?></label></div>-->
                        <!--                                <div><label style=" width: 30%">廢票票數 : </label><label><?php //echo $val['illegal']             
                                                                                                                        ?></label></div>-->
                    </div>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</body>

<script>
jQuery(document).ready(function() {

});
</script>

</html>