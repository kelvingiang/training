<?php
function uploadFile($name, $File)
{
    if (!empty($File['file_upload']['name'])) {
        $errors = array();
        $file_name = $File['file_upload']['name'];
        $file_size = $File['file_upload']['size'];
        $file_tmp = $File['file_upload']['tmp_name'];
        $file_type = $File['file_upload']['type'];

        $file_trim = ((explode('.', $File['file_upload']['name'])));
        $trim_name = strtolower($file_trim[0]);
        $trim_type = strtolower($file_trim[1]);

        $cus_name = $name . '.' . $trim_type;
        $extensions = array("jpeg", "jpg", "png", "bmp");
        if (in_array($trim_type, $extensions) === false) {
            $errors[] = "上傳照片檔案是 JPEG, PNG, BMP.";
        }
        if ($file_size > 2097152) {
            $errors[] = '上傳檔案容量不可大於 2 MB';
        }
        //$path = WP_CONTENT_DIR . DS . 'themes' . DS . '2020' . DS . 'images' . DS . 'apply' . DS; /* get function path upload img dc khai bao tai file hepler */

        if (empty($errors) == true) {

            if (is_file(DIR_IMAGES_APPLY . $name)) {
                unlink(DIR_IMAGES_APPLY . $name);
            }
            move_uploaded_file($file_tmp, (DIR_IMAGES_APPLY . $cus_name));
            return $cus_name;
        } else {
            return $errors;
        }
    }
}

function uploadImg($File, $name)
{
    if (!empty($File['img_upload']['name'])) {
        $errors = array();
        $file_name = $File['img_upload']['name'];
        $file_size = $File['img_upload']['size'];
        $file_tmp = $File['img_upload']['tmp_name'];
        $file_type = $File['img_upload']['type'];

        $file_trim = ((explode('.', $File['img_upload']['name'])));
        $trim_type = strtolower($file_trim[1]);

        $cus_name = $File['img_upload']['name'];
        $extensions = array("jpeg", "jpg", "png", "bmp");
        if (in_array($trim_type, $extensions) === false) {
            $errors[] = "上傳照片檔案是 JPEG, PNG, BMP.";
        }
        if ($file_size > 2097152) {
            $errors[] = '上傳檔案容量不可大於 2 MB';
        }
        //$path = WP_CONTENT_DIR . DS . 'themes' . DS . '2020' . DS . 'images' . DS . 'download' . DS; /* get function path upload img dc khai bao tai file hepler */

        if (empty($errors) == true) {

            if (is_file(DIR_IMAGES_DOWNLOAD . $name)) {
                unlink(DIR_IMAGES_DOWNLOAD . $name);
            }
            move_uploaded_file($file_tmp, (DIR_IMAGES_DOWNLOAD . $cus_name));
            return $cus_name;
        } else {
            return $errors;
        }
    }
}

function uploadFileDownLoad($File, $name)
{
    if (!empty($File['file_upload']['name'])) {
        $errors = array();
        $file_name = $File['file_upload']['name'];
        $file_size = $File['file_upload']['size'];
        $file_tmp = $File['file_upload']['tmp_name'];
        //$file_type = $File['file_upload']['type'];
        //$file_trim = ((explode('.', $File['file_upload']['name'])));
        //$trim_name = strtolower($file_trim[0]);
        //$trim_type = strtolower($file_trim[1]);

        $cus_name = $file_name;

        if ($file_size > 100097152) {
            $errors[] = '上傳檔案容量不可大於 100 MB';
        }
        //$path = WP_CONTENT_DIR . DS . 'themes' . DS . '2020' . DS . 'file' . DS; /* get function path upload img dc khai bao tai file hepler */

        if (empty($errors) == true) {

            if (is_file(DIR_FILE . $name)) {
                unlink(DIR_FILE . $name);
            }

            move_uploaded_file($file_tmp, (DIR_FILE . $cus_name));
            return $cus_name;
        } else {
            return $errors;
        }
    }
}
