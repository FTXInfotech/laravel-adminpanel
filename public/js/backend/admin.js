//common functionalities for all the javascript featueres 
var Backend = {}; // common variable used in all the files of the backend 

(function()
{
    Backend = {
    
    Utils:{
        toggleClass :function(element,className){
            if (element.classList) {
                element.classList.toggle(className);
              } else {
                var classes = element.className.split(' ');
                var existingIndex = classes.indexOf(className);
              
                if (existingIndex >= 0)
                  classes.splice(existingIndex, 1);
                else
                  classes.push(className);
              
                element.className = classes.join(' ');
              }
        },
        documentReady : function(callback){
            if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
                callback();
              } else {
                document.addEventListener('DOMContentLoaded', callback);
              }
        },

        ajaxrequest:function(url,method,data,csrf,callback){
            var request = new XMLHttpRequest();
            if (window.XMLHttpRequest) {
                // code for modern browsers
                request = new XMLHttpRequest();
             } else {
                // code for old IE browsers
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            request.open(method, url, true);
            request.setRequestHeader('X-CSRF-TOKEN', csrf);
            request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            if("post" === method.toLowerCase()){
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                data = this.jsontoformdata(data);
            }
            

            // when request is in the ready state change the details or perform success function 
            request.onreadystatechange = function()
            {
                if (request.readyState === XMLHttpRequest.DONE) {
                    // Everything is good, the response was received.
                    request.onload = callback.success(request);
                } 
            };
            
            request.onerror = callback.error;

            
            
            request.send(data);
        },

        // This should probably only be used if all JSON elements are strings
        jsontoformdata:function (srcjson){
            if(typeof srcjson !== "object")
            if(typeof console !== "undefined"){
                console.log("\"srcjson\" is not a JSON object");
                return null;
            }
            u = encodeURIComponent;
            var urljson = "";
            var keys = Object.keys(srcjson);
            for(var i=0; i <keys.length; i++){
                urljson += u(keys[i]) + "=" + u(srcjson[keys[i]]);
                if(i < (keys.length-1))urljson+="&";
            }
            return urljson;
        },

        removeClass:function(el,className){
            if (el.classList)
                el.classList.remove(className);
            else
                el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }

    },

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
            select2: $(".select2"),
        },

        init: function ()
        {
            this.setSelectors();
            this.addHandlers();
        },
        setSelectors:function(){
            this.selectors.select2 = $(".select2");
           
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
            tags: document.querySelector(".tags"),
            categories : document.querySelector(".categories"),
            toDisplay :document.querySelector(".toDisplay"),
            status : document.querySelector(".status"),
        },

        init: function ()
        {
            this.setSelectors();
            this.addHandlers();
            Backend.tinyMCE.init();
        },
        setSelectors:function(){
            tags= document.querySelector(".tags");
            categories = document.querySelector(".categories");
            toDisplay =document.querySelector(".toDisplay");
            status = document.querySelector(".status");
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
            emailtemplateSelection: document.querySelector(".select2")
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

            document.querySelector( ".modal-body" ).innerHTML = tinyMCE.get('txtBody').getContent();
            document.querySelector( ".modal-body" ).modal('show');
            
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
            init: function ()
            {
                this.setSelectors();
                this.addHandlers();
            },
            setSelectors:function(){
                this.selectors.state = document.querySelector(".st");
                this.selectors.cities = document.querySelector(".ct");
            },
            addHandlers: function ()
            {
                this.selectors.state.select2();
                this.selectors.cities.select2();
            }
        },

        /**
         * for all datatables
         *
         */
        DataTableSearch: { //functionalities related to datable search at all the places 
            selector:{
            },

            init: function (dataTable) {

               this.setSelectors();
               this.addHandlers();
       
            },
            setSelectors:function(){
                this.selector.searchInput = document.querySelector("div.dataTables_filter input");
                this.selector.columnSearchInput = document.querySelectorAll(".search-input-text");
                this.selector.columnSelectInput = document.querySelectorAll('search-input-select');
                this.selector.restButton = document.querySelectorAll('.reset-data');
                this.setSelectors.copyButton = document.getElementById("copyButton");
                this.setSelectors.csvButton = document.getElementById("csvButton");
                this.setSelectors.excelButton = document.getElementById("excelButton");
                this.setSelectors.pdfButton = document.getElementById("pdfButton");
                this.setSelectors.printButton = document.getElementById("printButton");
                
            },
            cloneElement:function(element,callback){
                var clone = element.cloneNode();
                while (element.firstChild) {
                    clone.appendChild(element.lastChild);
                }
                element.parentNode.replaceChild(clone, element);
                Backend.DataTableSearch.setSelectors();
                callback(this.selector.searchInput);
            },
            addHandlers:function(){
                        // get the datatable search input and on its key press check if we hit enter then search with datatable
               this.cloneElement(this.selector.searchInput,function(element){ //cloning done to remove any binding of the events
                    element.onkeypress = function(event){
                        if(event.keyCode==13){
                            dataTable.fnFilter( this.value );
                        }
                    };
               }); // to remove all the listinerers  
               
                // for text boxes
                //column input search if search box on the column of the datatable given with enter then search with datatable 
                if(this.selector.columnSearchInput.length>0){
                    this.selector.columnSearchInput.forEach(function(element){
                        element.onkeypress = function(event){
                            if (event.keyCode == 13){
                                var i =element.getAttribute("data-column")  // getting column index
                                var v =element.value;  // getting search input value
                                dataTable.api().columns(i).search(v).draw();
                            }
                        };
                    });
                }
               

               // Individual columns search
                if(this.selector.columnSelectInput.length>>0){
                    this.selector.columnSelectInput.forEach(function(element){
                        element.onchange = function(event){
                            var i =element.getAttribute("data-column"); // getting column index
                            var v =element.value;  // getting search input value
                            dataTable.api().columns(i).search(v).draw();
                        };
                    });
                }
               
                // Individual columns reset
                if(this.selector.restButton.length>>0){
                    this.selector.restButton.forEach(function(element){
                        element.onclick = function(event){
                            var inputelement  = this.previousElementSibling;
                            var i = inputelement.getAttribute("data-column");
                            inputelement.value = "";
                            dataTable.api().columns(i).search("").draw();
                        };
                    });
                }

                this.setSelectors.copyButton.onclick = function(element){
                    document.querySelector(".copyButton").click();
                };
                this.setSelectors.csvButton.onclick = function(element){
                    document.querySelector(".csvButton").click();
                };
                this.setSelectors.excelButton.onclick = function(element){
                    document.querySelector(".excelButton").click();
                };
                this.setSelectors.pdfButton.onclick = function(element){
                    document.querySelector(".pdfButton").click();
                };
                this.setSelectors.printButton.onclick = function(element){
                    document.querySelector(".printButton").click();
                };
            }

        }    
    };
})();









