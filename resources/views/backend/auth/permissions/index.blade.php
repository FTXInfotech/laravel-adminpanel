@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.permissions.management'))

@section('breadcrumb-links')
@include('backend.auth.permissions.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.permissions.management')
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table" id="permissions-table" data-ajax_url="{{ route("admin.auth.permission.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.permissions.table.permission') }}</th>
                                <th>{{ trans('labels.backend.access.permissions.table.display_name') }}</th>
                                <th>{{ trans('labels.backend.access.permissions.table.sort') }}</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Permissions.list.init();
    });
</script>
@endsection