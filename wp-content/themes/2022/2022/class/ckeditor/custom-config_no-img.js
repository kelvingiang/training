/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
CKEDITOR.editorConfig = function(config) {

    config.language = 'zh-cn';
    config.uiColor = '#999999',
            config.resize_enabled = false;   // tat di phan keo resize cua khung editor
    config.enterMode = CKEDITOR.ENTER_BR; // trong noi dung khi xuong dong chi chen the br mac dinh la the p
    config.tabSpaces = 4;  // thiet lap khoang cach khi nhan tab 
    // cho hien thi cac button chuc nang 
    config.toolbar = [{name: 'document'        , items : ['Source']},
                             {name: 'Styles'            , items : ['Style', 'Format', 'Font', 'FontSize']},
                             {name: 'clipboard'        , items : ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']},
                             {name: 'editing'            , items : ['Find', 'Replace','-', 'SelectAll']},
                             {name: 'basicstyles'       , items : ['Bold', 'Italic','Underline', 'RemoveFormat']},
                             {name: 'insert'              , items : ['Table']}
                             
    ];
    
       // Make dialogs simpler.
//config.filebrowserImageBrowseUrl = '/ckeditor/pictures';
//config.filebrowserImageUploadUrl = '/ckeditor/pictures';
    // config.filebrowserImageUploadUrl = '/uploader/upload.php?type=Images';
};

