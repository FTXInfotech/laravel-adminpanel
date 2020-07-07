(function () {

    FTX.Faqs = {

        list: {
        
            selectors: {
                faqs_table: $('#faqs-table'),
            },
        
            init: function () {

                this.selectors.faqs_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.faqs_table.data('ajax_url'),
                        type: 'post',
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