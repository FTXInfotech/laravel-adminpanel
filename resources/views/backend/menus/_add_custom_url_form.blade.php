{{ Form::open(['class' => 'form-horizontal hidden', 'role' => 'form', 'method' => 'post', 'id' => 'menu-add-custom-url']) }}
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.menus.field.name'), ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label required']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('name', null, ['class' => 'form-control box-size mi-name', 'id' => '', 'placeholder' => trans('labels.backend.menus.field.name'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('url', trans('labels.backend.menus.field.url'), ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('url', null, ['class' => 'form-control box-size mi-url', 'placeholder' => trans('labels.backend.menus.field.url')]) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('url', trans('labels.backend.menus.field.url_type'), ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label']) }}
        <div class="col-lg-9 col-md-9 col-sm-9 ">
          <div class="radio">
            <label class="radio-inline">{{ Form::radio('url_type', 'route', null, ['class' => 'mi-url_type_route']) }} {{ trans('labels.backend.menus.field.url_types.route') }}</label>
            <label class="radio-inline">{{ Form::radio('url_type', 'static', true, ['class' => 'mi-url_type_static']) }} {{ trans('labels.backend.menus.field.url_types.static') }}</label>
          </div>
          <div class="checkbox">
            {{ Form::hidden('open_in_new_tab', 0) }}
            <label>
              {{ Form::checkbox('open_in_new_tab', 1, false, ['class' => 'mi-open_in_new_tab']) }} {{ trans('labels.backend.menus.field.open_in_new_tab') }}
            </label>
          </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('icon', trans('labels.backend.menus.field.icon'), ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label', 'title' => trans('labels.backend.menus.field.icon_title')]) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('icon', null, ['class' => 'form-control box-size mi-icon', 'placeholder' => trans('labels.backend.menus.field.icon_title')]) }}
        </div>
    </div>
    <div class="form-group view-permission-block">
        {{ Form::label('view_permission_id', trans('labels.backend.menus.field.view_permission_id'), ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('view_permission_id', null, ['class' => 'form-control box-size mi-view_permission_id', 'placeholder' => trans('labels.backend.menus.field.view_permission_id')]) }}
        </div>
    </div>
    {{ Form::hidden('id', null, ['class' => 'mi-id']) }}
    <div class="box-body">
            <div class="form-group">
                <div class="edit-form-btn">
                  {{ Form::reset(trans('buttons.general.cancel'), ['class' => 'btn btn-default btn-md', 'data-dismiss' => 'modal']) }}
                  {{ Form::submit(trans('buttons.general.save'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
{{ Form::close() }}
