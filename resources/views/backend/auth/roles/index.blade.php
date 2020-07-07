@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.roles.management'))

@section('breadcrumb-links')
@include('backend.auth.roles.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.roles.management')
                </h4>
            </div>
            <!--col-->
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table" id="roles-table" data-ajax_url="{{ route("admin.auth.role.get") }}">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.access.roles.table.role')</th>
                                <th>@lang('labels.backend.access.roles.table.permissions')</th>
                                <th>@lang('labels.backend.access.roles.table.number_of_users')</th>
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
        FTX.Roles.list.init();
    });
</script>
@endsection