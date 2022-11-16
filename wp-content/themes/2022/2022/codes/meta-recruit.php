<?php

// FRONT END DANG TUYEN DUNG CUA CTY ==============================================
function recruitMetaBox($recMeta, $_post)
{

    $editor = checkContent($_post['editor']);
    $orther = checkContent($_post['another']);

    update_post_meta($recMeta, '_recruit_like', 0);
    update_post_meta($recMeta, '_recruit_view', 0);
    update_post_meta($recMeta, '_recruit_postby', $_SESSION['login']);
    update_post_meta($recMeta, '_recruit_status', $_post['chk_status']);
    update_post_meta($recMeta, '_recruit_company_tw', esc_attr($_post['txt_company_tw']));
    update_post_meta($recMeta, '_recruit_company_vn', esc_attr($_post['txt_company_vn']));
    update_post_meta($recMeta, '_recruit_company_en', esc_attr($_post['txt_company_en']));
    update_post_meta($recMeta, '_recruit_address', esc_attr($_post['txt_address']));
    update_post_meta($recMeta, '_recruit_phone', esc_attr($_post['txt_phone']));
    update_post_meta($recMeta, '_recruit_email', esc_attr($_post['txt_email']));
    update_post_meta($recMeta, '_recruit_count', esc_attr($_post['txt_count']));
    update_post_meta($recMeta, '_recruit_summary', $editor);

    update_post_meta($recMeta, '_recruit_lack_job', esc_attr($_post['txt_lack_job']));
    update_post_meta($recMeta, '_recruit_lack_count', esc_attr($_post['txt_lack_count']));
    update_post_meta($recMeta, '_recruit_sex', esc_attr($_post['sel_sex']));
    update_post_meta($recMeta, '_recruit_date_from', esc_attr($_post['txt_date_from']));
    update_post_meta($recMeta, '_recruit_date_to', esc_attr($_post['txt_date_to']));
    update_post_meta($recMeta, '_recruit_level', esc_attr($_post['txt_level']));
    update_post_meta($recMeta, '_recruit_experience', esc_attr($_post['txt_experience']));
    update_post_meta($recMeta, '_recruit_age_from', esc_attr($_post['txt_age_from']));
    update_post_meta($recMeta, '_recruit_age_to', esc_attr($_post['txt_age_to']));
    update_post_meta($recMeta, '_recruit_language', esc_attr($_post['txt_language']));
    update_post_meta($recMeta, '_recruit_work_space', esc_attr($_post['txt_word_space']));
    update_post_meta($recMeta, '_recruit_salary', esc_attr($_post['txt_salary']));
    update_post_meta($recMeta, '_recruit_orther', $orther);
    update_post_meta($recMeta, '_recruit_contact_name', esc_attr($_post['txt_contact_name']));
    update_post_meta($recMeta, '_recruit_contact_phone', esc_attr($_post['txt_contact_phone']));
    update_post_meta($recMeta, '_recruit_contact_email', esc_attr($_post['txt_contact_email']));

    update_post_meta($recMeta, 'seo_title', esc_attr(substr($_post['txt_title'], 0, 20)));
    update_post_meta($recMeta, 'seo_description', esc_attr($_post['editor']));
    update_post_meta($recMeta, 'seo_keywords', esc_attr($_post['txt_title']));

    // ADD NEW 18-05-2020
    update_post_meta($recMeta, '_recruit_place', esc_attr($_post['sel_place']));
    update_post_meta($recMeta, '_recruit_career', esc_attr($_post['sel_career']));
}


// FRONT END HO SO UNG TUYEN CUA SINH VIEN ==========================================
function recruitmentMetaBox($recMeta, $_post)
{

    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';

    // die();


    if (!empty($_FILES['file_upload']['name'])) {
        $loginID = $_SESSION['login_id'];
        $uploadReturn = uploadFile($loginID, $_FILES);
        update_post_meta($loginID, 'm_img', $uploadReturn);
        update_post_meta($recMeta, '_recruit_img', $uploadReturn);
    };

    if (is_array($uploadReturn)) {
        return $uploadReturn;
    } else {
        $orther = checkContent($_post['another']);
        update_post_meta($recMeta, '_recruit_like', 0);
        update_post_meta($recMeta, '_recruit_view', 0);
        update_post_meta($recMeta, '_recruit_postby', $_SESSION['login']);
        update_post_meta($recMeta, '_recruit_status', $_post['chk_status']);
        update_post_meta($recMeta, '_recruit_fullname', esc_attr($_post['txt_fullname']));
        update_post_meta($recMeta, '_recruit_birthday', esc_attr($_post['txt_birthday']));
        update_post_meta($recMeta, '_recruit_sex', esc_attr($_post['sel_sex']));
        update_post_meta($recMeta, '_recruit_address', esc_attr($_post['txt_address']));
        update_post_meta($recMeta, '_recruit_email', esc_attr($_post['txt_email']));
        update_post_meta($recMeta, '_recruit_phone', esc_attr($_post['txt_phone']));
        update_post_meta($recMeta, '_recruit_level', esc_attr($_post['txt_level']));
        update_post_meta($recMeta, '_recruit_experience', esc_attr($_post['txt_experience']));
        update_post_meta($recMeta, '_recruit_another', $orther);
        //===== add new 09/04/2020
        update_post_meta($recMeta, '_recruit_height', esc_attr($_post['txt_height']));
        update_post_meta($recMeta, '_recruit_department', esc_attr($_post['txt_department']));
        update_post_meta($recMeta, '_recruit_work', esc_attr($_post['txt_work']));
        update_post_meta($recMeta, '_recruit_job', esc_attr($_post['txt_job']));
        update_post_meta($recMeta, '_recruit_salary', esc_attr($_post['txt_salary']));
        update_post_meta($recMeta, '_recruit_industry', esc_attr($_post['txt_industry']));
        update_post_meta($recMeta, '_recruit_language', esc_attr($_post['txt_language']));
        update_post_meta($recMeta, '_recruit_license', esc_attr($_post['txt_license']));
        update_post_meta($recMeta, '_recruit_software', esc_attr($_post['txt_software']));
        update_post_meta($recMeta, '_recruit_drive', esc_attr($_post['chk_drive']));
        update_post_meta($recMeta, '_recruit_line', esc_attr($_post['txt_line']));

        update_post_meta($recMeta, 'seo_title', esc_attr(substr($_post['txt_title'], 0, 20)));
        update_post_meta($recMeta, 'seo_description', esc_attr($_post['txt_title']));
        update_post_meta($recMeta, 'seo_keywords', esc_attr($_post['txt_title']));
    }
}
