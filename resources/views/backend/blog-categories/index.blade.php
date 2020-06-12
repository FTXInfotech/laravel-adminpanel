@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.blog-category.management'))

@section('breadcrumb-links')
    @include('backend.blog-categories.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                {{ __('labels.backend.access.blog-category.management') }} <small class="text-muted">{{ __('labels.backend.access.blog-category.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.blog-categories.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="blogs-table" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.blog-category.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.blog-category.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.blog-category.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.blog-category.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if($category->status)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td>{{ $category->user_name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td class="btn-td">
                                    @include('backend.blog-categories.includes.actions', ['category' => $category])
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No categories found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $categories->total() !!} {{ trans_choice('labels.backend.access.blog-category.table.total', $categories->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $categories->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection