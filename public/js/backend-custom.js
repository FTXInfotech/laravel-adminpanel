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

        Permission: {

            selectors: {
                permissions_table: $('#permissions-table'),
            },
            init: function () {

                Backend.Utils.setCSRF();

                this.selectors.permissions_table.dataTable({

                    processing: false,
                    serverSide: true,

                    ajax: {
                        url: this.selectors.permissions_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [
                        { data: 'name', name: 'permissions.name' },
                        { data: 'display_name', name: 'permissions.display_name', sortable: false },
                        { data: 'sort', name: 'permissions.sort', sortable: false },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[2, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        Backend.Utils.dtAnchorToForm(row);
                    }
                })
            },
        },

        UserPage: {

            selectors: {
                users_table: $('#users-table'),
            },
            init: function (pageName) {

                Backend.Utils.setCSRF();

                var data = {};

                if (pageName == 'list') {
                    data = { status: 1, trashed: false };
                } else if (pageName == 'deleted') {
                    data = { status: 0, trashed: true };
                } else if (pageName == 'deactive') {
                    data = { status: 0, trashed: false };
                }

                this.selectors.users_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.users_table.data('ajax_url'),
                        type: 'post',
                        data: data
                    },
                    columns: [

                        { data: 'first_name', name: 'first_name' },
                        { data: 'last_name', name: 'last_name' },
                        { data: 'email', name: 'email' },
                        { data: 'confirmed', name: 'confirmed' },
                        { data: 'roles', name: 'roles', sortable: false },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'updated_at', name: 'updated_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        Backend.Utils.dtAnchorToForm(row);
                    }
                })
            },
        },

        /**
         * Pages
         *
         */
        Pages: {
            selectors: {
                pages_table: $('#pages-table'),
            },
            init: function (locale) {

                Backend.Utils.setCSRF();

                this.selectors.pages_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.pages_table.data('ajax_url'),
                        type: 'post',
                        data: { status: 1, trashed: false }
                    },
                    columns: [

                        { data: 'title', name: 'title' },
                        { data: 'status', name: 'status' },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }

                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        Backend.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        RolePage: {

            selectors: {
                role_table: $('#roles-table'),
            },
            init: function () {

                Backend.Utils.setCSRF();

                this.selectors.role_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.role_table.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'permissions', name: 'permissions', sortable: false },
                        { data: 'users', name: 'users', searchable: false, sortable: false },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[3, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        Backend.Utils.dtAnchorToForm(row);
                    }
                })
            },
        },

        EmailPage: {

            selectors: {
                email_table: $('#email-templates-table'),
            },
            init: function () {

                Backend.Utils.setCSRF();

                this.selectors.email_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.email_table.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'title', name: 'title' },
                        { data: 'status', name: 'status' },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[3, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        Backend.Utils.dtAnchorToForm(row);
                    }
                })
            },
        },
        /**
         * Roles management
         */
        Roles: {
            selectors: {
                associated: document.querySelector("select[name='associated_permissions']"),
                associated_container: document.getElementById("available-permissions"),
                searchButton = document.querySelector(".search-button"),
            },
            init: function (page) {
                this.setSelectors();
                this.setRolepermission(page);
                this.addHandlers();
            },
            setSelectors: function () {
                this.selectors.associated = document.querySelector("select[name='associated_permissions']");
                this.selectors.associated_container = document.getElementById("available-permissions");
                this.selectors.searchButton = document.querySelector(".search-button");
            },
            addHandlers: function () {
                var associated = this.selectors.associated;
                var associated_container = this.selectors.associated_container;
                var searchButton = this.selectors.searchButton;

                if (associated_container != null) {

                    if (associated.value == "custom") {
                        Backend.Utils.removeClass(associated_container, "hidden");
                        Backend.Utils.removeClass(searchButton, "hidden");
                    } else {
                        Backend.Utils.addClass(associated_container, 'hidden');
                        Backend.Utils.addClass(searchButton, 'hidden');
                    }
                }

                associated.onchange = function (event) {

                    if (associated_container != null) {
                        if (associated.value == "custom") {
                            Backend.Utils.removeClass(associated_container, "hidden");
                            Backend.Utils.removeClass(searchButton, "hidden");
                        } else {
                            Backend.Utils.addClass(associated_container, 'hidden');
                            Backend.Utils.addClass(searchButton, 'hidden');
                        }
                    }
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
        Users: {
            selectors: {
                getPremissionURL: "",
                getRoleForPermissions: "",
                getAvailabelPermissions: "",
                Role3: "",
                searchButton: "",
            },
            init: function (page) {
                this.setSelectors();
                this.addHandlers(page);
            },
            setSelectors: function () {
                this.selectors.getRoleForPermissions = document.querySelectorAll(".get-role-for-permissions");
                this.selectors.getAvailabelPermissions = document.querySelector(".get-available-permissions");
                this.selectors.searchButton = document.querySelector(".search-button");
                this.selectors.Role3 = document.getElementById("role-3");
            },
            addHandlers: function (page) {
                /**
                 * This function is used to get clicked element role id and return required result
                 */

                this.selectors.getRoleForPermissions.forEach(function (element) {
                    element.onclick = function (event) {

                        Backend.Users.selectors.searchButton.value = '';
                        Backend.Utils.addClass(Backend.Users.selectors.searchButton, 'hidden');
                        // Backend.Users.selectors.searchButton.dispatchEvent(new Event('keyup'));

                        Backend.Utils.addClass(document.getElementById("available-permissions"), 'hidden');

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

                                            htmlstring += '<div><input type="checkbox" name="permissions[' + key + ']" value="' + key + '" id="perm_' + key + '" ' + addChecked + '/><label for="perm_' + key + '" style="margin-left:10px;">' + permissions[key] + '</label></div>';
                                        }
                                    }
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = htmlstring;
                                    Backend.Utils.removeClass(document.getElementById("available-permissions"), 'hidden');
                                    Backend.Utils.removeClass(Backend.Users.selectors.searchButton, 'hidden');

                                } else {
                                    // We reached our target server, but it returned an error
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                }
                            },
                            error: function () {
                                Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                            }
                        };

                        Backend.Utils.ajaxrequest(Backend.Users.selectors.getPremissionURL, "post", {
                            role_id: event.target.value
                        }, Backend.Utils.csrf, callback);
                    };
                });

                this.selectors.searchButton.addEventListener('keyup', function (e) {

                    var searchTerm = this.value.toLowerCase();

                    Backend.Users.selectors.getAvailabelPermissions.children.forEach(function (el) {

                        var shouldShow = true;

                        searchTerm.split(" ").forEach(function (val) {
                            if (shouldShow && (el.querySelector('label').innerHTML.toLowerCase().indexOf(val) == -1)) {
                                shouldShow = false;
                            }
                        });

                        if (shouldShow) {
                            Backend.Utils.removeClass(el, 'hidden');
                        } else {
                            Backend.Utils.addClass(el, 'hidden');
                        }
                    });
                });

                if (page == "create") {
                    Backend.Users.selectors.Role3.click();
                }
            },
            windowloadhandler: function () {

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
        Blog: {
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

            init: function (locale) {
                this.addHandlers(locale);
                Backend.tinyMCE.init(locale);
            },

            addHandlers: function (locale) {

                this.selectors.tags.select2({
                    tags: true,
                });
                this.selectors.categories.select2();
                this.selectors.toDisplay.select2();
                this.selectors.status.select2();

                //For Blog datetimepicker for publish_datetime
                this.selectors.datetimepicker1.datetimepicker({
                    // locale: locale,
                    format: 'YYYY-MM-DD HH:mm',
                    showTodayButton: true,
                    showClear: true,
                });

                // For generating the Slug  //changing slug on blur event
                this.selectors.name.onblur = function (event) {
                    url = event.target.value;
                    if (url !== '') {
                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    response = request.responseText;
                                    Backend.Blog.selectors.slug.value = Backend.Blog.selectors.SlugUrl + '/' + response.trim();
                                }
                            },
                            error: function (request) {

                            }
                        };
                        Backend.Utils.ajaxrequest(Backend.Blog.selectors.GenerateSlugUrl, "post", {
                            text: url
                        }, Backend.Utils.csrf, callback);
                    }
                };

            }
        },

        Menu: {
            selectors: {
                menuItemContainer: jQuery("#menu-items"),
                menuItemsData: jQuery(".menu-items-field"),
                addCustomUrlButton: jQuery(".show-modal"),
                modal: jQuery("#showMenuModal"),
                document: jQuery("document"),
                addCustomUrlForm: "#menu-add-custom-url",
                addModuleToMenuButton: ".add-module-to-menu",
                removeMenuItemButton: ".remove-menu-item",
                editMenuItemButton: ".edit-menu-item",
                formUrl: "",
            },

            methods: {
                getNewId: function (str) {
                    var arr = str.match(/"id":[0-9]+/gi);
                    if (arr) {
                        $.each(arr, function (index, item) {
                            arr[index] = parseInt(item.replace('"id":', ''));
                        });
                        return Math.max.apply(Math, arr) + 1;
                    }
                    return 1;
                },

                findItemById: function (item, id) {
                    if (item.id == id) {
                        return item;
                    }
                    var found = false;
                    var foundItem;
                    if (item.children) {
                        $.each(item.children, function (index, childItem) {
                            foundItem = Backend.Menu.methods.findItemById(childItem, id);
                            if (foundItem) {
                                found = true;
                                return false;
                            }
                        });
                    }
                    if (found) {
                        return foundItem;
                    }
                    return null;
                },

                addMenuItem: function (obj) {
                    Backend.Menu.selectors.menuItemContainer.nestable('add', {
                        "id": Backend.Menu.methods.getNewId(Backend.Menu.selectors.menuItemsData.val()),
                        "content": obj.name,
                        "name": obj.name,
                        "url": obj.url,
                        "url_type": obj.url_type,
                        "open_in_new_tab": obj.open_in_new_tab,
                        "icon": obj.icon,
                        "view_permission_id": obj.view_permission_id
                    });
                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                },

                editMenuItem: function (obj) {
                    var newObject = {
                        "id": obj.id,
                        "content": obj.name,
                        "name": obj.name,
                        "url": obj.url,
                        "url_type": obj.url_type,
                        "open_in_new_tab": obj.open_in_new_tab,
                        "icon": obj.icon,
                        "view_permission_id": obj.view_permission_id
                    };
                    var menuItems = Backend.Menu.selectors.menuItemContainer.nestable('serialise');
                    var itemData;
                    $.each(menuItems, function (index, item) {
                        itemData = Backend.Menu.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.children) {
                        newObject.children = itemData.children;
                    }

                    Backend.Menu.selectors.menuItemContainer.nestable('replace', newObject);

                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                }
            },

            init: function () {
                this.addHandlers();
            },

            addHandlers: function () {
                var context = this;
                var formName = "_add_custom_url_form";

                this.selectors.menuItemContainer.nestable({
                    callback: function (l, e) {
                        context.selectors.menuItemsData.val(JSON.stringify($(l).nestable('serialise')));
                    },
                    json: this.selectors.menuItemsData.val(),
                    includeContent: true,
                    scroll: false,
                    maxDepth: 10
                });

                this.selectors.addCustomUrlButton.click(function () {
                    var title = context.selectors.addCustomUrlButton.attr("data-header");
                    context.selectors.modal.find(".modal-title").html(title);
                    context.selectors.modal.modal("show");

                    callback = {
                        success: function (request) {
                            if (request.status >= 200 && request.status < 400) {
                                // Success!
                                context.selectors.modal.find(".modal-body").html(request.responseText);
                                // jQuery(document).find(context.selectors.modal).find(".view-permission-block").remove();
                                jQuery(document).find(context.selectors.addCustomUrlForm).removeClass("hidden");
                            }
                        },
                        error: function (request) {
                            //Do Something
                        }
                    };
                    Backend.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, Backend.Utils.csrf, callback);
                });

                jQuery(document).on("submit", context.selectors.addCustomUrlForm, function (e) {
                    e.preventDefault();
                    var formData = jQuery(this).serializeArray().reduce(function (obj, item) {
                        obj[item.name] = item.value;
                        return obj;
                    }, {});
                    if (formData.name.length > 0) {
                        if (formData.id.length > 0) {
                            context.methods.editMenuItem(formData);
                        } else {
                            context.methods.addMenuItem(formData);
                        }
                        context.selectors.modal.modal("hide");
                    }
                });

                jQuery(document).on("click", context.selectors.addModuleToMenuButton, function () {
                    var dataObj = {
                        id: $(this).attr("data-id"),
                        name: $(this).attr("data-name"),
                        url: $(this).attr("data-url"),
                        url_type: $(this).attr("data-url_type"),
                        open_in_new_tab: $(this).attr("data-open_in_new_tab"),
                        view_permission_id: $(this).attr("data-view_permission_id"),
                    };
                    context.methods.addMenuItem(dataObj);
                });

                jQuery(document).on("click", context.selectors.removeMenuItemButton, function () {
                    context.selectors.menuItemContainer.nestable('remove', jQuery(this).parents(".dd-item").first().attr("data-id"));
                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                });

                jQuery(document).on("click", context.selectors.editMenuItemButton, function () {
                    id = jQuery(this).parents(".dd-item").first().attr("data-id");
                    var menuItems = context.selectors.menuItemContainer.nestable('serialise');
                    var itemData;
                    $.each(menuItems, function (index, item) {
                        itemData = context.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.id != undefined && itemData.id == id) {
                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    context.selectors.modal.find(".modal-body").html(request.responseText);
                                    context.selectors.modal.find(".modal-dialog .modal-content .modal-header .modal-title").html("Edit: " + itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-id").val(itemData.id);
                                    $(document).find(context.selectors.modal).find(".mi-name").val(itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-url").val(itemData.url);
                                    $(document).find(context.selectors.modal).find(".mi-url_type_" + itemData.url_type).prop("checked", true);
                                    if (itemData.open_in_new_tab == 1) {
                                        $(document).find(context.selectors.modal).find(".mi-open_in_new_tab").prop("checked", true);
                                    }
                                    $(document).find(context.selectors.modal).find(".mi-icon").val(itemData.icon);
                                    $(document).find(context.selectors.modal).find(".mi-view_permission_id").val(itemData.view_permission_id);
                                    $(document).find("#menu-add-custom-url").removeClass("hidden");
                                    context.selectors.modal.modal("show");
                                }
                            },
                            error: function (request) {
                                //Do Something
                            }
                        };
                        Backend.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, Backend.Utils.csrf, callback);
                    }
                });
            }
        },

        /**
         * Tiny MCE
         */
        tinyMCE: {
            init: function (locale) {

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

        /**
         * Faq
         *
         */
        Faq: {
            selectors: {
                faqs_table: $('#faqs-table'),
            },
            init: function (page, locale) {

                if (page == "edit") {
                    Backend.tinyMCE.init(locale);
                } else {

                    Backend.Utils.setCSRF();

                    this.selectors.faqs_table.dataTable({

                        processing: false,
                        serverSide: true,
                        ajax: {
                            url: this.selectors.faqs_table.data('ajax_url'),
                            type: 'post',
                            data: { status: 1, trashed: false }
                        },
                        columns: [

                            { data: 'question', name: 'question' },
                            { data: 'answer', name: 'answer' },
                            { data: 'status', name: 'status' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'actions', name: 'actions', searchable: false, sortable: false }

                        ],
                        order: [[0, "asc"]],
                        searchDelay: 500,
                        "createdRow": function (row, data, dataIndex) {
                            Backend.Utils.dtAnchorToForm(row);
                        }
                    });
                }
            }
        },

        /**
         * Profile
         *
         */
        Profile: {
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
            selector: {},

            init: function (dataTable) {

                this.setSelectors();

                this.setSelectors.divAlerts.delay(2000).fadeOut(800);

                this.addHandlers(dataTable);

            },
            setSelectors: function () {
                this.selector.searchInput = document.querySelector("div.dataTables_filter input");
                this.selector.columnSearchInput = document.querySelectorAll(".search-input-text");
                this.selector.columnSelectInput = document.querySelectorAll(".search-input-select");
                this.selector.restButton = document.querySelectorAll('.reset-data');
                this.setSelectors.copyButton = document.getElementById("copyButton");
                this.setSelectors.csvButton = document.getElementById("csvButton");
                this.setSelectors.excelButton = document.getElementById("excelButton");
                this.setSelectors.pdfButton = document.getElementById("pdfButton");
                this.setSelectors.printButton = document.getElementById("printButton");
                this.setSelectors.divAlerts = jQuery('div.alert').not('.alert-important');

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
                                var i = element.getAttribute("data-column"); // getting column index
                                var v = element.value; // getting search input value
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
                            var v = element.value; // getting search input value
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

        /**
         * Settings
         *
         */
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
                            } else {
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

                            Backend.Utils.ajaxrequest(route, "POST", {
                                data: value,
                                _token: Backend.Utils.csrf
                            }, Backend.Utils.csrf, callback);
                        }
                    });
                };
            }
        }
    };

})();