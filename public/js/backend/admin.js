var Backend = {


    /**
     * Pages
     *
     */
    Pages:
    {
        init: function()
        {
            Backend.tinyMCE.init();
        },
    },

    /**
     * Access management
     *
     */
    Access:
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
     * Blog
     *
     */
    Blog:
    {
        selectors: {
            tags: jQuery(".tags"),
            categories : jQuery(".categories"),
            toDisplay :jQuery(".toDisplay"),
            status : jQuery(".status"),
        },

        init: function ()
        {
            this.addHandlers();
            Backend.tinyMCE.init();
        },

        addHandlers: function ()
        {
            this.selectors.tags.select2({
                tags: true,
            });
            this.selectors.categories.select2();
            this.selectors.toDisplay.select2();
            this.selectors.status.select2();
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

    emailTemplate: {

        selectors: {
            emailtemplateSelection: jQuery(".select2")
        },

        init: function () {
            Backend.emailTemplate.addHandlers();
            Backend.tinyMCE.init();
        },

        // ! Backend.emailTemplate.addHandlers
        addHandlers: function () {
            // to add placeholder in to active textarea
            $("#addPlaceHolder").on('click', function (event) {
                Backend.emailTemplate.addPlaceHolder(event);
            });
            $("#showPreview").on('click', function (event) {
                Backend.emailTemplate.showPreview(event);
            });
            this.selectors.emailtemplateSelection.select2();
        },

        // ! Backend.emailTemplate.addPlaceHolder
        addPlaceHolder: function (event) {
            var placeHolder = $('#placeHolder').val();
            if (placeHolder != '') {
                tinymce.activeEditor.execCommand('mceInsertContent', false, "[" + $('#placeHolder :selected').text() + "]");
            }
        },

        // ! Backend.emailTemplate.showPreview
        showPreview: function (event) {
            jQuery( ".modal-body" ).html(tinyMCE.get('txtBody').getContent());
            $(".model-wrapper").modal('show');
        },
    },

    /**
     * Faq
     *
     */
    Faq:
    {
        selectors:
        {
        },

        init: function ()
        {
            // this.addHandlers();
            Backend.tinyMCE.init();
        },

        addHandlers: function ()
        {
        }
    },

    /**
     * Profile
     *
     */
    Profile:
    {
        selectors: {
            state: jQuery(".st"),
            cities : jQuery(".ct"),
        },

        init: function ()
        {
            this.addHandlers();
        },

        addHandlers: function ()
        {
            this.selectors.state.select2();
            this.selectors.cities.select2();
        }
    },

    DataTableSearch: {
        init: function (dataTable) {

            // Header All search columns
            $("div.dataTables_filter input").unbind();
            $("div.dataTables_filter input").keypress( function (e)
            {
                if (e.keyCode == 13)
                {
                    dataTable.fnFilter( this.value );
                }
            });

            // Individual columns search
            $('.search-input-text').on( 'keypress', function (e) {
                // for text boxes
                if (e.keyCode == 13)
                {
                    var i =$(this).attr('data-column');  // getting column index
                    var v =$(this).val();  // getting search input value
                    dataTable.api().columns(i).search(v).draw();
                }
            });

            // Individual columns search
            $('.search-input-select').on( 'change', function (e) {
                // for dropdown
                var i =$(this).attr('data-column');  // getting column index
                var v =$(this).val();  // getting search input value
                dataTable.api().columns(i).search(v).draw();
            });

            // Individual columns reset
            $('.reset-data').on( 'click', function (e) {
                var textbox = $(this).prev('input'); // Getting closest input field
                var i =textbox.attr('data-column');  // Getting column index
                $(this).prev('input').val(''); // Blank the serch value
                dataTable.api().columns(i).search("").draw();
            });

             //Copy button
            $('#copyButton').click(function(){
                $('.copyButton').trigger('click');
            });
             //Download csv
            $('#csvButton').click(function(){
                $('.csvButton').trigger('click');
            });
            //Download excelButton
            $('#excelButton').click(function(){
                $('.excelButton').trigger('click');
            });
            //Download pdf
            $('#pdfButton').click(function(){
                $('.pdfButton').trigger('click');
            });
             //Download printButton
            $('#printButton').click(function(){
                $('.printButton').trigger('click');
            });

            var id = $('.table-responsive .dataTables_filter').attr('id');
            $('#'+id+' label').append('<a class="reset-data" id="input-sm-reset" href="javascript:void(0)"><i class="fa fa-times"></i></a>');
            $(document).on('click', "#"+id+" label #input-sm-reset", function(){
                dataTable.fnFilter('');
            });
        },
    }
}