<div>
    <h1>XML</h1>
    <?php
    $file = file_get_contents(PART_CLASS . 'xml/member.xml');
    // echo $file;
    $xml  = simplexml_load_string($file);

    foreach ($xml as $val) {
        echo '<div>' . $val->name . '-' . $val->phone . '</div>';
    }
    ?>
    <h3>the end</h3>
    <div>
        <h1>Face Book</h1>
        <?php

        //$filefb = file_get_contents("http://fetchrss.com/rss/614c3ab8f828637ffd32c5d2614c3a4278c825530148a012.xml");
        $filefb = file_get_contents("https://rss.app/feeds/qBvxgH6KfWVv4eXt.xml");

        $xmlfb  = simplexml_load_string($filefb);

        foreach ($xmlfb->channel->item as $val) { ?>
        <div>
            <div><a href="<?php echo $val->link ?>"> <?php echo $val->title ?></a></div>
            <div><?php echo $val->description ?> </div>
        </div>
        <?php }
        // curl_close($curl_handle);
        ?>

    </div>


    <h1>XML web </h1>
    <?php

    $file2 = file_get_contents("https://vnexpress.net/rss/thoi-su.rss");

    //$file2 = curl_get_contents("https://vnexpress.net/rss/thoi-su.rss");
    //$xml2  = simplexml_load_file($file2);
    $xml2  = simplexml_load_string($file2);

    foreach ($xml2->channel->item as $val) { ?>
    <div>
        <div><a href="<?php echo $val->link ?>"> <?php echo $val->title ?></a></div>
        <div><?php echo $val->description ?> </div>
    </div>
    <?php }
    // curl_close($curl_handle);
    ?>

    <?php



    ?>

    <h3>the end</h3>
</div>