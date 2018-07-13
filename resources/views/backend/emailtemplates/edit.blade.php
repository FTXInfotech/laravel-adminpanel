@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.emailtemplates.management') . ' | ' . trans('labels.backend.emailtemplates.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.emailtemplates.management') }}
        <small>{{ trans('labels.backend.emailtemplates.edit') }}</small>
    </h1>
    <div class="model-container">
        <div class="modal fade model-wrapper" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel"> Email Template </h4>
                    </div>

                    <div id="model-body" class="modal-body">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{ Form::model($emailtemplate, ['route' => ['admin.emailtemplates.update', $emailtemplate], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.emailtemplates.edit') }}</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('title', trans('validation.attributes.backend.emailtemplates.title'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('title', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.emailtemplates.title'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('type_id', trans('validation.attributes.backend.emailtemplates.type'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::select('type_id', $emailtemplatetypes, null,['class' => 'form-control select2 box-size', 'placeholder' => trans('validation.attributes.backend.emailtemplates.type'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('placeholder', trans('validation.attributes.backend.emailtemplates.placeholder'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <div class="input-group box-size">
                            {{ Form::select('placeholder', $emailtemplateplaceholders, null,['class' => 'form-control select2', 'placeholder' => trans('validation.attributes.backend.emailtemplates.placeholder'), 'id' => 'placeHolder', 'style' => 'width:100%']) }}
                            <span class="input-group-btn">
                                <button class="btn btn-primary" id="addPlaceHolder" type="button">{{ trans('buttons.general.crud.add') }}</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('subject', trans('validation.attributes.backend.emailtemplates.subject'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('subject', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.emailtemplates.subject')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('body', trans('validation.attributes.backend.emailtemplates.body'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10 mce-box">
                        {{ Form::textarea('body', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.emailtemplates.body'), 'id' => 'txtBody']) }}
                    </div><!--col-lg-3-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('is_active', trans('validation.attributes.backend.emailtemplates.is_active'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <div class="control-group">
                            <label class="control control--checkbox">
                                {{ Form::checkbox('is_active', 1, ($emailtemplate->status == 1) ? true : false ) }}
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                    </div><!--col-lg-3-->
                </div><!--form control-->
                <div class="edit-form-btn">
                    {{ link_to_route('admin.emailtemplates.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    <input type="button" id="showPreview" data-toggle="modal" data-target="#templatePreview" class="btn btn-info btn-md" value="{{ trans('buttons.general.preview') }}" />
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->
    {{ Form::close() }}
@endsection
@section("after-scripts")
    <script type="text/javascript">
        Backend.emailTemplate.init();
    </script>
@endsection