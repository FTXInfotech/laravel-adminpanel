@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blog-tag.management') . ' | ' . __('labels.backend.access.blog-tag.edit'))

@section('breadcrumb-links')
    @include('backend.blog-tags.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($blogTag, ['route' => ['admin.blog-tags.update', $blogTag], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

    <div class="card">
        @include('backend.blog-tags.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.blog-tags.index', 'id' => $blogTag->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection