//khai bao url
var url_admin = 'http://localhost/training/wp-admin/admin-ajax.php';

//function load more bang button cho news page
function button_load_more_news($cateID, $listID)
{
    var lastID = jQuery('.slider-multi-item:last').attr('data_id');
    var offset = lastID; //số lượng bài viết ban đầu
    jQuery.ajax({
        //url: '<?php echo admin_url('admin-ajax.php') ?>',
        url: url_admin,
        type: 'post',
        dataType: 'html',
        data: {
            action: "loadmore", // tên action, dữ liệu gửi lên server
            offset: offset,
            cateID: $cateID,
        },
        success: function(res) {
            jQuery($listID).append(res);
            var $target = jQuery('html,body');
            $target.animate({
                scrollTop: $target.height()
            }, 2000);

            //ẩn button khi không còn bài viết hiển thị 
            if('' === res ){
                jQuery('#load-more').hide(); 
                return;
            }
        },
        error: function (xhr) {
            console.log(xhr.reponseText);
        }
    });
}

//function load more bang scrolling cho news page
function scroll_load_more_news($page, $cateID, $listID, $alreadyScroll)
{
    //lấy id cuối cùng của danh sách
    var lastID = jQuery('.slider-multi-item:last').attr('data_id');
    var docHeight = jQuery(document).height();
    var winHeight = jQuery(window).height();
    //nếu màn hình đang ở dưới cuối thẻ thực hiển tải thêm dữ liệu
    if(jQuery(window).scrollTop() > (docHeight - winHeight) && $alreadyScroll == true){
        jQuery.ajax({
            //url: '<?php //echo get_template_directory_uri() . '/ajax/load_news.php' ?>',
            url: url_admin,
            type: "post",
            dataType: 'html',
            cache: false,
            data: {
                id: lastID,
                action: 'scrolling_loadmore',
                page: $page,
                cateID: $cateID,
            },
            success: function(res) {
                jQuery($listID).append(res);
                $page++;
                // var $target = jQuery('html,body');
                // $target.animate({
                //     scrollTop: $target.height()
                // }, 2000);
            },
            error: function (xhr) {
                console.log(xhr.reponseText);
            }
        })
    }
}

