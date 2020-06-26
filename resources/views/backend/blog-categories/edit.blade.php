@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blog-category.management') . ' | ' . __('labels.backend.access.blog-category.edit'))

@section('breadcrumb-links')
    @include('backend.blog-categories.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($blogCategory, ['route' => ['admin.blog-categories.update', $blogCategory], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

    <div class="card">
        @include('backend.blog-categories.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.blog-categories.index', 'id' => $blogCategory->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection