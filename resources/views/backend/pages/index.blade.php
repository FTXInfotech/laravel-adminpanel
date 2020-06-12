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
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pages.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.pages.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.pages.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.pages.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.pages.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{ $page->title }}</td>
                                <td>
                                    @if($page->status)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td>{{ $page->user_name }}</td>
                                <td>{{ $page->created_at }}</td>
                                <td class="btn-td">
                                    @include('backend.pages.includes.actions', ['page' => $page])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No pages found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $pages->total() !!} {{ trans_choice('labels.backend.access.pages.table.total', $pages->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pages->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection
