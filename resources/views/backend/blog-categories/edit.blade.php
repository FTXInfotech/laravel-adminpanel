@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blog-category.management') . ' | ' . __('labels.backend.access.blog-category.edit'))

@section('breadcrumb-links')
    @include('backend.blog-categories.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($blogCategory, ['route' => ['admin.blog-categories.update', $blogCategory], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

    <div class="card">
        @include('backend.blog-categories.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.blog-categories.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection