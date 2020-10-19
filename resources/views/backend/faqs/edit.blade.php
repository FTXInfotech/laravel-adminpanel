@extends('backend.layouts.app')

@section('title', __('labels.backend.access.faqs.management') . ' | ' . __('labels.backend.access.faqs.edit'))

@section('breadcrumb-links')
    @include('backend.faqs.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($faq, ['route' => ['admin.faqs.update', $faq], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.faqs.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.faqs.index', 'id' => $faq->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection