@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.edit'))

@section('breadcrumb-links')
    @include('backend.email-templates.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($emailTemplate, ['route' => ['admin.email-templates.update', $emailTemplate], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.email-templates.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.email-templates.index', 'id' => $emailTemplate->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection