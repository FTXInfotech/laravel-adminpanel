@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.faqs.management'))

@section('breadcrumb-links')
@include('backend.faqs.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.faqs.management') }} <small class="text-muted">{{ __('labels.backend.access.faqs.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="faqs-table" class="table" data-ajax_url="{{ route("admin.faqs.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.faqs.table.question') }}</th>
                                <th>{{ trans('labels.backend.access.faqs.table.answer') }}</th>
                                <th>{{ trans('labels.backend.access.faqs.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.faqs.table.createdat') }}</th>
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
        FTX.Faqs.list.init();
    });
</script>

@stop