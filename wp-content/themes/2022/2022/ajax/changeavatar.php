<?php

// include WordPress
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

use PHPImageWorkshop\ImageWorkshop;

// dien kien where de lay du lieu
$arr = array(
    'post_type' => 'member',
    'meta_query' => array(
        array('key' => 'm_user', 'value' => $_SESSION['login'])
    ),
);

// upload image and change avatar
if (isset($_FILES['myfile'])) {
    $errors = array();
    $file_name = $_FILES['myfile']['name'];
    $file_size = $_FILES['myfile']['size'];
    $file_tmp = $_FILES['myfile']['tmp_name'];
    $file_type = $_FILES['myfile']['type'];

    $file_trim = ((explode('.', $_FILES['myfile']['name'])));
    $trim_name = strtolower($file_trim[0]);
    $trim_type = strtolower($file_trim[1]);
    $name = $_SESSION['login'];
    $cus_name = 'avatar-' . $name . '.' . $trim_type;  //tao name moi cho file tranh trung va mat file

    $extensions = array("jpeg", "jpg", "png");
    if (in_array($trim_type, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }
    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }
    /* $path = upload_avatar(); // get function path upload img dc khai bao tai file hepler */
    $path = DIR_IMAGES_AVATAR;

    if (empty($errors) == true) {
        //=== upload hinh ==============================
        move_uploaded_file($file_tmp, ($path . $cus_name));
        //   echo   WP_PLUGIN_DIR.'/resizeimg/easyphpthumbnail.class.php';
        // ==== sua kich thuoc hinh sau khi upload tao thumbnail =========================
        require_once(DIR_CLASS . 'PHPImageWorkshop/autoload.php');
        $path = DIR_IMAGES_AVATAR . $cus_name;
        $layer = ImageWorkshop::initFromPath($path);

        // Cropping thay doi kich thuoc va cat tai vi tri position
        /* $newWidth 	= 100; // px
          $newHeight 	= 100; // px
          $positionX 	= 100; // left translation of 30px
          $positionY 	= 100; // top translation of 20px
          $position 	= "RM";
          // LT MT RT
          $layer->cropInPixel($newWidth, $newHeight, $positionX, $positionY, $position); */

        $layer->cropMaximumInPixel(0, 0, "MM"); // cat hinh dua vao phan W hay H nho nhat de tao thanh hinh vuong
        $layer->resizeInPixel(50, 50, true); // sau khi tao thanh hinh vuong resize la kinh thuoc minh mong muon
        // phan save hinh 
        $dirPath = DIR_IMAGES_AVATAR;
        $filename = $cus_name; // save ten trung de xoa hinh moi up len
        $createFolders = FALSE;  //FALSE khong tao thu muc moi
        $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
        $imageQuality = 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
        $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

        //======cap nhat lại hinh avata trong database=======================================
        $memberAvata = current(get_posts($arr));
        $id = $memberAvata->ID; // lay ID cua du dong du lieu lay dc
        update_post_meta($id, 'm_image', $filename);
        $response = array(
            'status' => 'done',
            'message' => ''
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => $errors
        );
    }
}


echo json_encode($response);