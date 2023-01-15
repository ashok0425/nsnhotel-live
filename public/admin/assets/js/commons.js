var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


(function ($) {
    'use strict';

   

    var editor_config = {
        path_absolute: "/",
        selector: ".tinymce_editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);


    $(document).ready(function () {
        $('#example1').DataTable({
            "pageLength": 10,
            "order": [0, "desc"],
            "scrollX": true
        });

        //$('.right_col').css('min-height', 'auto');
    }); 


    /*  [ Chosen ]
        - - - - - - - - - - - - - - - - - - - - */
    $('.chosen-select').chosen({
        no_results_text: "Oops, nothing found!"
    });

})(jQuery);


function getUrlAPI(slug, type = "api") {
    const base_url = window.location.origin;
    if (type === "full")
        return slug;
    else
        return base_url + "/" + type + slug;
}

function callAPI(data) {
    try {
        let method = data.method || "GET";
        let header = data.header || {'Accept': 'application/json', 'Content-Type': 'application/json'};
        let body = JSON.stringify(data.body);

        return fetch(data.url, {
            'method': method,
            'headers': header,
            'body': body
        }).then(res => {
            return res.json();
        }).then(response => {
            return response;
        })

    } catch (e) {
        console.log(e);
    }
}

function toSlug(text) {
    var slug;

    //Äá»•i chá»¯ hoa thÃ nh chá»¯ thÆ°á»ng
    slug = text.toLowerCase();

    //Äá»•i kÃ½ tá»± cÃ³ dáº¥u thÃ nh khÃ´ng dáº¥u
    slug = slug.replace(/Ã¡|Ã |áº£|áº¡|Ã£|Äƒ|áº¯|áº±|áº³|áºµ|áº·|Ã¢|áº¥|áº§|áº©|áº«|áº­/gi, 'a');
    slug = slug.replace(/Ã©|Ã¨|áº»|áº½|áº¹|Ãª|áº¿|á»|á»ƒ|á»…|á»‡/gi, 'e');
    slug = slug.replace(/i|Ã­|Ã¬|á»‰|Ä©|á»‹/gi, 'i');
    slug = slug.replace(/Ã³|Ã²|á»|Ãµ|á»|Ã´|á»‘|á»“|á»•|á»—|á»™|Æ¡|á»›|á»|á»Ÿ|á»¡|á»£/gi, 'o');
    slug = slug.replace(/Ãº|Ã¹|á»§|Å©|á»¥|Æ°|á»©|á»«|á»­|á»¯|á»±/gi, 'u');
    slug = slug.replace(/Ã½|á»³|á»·|á»¹|á»µ/gi, 'y');
    slug = slug.replace(/Ä‘/gi, 'd');
    //XÃ³a cÃ¡c kÃ½ tá»± Ä‘áº·t biá»‡t
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Äá»•i khoáº£ng tráº¯ng thÃ nh kÃ½ tá»± gáº¡ch ngang
    slug = slug.replace(/ /gi, "-");
    //Äá»•i nhiá»u kÃ½ tá»± gáº¡ch ngang liÃªn tiáº¿p thÃ nh 1 kÃ½ tá»± gáº¡ch ngang
    //PhÃ²ng trÆ°á»ng há»£p ngÆ°á»i nháº­p vÃ o quÃ¡ nhiá»u kÃ½ tá»± tráº¯ng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //XÃ³a cÃ¡c kÃ½ tá»± gáº¡ch ngang á»Ÿ Ä‘áº§u vÃ  cuá»‘i
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

    //In slug ra textbox cÃ³ id â€œslugâ€
    // document.getElementById('slug').value = slug;

    return slug;
}

function previewUploadImage(input, element_id) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $(`#${element_id}`).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


function notify(noti_content, noti_type = 'success',) {
    /**
     * Type: success, info, danger
     */
    new PNotify({
        title: 'Notify!',
        text: noti_content,
        type: noti_type,
        styling: 'bootstrap3',
        delay: 3000
    });
}