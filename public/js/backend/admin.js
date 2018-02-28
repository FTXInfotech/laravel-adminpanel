//common functionalities for all the javascript featueres 
var Backend = {}; // common variable used in all the files of the backend 

(function () {
    Backend = {

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
                if ("post" === method.toLowerCase() || "patch" === method.toLowerCase()) {
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                    data = this.jsontoformdata(data);
                }

                // when request is in the ready state change the details or perform success function 
                request.onreadystatechange = function () {
                    if (request.readyState === XMLHttpRequest.DONE) {
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
                        console.log("\"srcjson\" is not a JSON object");
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


        },

        /**
         * Pages
         *
         */
        Pages:
            {
                init: function () {
                    Backend.tinyMCE.init();
                },
            },

        /**
         * Roles management
         */
        Roles: {
            selectors: {
                associated: document.querySelector("select[name='associated_permissions']"),
                associated_container: document.getElementById("#available-permissions"),
            },
            init(page) {

                this.setSelectors();
                this.setRolepermission(page);
                this.addHandlers();

            },
            setSelectors: function () {
                this.selectors.associated = document.querySelector("select[name='associated_permissions']");
                this.selectors.associated_container = document.getElementById("available-permissions");
            },
            addHandlers: function () {
                var associated = this.selectors.associated;
                var associated_container = this.selectors.associated_container;

                if (associated_container != null)
                    if (associated.value == "custom")
                        Backend.Utils.removeClass(associated_container, "hidden");
                    else
                        Backend.Utils.addClass(associated_container, 'hidden');

                associated.onchange = function (event) {
                    if (associated_container != null)
                        if (associated.value == "custom")
                            Backend.Utils.removeClass(associated_container, "hidden");
                        else
                            Backend.Utils.addClass(associated_container, 'hidden');
                };
            },
            setRolepermission: function (page) {
                Backend.Users.setSelectors();
                Backend.Users.addHandlers(page);
            }

        },
        /**
        * Users management
        *
        */
        Users:
            {
                selectors: {
                    select2: $(".select2"),
                    getPremissionURL: "",
                    showPermission: document.querySelectorAll(".show-permissions")
                },
                init: function (page) {
                    this.setSelectors();
                    this.addHandlers(page);
                },
                setSelectors: function () {
                    this.selectors.select2 = $(".select2");
                    this.selectors.getRoleForPermissions = document.querySelectorAll(".get-role-for-permissions");
                    this.selectors.getAvailabelPermissions = document.querySelector(".get-available-permissions");
                    this.selectors.Role3 = document.getElementById("role-3");
                    this.showPermission = document.querySelectorAll(".show-permissions");
                },
                addHandlers: function (page) {
                    /**
                  * This function is used to get clicked element role id and return required result
                  */

                    this.selectors.getRoleForPermissions.forEach(function (element) {
                        element.onclick = function (event) {
                            callback = {
                                success: function (request) {
                                    if (request.status >= 200 && request.status < 400) {
                                        // Success!
                                        var response = JSON.parse(request.responseText);
                                        var permissions = response.permissions;
                                        var rolePermissions = response.rolePermissions;
                                        var allPermisssions = response.allPermissions;

                                        Backend.Users.selectors.getAvailabelPermissions.innerHTML = "";
                                        htmlstring = "";
                                        if (permissions.length == 0) {
                                            Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                        } else {
                                            for (var key in permissions) {
                                                var addChecked = '';
                                                if (allPermisssions == 1 && rolePermissions.length == 0) {
                                                    addChecked = 'checked="checked"';
                                                } else {
                                                    if (typeof rolePermissions[key] !== "undefined") {
                                                        addChecked = 'checked="checked"';
                                                    }
                                                }
                                                htmlstring += '<label class="control control--checkbox"> <input type="checkbox" name="permissions[' + key + ']" value="' + key + '" id="perm_' + key + '" ' + addChecked + ' /> <label for="perm_' + key + '">' + permissions[key] + '</label> <div class="control__indicator"></div> </label> <br>';
                                            }
                                        }
                                        Backend.Users.selectors.getAvailabelPermissions.innerHTML = htmlstring;
                                        Backend.Utils.removeClass(document.getElementById("available-permissions"), 'hidden');

                                    } else {
                                        // We reached our target server, but it returned an error
                                        Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                    }
                                },
                                error: function () {
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                }
                            };

                            Backend.Utils.ajaxrequest(Backend.Users.selectors.getPremissionURL, "post", { role_id: event.target.value }, Backend.Utils.csrf, callback);
                        }
                    });
                    if (page == "create") {
                        Backend.Users.selectors.Role3.click();
                    }

                    this.selectors.select2.select2();

                },
                windowloadhandler: function () {

                    // scripts to be handeled on user create and edit when window is laoaded
                    Backend.Users.selectors.showPermission.forEach(function (element) {
                        element.onclick = function (event) {
                            event.preventDefault();
                            var $this = this;
                            var role = $this.getAttribute("data-role");

                            var permissions = document.querySelector(".permission-list[data-role='" + role + "']");
                            var hideText = $this.querySelector('.hide-text');
                            var showText = $this.querySelector('.show-text');

                            // show permission list
                            Backend.Utils.toggleClass(permissions, 'hidden');

                            // toggle the text Show/Hide for the link
                            Backend.Utils.toggleClass(hideText, 'hidden');
                            Backend.Utils.toggleClass(showText, 'hidden');
                        };
                    });
                }
            },
        /**
        * Users delete page 
        *
        */

        UserDeleted: {
            selectors: {
                AlldeletePerms: document.querySelectorAll("a[name='delete_user_perm']"),
                AllrestorePerms: document.querySelectorAll("a[name='restore_user']"),
                Areyousure: "",
                delete_user_confirm: "",
                continue: "",
                cancel: "",
                restore_user_confirm: "",
            },
            setSelectors: function () {
                this.selectors.AlldeletePerms = document.querySelectorAll("a[name='delete_user_perm']");
                this.selectors.AllrestorePerms = document.querySelectorAll("a[name='restore_user']");
            },
            windowloadhandler: function () {
                this.setSelectors();
                /*
                    deleted page showing the swal when click on peremenenant delition
                 */
                this.selectors.AlldeletePerms.forEach(function (element) {
                    element.onclick = function (event) {
                        event.preventDefault();
                        var linkURL = this.getAttribute("href");
                        swal({
                            title: Backend.UserDeleted.selectors.Areyousure,
                            text: Backend.UserDeleted.selectors.delete_user_confirm,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: Backend.UserDeleted.selectors.continue,
                            cancelButtonText: Backend.UserDeleted.selectors.cancel,
                            closeOnConfirm: false
                        }, function (isConfirmed) {
                            if (isConfirmed) {
                                window.location.href = linkURL;
                            }
                        });
                    };
                });
                /**
                 * deleted user page handeler for user restore
                 */
                this.selectors.AllrestorePerms.forEach(function (element) {

                    element.onclick = function (event, element) {
                        event.preventDefault();

                        var linkURL = this.getAttribute("href");

                        swal({
                            title: Backend.UserDeleted.selectors.Areyousure,
                            text: Backend.UserDeleted.selectors.restore_user_confirm,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: Backend.UserDeleted.selectors.continue,
                            cancelButtonText: Backend.UserDeleted.selectors.cancel,
                            closeOnConfirm: false
                        }, function (isConfirmed) {
                            if (isConfirmed) {
                                window.location.href = linkURL;
                            }
                        });
                    };
                });
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
                    categories: jQuery(".categories"),
                    toDisplay: jQuery(".toDisplay"),
                    status: jQuery(".status"),
                    datetimepicker1: jQuery("#datetimepicker1"),
                    GenerateSlugUrl: "",
                    name: document.getElementById("name"),
                    SlugUrl: "",
                    slug: document.getElementById("slug"),
                },

                init: function () {
                    this.addHandlers();
                    Backend.tinyMCE.init();
                },

                addHandlers: function () {

                    this.selectors.tags.select2({
                        tags: true,
                    });
                    this.selectors.categories.select2();
                    this.selectors.toDisplay.select2();
                    this.selectors.status.select2();

                    //For Blog datetimepicker for publish_datetime
                    this.selectors.datetimepicker1.datetimepicker();

                    // For generating the Slug  //changing slug on blur event
                    this.selectors.name.onblur = function (event) {
                        url = event.target.value;
                        if (url !== '') {
                            callback = {
                                success: function (request) {
                                    if (request.status >= 200 && request.status < 400) {
                                        // Success!
                                        response = request.responseText;
                                        Backend.Blog.selectors.slug.value = Backend.Blog.selectors.SlugUrl + '/' + response;
                                    }
                                },
                                error: function (request) {

                                }
                            };
                            Backend.Utils.ajaxrequest(Backend.Blog.selectors.GenerateSlugUrl, "post", { text: url }, Backend.Utils.csrf, callback);
                        }
                    };

                }
            },


        /**
         * Tiny MCE
         */
        tinyMCE: {
            init: function () {
                tinymce.init({
                    path_absolute: "/",
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
                $(".select2").select2();
                // to add placeholder in to active textarea
                document.getElementById("addPlaceHolder").onclick = function (event) {
                    Backend.emailTemplate.addPlaceHolder(event);
                };
                document.getElementById("showPreview").onclick = function (event) {
                    Backend.emailTemplate.showPreview(event);
                };

            },

            // ! Backend.emailTemplate.addPlaceHolder
            addPlaceHolder: function (event) {
                var placeHolder = document.getElementById('placeHolder').value;
                if (placeHolder != '') {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, "[" + $('#placeHolder :selected').text() + "]");
                }
            },

            // ! Backend.emailTemplate.showPreview
            showPreview: function (event) {
                document.querySelector(".modal-body").innerHTML = tinyMCE.get('txtBody').getContent();
                //jQuery( ".modal-body" ).html(tinyMCE.get('txtBody').getContent());
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

                init: function () {
                    // this.addHandlers();
                    Backend.tinyMCE.init();
                },

                addHandlers: function () {
                }
            },


        /**
         * Profile
         *
         */
        Profile:
            {
                selectors: {

                },
                init: function () {
                    this.setSelectors();
                    this.addHandlers();
                },
                setSelectors: function () {

                    this.selectors.state = document.querySelector(".st");
                    this.selectors.cities = document.querySelector(".ct");
                },
                addHandlers: function () {
                    if (this.selectors.state != null) {
                        this.selectors.state.select2();
                    }
                    if (this.selectors.cities != null) {
                        this.selectors.cities.select2();
                    }

                }
            },

        /**
         * for all datatables
         *
         */
        DataTableSearch: { //functionalities related to datable search at all the places 
            selector: {
            },

            init: function (dataTable) {

                this.setSelectors();
                this.addHandlers(dataTable);

            },
            setSelectors: function () {
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
            cloneElement: function (element, callback) {
                var clone = element.cloneNode();
                while (element.firstChild) {
                    clone.appendChild(element.lastChild);
                }
                element.parentNode.replaceChild(clone, element);
                Backend.DataTableSearch.setSelectors();
                callback(this.selector.searchInput);
            },
            addHandlers: function (dataTable) {
                // get the datatable search input and on its key press check if we hit enter then search with datatable
                this.cloneElement(this.selector.searchInput, function (element) { //cloning done to remove any binding of the events
                    element.onkeypress = function (event) {
                        if (event.keyCode == 13) {
                            dataTable.fnFilter(this.value);
                        }
                    };
                }); // to remove all the listinerers  

                // for text boxes
                //column input search if search box on the column of the datatable given with enter then search with datatable 
                if (this.selector.columnSearchInput.length > 0) {
                    this.selector.columnSearchInput.forEach(function (element) {
                        element.onkeypress = function (event) {
                            if (event.keyCode == 13) {
                                var i = element.getAttribute("data-column")  // getting column index
                                var v = element.value;  // getting search input value
                                dataTable.api().columns(i).search(v).draw();
                            }
                        };
                    });
                }


                // Individual columns search
                if (this.selector.columnSelectInput.length >> 0) {
                    this.selector.columnSelectInput.forEach(function (element) {
                        element.onchange = function (event) {
                            var i = element.getAttribute("data-column"); // getting column index
                            var v = element.value;  // getting search input value
                            dataTable.api().columns(i).search(v).draw();
                        };
                    });
                }

                // Individual columns reset
                if (this.selector.restButton.length >> 0) {
                    this.selector.restButton.forEach(function (element) {
                        element.onclick = function (event) {
                            var inputelement = this.previousElementSibling;
                            var i = inputelement.getAttribute("data-column");
                            inputelement.value = "";
                            dataTable.api().columns(i).search("").draw();
                        };
                    });
                }

                this.setSelectors.copyButton.onclick = function (element) {
                    document.querySelector(".copyButton").click();
                };
                this.setSelectors.csvButton.onclick = function (element) {
                    document.querySelector(".csvButton").click();
                };
                this.setSelectors.excelButton.onclick = function (element) {
                    document.querySelector(".excelButton").click();
                };
                this.setSelectors.pdfButton.onclick = function (element) {
                    document.querySelector(".pdfButton").click();
                };
                this.setSelectors.printButton.onclick = function (element) {
                    document.querySelector(".printButton").click();
                };
            }

        },

        Settings: {
            selectors: {
                RouteURL: "",
                setting: document.getElementById("setting")
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();
            },
            setSelectors: function () {
                this.selectors.setting = document.getElementById("setting");
                this.selectors.removeLogo = document.querySelector(".remove-logo");
                this.selectors.imageRemoveLogo = document.querySelector(".img-remove-logo");
                this.selectors.imageRemoveFavicon = document.querySelector(".img-remove-favicon");
            },
            addHandlers: function () {
                var route = this.selectors.RouteURL;
                var data_id = this.selectors.setting.getAttribute("data-id");
                route = route.replace('-1', data_id);
                this.selectors.removeLogo.onclick = function (event) {
                    var data = event.target.getAttribute("data-id");

                    swal({
                        title: "Warning",
                        text: "Are you sure you want to remove?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        closeOnConfirm: true
                    }, function (confirmed) {
                        if (confirmed) {
                            if (data == 'logo') {
                                value = 'logo';
                                Backend.Utils.addClass(Backend.Settings.selectors.imageRemoveLogo, 'hidden');
                            }
                            else {
                                value = 'favicon';
                                Backend.Utils.addClass(Backend.Settings.selectors.imageRemoveFavicon, 'hidden');
                            }

                            callback = {
                                success: function (request) {
                                    if (request.status >= 200 && request.status < 400) {
                                        // Success!
                                    }
                                },
                                error: function (request) {

                                }
                            };

                            Backend.Utils.ajaxrequest(route, "POST", { data: value, _token: Backend.Utils.csrf }, Backend.Utils.csrf, callback);
                        }
                    });

                };

            }
        }

    };




})();









