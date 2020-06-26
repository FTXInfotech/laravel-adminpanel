@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blogs.management') . ' | ' . __('labels.backend.access.blogs.create'))

@section('breadcrumb-links')
    @include('backend.blogs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.blogs.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.blogs.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.blogs.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection