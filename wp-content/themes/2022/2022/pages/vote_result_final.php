<?php
/*
  Template Name:  Vote Final Result
 */
?>
<html>

<head>
    <title>ctcvn vote system</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

</head>
<style>
#main_bg {
    background-image: url();
}
</style>

<body id="main_bg">
    <div class=" container-fluid " style=" background-color: #fff; padding: 0">
        <div class="row" style=" margin: 0">

            <?php
            $lishiList = getVoteFinalResult();
            //$vote_lishi_total = get_option('_vote_total_lishi');
            ?>
            <!--                <div class="col-lg-12 title-space">
                                    <label>理監事選舉結果</label>
                                </div>-->
            <div class="col-lg-12">
                <ul class="result-list" style=" text-align: center">
                    <?php
                    foreach ($lishiList as $val) {
                        switch ($val['position']) {
                            case "1":
                                $position = "總會長";
                                $color = "#fcf5ea";
                                $bg_color = "#fc5108";
                                break;

                            case "2":
                                $position = "監事長";
                                $color = "#e3edf7";
                                $bg_color = "#002a80";
                                break;
                        }
                    ?>
                    <li
                        style="flex: 49%; height: 98vh; letter-spacing: 2px;   border-left: 1px solid #ccc; background-color: <?php echo $color ?>">
                        <div
                            style=" font-weight: bold; font-size: 25px; height: 80px;  line-height: 80px; background-color:<?php echo $bg_color ?>   ; color: white">
                            <?php echo $position ?>
                        </div>
                        <div style="  font-weight: bold; height: 50px; line-height: 50px; color: #333; font-size: 20px">
                            <?php echo $val['name'] ?>
                        </div>
                        <div style="margin-bottom: 50px;  margin-top: 30px; max-height: 500px">
                            <img style=" height: 400px; border-radius: 5px;
                                         box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                         border: 1px solid #999" src="<?php echo PART_IMAGES_VOTE . $val['img'] ?>" />
                        </div>
                        <div style=" justify-content: flex-start; font-size: 1.2em">
                            <?php echo $val['company'] ?>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>

        </div>
    </div>
</body>

<script>
jQuery(document).ready(function() {

});
</script>

</html>