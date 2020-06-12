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
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.blogs.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table">
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
                        <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>{{ $blog->name }}</td>
                                <td>{{ $blog->publish_datetime }}</td>
                                <td>{{ $blog->status }}</td>
                                <td>{{ $blog->user_name }}</td>
                                <td>{{ $blog->created_at }}</td>
                                <td class="btn-td">
                                    @include('backend.blogs.includes.actions', ['blog' => $blog])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No blogs found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $blogs->total() !!} {{ trans_choice('labels.backend.access.blogs.table.total', $blogs->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $blogs->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection
