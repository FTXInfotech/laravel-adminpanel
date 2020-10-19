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
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table" data-ajax_url="{{ route("admin.blogs.get") }}">
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
        FTX.Blogs.list.init();
    });
</script>
@stop