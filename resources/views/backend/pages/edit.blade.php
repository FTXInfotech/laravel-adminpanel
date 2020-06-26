@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@section('breadcrumb-links')
    @include('backend.pages.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($page, ['route' => ['admin.pages.update', $page], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.pages.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.pages.index', 'id' => $page->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection