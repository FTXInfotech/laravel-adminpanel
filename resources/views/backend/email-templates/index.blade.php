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
                    <table id="blogs-table" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.email-templates.table.title') }}</th>
                                <th>{{ trans('labels.backend.access.email-templates.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.email-templates.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($emailTemplates as $emailTemplate)
                            <tr>
                                <td>{{ $emailTemplate->title }}</td>
                                <td>
                                    @if($emailTemplate->status)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td>{{ $emailTemplate->created_at }}</td>
                                <td class="btn-td">
                                    @include('backend.email-templates.includes.actions', ['emailTemplate' => $emailTemplate])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No email templates found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $emailTemplates->total() !!} {{ trans_choice('labels.backend.access.email-templates.table.total', $emailTemplates->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $emailTemplates->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection