@extends('backend.layouts.app')

@section('title', __('labels.backend.access.faqs.management') . ' | ' . __('labels.backend.access.faqs.edit'))

@section('breadcrumb-links')
    @include('backend.faqs.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($faq, ['route' => ['admin.faqs.update', $faq], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.faqs.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.faqs.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection