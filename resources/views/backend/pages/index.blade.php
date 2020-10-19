@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.pages.management'))

@section('breadcrumb-links')
@include('backend.pages.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.pages.management') }} <small class="text-muted">{{ __('labels.backend.access.pages.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="pages-table" class="table" data-ajax_url="{{ route("admin.pages.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.pages.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.pages.table.status') }}</th>
                                <th data-orderable="false">{{ trans('labels.backend.access.pages.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.pages.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
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
        FTX.Pages.list.init();
    });
</script>
@endsection