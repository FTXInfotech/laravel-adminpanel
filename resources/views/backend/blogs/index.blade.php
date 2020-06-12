@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.blogs.management'))

@section('breadcrumb-links')
    @include('backend.blogs.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                {{ __('labels.backend.access.blogs.management') }} <small class="text-muted">{{ __('labels.backend.access.blogs.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.blogs.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.blogs.table.title') }}</th>
                                <th>{{ trans('labels.backend.access.blogs.table.published') }}</th>
                                <th>{{ trans('labels.backend.access.blogs.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.blogs.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.blogs.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        
        
    </div><!--card-body-->
</div><!--card-->
@endsection

@section('pagescript')

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            var dataTable = $('#blogs-table').DataTable({
                processing: false,
                serverSide: true,
                pagingType: "full_numbers",
                ajax: {
                    url: '{{ route("admin.blogs.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: 'blogs.name'},
                    {data: 'publish_datetime', name: 'blogs.publish_datetime'},
                    {data: 'status', name: 'blogs.status'},
                    {data: 'created_by', name: 'blogs.created_by'},
                    {data: 'created_at', name: 'blogs.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }}
                    ]
                },
                "createdRow": function( row, data, dataIndex){
                    Common.Utils.DataTables.CreateRow(row, data, dataIndex);
                }
            });
        });
    </script>
@stop