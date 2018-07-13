<div class="form-group">
    {{ Form::label('name', trans('validation.attributes.backend.access.permissions.name'), ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.permissions.name'), 'required' => 'required']) }}
    </div><!--col-lg-10-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('display_name', trans('validation.attributes.backend.access.permissions.display_name'), ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::text('display_name', null,['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.permissions.display_name'), 'required' => 'required']) }}
    </div><!--col-lg-3-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('sort', trans('validation.attributes.backend.access.permissions.sort'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-10">
        {{ Form::text('sort', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.permissions.sort')]) }}
    </div><!--col-lg-10-->
</div><!--form control-->