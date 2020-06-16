@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.permission.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.permission.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.permissions.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table" id="permissions-table">
                        <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Display Name</th>
                            <th>Sort</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@section('pagescript')

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var dataTable = $('#permissions-table').dataTable({
                processing: false,
                serverSide: true,

                ajax: {
                    url: '{{ route("admin.auth.permission.get") }}',
                    type: 'post',
                },
                columns: [
                    {data: 'name', name: 'permissions.name'},
                    {data: 'display_name', name: 'permissions.display_name', sortable: false},
                    {data: 'sort', name: 'permissions.sort', sortable: false},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[2, "asc"]],
                searchDelay: 500,
                "createdRow": function( row, data, dataIndex){
                    Common.Utils.DataTables.CreateRow(row, data, dataIndex);
                }
                // dom: 'lBfrtip',
                // buttons: {
                //     buttons: [
                //         { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                //         { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                //         { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                //         { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                //         { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }}
                //     ]
                // },
                // language: {
                //     @lang('datatable.strings')
                // }
            });

            // Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection