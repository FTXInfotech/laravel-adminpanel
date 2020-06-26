@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.permissions.management') . ' | ' . trans('labels.backend.access.permissions.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.permissions.management') }}
        <small>{{ trans('labels.backend.access.permissions.create') }}</small>
    </h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.auth.permission.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission']) }}

    <div class="card">
        @include('backend.auth.permissions.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auth.permission.index'])
    </div><!--card-->
    {{ Form::close() }}
@endsection
