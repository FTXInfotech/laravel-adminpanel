@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.blogs.management') . ' | ' . trans('labels.backend.blogs.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.blogs.management') }}
        <small>{{ trans('labels.backend.blogs.edit') }}</small>
    </h1>
@endsection

@section('content')

    {{ Form::model($blog, ['route' => ['admin.blogs.update', $blog], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.blogs.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.blogs.partials.blogs-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                <div class="form-group">
                    @include("backend.blogs.form")
                    <div class="edit-form-btn">
                    {{ link_to_route('admin.blogs.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection