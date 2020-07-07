(function () {

    FTX.Roles = {

        list: {

            selectors: {
                role_table: $('#roles-table'),
            },

            init: function () {

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
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            selectors: {
                associated: document.querySelector("select[name='associated_permissions']"),
                associated_container: document.getElementById("available-permissions"),
                searchButton: document.querySelector(".search-button"),
            },
            init: function (pageName) {
                this.setSelectors();
                this.setRolepermission(pageName);
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
                        FTX.Utils.removeClass(associated_container, "hidden");
                        FTX.Utils.removeClass(searchButton, "hidden");
                    } else {
                        FTX.Utils.addClass(associated_container, 'hidden');
                        FTX.Utils.addClass(searchButton, 'hidden');
                    }
                }

                associated.onchange = function (event) {

                    if (associated_container != null) {
                        if (associated.value == "custom") {
                            FTX.Utils.removeClass(associated_container, "hidden");
                            FTX.Utils.removeClass(searchButton, "hidden");
                        } else {
                            FTX.Utils.addClass(associated_container, 'hidden');
                            FTX.Utils.addClass(searchButton, 'hidden');
                        }
                    }
                };
            },
            setRolepermission: function (pageName) {
                FTX.Users.edit.setSelectors();
                FTX.Users.edit.addHandlers(pageName);
            }
        },
    }
})();