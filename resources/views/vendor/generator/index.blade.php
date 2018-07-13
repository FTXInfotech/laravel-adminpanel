@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.modules.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.modules.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.modules.management') }}</h3>

            <div class="box-tools pull-right">
                @include('generator::partials.modules-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="modules-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.modules.table.name') }}</th>
                            <th>{{ trans('labels.backend.modules.table.view_permission_id') }}</th>
                            <th>{{ trans('labels.backend.modules.table.url') }}</th>
                            <th>{{ trans('labels.backend.modules.table.created_by') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.modules.table.name')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('permission', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.modules.table.view_permission_id')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('route', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => trans('labels.backend.modules.table.url')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('created_by', null, ["class" => "search-input-text form-control", "data-column" => 3, "placeholder" => trans('labels.backend.modules.table.created_by')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
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
            {{-- {!! history()->renderType('Blog') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        $(function() {
            var dataTable = $('#modules-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.modules.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: '{{config('module.table')}}.name'},
                    {data: 'view_permission_id', name: '{{config('module.table')}}.view_permission_id'},
                    {data: 'url', name: '{{config('module.table')}}.url'},
                    {data: 'created_by', name: '{{config('access.users_table')}}.first_name'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
