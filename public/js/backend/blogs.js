(function () {

    FTX.Blogs = {

        list: {

            selectors: {
                blogs_table: $('#blogs-table'),
            },

            init: function () {

                this.selectors.blogs_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.blogs_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [

                        { data: 'name', name: 'blogs.name' },
                        { data: 'publish_datetime', name: 'blogs.publish_datetime' },
                        { data: 'display_status', name: 'blogs.status' },
                        { data: 'created_by', name: 'blogs.created_by' },
                        { data: 'created_at', name: 'blogs.created_at' },
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
                tags: jQuery(".tags"),
                categories: jQuery(".categories"),
                status: jQuery(".status"),
                publish_datetime: jQuery("#publish_datetime"),
            },

            init: function (locale) {
                this.addHandlers(locale);
                FTX.tinyMCE.init(locale);
            },

            addHandlers: function (locale) {

                this.selectors.tags.select2({
                    tags: true,
                    width: '100%',
                });

                this.selectors.categories.select2({
                    width: '100%',
                    tags: true,
                    placeholder: 'Select category'
                });

                this.selectors.status.select2({
                    width: '100%'
                });

                this.selectors.publish_datetime.datetimepicker({
                    locale: (locale === undefined ? 'en_US' : locale),
                });
            },
        },
    }
})();