@extends('backend.layouts.app')

@section('title', __('labels.backend.access.blogs.management') . ' | ' . __('labels.backend.access.blogs.edit'))

@section('breadcrumb-links')
    @include('backend.blogs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($blog, ['route' => ['admin.blogs.update', $blog], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.blogs.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.blogs.index', 'id' => $blog->id ])
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