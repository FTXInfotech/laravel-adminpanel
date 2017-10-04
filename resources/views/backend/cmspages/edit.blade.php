@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.cmspages.management') . ' | ' . trans('labels.backend.cmspages.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.cmspages.management') }}
        <small>{{ trans('labels.backend.cmspages.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($cmspage, ['route' => ['admin.cmspages.update', $cmspage], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.cmspages.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.cmspages-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('title', trans('validation.attributes.backend.cmspages.title'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('title', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.cmspages.title'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('description', trans('validation.attributes.backend.cmspages.description'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.cmspages.description')]) }}
                    </div><!--col-lg-3-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('cannonical_link', trans('validation.attributes.backend.cmspages.cannonical_link'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('cannonical_link', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.cmspages.cannonical_link')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('seo_title', trans('validation.attributes.backend.cmspages.seo_title'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('seo_title', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.cmspages.seo_title')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('seo_keyword', trans('validation.attributes.backend.cmspages.seo_keyword'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('seo_keyword', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.cmspages.seo_keyword')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('seo_description', trans('validation.attributes.backend.cmspages.seo_description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('seo_description', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.cmspages.seo_description')]) }}
                    </div><!--col-lg-3-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('status', trans('validation.attributes.backend.cmspages.is_active'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <div class="control-group">
                            <label class="control control--checkbox">
                                {{ Form::checkbox('status', 1, ($cmspage->status == 1) ? true : false ) }}
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                    </div><!--col-lg-3-->
                </div><!--form control-->
                <div class="edit-form-btn">
                    {{ link_to_route('admin.cmspages.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->
    {{ Form::close() }}
@endsection
@section("after-scripts")
    <script type="text/javascript">
        FinBuilders.Cmspage.init();    
    </script>
@endsection