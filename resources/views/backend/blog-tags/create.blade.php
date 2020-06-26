@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blog-tag.management') . ' | ' . __('labels.backend.access.blog-tag.create'))

@section('breadcrumb-links')
    @include('backend.blog-tags.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.blog-tags.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.blog-tags.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.blog-tags.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection