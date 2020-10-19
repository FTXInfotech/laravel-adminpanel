@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blog-category.management') . ' | ' . __('labels.backend.access.blog-category.create'))

@section('breadcrumb-links')
    @include('backend.blog-categories.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.blog-categories.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.blog-categories.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.blog-categories.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection