@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.blog-tag.management'))

@section('breadcrumb-links')
    @include('backend.blog-tags.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                {{ __('labels.backend.access.blog-tag.management') }} <small class="text-muted">{{ __('labels.backend.access.blog-tag.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.blog-tags.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.blog-tag.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.blog-tag.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.blog-tag.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.blog-tag.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    @if($tag->status)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td>{{ $tag->user_name }}</td>
                                <td>{{ $tag->created_at }}</td>
                                <td class="btn-td">
                                    @include('backend.blog-tags.includes.actions', ['tag' => $tag])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No tags found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $tags->total() !!} {{ trans_choice('labels.backend.access.blog-tag.table.total', $tags->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $tags->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection