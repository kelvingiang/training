<?php

class Setting_Model {

    public function __construct() {
        
    }

    public function Save($arr) {
        update_option("commerce_name", $arr['txt-name']);
        update_option("commerce_address", $arr['txt-address']);
        update_option("commerce_mobile", $arr['txt-mobile']);
        update_option("commerce_phone", $arr['txt-phone']);
        update_option("commerce_fax", $arr['txt-fax']);
        update_option("commerce_email", $arr['txt-email']);
        update_option("commerce_map_x", $arr['txt-map-x']);
        update_option("commerce_map_y", $arr['txt-map-y']);

        update_post_meta(1, '_info_charter', $arr['info_charter']);
        update_post_meta(1, '_info_apply', $arr['info_apply']);
    }

}
