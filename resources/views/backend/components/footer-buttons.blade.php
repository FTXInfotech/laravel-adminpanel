<div class="card-footer">
    <div class="row">
        <div class="col">
            {{ link_to_route($cancelRoute, trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-sm']) }}
        </div><!--col-->

        <div class="col text-right">
            {{ Form::submit((isset($id)) ? trans('buttons.general.crud.update') : trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-sm pull-right']) }}
        </div><!--row-->
    </div><!--row-->
</div><!--card-footer-->