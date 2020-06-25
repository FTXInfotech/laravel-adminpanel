@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blogs.management') . ' | ' . __('labels.backend.access.blogs.create'))

@section('breadcrumb-links')
    @include('backend.blogs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.blogs.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.blogs.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.blogs.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection