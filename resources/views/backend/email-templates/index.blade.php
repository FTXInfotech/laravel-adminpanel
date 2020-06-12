@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.email-templates.management'))

@section('breadcrumb-links')
    @include('backend.email-templates.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                {{ __('labels.backend.access.email-templates.management') }} <small class="text-muted">{{ __('labels.backend.access.email-templates.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.email-templates.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="email-templates-table" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.email-templates.table.title') }}</th>
                                <th>{{ trans('labels.backend.access.email-templates.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.email-templates.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.email-templates.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
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
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            var dataTable = $('#email-templates-table').DataTable({
                processing: false,
                serverSide: true,
                pagingType: "full_numbers",
                ajax: {
                    url: '{{ route("admin.emailTemplates.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'title', name: 'email_templates.title'},
                    {data: 'status', name: 'email_templates.status'},
                    {data: 'created_by', name: 'email_templates.created_by'},
                    {data: 'created_at', name: 'email_templates.created_at'},
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
                // "language": {
                //     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                // }
            });
        });
    </script>
@stop