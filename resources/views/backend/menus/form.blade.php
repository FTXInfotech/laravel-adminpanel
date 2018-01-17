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
        var formName = '_add_custom_url_form';
        var lastId = null;
        $('#menu-items').nestable({
            callback: function(l, e){
                $(".menu-items-field").val(JSON.stringify($(l).nestable('serialise')));
            },
            json: $(".menu-items-field").val(),
            includeContent:true,
            scroll: false,
            maxDepth: 10
        });
        $(".show-modal").click(function(){
            $("#showMenuModal").find(".modal-dialog .modal-content .modal-header .modal-title").html($(this).attr("data-header"));
            formName = $(this).attr("data-form");
            $("#showMenuModal").modal("show");
            setTimeout(function() {
                $(document).find("#showMenuModal .view-permission-block").remove();
                $(document).find("#menu-add-custom-url").removeClass("hidden");
            }, 500);
        });
        $("#showMenuModal").on('show.bs.modal', function () {
            $.get("{{ route('admin.menus.getform') }}/" + formName, function(data, status){
                if(status == "success") {
                    $("#showMenuModal").find(".modal-dialog .modal-content .modal-body").html(data);
                }
                else {
                    $("#showMenuModal").find(".modal-dialog .modal-content .modal-body").html("Something went wrong! Please try again later.");
                }
            });
        });
        var getNewId = function(str) {
            var arr = str.match(/"id":[0-9]+/gi);
            if(arr) {
                $.each(arr, function(index, item) {
                    arr[index] =  parseInt(item.replace('"id":', ''));
                });
                return Math.max.apply(Math, arr) + 1;
            }
            return 1;
        }
        var addMenuItem = function(obj) {
            $('#menu-items').nestable('add', {
                                            "id": getNewId($(".menu-items-field").val()),
                                            "content": obj.name,
                                            "name": obj.name,
                                            "url": obj.url,
                                            "url_type" : obj.url_type,
                                            "open_in_new_tab": obj.open_in_new_tab,
                                            "icon": obj.icon,
                                            "view_permission_id": obj.view_permission_id
                                        });
            $(".menu-items-field").val(JSON.stringify($('#menu-items').nestable('serialise')));

        }
        var editMenuItem = function(obj) {
            var newObject = {
                                "id": obj.id,
                                "content": obj.name,
                                "name": obj.name,
                                "url": obj.url,
                                "url_type": obj.url_type,
                                "open_in_new_tab": obj.open_in_new_tab,
                                "icon": obj.icon,
                                "view_permission_id": obj.view_permission_id
                            };
            var menuItems = $("#menu-items").nestable('serialise');
            var itemData;
            $.each(menuItems, function(index, item){
                itemData = findItemById(item, id);
                if(itemData) { return false; }
            });
            if(itemData.children) {
                newObject.children = itemData.children;
            }
            $('#menu-items').nestable('replace', newObject);
            $(".menu-items-field").val(JSON.stringify($('#menu-items').nestable('serialise')));

        }
        $(document).on("submit", "#menu-add-custom-url", function(e){
            e.preventDefault();
            var formData = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            if(formData.name.length > 0) {
                if(formData.id.length > 0) {
                    editMenuItem(formData);
                } else {
                    addMenuItem(formData);
                }
                $("#showMenuModal").modal("hide");
            }
        });
        $(document).on("click", ".add-module-to-menu", function(){
            var dataObj = {
                id: $(this).attr("data-id"),
                name: $(this).attr("data-name"),
                url: $(this).attr("data-url"),
                url_type: $(this).attr("data-url_type"),
                open_in_new_tab: $(this).attr("data-open_in_new_tab"),
                view_permission_id: $(this).attr("data-view_permission_id"),
            }
            addMenuItem(dataObj);
        });
        var findItemById = function(item, id) {
            if(item.id == id) {
                return item;
            }
            var found = false;
            var foundItem;
            if(item.children){
                $.each(item.children, function(index, childItem){
                    foundItem = findItemById(childItem, id);
                    if(foundItem)
                    {
                        console.log(foundItem);
                        found = true;
                        return false;
                    }
                });
            }
            if(found)
            {
                return foundItem;
            }
            return null;
        };

        $(document).ready(function(){
            $(document).on("click", ".edit-menu-item", function() {
                id = $(this).parents(".dd-item").first().attr("data-id");
                $("#showMenuModal").modal("show");
                var menuItems = $("#menu-items").nestable('serialise');
                var itemData;
                $.each(menuItems, function(index, item){
                    itemData = findItemById(item, id);
                    //console.log(itemData);
                    if(itemData) { return false; }
                });
                if(itemData.id != undefined && itemData.id == id)
                {
                    setTimeout(function() {
                        $("#showMenuModal").find(".modal-dialog .modal-content .modal-header .modal-title").html("Edit: "+itemData.name);
                        $(document).find("#showMenuModal .mi-id").val(itemData.id);
                        $(document).find("#showMenuModal .mi-name").val(itemData.name);
                        $(document).find("#showMenuModal .mi-url").val(itemData.url);
                        $(document).find("#showMenuModal .mi-url_type_"+itemData.url_type).prop("checked", true);
                        if(itemData.open_in_new_tab == 1) {
                          $(document).find("#showMenuModal .mi-open_in_new_tab").prop("checked", true);
                        }
                        $(document).find("#showMenuModal .mi-icon").val(itemData.icon);
                        if(itemData.view_permission_id) {
                            $(document).find("#showMenuModal .mi-view_permission_id").val(itemData.view_permission_id);
                        } else {
                            $(document).find("#showMenuModal .view-permission-block").remove();
                        }
                        $(document).find("#menu-add-custom-url").removeClass("hidden");
                    }, 500 );
                    return;
                }
            });
            $(document).on("click", ".remove-menu-item", function() {
                $("#menu-items").nestable('remove', $(this).parents(".dd-item").first().attr("data-id"));
                $(".menu-items-field").val(JSON.stringify($("#menu-items").nestable('serialise')));
            });

        });

</script>
@endsection
