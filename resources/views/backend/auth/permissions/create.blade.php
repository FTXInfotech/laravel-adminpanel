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
