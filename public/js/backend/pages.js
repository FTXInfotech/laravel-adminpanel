(function () {

    FTX.Pages = {

        list: {
        
            selectors: {
                pages_table: $('#pages-table'),
            },
        
            init: function () {

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
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            init: function (locale) {
                FTX.tinyMCE.init(locale);                
            }
        },
    }
})();