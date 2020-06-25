@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blogs.management') . ' | ' . __('labels.backend.access.blogs.edit'))

@section('breadcrumb-links')
    @include('backend.blogs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($blog, ['route' => ['admin.blogs.update', $blog], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.blogs.form')

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ link_to_route('admin.blogs.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-sm pull-right']) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ Form::close() }}
@endsection

@section('pagescript')
    <script src="{{URL::asset('/js/moment.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{URL::asset('/js/select2/select2.min.js')}}"></script>
    <script src="{{URL::asset('/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{URL::asset('/js/backend/blogs.js')}}"></script>

    <script type="text/javascript">

        Blog.Blog.init('en_US');

    </script>
@stop