@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.create'))

@section('breadcrumb-links')
    @include('backend.email-templates.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.email-templates.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.email-templates.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.email-templates.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection