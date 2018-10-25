@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.deleted'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.deleted') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.deleted') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.access.includes.partials.user-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="users-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.users.table.first_name') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.last_name') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.confirmed') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.roles') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.created') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.access.users.table.first_name')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('last_name', null, ["class" => "search-input-text form-control", "data-column" => 1, "placeholder" => trans('labels.backend.access.users.table.last_name')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th>
                                {!! Form::text('email', null, ["class" => "search-input-text form-control", "data-column" => 2, "placeholder" => trans('labels.backend.access.users.table.email')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th></th>
                            <th>
                            {!! Form::text('roles', null, ["class" => "search-input-text form-control", "data-column" => 4, "placeholder" => trans('labels.backend.access.users.table.roles')]) !!}
                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
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
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}
	<script>

            (function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var dataTable = $('#users-table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("admin.access.user.get") }}',
                        type: 'post',
                        data: {status: false, trashed: true}
                    },
                    columns: [
                        {data: 'first_name', name: '{{config('access.users_table')}}.first_name'},
                        {data: 'last_name', name: '{{config('access.users_table')}}.last_name'},
                        {data: 'email', name: '{{config('access.users_table')}}.email'},
                        {data: 'confirmed', name: '{{config('access.users_table')}}.confirmed'},
                        {data: 'roles', name: '{{config('access.roles_table')}}.name', sortable: false},
                        {data: 'created_at', name: '{{config('access.users_table')}}.created_at'},
                        {data: 'updated_at', name: '{{config('access.users_table')}}.updated_at'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    dom: 'lBfrtip',
                    buttons: {
                        buttons: [
                            { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }}
                        ]
                    }
                });
    
                Backend.DataTableSearch.init(dataTable);

                Backend.UserDeleted.selectors.Areyousure = "{{ trans('strings.backend.general.are_you_sure') }}";
                Backend.UserDeleted.selectors.delete_user_confirm = "{{ trans('strings.backend.access.users.delete_user_confirm') }}";
                Backend.UserDeleted.selectors.continue = "{{ trans('strings.backend.general.continue') }}";
                Backend.UserDeleted.selectors.cancel ="{{ trans('buttons.general.cancel') }}";
                Backend.UserDeleted.selectors.restore_user_confirm ="{{ trans('strings.backend.access.users.restore_user_confirm') }}";
            
            })();

            
     
        window.onload = function(){
            
            Backend.UserDeleted.windowloadhandler();
        }
          
	</script>
@endsection
