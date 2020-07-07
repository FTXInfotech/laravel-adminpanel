(function () {

    FTX.Permissions = {

        list: {
        
            selectors: {
                permissions_table: $('#permissions-table'),
            },
        
            init: function () {

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
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },
    }
})();