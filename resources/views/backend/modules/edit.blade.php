@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.modules.management') . ' | ' . trans('labels.backend.modules.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.modules.management') }}
        <small>{{ trans('labels.backend.modules.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($module, ['route' => ['admin.modules.update', $module], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.modules.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.modules-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                <div class="form-group">
                    @include("backend.modules.form")
                    <div class="edit-form-btn">
                    {{ link_to_route('admin.modules.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection