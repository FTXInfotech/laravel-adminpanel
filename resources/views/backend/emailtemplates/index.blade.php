@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.emailtemplates.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.emailtemplates.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.emailtemplates.management') }}</h3>

            <div class="box-tools pull-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown">Export
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#" id="copyButton"><i class="fa fa-clone"></i> Copy</a></li>
                    <li><a href="#" id="csvButton"><i class="fa fa-file-text-o"></i> CSV</a></li>
                    <li><a href="#" id="excelButton"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                    <li><a href="#" id="pdfButton"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                    <li><a href="#" id="printButton"><i class="fa fa-print"></i> Print</a></li>
                  </ul>
                </div>
            </div>

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="emailtemplates-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.emailtemplates.table.title') }}</th>
                            <th>{{ trans('labels.backend.emailtemplates.table.subject') }}</th>
                            <th>{{ trans('labels.backend.emailtemplates.table.status') }}</th>
                            <th>{{ trans('labels.backend.emailtemplates.table.createdat') }}</th>
                            <th>{{ trans('labels.backend.emailtemplates.table.updatedat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('title', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.emailtemplates.table.title')]) !!}
                                <a class="reset-data" href="javascript:void(0)" data-column=0><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('subject', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.emailtemplates.table.subject')]) !!}
                                <a class="reset-data" href="javascript:void(0)" data-column=1><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::select('status', [0 => "InActive", 1 => "Active"], null, ["class" => "search-input-select form-control", "data-column" => 2, "placeholder" => trans('labels.backend.emailtemplates.table.all')]) !!}
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! history()->renderType('EmailTemplate') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        $(function() {
            var dataTable = $('#emailtemplates-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.emailtemplates.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'title', name: '{{config('module.email_templates.table')}}.title'},
                    {data: 'subject', name: '{{config('module.email_templates.table')}}.subject'},
                    {data: 'status', name: '{{config('module.email_templates.table')}}.status'},
                    {data: 'created_at', name: '{{config('module.email_templates.table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('module.email_templates.table')}}.updated_at'},
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
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection