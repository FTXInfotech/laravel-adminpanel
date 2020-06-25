@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@section('breadcrumb-links')
    @include('backend.pages.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($page, ['route' => ['admin.pages.update', $page], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.pages.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.pages.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection