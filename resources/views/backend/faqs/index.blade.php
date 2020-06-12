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
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.faqs.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table">
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
                        @forelse($faqs as $faq)
                            <tr>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td>
                                    @if($faq->status)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td>{{ $faq->created_at }}</td>
                                <td class="btn-td">
                                    @include('backend.faqs.includes.actions', ['faq' => $faq])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No faqs found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $faqs->total() !!} {{ trans_choice('labels.backend.access.faqs.table.total', $faqs->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $faqs->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection