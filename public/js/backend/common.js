//common functionalities for all the javascript featueres
var FTX = {}; // common variable used in all the files of the backend

(function () {

    FTX = {

        Utils: {

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            toggleClass: function (element, className) {

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

            addClass: function (element, className) {

                if (element.classList)
                    element.classList.add(className);
                else
                    element.className += ' ' + className;
            },

            removeClass: function (el, className) {

                if (el.classList)
                    el.classList.remove(className);
                else
                    el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
            },

            documentReady: function (callback) {
                if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
                    callback();
                } else {
                    document.addEventListener('DOMContentLoaded', callback);
                }
            },

            ajaxrequest: function (url, method, data, csrf, callback) {

                var request = new XMLHttpRequest();
                var loadingIcon = jQuery(".loading");

                if (window.XMLHttpRequest) {
                    // code for modern browsers
                    request = new XMLHttpRequest();
                } else {
                    // code for old IE browsers
                    request = new ActiveXObject("Microsoft.XMLHTTP");
                }
                request.open(method, url, true);

                request.onloadstart = function () {
                    loadingIcon.show();
                };
                request.onloadend = function () {
                    loadingIcon.hide();
                };
                request.setRequestHeader('X-CSRF-TOKEN', csrf);
                request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                if ("post" === method.toLowerCase() || "patch" === method.toLowerCase()) {
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                    data = this.jsontoformdata(data);
                }

                // when request is in the ready state change the details or perform success function
                request.onreadystatechange = function () {
                    if (request.readyState === this.DONE) {
                        // Everything is good, the response was received.
                        request.onload = callback.success(request);
                    }
                };
                request.onerror = callback.error;
                request.send(data);
            },

            // This should probably only be used if all JSON elements are strings
            jsontoformdata: function (srcjson) {
                if (typeof srcjson !== "object")
                    if (typeof console !== "undefined") {
                        return null;
                    }
                u = encodeURIComponent;
                var urljson = "";
                var keys = Object.keys(srcjson);
                for (var i = 0; i < keys.length; i++) {
                    urljson += u(keys[i]) + "=" + u(srcjson[keys[i]]);
                    if (i < (keys.length - 1)) urljson += "&";
                }
                return urljson;
            },

            setCSRF: function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': this.csrf
                    }
                });
            },

            dtAnchorToForm: function ($parent) {

                $('td:last', $parent).addClass('btn-td');

                $('[data-method]', $parent).append(function () {
                    if (!$(this).find('form').length > 0) {
                        var method = this.getAttribute('data-method');

                        if (method == 'delete') {
                            return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                                "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                                "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                                '</form>\n';
                        } else {
                            return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                                "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                                '</form>\n';
                        }
                    } else { return '' }
                })
                    .attr('href', '#')
                    .attr('style', 'cursor:pointer;')
                    .attr('onclick', '$(this).find("form").submit();');
            },

        },

        tinyMCE: {
            init: function (locale='en_US') {
                
                tinymce.init({
                    language: (locale === 'en_US' ? undefined : locale),
                    path_absolute: "/",
                    selector: 'textarea',
                    height: 200,
                    width: 725,
                    // theme: 'silver', // New theme available in latest tinymce
                    plugins: [
                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                        'insertdatetime nonbreaking save table contextmenu directionality',
                        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                    ],
                    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    //                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                    image_advtab: true,
                    relative_urls: false,
                    file_browser_callback: function (field_name, url, type, win) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                        var cmsURL = "/" + 'laravel-filemanager?field_name=' + field_name;
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
                    },
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css'
                    ]
                });
            }
        },
    };

    FTX.Utils.documentReady(function () {
        FTX.Utils.setCSRF();
    });

})();