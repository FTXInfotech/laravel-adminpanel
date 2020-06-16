@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.auth.permissions.management') . ' | ' . trans('labels.backend.auth.permissions.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.auth.permissions.management') }}
        <small>{{ trans('labels.backend.auth.permissions.edit') }}</small>
    </h1>
@endsection

@section('content')
{{ Form::model($permission, ['route' => ['admin.auth.permission.update', $permission], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission']) }}

    <div class="card">
        @include('backend.auth.permissions.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.auth.permission.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection