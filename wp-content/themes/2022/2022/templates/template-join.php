<?php
//$uri = $_SERVER['REQUEST_URI'];  // lay url tai trang hien hanh
// LAY DU DC THIET LAP TRONG PHAN APPLY CUA ADMIN 
$arrArgs = array(
    'post_type' => 'apply',
);
$objApply = current(get_posts($arrArgs));

if ($objApply) {

    $getMeta = get_post_meta($objApply->ID);

    $dontiep1 = $getMeta['a_dontiep_1'][0];
    $dontiep2 = $getMeta['a_dontiep_2'][0];
    $dontiep3 = $getMeta['a_dontiep_3'][0];
    $dontiep4 = $getMeta['a_dontiep_4'][0];
    $dontiep5 = $getMeta['a_dontiep_5'][0];
    $dontiep = $dontiep1 . $dontiep2 . $dontiep3 . $dontiep4 . $dontiep5;
    $attend = $getMeta['a_attend'][0];
    $hotel = $getMeta['a_hotel'][0];
    $roomFee = $getMeta['a_room_fee'][0];
    $roomNote = $getMeta['a_room_note'][0];
    $room = $hotel . $roomFee . $roomNote;
    $meal1 = $getMeta['a_meal_1'][0];
    $meal2 = $getMeta['a_meal_2'][0];
    $meal3 = $getMeta['a_meal_3'][0];
    $meal4 = $getMeta['a_meal_4'][0];
    $meal5 = $getMeta['a_meal_5'][0];
    $meal = $meal1 . $meal2 . $meal3 . $meal4 . $meal5;
    $mealNote = $getMeta['a_meal_note'][0];
    $Note = $getMeta['a_note'][0];
    //ADD NEW 10/03/16
    $orther_title_1 = $getMeta['a_orther_title_one'][0];
    $orther_title_2 = $getMeta['a_orther_title_two'][0];
    $orther_title_3 = $getMeta['a_orther_title_three'][0];
    $orther_title_4 = $getMeta['a_orther_title_fore'][0];
    $orther_title_5 = $getMeta['a_orther_title_five'][0];
    $orther_content_1 = $getMeta['a_orther_content_one'][0];
    $orther_content_2 = $getMeta['a_orther_content_two'][0];
    $orther_content_3 = $getMeta['a_orther_content_three'][0];
    $orther_content_4 = $getMeta['a_orther_content_fore'][0];
    $orther_content_5 = $getMeta['a_orther_content_five'][0];
}

//KIEM TRA XEM NGUOI DUNG DA DANG KY CHUA IF DANG KY ROI THI LAY DATA VA KO INSERT DONG DATA MOI
global $flag;
$flag = TRUE;   // bien nay dung de kiem tra nguoi dung dang ky chua de xac dinh viec cap nhat hay them moi    
global $joinID;  // lay id nay de ap dung cho veic cap nhat du lieu o phan update

if (empty($joinID)) {
    $joinArr = array(
        'post_status' => 'publish',
        'post_type' => 'join',
        'meta_query' => array(array('key' => 'e_registerby', 'value' => $_SESSION['login'])),
    );
    $myQuery = new WP_Query($joinArr);
    if ($myQuery->have_posts()):
        $flag = FALSE;
        while ($myQuery->have_posts()):
            $myQuery->the_post();
            $id = get_the_ID();
            $joinID = get_the_ID();

            $e_branch = get_post_meta($id, 'e_brach', true);
            $e_count = get_post_meta($id, 'e_count', true);
            $e_name_1 = get_post_meta($id, 'e_name_1', true);
            $e_name_2 = get_post_meta($id, 'e_name_2', true);
            $e_name_3 = get_post_meta($id, 'e_name_3', true);
            $e_name_4 = get_post_meta($id, 'e_name_4', true);
            $e_lastname_1 = get_post_meta($id, 'e_lastname_1', true);
            $e_lastname_2 = get_post_meta($id, 'e_lastname_2', true);
            $e_lastname_3 = get_post_meta($id, 'e_lastname_3', true);
            $e_lastname_4 = get_post_meta($id, 'e_lastname_4', true);
            $e_midename_1 = get_post_meta($id, 'e_midename_1', true);
            $e_midename_2 = get_post_meta($id, 'e_midename_2', true);
            $e_midename_3 = get_post_meta($id, 'e_midename_3', true);
            $e_midename_4 = get_post_meta($id, 'e_midename_4', true);
            $e_firstname_1 = get_post_meta($id, 'e_firstname_1', true);
            $e_firstname_2 = get_post_meta($id, 'e_firstname_2', true);
            $e_firstname_3 = get_post_meta($id, 'e_firstname_3', true);
            $e_firstname_4 = get_post_meta($id, 'e_firstname_4', true);
            $e_relation_1 = get_post_meta($id, 'e_relation_1', true);
            $e_relation_2 = get_post_meta($id, 'e_relation_2', true);
            $e_relation_3 = get_post_meta($id, 'e_relation_3', true);
            $e_relation_4 = get_post_meta($id, 'e_relation_4', true);
            $e_sex_1 = get_post_meta($id, 'e_sex_1', true);
            $e_sex_2 = get_post_meta($id, 'e_sex_2', true);
            $e_sex_3 = get_post_meta($id, 'e_sex_3', true);
            $e_sex_4 = get_post_meta($id, 'e_sex_4', true);
            $e_eat = get_post_meta($id, 'e_eat', true);
            $e_eat_1 = get_post_meta($id, 'e_eat_1', true);
            $e_eat_2 = get_post_meta($id, 'e_eat_2', true);
            $e_eat_3 = get_post_meta($id, 'e_eat_3', true);
            $e_eat_4 = get_post_meta($id, 'e_eat_4', true);
            $e_dontiep = get_post_meta($id, 'e_dontiep', true);
            // SET GIA TRI MAC DINH CHO EAT
            if (empty($e_eat)) {
                $e_eat = '1';
            }
//PHAN DON TIEP                    
            $dontiep = unserialize($e_dontiep);
            foreach ($dontiep as $key => $val) {
                switch ($val) {
                    case '自理' :
                        $e_dontiep_0 = 'on';
                        break;
                    case $dontiep1 :
                        $e_dontiep_1 = 'on';
                        break;
                    case $dontiep2 :
                        $e_dontiep_2 = 'on';
                        break;
                    case $dontiep3 :
                        $e_dontiep_3 = 'on';
                        break;
                    case $dontiep4 :
                        $e_dontiep_4 = 'on';
                        break;
                    case $dontiep5 :
                        $e_dontiep_5 = 'on';
                        break;
                }
            }
            
            
            // PHAN DAT PHONG             
            $e_room = get_post_meta($id, 'e_room', true);
            $room = unserialize($e_room);
            
            $e_check_in    = $room['check_in'];
            $e_check_out   = $room['check_out'];
            $e_s_room_qty   = $room['s_qty'];
            $e_b_room_qty   = $room['b_qty'];
            $room['s_bed'] === "一大床" ? $e_s_bed = 'on' : '';
            $room['b_bed'] === "兩小床" ? $e_b_bed = 'on' : '';

//            foreach ($room as $key => $val) {
//                if ($val == '自理') {
//                    $e_no_room = 'on';
//                }
//                if ($key == 'check_in') {
//                    $e_check_in = $val;
//                }
//                if ($key == 'check_out') {
//                    $e_check_out = $val;
//                }
////                if ($val == '單人房') {
////                    $e_s_room = 'on';
////                }
////                if ($val == '雙人房') {
////                    $e_b_room = 'on';
////                }
//                if ($key == 's_qty') {
//                    $e_s_room_qty = $val;
//                }
//                if ($key == 'b_qty') {
//                    $e_b_room_qty = $val;
//                }
//                if ($val == '兩小床') {
//                    $e_b_bed = 'on';
//                }
//                if ($val == '一大床') {
//                    $e_s_bed = 'on';
//                }
//            }

            $e_meal = get_post_meta($id, 'e_meal', true);
            $meal = unserialize($e_meal);
            foreach ($meal as $val1) {
                $arr = explode(',', $val1);
                if (trim($arr[0]) == trim($meal1)) {
                //   $e_meal_1 = 'on';
                    $e_meal_qty_1 = trim($arr[2]);
                }
                if (trim($arr[0]) == trim($meal2)) {
                  //  $e_meal_2 = 'on';
                    $e_meal_qty_2 = trim($arr[2]);
                }
                if (trim($arr[0]) == trim($meal3)) {
                    //$e_meal_3 = 'on';
                    $e_meal_qty_3 = trim($arr[2]);
                }
                if (trim($arr[0]) == trim($meal4)) {
                    //$e_meal_4 = 'on';
                    $e_meal_qty_4 = trim($arr[2]);
                }
                if (trim($arr[0]) == trim($meal5)) {
                    //$e_meal_5 = 'on';
                    $e_meal_qty_5 = trim($arr[2]);
                }
            }

            $e_orther = get_post_meta($id, 'e_orther', true);
            $orther = unserialize($e_orther);
            foreach ($orther as $val) {
                $arr = explode(',', $val);
                $o_title = trim($arr[0]);
                switch ($o_title) {
                    case $orther_title_1:
                        $e_orther_qty_1 = trim($arr[2]);
                        break;
                    case $orther_title_2 :
                        $e_orther_qty_2 = trim($arr[2]);
                        break;
                    case $orther_title_3:
                        $e_orther_qty_3 =  trim($arr[2]);
                        break;
                    case $orther_title_4:
                        $e_orther_qty_4 = trim($arr[2]);
                        break;
                    case  $orther_title_5:
                        $e_orther_qty_5 = trim($arr[2]);
                        break;
                }
            }

            $e_note = trim(get_post_meta($id, 'e_note', true));
        endwhile;
    endif;
}

// ====================KIEM TRA INPUT BANG FUNCTION TRONG DANG  TUYEN=============================
$e_error = '';

if ($_POST) {
    if (isset($_POST['e_branch'])) {
        $e_branch = $_POST['e_branch'];
        if ($e_branch == '0') {
            $err_e_branch = '請選擇商會名稱';
            $e_error = 'branch';
        }
    }

    if (isset($_POST['e_count'])) {
        $e_count = $_POST['e_count'];
    }

    if (isset($_POST['e_note'])) {
        $e_note = trim($_POST['e_note']);
    }

    // KIEM TRA CAC IINPUT NAME 
    $err_count = '';
    if (isset($_POST['e_name_1'])) {
        $e_name_1 = $_POST['e_name_1'];
        $back_name_1 = checkstr($e_name_1, 1, 20);
        if (!empty($back_name_1)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'name1';
        }
    }
    if (isset($_POST['e_name_2'])) {
        $e_name_2 = $_POST['e_name_2'];
        $back_name_2 = checkstr($e_name_2, 1, 20);
        if (!empty($back_name_2)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'name2';
        }
    }
    if (isset($_POST['e_name_3'])) {
        $e_name_3 = $_POST['e_name_3'];
        $back_name_3 = checkstr($e_name_3, 1, 20);
        if (!empty($back_name_3)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'name3';
        }
    }
    if (isset($_POST['e_name_4'])) {
        $e_name_4 = $_POST['e_name_4'];
        $back_name_4 = checkstr($e_name_4, 1, 20);
        if (!empty($back_name_4)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'name4';
        }
    }

    // KIEM TRA CAC IINPUT ENGLISH NAME 
    if (isset($_POST['e_lastname_1']) || isset($_POST['e_midename_1']) || isset($_POST['e_firstname_1'])) {
        $e_lastname_1 = $_POST['e_lastname_1'];
        $e_midename_1 = $_POST['e_midename_1'];
        $e_firstname_1 = $_POST['e_firstname_1'];
        $back_lastname_1 = checkstr($e_lastname_1);
        $back_midename_1 = checkstr($e_midename_1);
        $back_firstname_1 = checkstr($e_firstname_1);
        if (!empty($back_lastname_1)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'lastname1';
        }
        if (!empty($back_midename_1)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'midename1';
        }
        if (!empty($back_firstname_1)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'firstname1';
        }
    }
    if (isset($_POST['e_lastname_2']) || isset($_POST['e_midename_2']) || isset($_POST['e_firstname_2'])) {
        $e_lastname_2 = $_POST['e_lastname_2'];
        $e_midename_2 = $_POST['e_midename_2'];
        $e_firstname_2 = $_POST['e_firstname_2'];
        $back_lastname_2 = checkstr($e_lastname_2);
        $back_midename_2 = checkstr($e_midename_2);
        $back_firstname_2 = checkstr($e_firstname_2);
        if (!empty($back_lastname_2)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'lastname2';
        }
        if (!empty($back_midename_2)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'midename2';
        }
        if (!empty($back_firstname_2)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'firstname2';
        }
    }
    if (isset($_POST['e_lastname_3']) || isset($_POST['e_midename_3']) || isset($_POST['e_firstname_3'])) {
        $e_lastname_3 = $_POST['e_lastname_3'];
        $e_midename_3 = $_POST['e_midename_3'];
        $e_firstname_3 = $_POST['e_firstname_3'];
        $back_lastname_3 = checkstr($e_lastname_3);
        $back_midename_3 = checkstr($e_midename_3);
        $back_firstname_3 = checkstr($e_firstname_3);
        if (!empty($back_lastname_3)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'lastname3';
        }
        if (!empty($back_midename_3)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'midename3';
        }
        if (!empty($back_firstname_3)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'firstname3';
        }
    }
    if (isset($_POST['e_lastname_4']) || isset($_POST['e_midename_4']) || isset($_POST['e_firstname_4'])) {
        $e_lastname_4 = $_POST['e_lastname_4'];
        $e_midename_4 = $_POST['e_midename_4'];
        $e_firstname_4 = $_POST['e_firstname_4'];
        $back_lastname_4 = checkstr($e_lastname_4);
        $back_midename_4 = checkstr($e_midename_4);
        $back_firstname_4 = checkstr($e_firstname_4);
        if (!empty($back_lastname_4)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'lastname4';
        }
        if (!empty($back_midename_4)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'midename4';
        }
        if (!empty($back_firstname_4)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'firstname4';
        }
    }

    // KIEM TRA CAC IINPUT RELATION 
    if (isset($_POST['e_relation_1'])) {
        $e_relation_1 = $_POST['e_relation_1'];
        $back_relation_1 = checkstr($e_relation_1, 1, 20);
        if (!empty($back_relation_1)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'relation1';
        }
    }
    if (isset($_POST['e_relation_2'])) {
        $e_relation_2 = $_POST['e_relation_2'];
        $back_relation_2 = checkstr($e_relation_2, 1, 20);
        if (!empty($back_relation_2)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'relation2';
        }
    }
    if (isset($_POST['e_relation_3'])) {
        $e_relation_3 = $_POST['e_relation_3'];
        $back_relation_3 = checkstr($e_relation_3, 1, 20);
        if (!empty($back_relation_3)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'relation3';
        }
    }
    if (isset($_POST['e_relation_4'])) {
        $e_relation_4 = $_POST['e_relation_4'];
        $back_relation_4 = checkstr($e_relation_4, 1, 20);
        if (!empty($back_relation_4)) {
            $err_count = '請檢查隨行眷屬的資料';
            $e_error = 'relation4';
        }
    }

    //KIEM TRA DONTIEP
    if (!isset($_POST['e_dontiep_0']) && !isset($_POST['e_dontiep_1']) && !isset($_POST['e_dontiep_2']) && !isset($_POST['e_dontiep_3']) && !isset($_POST['e_dontiep_4']) && !isset($_POST['e_dontiep_4'])) {
        $err_dontiep = '請選擇接送方式';
        $e_error .= ',dontiep';
    } else {
        $err_dontiep = '';
    }
    if ($_POST['e_dontiep_0'] == 'on') {
        $e_dontiep_0 = 'on';
    }
    if (isset($_POST['e_dontiep_1'])) {
        $e_dontiep_1 = 'on';
    }
    if (isset($_POST['e_dontiep_2'])) {
        $e_dontiep_2 = 'on';
    }
    if (isset($_POST['e_dontiep_3'])) {
        $e_dontiep_3 = 'on';
    }
    if (isset($_POST['e_dontiep_4'])) {
        $e_dontiep_4 = 'on';
    }
    if (isset($_POST['e_dontiep_5'])) {
        $e_dontiep_5 = 'on';
    }

    //KIEM TRA ROOM
    if (!isset($_POST['e_no_room']) && empty($_POST['e_check_in']) && empty($_POST['e_check_out'])) {
        $err_room1 = '請選擇訂房資料';
        $e_error .= ',room';
    } else {
        $err_room1 = '';
    }
    if (isset($_POST['e_no_room'])) {
        $e_no_room = 'on';
    }
    if (!empty($_POST['e_check_in'])) {
        $e_check_in = $_POST['e_check_in'];
    }
    if (!empty($_POST['e_check_out'])) {
        $e_check_out = $_POST['e_check_out'];
    }
//    if (!empty($_POST['e_s_room'])) {
//        $e_s_room = 'on';
//    }
//    if (!empty($_POST['e_b_room'])) {
//        $e_b_room = 'on';
//    }
    if (isset($_POST['e_s_bed'])) {
        $e_s_bed = 'on';
    }
    if (isset($_POST['e_b_bed'])) {
        $e_b_bed = 'on';
    }
    if (!empty($_POST['e_s_room_qty'])) {
        $e_s_room_qty = $_POST['e_s_room_qty'];
    }
    if (!empty($_POST['e_b_room_qty'])) {
        $e_b_room_qty = $_POST['e_b_room_qty'];
    }

    //KIEM SO LUONG DAT PHONG
//    if ((isset($_POST['e_s_room']) && empty($_POST['e_s_room_qty'])) || (isset($_POST['e_b_room']) && empty($_POST['e_b_room_qty']))) {
//        $err_room2 = '請輸入數量';
//        $e_error .= ',room';
//    } else {
//        $err_room2 = '';
//    }

    $err_room = $err_room1;//. $err_room2;


    //KIEM PHAN DANG KY DUNG BUA
//    if (isset($_POST['e_meal_1'])) {
//        $e_meal_1 = 'on';
//    }
//    if (isset($_POST['e_meal_2'])) {
//        $e_meal_2 = 'on';
//    }
//    if (isset($_POST['e_meal_3'])) {
//        $e_meal_3 = 'on';
//    }
//    if (isset($_POST['e_meal_4'])) {
//        $e_meal_4 = 'on';
//    }
//    if (isset($_POST['e_meal_5'])) {
//        $e_meal_5 = 'on';
//    }
    if (!empty($_POST['e_meal_qty_1'])) {
        $e_meal_qty_1 = $_POST['e_meal_qty_1'];
    }
    if (!empty($_POST['e_meal_qty_2'])) {
        $e_meal_qty_2 = $_POST['e_meal_qty_2'];
    }
    if (!empty($_POST['e_meal_qty_3'])) {
        $e_meal_qty_3 = $_POST['e_meal_qty_3'];
    }
    if (!empty($_POST['e_meal_qty_4'])) {
        $e_meal_qty_4 = $_POST['e_meal_qty_4'];
    }
    if (!empty($_POST['e_meal_qty_5'])) {
        $e_meal_qty_5 = $_POST['e_meal_qty_5'];
    }
    // DO BO QUA PHAN CHECK BOX CHO NEN KHONG CAN KIEM TRA SO LUONG 
    //KIEM SO LUONG
//    if ((isset($_POST['e_meal_1']) && empty($_POST['e_meal_qty_1'])) ||
//            (isset($_POST['e_meal_2']) && empty($_POST['e_meal_qty_2'])) ||
//            (isset($_POST['e_meal_3']) && empty($_POST['e_meal_qty_3'])) ||
//            (isset($_POST['e_meal_4']) && empty($_POST['e_meal_qty_4'])) ||
//            (isset($_POST['e_meal_5']) && empty($_POST['e_meal_qty_5']))) {
//        $err_meal = '請輸入參加人數';
//        $e_error .= ',meal';
//    } else {
//        $err_meal = '';
//    }


    //KIEM TRA PHAN NOT
    if (!empty($_POST['e_note'])) {
        $e_note = trim($_POST['e_note']);
    }

    // TETS     
}
//===  INSERT DATA  ============================================================================
addData($e_error);

// echo $e_error;
//   echo get_the_title();

function addData($error) {
    if (empty($error)) {
        global $flag;
        if ($_POST) {
            $_SESSION['submit'] = 'submit';
            if ($flag == true) { //       echo 'data have already insert to databse';
                $newRecruit = array(
                    'post_title' => get_the_title(),
                    'post_status' => 'publish',
                    'post_type' => 'join'
                );
                //add post moi
                $joinMeta = wp_insert_post($newRecruit);
                //   wp_set_object_terms($joinMeta, $cat, 'recruitment_category');
            }
            //KHAI BAO LAI BIEN joinMeta DE AP DUNG CHO VIEC UPDATE DATA
            if (!isset($joinMeta)) {
                global $joinID;
                $joinMeta = $joinID;
            }
            // Save phan metabox active //
            update_post_meta($joinMeta, 'e_registerby', $_SESSION['login']);
            update_post_meta($joinMeta, 'e_eventtitle', get_the_title());
            update_post_meta($joinMeta, 'e_fullname', $_POST['fullName']);
            update_post_meta($joinMeta, 'e_enname', $_POST['enName']);
            update_post_meta($joinMeta, 'e_phone', $_POST['phone']);
            update_post_meta($joinMeta, 'e_email', $_POST['email']);
            update_post_meta($joinMeta, 'e_position', $_POST['position']);
            update_post_meta($joinMeta, 'e_sex', $_POST['sex']);
            update_post_meta($joinMeta, 'e_brach', $_POST['e_branch']);
            update_post_meta($joinMeta, 'e_count', $_POST['e_count']);
            update_post_meta($joinMeta, 'e_note', $_POST['e_note']);
            update_post_meta($joinMeta, 'e_eat', $_POST['e_eat']);
            // DU LIEU NGUOI DI CUNG            
            if (isset($_POST['e_name_1'])) {
                update_post_meta($joinMeta, 'e_name_1', $_POST['e_name_1']);
                update_post_meta($joinMeta, 'e_enname_1', $_POST['e_lastname_1'] . ',' . $_POST['e_midename_1'] . '-' . $_POST['e_firstname_1']);
                update_post_meta($joinMeta, 'e_lastname_1', $_POST['e_lastname_1']);
                update_post_meta($joinMeta, 'e_midename_1', $_POST['e_midename_1']);
                update_post_meta($joinMeta, 'e_firstname_1', $_POST['e_firstname_1']);
                update_post_meta($joinMeta, 'e_relation_1', $_POST['e_relation_1']);
                update_post_meta($joinMeta, 'e_sex_1', $_POST['e_sex_1']);
                update_post_meta($joinMeta, 'e_eat_1', $_POST['e_eat_1']);
            }else{
                update_post_meta($joinMeta, 'e_name_1', '');
                update_post_meta($joinMeta, 'e_enname_1', '');
                update_post_meta($joinMeta, 'e_lastname_1', '');
                update_post_meta($joinMeta, 'e_midename_1','');
                update_post_meta($joinMeta, 'e_firstname_1', '');
                update_post_meta($joinMeta, 'e_relation_1', '');
                update_post_meta($joinMeta, 'e_sex_1', '');
                update_post_meta($joinMeta, 'e_eat_1', '');
            }

            if (isset($_POST['e_name_2'])) {
                update_post_meta($joinMeta, 'e_name_2', $_POST['e_name_2']);
                update_post_meta($joinMeta, 'e_enname_2', $_POST['e_lastname_2'] . ',' . $_POST['e_midename_2'] . '-' . $_POST['e_firstname_2']);
                update_post_meta($joinMeta, 'e_lastname_2', $_POST['e_lastname_2']);
                update_post_meta($joinMeta, 'e_midename_2', $_POST['e_midename_2']);
                update_post_meta($joinMeta, 'e_firstname_2', $_POST['e_firstname_2']);
                update_post_meta($joinMeta, 'e_relation_2', $_POST['e_relation_2']);
                update_post_meta($joinMeta, 'e_sex_2', $_POST['e_sex_2']);
                update_post_meta($joinMeta, 'e_eat_2', $_POST['e_eat_2']);
            }else{
                update_post_meta($joinMeta, 'e_name_2', '');
                update_post_meta($joinMeta, 'e_enname_2', '');
                update_post_meta($joinMeta, 'e_lastname_2', '');
                update_post_meta($joinMeta, 'e_midename_2','');
                update_post_meta($joinMeta, 'e_firstname_2', '');
                update_post_meta($joinMeta, 'e_relation_2', '');
                update_post_meta($joinMeta, 'e_sex_2', '');
                update_post_meta($joinMeta, 'e_eat_2', '');
            }

            if (isset($_POST['e_name_3'])) {
                update_post_meta($joinMeta, 'e_name_3', $_POST['e_name_3']);
                update_post_meta($joinMeta, 'e_enname_3', $_POST['e_lastname_3'] . ',' . $_POST['e_midename_3'] . '-' . $_POST['e_firstname_3']);
                update_post_meta($joinMeta, 'e_lastname_3', $_POST['e_lastname_3']);
                update_post_meta($joinMeta, 'e_midename_3', $_POST['e_midename_3']);
                update_post_meta($joinMeta, 'e_firstname_3', $_POST['e_firstname_3']);
                update_post_meta($joinMeta, 'e_relation_3', $_POST['e_relation_3']);
                update_post_meta($joinMeta, 'e_sex_3', $_POST['e_sex_3']);
                update_post_meta($joinMeta, 'e_eat_3', $_POST['e_eat_3']);
            }else{
                update_post_meta($joinMeta, 'e_name_3', '');
                update_post_meta($joinMeta, 'e_enname_3', '');
                update_post_meta($joinMeta, 'e_lastname_3', '');
                update_post_meta($joinMeta, 'e_midename_3','');
                update_post_meta($joinMeta, 'e_firstname_3', '');
                update_post_meta($joinMeta, 'e_relation_3', '');
                update_post_meta($joinMeta, 'e_sex_3', '');
                update_post_meta($joinMeta, 'e_eat_3', '');
            }

            if (isset($_POST['e_name_4']) && !empty($_POST['e_name_4']) ) {
                update_post_meta($joinMeta, 'e_name_4', $_POST['e_name_4']);
                update_post_meta($joinMeta, 'e_enname_4', $_POST['e_lastname_4'] . ',' . $_POST['e_midename_4'] . '-' . $_POST['e_firstname_4']);
                update_post_meta($joinMeta, 'e_lastname_4', $_POST['e_lastname_4']);
                update_post_meta($joinMeta, 'e_midename_4', $_POST['e_midename_4']);
                update_post_meta($joinMeta, 'e_firstname_4', $_POST['e_firstname_4']);
                update_post_meta($joinMeta, 'e_relation_4', $_POST['e_relation_4']);
                update_post_meta($joinMeta, 'e_sex_4', $_POST['e_sex_4']);
                update_post_meta($joinMeta, 'e_eat_4', $_POST['e_eat_4']);
            }else{
                update_post_meta($joinMeta, 'e_name_4', '');
                update_post_meta($joinMeta, 'e_enname_4', '');
                update_post_meta($joinMeta, 'e_lastname_4', '');
                update_post_meta($joinMeta, 'e_midename_4','');
                update_post_meta($joinMeta, 'e_firstname_4', '');
                update_post_meta($joinMeta, 'e_relation_4', '');
                update_post_meta($joinMeta, 'e_sex_4', '');
                update_post_meta($joinMeta, 'e_eat_4', '');
            }
            // CACH THUC DUA DON
            $dontiep = array();
            if (isset($_POST['e_dontiep_0'])) {
                $dontiep[] = $_POST['e_dontiep_0'];
            }
            if (isset($_POST['e_dontiep_1'])) {
                $dontiep[] = $_POST['e_dontiep_1'];
            }
            if (isset($_POST['e_dontiep_2'])) {
                $dontiep[] = $_POST['e_dontiep_2'];
            }
            if (isset($_POST['e_dontiep_3'])) {
                $dontiep[] = $_POST['e_dontiep_3'];
            }
            if (isset($_POST['e_dontiep_4'])) {
                $dontiep[] = $_POST['e_dontiep_4'];
            }
            if (isset($_POST['e_dontiep_5'])) {
                $dontiep[] = $_POST['e_dontiep_5'];
            }
            update_post_meta($joinMeta, 'e_dontiep', serialize($dontiep));
            // DUNG DAT PHONG HOTEL
            $room = array();
            if (isset($_POST['e_no_room'])) {
                $room['no_room'] = $_POST['e_no_room'];
            }
            if (isset($_POST['e_check_in'])) {
                $room['check_in'] = $_POST['e_check_in'];
            }
            if (isset($_POST['e_check_out'])) {
                $room['check_out'] = $_POST['e_check_out'];
            }
//            if (isset($_POST['e_s_room'])) {
//                $room['s_room'] = $_POST['e_s_room'];
//            }
//            if (isset($_POST['e_b_room'])) {
//                $room['b_room'] = $_POST['e_b_room'];
//            }
            if ($_POST['e_s_room_qty'] !='' &&  $_POST['e_s_room_qty'] > 0 ) {
                $room['s_qty'] = $_POST['e_s_room_qty'];
            }
            if ($_POST['e_b_room_qty'] != '' && $_POST['e_b_room_qty'] > 0 ) {
                $room['b_qty'] = $_POST['e_b_room_qty'];
            }
            if (isset($_POST['e_s_bed'])) {
                $room['s_bed'] = $_POST['e_s_bed'];
            }
            if (isset($_POST['e_b_bed'])) {
                $room['b_bed'] = $_POST['e_b_bed'];
            }
            update_post_meta($joinMeta, 'e_room', serialize($room));
// DAT DUNG BUA
            $meal = array();
            if ($_POST['e_meal_qty_1'] != '' && $_POST['e_meal_qty_1'] > 0 ) {
                $meal[] = $_POST['e_meal_1'] . ', 參加人數&nbsp;,' . trim($_POST['e_meal_qty_1']);
            }
            if ($_POST['e_meal_qty_2'] != '' && $_POST['e_meal_qty_2'] > 0 ) {
                $meal[] = $_POST['e_meal_2'] . ', 參加人數&nbsp;,' . trim($_POST['e_meal_qty_2']);
            }
            if ($_POST['e_meal_qty_3'] != '' && $_POST['e_meal_qty_3'] > 0 ) {
                $meal[] = $_POST['e_meal_3'] . ', 參加人數&nbsp;,' . trim($_POST['e_meal_qty_3']);
            }
            if ($_POST['e_meal_qty_4'] != '' && $_POST['e_meal_qty_4'] > 0 ) {
                $meal[] = $_POST['e_meal_4'] . ', 參加人數&nbsp;,' . trim($_POST['e_meal_qty_4']);
            }
            if ($_POST['e_meal_qty_5'] != '' && $_POST['e_meal_qty_5'] > 0 ) {
                $meal[] = $_POST['e_meal_5'] . ', 參加人數&nbsp;,' . trim($_POST['e_meal_qty_5']);
            }
            update_post_meta($joinMeta, 'e_meal', serialize($meal));

            $orther = array();
            if ($_POST['e_orther_title_1'] != '' && $_POST['e_orther_qty_1'] > 0) {
                $orther[] = $_POST['e_orther_title_1'] . ', 參加人數&nbsp;,' . trim($_POST['e_orther_qty_1']);
            }
            if ($_POST['e_orther_title_2'] != '' && $_POST['e_orther_qty_2'] > 0) {
                $orther[] = $_POST['e_orther_title_2'] . ', 參加人數&nbsp;,' . trim($_POST['e_orther_qty_2']);
            }
            if ($_POST['e_orther_title_3'] != '' && $_POST['e_orther_qty_3'] > 0) {
                $orther[] = $_POST['e_orther_title_3'] . ', 參加人數&nbsp;,' . trim($_POST['e_orther_qty_3']);
            }
            if ($_POST['e_orther_title_4'] != '' && $_POST['e_orther_qty_4'] > 0) {
                $orther[] = $_POST['e_orther_title_4'] . ', 參加人數&nbsp;,' . trim($_POST['e_orther_qty_4']);
            }
            if ($_POST['e_orther_title_1'] != '' && $_POST['e_orther_qty_5'] > 0) {
                $orther[] = $_POST['e_orther_title_5'] . ', 參加人數&nbsp;,' . trim($_POST['e_orther_qty_5']);
            }
            update_post_meta($joinMeta, 'e_orther', serialize($orther));
        }
    }
}
?>

<?php
if ($_SESSION['login']) {

    //LAY THONG USER THONG QUA SESSION
    $arr = array(
        'post_type' => 'member',
        'meta_query' => array(
            array('key' => 'm_user', 'value' => $_SESSION['login'])
        ),
    );
    $objMember = current(get_posts($arr));
    if ($objMember) {
        $getMeta = get_post_meta($objMember->ID); // lay gia tri tu metabox 
        //$user = $getMeta['m_user'][0]; //
        $fullname = $getMeta['m_fullname'][0];
        //$address = $getMeta['m_address'][0];
        $lastname = $getMeta['m_lastname'][0];
        $midename = $getMeta['m_midename'][0];
        $firstname = $getMeta['m_firstname'][0];
        $position = $getMeta['m_position'][0];
        //$birthdate= $getMeta['m_birthdate'][0];
        $sex = $getMeta['m_sex'][0];
        // $company = $getMeta['m_company'][0];
        $email = $getMeta['m_email'][0];
       // $_SESSION['email'] = $getMeta['m_email'][0];
        $phone = $getMeta['m_phone'][0];
        $enName = $lastname . ',' . $midename . '-' . $firstname;
    }
    ?> 
    <div class='head-title'>
        <div class="title">
            <h2 class="head"> <?php _e('活 動 報 名 表 ', 'suite'); ?></h2>
        </div>
    </div>
    <div class="div-error">
                        <?php
                        $err = $err_e_branch != '' ? '&#9679;&#32;' . $err_e_branch . '<br>' : '';
                        $err .= $err_count != '' ? '&#9679;&#32;' . $err_count . '<br>' : '';
                        $err .= $err_dontiep != '' ? '&#9679;&#32;' . $err_dontiep . '<br>' : '';
                        $err .= $err_room != '' ? '&#9679;&#32;' . $err_room . '<br>' : '';
                        $err .= $err_meal != '' ? '&#9679;&#32;' . $err_meal . '<br>' : '';
                        ?>
        <h4 style="font-weight: bold"> 請 檢 查 不 正 確 的 資 料 </h4>
        <label><?php echo $err ?></label>
    </div>
    <form id="f_joinevent" method ="post" action="#">
        <div style="border: 1px  #dfdfdf dotted; padding: 10px; border-radius: 5px; background-color: #F9F9F9">
            <input type="hidden" name="hidden-ID"id="hidden-ID"  value="<?php echo get_the_ID(); ?>"/>
            <input type="hidden" name="fullName" id="fullName"   value="<?php echo $fullname ?>"/>
            <input type="hidden" name="enName"  id="enName"       value="<?php echo $enName; ?>"/>
            <input type="hidden" name="phone"     id="phone"        value="<?php echo $phone; ?>"/>
            <input type="hidden" name="email"      id="email"         value="<?php echo $email; ?>"/>
            <input type="hidden" name="position"  id="position"     value="<?php echo $position; ?>"/>
            <input type="hidden" name="sex"         id="sex"             value="<?php echo $sex ?>"/>
            <div class="row">
                <div class=' col-md-6 col-sm-6 col-xs-5'> <label class="label-title"><?php _e('中文姓名', 'suite'); ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-7'> <label class="label-title"><?php _e('英文姓名', 'suite'); ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-5'> <label class='lbl-content'><?php echo $fullname ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-7 '> <label class='lbl-content' ><?php echo $enName; ?></label></div>
            </div>
            <div class="row">
                <div class=' col-md-6 col-sm-6 col-xs-5'> <label class="label-title"><?php _e('電話號碼', 'suite'); ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-7'> <label class="label-title"><?php _e('電郵信箱', 'suite'); ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-5 '> <label class='lbl-content'><?php echo $phone ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-7'> <label class='lbl-content' ><?php echo $email ?></label></div>
            </div>            
            <div class="row">
                <div class=' col-md-6 col-sm-6 col-xs-5' '> <label class="label-title"><?php _e('職    稱', 'suite'); ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-7'> <label class="label-title"><?php _e('性   別', 'suite'); ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-5 '> <label class='lbl-content'><?php echo $position ?></label></div>
                <div class=' col-md-6 col-sm-6 col-xs-7'> <label class='lbl-content' ><?php echo $sex == '1' ? '男' : '女'; ?></label></div>
            </div>
            <div class="row" style="height: 50px; margin-top: 10px; margin-bottom: 10px">
                <div class="col-md-12 col-sm-12 col-xs-12"> <label class="label-title"><?php _e('飲  食', 'suite'); ?> </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label style="margin-left: 20px"> 一 般 </label>
                    <input type="radio" name="e_eat" id="e_eat" value="1"  <?php echo $e_eat == '1' ? 'checked' : '' ?>>
                    <label style="margin-left: 40px"> 素 食 </label>
                    <input type="radio" name="e_eat" id="e_eat" value="2"  <?php echo $e_eat == '2' ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px">
                <div class=" col-md-12 col-sm-12 col-xs-12" ><label for="e_branch" class="label-title"><?php _e('商會名稱', 'suite'); ?></label> <label class="mess"> <?php echo $err_e_branch ?></label></div>
                <div class=" col-md-12 col-sm-12 col-xs-12"><select  class="form-control" name="e_branch" id="e_branch">
                        <option value ="0"> <?php _e('請選擇商會名稱', 'suite') ?></option>
    <?php
    // LAY CATEGORY AP DUNG CHO SELECTBOX
    $arrRec1 = array(
        'post_type' => 'brach',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    $myQuery1 = new WP_Query($arrRec1);
    if ($myQuery1->have_posts()):
        while ($myQuery1->have_posts()):
            $myQuery1->the_post();
//                                       $postMeta = get_post_meta($post->ID);
            ?>
                                <option value ="<?php echo get_the_title(); ?>" <?php echo $e_branch == get_the_title() ? 'selected' : '' ?> > <?php the_title(); ?></option>
        <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
                    </select></div>   
            </div>
            <div class='row'>
                <div class=" col-md-12 col-sm-12 col-xs-12"><label for="e_count" class="label-title"><?php _e('隨行眷屬', 'suite'); ?> <?php echo $_SESSION['submit']; ?></label><label class="mess" id="err_count"><?php echo $err_count ?></label></div>  
                <div class=" col-md-12 col-sm-12 col-xs-12">
                    <select  class="form-control" name="e_count" id="e_count">
                        <option value ="0" <?php echo $e_count == '0' ? 'selected' : '' ?>> 請選擇人數</option>
                        <option value ="1" <?php echo $e_count == '1' ? 'selected' : '' ?>> 1 名</option>
                        <option value ="2" <?php echo $e_count == '2' ? 'selected' : '' ?>> 2 名 </option>
                        <option value ="3" <?php echo $e_count == '3' ? 'selected' : '' ?>> 3 名</option>
                        <option value ="4" <?php echo $e_count == '4' ? 'selected' : '' ?>> 4 名</option>
                    </select>
                </div> 
                <!-- vi tri them cot nhap ten nguoi dang ky -->
                <div class=" col-md-12 col-sm-12 col-xs-12" style=" padding-left: 30px">
                    <ul id="join-count">
                        <li id="join_1">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align:left;"><label style=" margin-top: 3px " >中文名稱</label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12"><input type="text"  style="width:90%;margin-bottom: 2px"  id="e_name_1" name="e_name_1" value="<?php echo $e_name_1 ?>"></div>      
                                <div class="col-md-2 col-sm-2 col-xs-12"style="text-align:left;"><label style=" margin-top: 3px ">英文名稱</label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 2px">
                                    <input type="text" style="width:30%" id="e_lastname_1" name="e_lastname_1" value="<?php echo $e_lastname_1 ?>"> ,
                                    <input type="text" style="width:25%" id="e_midename_1" name="e_midename_1" value="<?php echo $e_lastname_1 ?>"> -
                                    <input type="text" style="width:30%" id="e_firstname_1" name="e_firstname_1" value="<?php echo $e_firstname_1 ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left; margin-top: 3px "><label style="margin-right: 27px; ">關  係</label></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">  <input type="text" style="width:82%" id="e_relation_1" name="e_relation_1" value="<?php echo $e_relation_1 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left ;margin-top:5px">
                                    <label>性  別 </label>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select name="e_sex_1" id="e_sex_1" style="width: 70px;">
                                        <option value ="1" <?php if ($e_sex_1 == '1') echo ' selected="selected" '; ?> >男</option>
                                        <option value ="2" <?php if ($e_sex_1 == '2') echo ' selected="selected" '; ?> >女</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12"> <label style=" margin-top: 3px ">飲 食 </label> </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left">
                                    <label>一般 </label>
                                    <input type="radio" name="e_eat_1" id="e_eat_1" value="1"  <?php echo $e_eat_1 == '1' ? 'checked' : '' ?>>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left"><label style="margin-right: 0px">素食</label>
                                    <input type="radio" name="e_eat_1" id="e_eat_1" value="2" <?php echo $e_eat_1 == '2' ? 'checked' : '' ?>>
                                </div>
                            </div>
                        </li>
                        <li id="join_2">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align:left;"><label style="margin-top: 3px">中文名稱</label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12"><input type="text"  style="width:90%; margin-bottom: 2px" id="e_name_2" name="e_name_2" value="<?php echo $e_name_2 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12"style="text-align:left;"><label style="margin-right: 3px">英文名稱 </label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 2px">
                                    <input type="text" style="width:30%" id="e_lastname_2" name="e_lastname_2" value="<?php echo $e_lastname_2 ?>"> ,
                                    <input type="text" style="width:25%" id="e_midename_2" name="e_midename_2" value="<?php echo $e_midename_2 ?>"> -
                                    <input type="text" style="width:30%" id="e_firstname_2" name="e_firstname_2" value="<?php echo $e_firstname_2 ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left;margin-top:3px"><label style="margin-right: 27px; ">關  係</label> </div>
                                <div class="col-md-4 col-sm-4 col-xs-12"><input type="text" style="width:82%" id="e_relation_2" name="e_relation_2" value="<?php echo $e_relation_2 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left ;margin-top:5px"> <label>性  別</label></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select name="e_sex_2" id="e_sex_2" style="width: 70px;">
                                        <option value ="1" <?php if ($e_sex_2 == '1') echo ' selected="selected" '; ?> >男</option>
                                        <option value ="2" <?php if ($e_sex_2 == '2') echo ' selected="selected" '; ?> >女</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2"> <label style=" margin-top: 3px ">飲 食 </label> </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left">
                                    <label>一般</label>
                                    <input type="radio" name="e_eat_2" id="e_eat_2" value="1"  <?php echo $e_eat_2 == '1' ? 'checked' : '' ?>>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left"><label style="margin-right: 0px">素食</label>
                                    <input type="radio" name="e_eat_2" id="e_eat_2" value="2" <?php echo $e_eat_2 == '2' ? 'checked' : '' ?>>
                                </div>
                            </div>
                        </li>
                        <li id="join_3">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align:left;"><label style="margin-top: 3px">中文名稱</label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12"><input type="text"  style="width:90%; margin-bottom: 2px" id="e_name_3" name="e_name_3" value="<?php echo $e_name_3 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12"style="text-align:left;"><label style="margin-right: 3px">英文名稱 </label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 2px">
                                    <input type="text" style="width:30%" id="e_lastname_3" name="e_lastname_3" value="<?php echo $e_lastname_3 ?>"> ,
                                    <input type="text" style="width:25%" id="e_midename_3" name="e_midename_3" value="<?php echo $e_midename_3 ?>"> -
                                    <input type="text" style="width:30%" id="e_firstname_3" name="e_firstname_3" value="<?php echo $e_firstname_3 ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left;margin-top:3px"><label style="margin-right: 27px; ">關  係</label> </div>
                                <div class="col-md-4 col-sm-4 col-xs-12"><input type="text" style="width:82%" id="e_relation_3" name="e_relation_3" value="<?php echo $e_relation_3 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left ;margin-top:5px"> <label>性  別</label></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select name="e_sex_3" id="e_sex_3" style="width: 70px;">
                                        <option value ="1" <?php if ($e_sex_3 == '1') echo ' selected="selected" '; ?> >男</option>
                                        <option value ="2" <?php if ($e_sex_3 == '2') echo ' selected="selected" '; ?> >女</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12"> <label style=" margin-top: 3px ">飲 食 </label> </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left">
                                    <label>一般</label>
                                    <input type="radio" name="e_eat_3" id="e_eat_3" value="1"  <?php echo $e_eat_3 == '1' ? 'checked' : '' ?>>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left"><label style="margin-right: 0px">素食</label>
                                    <input type="radio" name="e_eat_3" id="e_eat_3" value="2" <?php echo $e_eat_3 == '2' ? 'checked' : '' ?>>
                                </div>
                            </div>
                        </li>
                        <li id="join_4">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align:left;"><label style="margin-top: 3px">中文名稱</label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12"><input type="text"  style="width:90%; margin-bottom: 2px" id="e_name_4" name="e_name_4" value="<?php echo $e_name_4 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12"style="text-align:left;"><label style="margin-right: 3px">英文名稱 </label></div>
                                <div class="col-md-10 col-sm-10 col-xs-12" style="margin-bottom: 2px">
                                    <input type="text" style="width:30%" id="e_lastname_4" name="e_lastname_4" value="<?php echo $e_lastname_4 ?>"> ,
                                    <input type="text" style="width:25%" id="e_midename_4" name="e_midename_4" value="<?php echo $e_midename_4 ?>"> -
                                    <input type="text" style="width:30%" id="e_firstname_4" name="e_firstname_4" value="<?php echo $e_firstname_4 ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left;margin-top:3px"><label style="margin-right: 27px; ">關  係</label> </div>
                                <div class="col-md-4 col-sm-4 col-xs-12"><input type="text" style="width:82%" id="e_relation_4" name="e_relation_4" value="<?php echo $e_relation_4 ?>"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12" style="text-align: left ;margin-top:5px"> <label>性  別</label></div>
                                <div class="col-md-4 col-sm-4 col-xs-12" >
                                    <select name="e_sex_4" id="e_sex_4" style="width: 70px;">
                                        <option value ="1" <?php if ($e_sex_4 == '1') echo ' selected="selected" '; ?> >男</option>
                                        <option value ="2" <?php if ($e_sex_4 == '2') echo ' selected="selected" '; ?> >女</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12"> <label style=" margin-top: 3px ">飲 食 </label> </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left">
                                    <label>一般</label>
                                    <input type="radio" name="e_eat_4" id="e_eat_4" value="1"  <?php echo $e_eat_4 == '1' ? 'checked' : '' ?>>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-6" style="text-align: left"><label style="margin-right: 0px">素食</label>
                                    <input type="radio" name="e_eat_4" id="e_eat_4" value="2" <?php echo $e_eat_4 == '2' ? 'checked' : '' ?>>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>  
            </div>
            <div class="row row-modify"> 
                <div class="col-md-12 col-sm-12"> <label  class="label-title" ><?php _e('接送方式', 'suite'); ?></label><label class="mess" id="err_dontiep"><?php echo $err_dontiep ?></label></div>
                <div class='col-md-12 col-md-12' style="margin-left: 20px">
                    <input type="checkbox" name="e_dontiep_0" id="e_dontiep_0"  <?php echo $e_dontiep_0 == 'on' ? 'checked' : '' ?> value='自理'> <?php _e('自理', 'suite'); ?></br>
                    <?php if (!empty($dontiep1)) { ?>
                        <input type="checkbox" name="e_dontiep_1" id="e_dontiep_1" <?php echo $e_dontiep_1 == 'on' ? 'checked' : '' ?> value='<?php echo $dontiep1 ?>' > <?php echo $dontiep1 ?></br>
                    <?php } ?>
    <?php if (!empty($dontiep2)) { ?>
                        <input type="checkbox" name="e_dontiep_2" id="e_dontiep_2" <?php echo $e_dontiep_2 == 'on' ? 'checked' : '' ?> value='<?php echo $dontiep2 ?>' > <?php echo $dontiep2 ?></br>
                    <?php } ?>
                    <?php if (!empty($dontiep3)) { ?>
                        <input type="checkbox" name="e_dontiep_3" id="e_dontiep_3" <?php echo $e_dontiep_3 == 'on' ? 'checked' : '' ?> value='<?php echo $dontiep3 ?>' > <?php echo $dontiep3 ?></br>
                    <?php } ?>
                    <?php if (!empty($dontiep4)) { ?>
                        <input type="checkbox" name="e_dontiep_4" id="e_dontiep_4" <?php echo $e_dontiep_4 == 'on' ? 'checked' : '' ?> value='<?php echo $dontiep4 ?>' > <?php echo $dontiep4 ?></br>
    <?php } ?>
    <?php if (!empty($dontiep5)) { ?>
                        <input type="checkbox" name="e_dontiep_5" id="e_dontiep_5" <?php echo $e_dontiep_5 == 'on' ? 'checked' : '' ?> value='<?php echo $dontiep5 ?>' > <?php echo $dontiep5 ?></br>
                    <?php } ?>

                </div>
            </div>
            <div class="row row-modify">
                <div class="col-md-12 col-sm-12"> <label for="e_room" class="label-title" ><?php _e('出席費', 'suite'); ?></label></div>
                <div class="col-md-12 col-sm-12" style="margin-left: 10px">
    <?php echo $attend ?>
                </div>
            </div>
            <div class="row row-modify">
                <div class="col-md-12 col-sm-12"> <label for="e_no_room" class="label-title" ><?php _e('訂房資料', 'suite'); ?></label><label class="mess" id="err_room"><?php echo $err_room ?></label></div>
                <div class="row" style="margin-left: 10px">
                    <div class=" col-md-12"><input type="checkbox" name="e_no_room" id="e_no_room" value='自理' <?php echo $e_no_room == 'on' ? 'checked' : '' ?>> <?php _e('自理', 'suite'); ?></div>  
                    <div class="col-md-12" style="margin-bottom: 5px"><?php _e('入住日期', 'suite'); ?> <input type="text" class=" MyDate" style="width: 50%" maxlength="10" name="e_check_in" id="e_check_in" value="<?php echo $e_check_in ?>"></div> 
                    <div class="col-md-12"><?php _e('退房日期', 'suite'); ?> <input type="text" class=" MyDate" style="width: 50%" maxlength="10" name="e_check_out" id="e_check_out" value="<?php echo $e_check_out ?>"></div>
                    <div class="col-md-12">
                <?php echo $roomNote ?></br>
                <?php echo $hotel ?>
                    </div> 
                </div>
                <div class="row row-modify">
                    <div class="col-md-12"><label class="label-title"> <?php _e('標準房', 'suite'); ?> </label></div> 
                    <div class="col-md-12" style="margin-left: 20px; margin-bottom: 3px" >
                        <!--<input type="checkbox" name="e_s_room" id="e_s_room" style="margin-right: 10px" value="單人房" <?php  //echo $e_s_room == 'on' ? 'checked' : '' ?>>-->
                            <?php _e('單人房', 'suite'); ?> | <?php _e('數量', 'suite'); ?>
                           <input type="text" style="margin-left: 10px ; width: 40px" class="type-number" maxlength="2" name="e_s_room_qty" id="e_s_room_qty"  value="<?php echo $e_s_room_qty; ?>">
                    </div>
                    <div class="col-md-4" style="margin-left: 20px">
                        <!--<input type="checkbox" name="e_b_room" id="e_b_room" style="margin-right:10px" value="雙人房" <?php // echo $e_b_room == 'on' ? 'checked' : '' ?>>-->
                            <?php _e('雙人房', 'suite'); ?>
                        | <?php _e('數量', 'suite'); ?><input type="text" style="margin-left: 10px ; width: 40px" class=" type-number" maxlength="2" name="e_b_room_qty" id="e_b_room_qty" value="<?php echo $e_b_room_qty;?>">
                    </div>
                    <div class="col-md-5">
                        <input type="checkbox" name="e_s_bed" id="e_s_bed" value='一大床'<?php echo $e_s_bed == 'on' ? 'checked' : '' ?> style="margin-left: 20px;margin-right: 10px"><?php _e('一大床', 'suite'); ?>
                        <input type="checkbox" name="e_b_bed" id="e_b_bed" value='兩小床' <?php echo $e_b_bed == 'on' ? 'checked' : '' ?> style="margin-left: 10px"  > <?php _e('兩小床', 'suite'); ?>
                    </div>
                </div>
            </div>  
    <?php echo $roomFee ?>

            <div class="row row-modify">
                <div class="col-md-12"> <label class="label-title" ><?php _e('餐宴', 'suite'); ?></label> <label class="mess" id="err_meal"><?php echo $err_meal ?></label></div>
                <div class="col-md-12" style="margin-left: 20px">
    <?php echo $mealNote ?> 

    <?php if (!empty($meal1)) { ?>
                        <!--<input type="checkbox" name="e_meal_1" id="e_meal_1" value='<?php // echo $meal1 ?>' <?php // echo $e_meal_1 == 'on' ? 'checked' : '' ?>>--> 
                            <?php echo $meal1 ?> 
                        <input type="hidden" name="e_meal_1" id="e_meal_1" value="<?php echo $meal1 ?>">
                        -- 參加人數 <input type="text" name="e_meal_qty_1" id="e_meal_qty_1"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px " value="<?php echo trim($e_meal_qty_1) ?>"> </br>
    <?php } ?>
    <?php if (!empty($meal2)) { ?>
                        <!--<input type="checkbox" name="e_meal_2" id="e_meal_2" value='<?php // echo $meal2 ?>' <?php // echo $e_meal_2 == 'on' ? 'checked' : '' ?> >--> 
                            <?php echo $meal2 ?> 
                        <input type="hidden" name="e_meal_2" id="e_meal_2" value="<?php echo $meal2 ?>">
                        -- 參加人數 <input type="text" name="e_meal_qty_2" id="e_meal_qty_2" class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_meal_qty_2) ?>"></br>
    <?php } ?>
    <?php if (!empty($meal3)) { ?>
                        <!--<input type="checkbox" name="e_meal_3" id="e_meal_3" value='<?php // echo $meal3 ?>' <?php // echo $e_meal_3 == 'on' ? 'checked' : '' ?> >--> 
                            <?php echo $meal3 ?>
                        <input type="hidden" name="e_meal_3" id="e_meal_3" value="<?php echo $meal3 ?>">
                        -- 參加人數 <input type="text" name="e_meal_qty_3" id="e_meal_qty_3"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_meal_qty_3) ?>"></br>
    <?php } ?>
                <?php if (!empty($meal4)) { ?>
                        <!--<input type="checkbox" name="e_meal_4" id="e_meal_4" value='<?php // echo $meal4 ?>' <?php // echo $e_meal_4 == 'on' ? 'checked' : '' ?> >--> 
                       <?php echo $meal4 ?>
                        <input type="hidden" name="e_meal_4" id="e_meal_4" value="<?php echo $meal4 ?>">
                        -- 參加人數 <input type="text" name="e_meal_qty_4" id="e_meal_qty_4" class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_meal_qty_4) ?>"></br></br>
    <?php } ?>
    <?php if (!empty($meal5)) { ?>
                        <!--<input type="checkbox" name="e_meal_5" id="e_meal_5" value='<?php // echo $meal5 ?>' <?php // echo $e_meal_5 == 'on' ? 'checked' : '' ?> >-->
                       <?php echo $meal5 ?> 
                        <input type="hidden" name="e_meal_5" id="e_meal_5" value="<?php echo $meal5 ?>">
                        -- 參加人數 <input type="text" name="e_meal_qty_5" id="e_meal_qty_5"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_meal_qty_5) ?>"></br></br>
                        <?php } ?>
                </div>
            </div>
  
            <!--PHAN ORTHER ADD TO IN 10/03/2016-->      
            <div class="row row-modify">
    <?php if (!empty($orther_title_1)) { ?>
                    <div class=" col-md-12"> <label  class="label-title" ><?php echo $orther_title_1 ?></label>   </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> 
                        <input type="hidden" name="e_orther_title_1" id="e_orther_title_1" value="<?php echo $orther_title_1; ?>">
                        參加人數 <input type="text" name="e_orther_qty_1" id="e_orther_qty_1"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_orther_qty_1) ?>">
                    </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> <?php echo $orther_content_1; ?> </div>
    <?php } ?>
            </div> 

            <div class="row row-modify">
    <?php if (!empty($orther_title_2)) { ?>
                    <div class=" col-md-12"> <label  class="label-title" ><?php echo $orther_title_2 ?></label>   </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> 
                        <input type="hidden" name="e_orther_title_2" id="e_orther_title_2" value="<?php echo $orther_title_2; ?>">
                        參加人數 <input type="text" name="e_orther_qty_2" id="e_orther_qty_2"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_orther_qty_2) ?>">
                    </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> <?php echo $orther_content_2; ?> </div>
    <?php } ?>
            </div> 

            <div class="row row-modify">
    <?php if (!empty($orther_title_3)) { ?>
                    <div class=" col-md-12"> <label  class="label-title" ><?php echo $orther_title_3 ?></label>   </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> 
                        <input type="hidden" name="e_orther_title_3" id="e_orther_title_3" value="<?php echo $orther_title_3; ?>">
                        參加人數 <input type="text" name="e_orther_qty_3" id="e_orther_qty_3"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_orther_qty_3) ?>">
                    </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> <?php echo $orther_content_3; ?> </div>
    <?php } ?>
            </div> 

            <div class="row row-modify">
    <?php if (!empty($orther_title_4)) { ?>
                    <div class=" col-md-12"> <label  class="label-title" ><?php echo $orther_title_4 ?></label>   </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> 
                        <input type="hidden" name="e_orther_title_4" id="e_orther_title_4" value="<?php echo $orther_title_4; ?>">
                        參加人數 <input type="text" name="e_orther_qty_4" id="e_orther_qty_4"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_orther_qty_4) ?>">
                    </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> <?php echo $orther_content_4; ?> </div>
    <?php } ?>
            </div> 

            <div class="row row-modify">
    <?php if (!empty($orther_title_5)) { ?>
                    <div class=" col-md-12"> <label  class="label-title" ><?php echo $orther_title_5 ?></label>   </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> 
                        <input type="hidden" name="e_orther_title_5" id="e_orther_title_5" value="<?php echo $orther_title_5; ?>">
                        參加人數 <input type="text" name="e_orther_qty_5" id="e_orther_qty_5"  class="type-number"  maxlength="2" style="width: 50px; margin-bottom: 5px" value="<?php echo trim($e_orther_qty_5) ?>">
                    </div>
                    <div class="col-md-12" style=" margin-left: 10px; "> <?php echo $orther_content_5; ?> </div>
    <?php } ?>
            </div> 
            <!--END-->    
            
            <div class="row">
                <div class="col-md-12"> <label class="label-title"><?php _e('備註欄', 'suite'); ?></label> </div>
                <div class="col-md-12"><textarea  id="e_note" name="e_note" style="width: 633px; height: 151px; padding: 0px;">
    <?php echo trim($e_note); ?>
                    </textarea>
                </div> 
            </div> 
           <div class="row row-modify">
                <div class="col-md-12"><label  class="label-title" ><?php _e('備 註', 'suite'); ?></label></div>
                <div class="col-md-12" style="margin-left: 10px">
    <?php echo $Note ?>
                </div>
            </div>
            <div style="margin: 10px 5px; text-align: center">
                <input id="btn-submit" class="btn" type="submit" value="<?php _e('Submit', 'suite'); ?>" />
                <input id="btn-reset" class="btn" type="reset" value="<?php _e('Reset', 'suite'); ?>"/>
            </div>
        </div>
    </form>
