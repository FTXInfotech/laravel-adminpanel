@extends('backend.layouts.app')

@section('title', __('labels.backend.access.email-templates.management') . ' | ' . __('labels.backend.access.email-templates.create'))

@section('breadcrumb-links')
    @include('backend.email-templates.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.email-templates.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.email-templates.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.email-templates.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection