<div class="box-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="form-group">
                    {{ Form::label('categories', trans('labels.backend.menus.field.type'), ['class' => 'col-lg-4 col-md-4 col-sm-4 control-label required']) }}
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        {{ Form::select('type', $types, null, ['class' => 'form-control tags box-size', 'required' => 'required']) }}
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="form-group">
                    {{ Form::label('name', trans('labels.backend.menus.field.name'), ['class' => 'col-lg-2 col-md-2 col-sm-2 control-label required']) }}
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.menus.field.name'), 'required' => 'required']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-4 col-md-4 col-sm-4 ">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach ($modules as $module)
                            <div class="row modules-list-item">
                                <div class="col-lg-10">
                                    <span >{{ $module->name }}&nbsp;&nbsp;</span>
                                </div>
                                <div class="col-lg-2">
                                    <a href="javascript:void(0);"><i class="fa fa-plus add-module-to-menu" data-id="{{ $module->id }}" data-name="{{ $module->name }}" data-url="{{ $module->url }}" data-url_type="route" data-open_in_new_tab="0" data-view_permission_id="{{ $module->view_permission_id }}" ></i></a>
                                </div>
                            </div>
                        @endforeach
                        <br/>
                        <button type="button" class="btn btn-info show-modal" data-form="_add_custom_url_form" data-header="Add Custom URL"><i class="fa fa-plus" ></i>&nbsp;&nbsp;Add Custom URL</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 ">
                 {{ Form::hidden('items', empty($menu->items) ? '{}' : $menu->items, ['class' => 'menu-items-field']) }}
                <div class="well">
                    <div id="menu-items" class="dd">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section("after-styles")
     {!! Html::style('css/nestable2/jquery.nestable.css') !!}
@endsection
@section("after-scripts")
    {{ Html::script('js/nestable2/jquery.nestable.js') }}
    <script type="text/javascript">
        Backend.Menu.selectors.formUrl = "{{route('admin.menus.getform')}}";
        Backend.Menu.init();
</script>
@endsection
