<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.permissions.management') }}
                <small class="text-muted">{{ __('labels.backend.access.permissions.create') }}</small>
            </h4>
        </div><!--col-->
    </div><!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('name', trans('validation.attributes.backend.access.permissions.name'), ['class' => 'col-lg-2 control-label required']) }}
                
                <div class="col-md-10">
                    {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.permissions.name'), 'required' => 'required']) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('display_name', trans('validation.attributes.backend.access.permissions.display_name'), ['class' => 'col-lg-2 control-label required']) }}
                
                <div class="col-md-10">
                    {{ Form::text('display_name', null,['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.permissions.display_name'), 'required' => 'required']) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('sort', trans('labels.backend.access.permissions.table.sort'), ['class' => 'col-lg-2 control-label']) }}
                
                <div class="col-md-10">
                    {{ Form::text('sort', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.access.permissions.table.sort')]) }}
                </div><!--col-->
            </div><!--form-group-->

        </div><!--col-->
    </div><!--row-->
</div><!--card-body-->