<?php } ?>

<!-- PHAN SO POPUP -->
<div id="div-popup">
    <div id="div-alertInfo">
        <div id="alert-title">
<?php _e('', 'suite'); ?>
            <input type="button"style="display: none"  id="btn-close" name="btn-close" value="X"/>
        </div>
        <div id="alert-content"><h2><?php _e('謝謝! 您已報名成功', 'suite'); ?> </h2></div>
        <div id="alert-footer"></div>
    </div>
    <div id="div-bg" ></div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {

     //   var dontiepss = '<?php// echo $e_dontiep_1 . $e_dontiep_2 . $e_dontiep_3 . $e_dontiep_4 . $e_dontiep_5 ?>';
     //   if (dontiepss === '') {
       //    jQuery('#e_dontiep_0').prop('checked', true);
          //  checkDonTiep();
     //   }

        //PHAN KIEM TRA DANG KY PHONG
//        var room = '<?php // echo $e_b_room . $e_s_room ?>';
//        if (room === '') {
//            jQuery('#e_no_room').prop('checked', true);
//        }
        // PHAN DANG KY NGUOI THAN DI KEM
        var count1 = jQuery('#e_count').val();
        changJoin(count1);

        jQuery('#e_count').change(function() {
            var count2 = jQuery('#e_count').val();
            changJoin(count2);
        });

        function changJoin(count) {
            if (count === '0') {
                jQuery('#join-count > li').hide().find('*').attr('disabled', true);
                 jQuery('#join_1').find('input:text').val('');
                 jQuery('#join_2').find('input:text').val('');
                 jQuery('#join_3').find('input:text').val('');
                 jQuery('#join_4').find('input:text').val('');
            }
            if (count === '1') {
                jQuery('#join_1').show().find('*').attr('disabled', false);
                jQuery('#join_2').hide().find('*').attr('disabled', true);
                   jQuery('#join_2').find('input:text').val('');
                jQuery('#join_3').hide().find('*').attr('disabled', true);
                  jQuery('#join_3').find('input:text').val('');
                jQuery('#join_4').hide().find('*').attr('disabled', true);
                    jQuery('#join_4').find('input:text').val('');
            }
            if (count === '2') {
                jQuery('#join_1').show().find('*').attr('disabled', false);
                jQuery('#join_2').show().find('*').attr('disabled', false);
                jQuery('#join_3').hide().find('*').attr('disabled', true);
                   jQuery('#join_3').find('input:text').val('');
                jQuery('#join_4').hide().find('*').attr('disabled', true);
                   jQuery('#join_4').find('input:text').val('');
            }
            if (count === '3') {
                jQuery('#join_1').show().find('*').attr('disabled', false);
                jQuery('#join_2').show().find('*').attr('disabled', false);
                jQuery('#join_3').show().find('*').attr('disabled', false);
                jQuery('#join_4').hide().find('*').attr('disabled', true);
                   jQuery('#join_4').find('input:text').val('');
            }
            if (count === '4') {
                jQuery('#join_1').show().find('*').attr('disabled', false);
                jQuery('#join_2').show().find('*').attr('disabled', false);
                jQuery('#join_3').show().find('*').attr('disabled', false);
                jQuery('#join_4').show().find('*').attr('disabled', false);
            }
        }


        // BAO LOI KHI INSERT DATA

        var error = '<?php echo $e_error ?>';
        if (error !== '') {
            jQuery('.info-bg, .orange-title ').hide();
            jQuery('.div-error').show();
        } else {
            fn_popup();
        }

        // PHAN DANG DANG DAT PHONG CHECKBOX EVENT
//        jQuery('#e_s_room_qty').keypress(function() {
//            jQuery('#e_s_room').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_s_room').prop('checked', false);
//            }
//        });
//
//        jQuery('#e_b_room_qty').keypress(function() {
//            jQuery('#e_b_room').prop('checked', true);
//            jQuery('#e_b_bed').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_b_room').prop('checked', false);
//                jQuery('#e_b_bed').prop('checked', false);
//            }
//        });

        //DUNG BUA CHECKBOX EVENT
//        jQuery('#e_meal_qty_1').keypress(function() {
//            jQuery('#e_meal_1').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_meal_1').prop('checked', false);
//            }
//        });
//
//        jQuery('#e_meal_qty_2').keypress(function() {
//            jQuery('#e_meal_2').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_meal_2').prop('checked', false);
//            }
//        });
//
//        jQuery('#e_meal_qty_3').keypress(function() {
//            jQuery('#e_meal_3').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_meal_3').prop('checked', false);
//            }
//        });
//
//        jQuery('#e_meal_qty_4').keypress(function() {
//            jQuery('#e_meal_4').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_meal_4').prop('checked', false);
//            }
//        });
//
//        jQuery('#e_meal_qty_5').keypress(function() {
//            jQuery('#e_meal_5').prop('checked', true);
//        }).focusout(function() {
//            var txtval = jQuery(this).val();
//            if (txtval === '') {
//                jQuery('#e_meal_5').prop('checked', false);
//            }
//        });



// DAN LAI GIA TRI CHO INPUT NAME
        if ('<?php echo $e_name_1 ?>' !== '') {
            jQuery('#e_name_1').val('<?php echo $e_name_1 ?>');
        } else {
            jQuery('#error_1').text('<?php echo $back_name_1 ?>');
        }

        if ('<?php echo $e_name_2 ?>' !== '') {
            jQuery('#e_name_2').val('<?php echo $e_name_2 ?>');
        } else {
            jQuery('#error_name_2').text('<?php echo $back_name_2 ?>');
        }

        if ('<?php echo $e_name_3 ?>' !== '') {
            jQuery('#e_name_3').val('<?php echo $e_name_3 ?>');
        } else {
            jQuery('#error_name_3').text('<?php echo $back_name_3 ?>');
        }

        if ('<?php echo $e_name_4 ?>' !== '') {
            jQuery('#e_name_4').val('<?php echo $e_name_4 ?>');
        } else {
            jQuery('#error_name_4').text('<?php echo $back_name_4 ?>');
        }

        // DAN LAI GIA TRI CHO INPUT ENGLISH
        if ('<?php echo $e_lastname_1 ?>' !== '') {
            jQuery('#e_lastname_1').val('<?php echo $e_lastname_1 ?>');
        }
        if ('<?php echo $e_lastname_2 ?>' !== '') {
            jQuery('#e_lastname_2').val('<?php echo $e_lastname_2 ?>');
        }
        if ('<?php echo $e_lastname_3 ?>' !== '') {
            jQuery('#e_lastname_3').val('<?php echo $e_lastname_3 ?>');
        }
        if ('<?php echo $e_lastname_4 ?>' !== '') {
            jQuery('#e_lastname_4').val('<?php echo $e_lastname_4 ?>');
        }
        // DAN LAI GIA TRI CHO INPUT MEDINAME
        if ('<?php echo $e_midename_1 ?>' !== '') {
            jQuery('#e_midename_1').val('<?php echo $e_midename_1 ?>');
        }
        if ('<?php echo $e_midename_2 ?>' !== '') {
            jQuery('#e_midename_2').val('<?php echo $e_midename_2 ?>');
        }
        if ('<?php echo $e_midename_3 ?>' !== '') {
            jQuery('#e_midename_3').val('<?php echo $e_midename_3 ?>');
        }
        if ('<?php echo $e_midename_4 ?>' !== '') {
            jQuery('#e_midename_4').val('<?php echo $e_midename_4 ?>');
        }

        // DAN LAI GIA TRI CHO INPUT FIRSTNAME
        if ('<?php echo $e_firstname_1 ?>' !== '') {
            jQuery('#e_firstname_1').val('<?php echo $e_firstname_1 ?>');
        }
        if ('<?php echo $e_firstname_2 ?>' !== '') {
            jQuery('#e_firstname_2').val('<?php echo $e_firstname_2 ?>');
        }
        if ('<?php echo $e_firstname_3 ?>' !== '') {
            jQuery('#e_firstname_3').val('<?php echo $e_firstname_3 ?>');
        }
        if ('<?php echo $e_firstname_4 ?>' !== '') {
            jQuery('#e_firstname_4').val('<?php echo $e_firstname_4 ?>');
        }

        // DAN LAI GIA TRI CHO INPUT RELATION
        if ('<?php echo $e_relation_1 ?>' !== '') {
            jQuery('#e_relation_1').val('<?php echo $e_relation_1 ?>');
        }
        if ('<?php echo $e_relation_2 ?>' !== '') {
            jQuery('#e_relation_2').val('<?php echo $e_relation_2 ?>');
        }
        if ('<?php echo $e_relation_3 ?>' !== '') {
            jQuery('#e_relation_3').val('<?php echo $e_relation_3 ?>');
        }
        if ('<?php echo $e_relation_4 ?>' !== '') {
            jQuery('#e_relation_4').val('<?php echo $e_relation_4 ?>');
        }


//// PHAN THAY DOI KHI CHECK 
        jQuery('#e_dontiep_0').change(function() {
            checkDonTiep();
        });
        // checkDonTiep();

        function checkDonTiep() {
            if (jQuery('#e_dontiep_0').prop('checked') === true) {
                jQuery('#e_dontiep_1').prop("disabled", true).prop('checked', false);
                jQuery('#e_dontiep_2').prop("disabled", true).prop('checked', false);
                jQuery('#e_dontiep_3').prop("disabled", true).prop('checked', false);
                jQuery('#e_dontiep_4').prop("disabled", true).prop('checked', false);
                jQuery('#e_dontiep_5').prop("disabled", true).prop('checked', false);
            } else {
                jQuery('#e_dontiep_1').prop("disabled", false).prop('checked', false);
                jQuery('#e_dontiep_2').prop("disabled", false).prop('checked', false);
                jQuery('#e_dontiep_3').prop("disabled", false).prop('checked', false);
                jQuery('#e_dontiep_4').prop("disabled", false).prop('checked', false);
                jQuery('#e_dontiep_5').prop("disabled", false).prop('checked', false);
            }
        }

// //KIEM PHAN DANG KY PHONG O
        jQuery('#e_no_room').change(function() {
            checkRoom();
        });

        // KIEM TRA KHI MOI LOAD VO TRANG
      checkRoom();

        function checkRoom() {
            if (jQuery('#e_no_room').prop('checked') === true) {
                jQuery('#e_check_in').prop("disabled", true).val('');
                jQuery('#e_check_out').prop("disabled", true).val('');
               jQuery('#e_s_room_qty').prop("disabled", true).val('');
               jQuery('#e_b_room_qty').prop("disabled", true).val('');
//                jQuery('#e_s_room').prop("disabled", true).prop('checked', false);
//                jQuery('#e_b_room').prop("disabled", true).prop('checked', false);
                jQuery('#e_s_bed').prop("disabled", true).prop('checked', false);
                jQuery('#e_b_bed').prop("disabled", true).prop('checked', false);
            } else {
                jQuery('#e_check_in').prop("disabled", false);
                jQuery('#e_check_out').prop("disabled", false);
                jQuery('#e_s_room_qty').prop("disabled", false);
                jQuery('#e_b_room_qty').prop("disabled", false);
//                jQuery('#e_s_room').prop("disabled", false);
//                jQuery('#e_b_room').prop("disabled", false);
                jQuery('#e_s_bed').prop("disabled", false);
                jQuery('#e_b_bed').prop("disabled", false).prop('checked',true);
            }
        }

        // PHAN HIEN THI POPUP  
        //            fn_popup();

        function fn_popup() {
            var error = '<?php echo $e_error ?>';
            var post = '<?php echo $_SESSION['submit'] ?>';
            if (error === '' && post !== '') {
                $('#div-popup').fadeIn('slow');
                $('#div-alertInfo').css('top', '150px');
                setTimeout(closePopup, 5000);
            }
        }
        function closePopup() {
            $('#div-popup').fadeOut('slow');
            $('#div-alertInfo').css('top', '0px');
            $('#div-alertInfo').css('opacity', '0');
            // window.location.reload();
            window.location = '<?php echo home_url('events') ?>';
        }



    });


</script>