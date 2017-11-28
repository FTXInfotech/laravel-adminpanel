var Backend = {

    /**
     * Access management
     *
     */
    Select2:
    {
        selectors: {
            select2: jQuery(".select2"),
        },

        init: function ()
        {
            this.addHandlers();
        },

        addHandlers: function ()
        {
            this.selectors.select2.select2();
        }
    },

    /**
     * Tiny MCE
     */
    tinyMCE: {
        init: function () {
            tinymce.init({
                path_absolute : "/",
                selector: 'textarea',
                height: 200,
                width: 725,
                theme: 'modern',
                plugins: [
                  'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                  'searchreplace wordcount visualblocks visualchars code fullscreen',
                  'insertdatetime nonbreaking save table contextmenu directionality',
                  'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
//                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                image_advtab: true,
                relative_urls : false,
                file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = "/" + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
                } else {
                cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                    });
                },
                content_css: [
                  '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                  '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        }
    },
}
