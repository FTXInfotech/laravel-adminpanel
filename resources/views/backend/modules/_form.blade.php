<div class="box-body">
    <!-- Module Name -->
    <div class="form-group">
        {{ Form::label('name', trans('labels.backend.modules.form.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div>

    {{-- <!-- Module Url -->
    <div class="form-group">
        {{ Form::label('url', trans('labels.backend.modules.form.url'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => '', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div>

    <!-- Module View Permission -->
    <div class="form-group">
        {{ Form::label('view_permission_id', trans('labels.backend.modules.form.view_permission_id'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('view_permission_id', null, ['class' => 'form-control box-size view-permission', 'placeholder' => '', 'required' => 'required']) }}
            <div class="permission-messages">
            </div>
        </div><!--col-lg-10-->
    </div> --}}

    <!-- Directory -->
    <div class="form-group">
        {{ Form::label('directory_name', trans('labels.backend.modules.form.directory_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('directory_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog', 'required' => true]) }}
        </div><!--col-lg-10-->
    </div>
    <!-- End Directory -->
    {{-- <div class="form-group">
        {{ Form::label('model_namespace', trans('labels.backend.modules.form.namespace'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <div class="input-group box-size">
                <span class="input-group-addon">{{ $model_namespace }}</span>
                {{ Form::text('model_namespace', $model_directory, ['class' => 'form-control', 'placeholder' => '']) }}
            </div>
        </div><!--col-lg-10-->
    </div><!--form control--> --}}

    <!-- Model Name -->
    <div class="form-group">
        {{ Form::label('model_name', trans('labels.backend.modules.form.model_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('model_name', null, ['class' => 'form-control box-size only-text', 'placeholder' => 'e.g., Blog']) }}
            <div class="model-messages"></div>
        </div>
    </div>
    <!-- End Model Name -->
    <!-- Table Name -->
    <div class="form-group">
        {{ Form::label('table_name', trans('labels.backend.modules.form.table_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('table_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog']) }}
            <div class="table-messages"></div>
        </div><!--col-lg-10-->
    </div>
    <!-- End Table Name -->
    <!-- Crud Operations Create/Edit/Delete to be added to the field (Read operation is given by default)-->
    <div class="form-group">
        {{ Form::label('operations', 'Operations', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-8">
            <label class="control control--checkbox">
                <!-- For Create Operation of CRUD -->
                {{ Form::checkbox('model_create', '1', false) }}Create
                <div class="control__indicator"></div>
            </label>
            <label class="control control--checkbox">
                <!-- For Edit Operation of CRUD -->
                {{ Form::checkbox('model_edit', '1', false) }}Edit
                <div class="control__indicator"></div>
            </label>
            <label class="control control--checkbox">
                <!-- For Delete Operation of CRUD -->
                {{ Form::checkbox('model_delete', '1', false) }}Delete
                <div class="control__indicator"></div>
            </label>
        </div>
    </div>
    <!-- End Crud Operations -->

    <!-- Model -->
   {{--  <div class="form-group">
        <div class="col-lg-8 col-lg-offset-2 box-size">
            <div class="panel panel-default box-size">
                <div class="panel-heading">
                    <div class="control-group" style="display:inline">
                        <label class="control control--checkbox">
                            {{ Form::checkbox('model', 1, false) }}Model
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="panel-body hidden model">
                    <div class="form-group">
                        {{ Form::label('model_namespace', trans('labels.backend.modules.form.namespace'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            <div class="input-group box-size">
                                <span class="input-group-addon">{{ $model_namespace }}</span>
                                {{ Form::text('model_namespace', $model_directory, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('model_name', trans('labels.backend.modules.form.model_name'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            {{ Form::text('model_name', null, ['class' => 'form-control box-size only-text', 'placeholder' => 'e.g., Blog']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('table_name', trans('labels.backend.modules.form.table_name'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            {{ Form::text('table_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog']) }}
                        </div><!--col-lg-10-->
                    </div>
                    <!-- Crud Operations Create/Edit/Delete to be added to the field (Read operation is given by default)-->
                    <div class="form-group">
                        <div class="col-lg-2">
                            {{ Form::label('operations', 'Operations', ['class' => 'control-label']) }}
                        </div>
                        <div class="col-lg-8">
                            <label class="control control--checkbox">
                                <!-- For Create Operation of CRUD -->
                                {{ Form::checkbox('model_create', '1', false) }}Create
                                <div class="control__indicator"></div>
                            </label>
                            <label class="control control--checkbox">
                                <!-- For Edit Operation of CRUD -->
                                {{ Form::checkbox('model_edit', '1', false) }}Edit
                                <div class="control__indicator"></div>
                            </label>
                            <label class="control control--checkbox">
                                <!-- For Delete Operation of CRUD -->
                                {{ Form::checkbox('model_delete', '1', false) }}Delete
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                    </div>
                    <div class="table-messages"></div>
                    <div class="model-messages"></div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <!-- Controller -->
    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-2 box-size">
            <div class="panel panel-default box-size">
                <div class="panel-heading">
                    <div class="control-group" style="display:inline">
                        <label class="control control--checkbox">
                            {{ Form::checkbox('controller', 1, false) }}Controller
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="panel-body hidden controller">
                    <div class="form-group">
                        {{ Form::label('controller_namespace', trans('labels.backend.modules.form.namespace'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            <div class="input-group box-size">
                                <span class="input-group-addon">{{ $controller_namespace }}</span>
                                {{ Form::text('controller_namespace', null, ['class' => 'form-control box-size', 'placeholder' => '']) }}
                            </div>
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                    <div class="form-group">
                        {{ Form::label('controller_name', trans('labels.backend.modules.form.controller_name'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            {{ Form::text('controller_name', null, ['class' => 'form-control box-size only-text', 'placeholder' => 'e.g., BlogController', 'pattern' => "[A-Za-z]+" ] ) }}
                        </div>
                    </div>
                    <div class="controller-messages">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Table Controller -->
    {{-- <div class="form-group">
        <div class="col-lg-8 col-lg-offset-2 box-size">
            <div class="panel panel-default box-size">
                <div class="panel-heading">
                    <div class="control-group" style="display:inline">
                        <label class="control control--checkbox">
                            {{ Form::checkbox('table_controller', 1, false) }}Table Controller
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="panel-body hidden table_controller">
                    <div class="form-group">
                        {{ Form::label('table_controller_namespace', trans('labels.backend.modules.form.namespace'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            <div class="input-group box-size">
                                <span class="input-group-addon">{{ $controller_namespace }}</span>
                                {{ Form::text('table_controller_namespace', null, ['class' => 'form-control box-size required', 'placeholder' => '']) }}
                            </div>
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                    <div class="form-group">
                        {{ Form::label('table_controller_name', trans('labels.backend.modules.form.table_controller_name'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            {{ Form::text('table_controller_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., BlogController']) }}
                        </div>
                    </div>
                    <div class="table_controller-messages">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Migration -->
    {{-- <div class="form-group">
        <div class="col-lg-8 col-lg-offset-2 box-size">
            <div class="panel panel-default box-size">
                <div class="panel-heading">
                    <div class="control-group" style="display:inline">
                        <label class="control control--checkbox">
                            {{ Form::checkbox('table', 1, false) }}Migration
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="panel-body hidden table">
                    <div class="form-group">
                        {{ Form::label('table_name', trans('labels.backend.modules.form.table_name'), ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            {{ Form::text('table_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog']) }}
                        </div><!--col-lg-10-->
                    </div>
                    <div class="table-messages">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events & Listeners -->
    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-2 box-size">
            <div class="panel panel-default box-size">
                <div class="panel-heading">
                    <div class="control-group" style="display:inline">
                        <label class="control control--checkbox">
                            {{ Form::checkbox('el', 1, false) }}Events & Listeners
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="panel-body hidden el">
                    <div class="form-group">
                        {{ Form::label('event_namespace', 'Namespace', ['class' => 'col-lg-2 control-label required']) }}

                        <div class="col-lg-10">
                            <div class="input-group box-size">
                                <span class="input-group-addon">{{ $event_namespace }}</span>
                                {{ Form::text('event_namespace', $event_directory, ['class' => 'form-control box-size', 'placeholder' => '']) }}
                            </div>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="events-div">
                        <div class="form-group event clearfix">
                            {{ Form::label('event[]', trans('labels.backend.modules.form.event'), ['class' => 'col-lg-2 control-label required']) }}

                            <div class="col-lg-6">
                                {{ Form::text('event[]', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.modules.form.event'), 'style' => 'width:100%']) }}
                            </div><!--col-lg-10-->
                            <a href="#" class="btn btn-danger btn-md remove-field hidden">Remove Event</a>
                            <a href="#" class="btn btn-primary btn-md add-field">Add Event</a>
                        </div><!--form control-->
                    </div>

                    <div class="el-messages">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@section("after-scripts")
    <script type="text/javascript">
        //When the DOM is ready to be manipulated
        $(document).ready(function(){
            model_ns = {!! json_encode($model_namespace) !!};
            controller_ns = {!! json_encode($controller_namespace) !!};
            event_ns = {!! json_encode($event_namespace) !!};

            //If any errors occured
            handleAllCheckboxes();

            //model checkbox change event
            $("input[name=model]").on('change', function(e){
                handleCheckBox($(this), $(".model"));
            });

            //controller checkbox change event
            $("input[name=controller]").on('change', function(e){
                handleCheckBox($(this), $(".controller"));
            });

            // //table controller checkbox change event
            // $("input[name=table_controller]").on('change', function(e){
            //     handleCheckBox($(this), $(".table_controller"));
            // });
            //
            // //table checkbox change event
            // $("input[name=table]").on('change', function(e){
            //     handleCheckBox($(this), $(".table"));
            // });
            //
            // //routes checkbox change event
            // $("input[name=route]").on('change', function(e){
            //     handleCheckBox($(this), $(".route"));
            // });
            //
            // //views checkbox change event
            // $("input[name=views]").on('change', function(e){
            //     handleCheckBox($(this), $(".views"));
            //     throwMessages('warning', 'The files with the same name would be overwritten.', 'views');
            // });

            //events and listeners checkbox change event
            $("input[name=el]").on('change', function(e){
                handleCheckBox($(this), $(".el"));
            });

            //repository checkbox change event
            // $("input[name=repository]").on('change', function(e){
            //     handleCheckBox($(this), $(".repository"));
            // });

            //Add field in event panel
            $(document).on('click', ".add-field", function(e){
                e.preventDefault();
                clone = $(".event").first().clone();
                clone.appendTo(".events-div");
                clone.find(".remove-field").removeClass('hidden');
            });

            //remove field in event panel
            $(document).on('click', ".remove-field", function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            });

            $(document).on('blur', "input[name=model_name]", function(e){
                checkModelExists($(this));
            });

            $(document).on('blur', "input[name=controller_name]", function(e){
                checkControllerExists($(this));
            });

            // $(document).on('blur', "input[name=table_controller_name]", function(e){
            //     checkTableControllerExists($(this));
            // // });

            $(document).on('blur', "input[name=table_name]", function(e){
                checkTableExists($(this));
            });

            // $(document).on('blur', "input[name=repo_name]", function(e){
            //     checkRepositoryExists($(this));
            // });
            //
            // $(document).on('blur', "input[name='event[]']", function(e){
            //     checkEventExists($(this));
            // });
            //
            // $(document).on('blur', "input[name=view_permission_id]", function(e){
            //     checkPermissionExists($(this));
            // });

            $(document).on('keyup', "input[name=directory_name]", function(e){
                handleAllCheckboxes();
                //Views Directory value change
                $("input[name=views_directory]").val($(this).val().toLowerCase());
            });
        });

        function checkPermissionExists(permission) {
            if(permission.val()){
                $.post( "{{ route('admin.modules.check.permission') }}", { 'permission' : permission.val()} )
                .done( function( data ) {
                    throwMessages(data.type, data.message, "permission");
                });
            } else {
                 throwMessages('error', "Please provide some input.", "permission");
            }
        }

        function checkModelExists(model) {
            // if(!$("input[name=directory_name]").val()) {
            //     throwMessages('warning', 'Please provide directory name and then click [TAB] here.', "model");
            // } else {
                if(model.val() && $("input[name=model_namespace]").val()) {
                    path = getPath( model_ns, $("input[name=model_namespace]").val(), model.val());
                    checkPath(path, 'model');
                } else {
                    throwMessages('error', 'Please provide some input.', "model");
                }
            // }
        }

        function checkControllerExists(controller) {
            // if(!$("input[name=directory_name]").val()) {
            //     throwMessages('warning', 'Please provide directory name and then click [TAB] here.', "controller");
            // } else {
                if(controller.val() && $("input[name=controller_namespace]").val()) {
                    path = getPath( controller_ns, $("input[name=controller_namespace]").val(), controller.val());
                    checkPath(path, 'controller');
                } else {
                    throwMessages('error', 'Please provide some input.', "controller");
                }
            // }
        }

        function checkTableControllerExists(table_controller) {
            if(table_controller.val() && $("input[name=table_controller_namespace]").val()) {
                path = getPath( controller_ns, $("input[name=table_controller_namespace]").val(), table_controller.val());
                checkPath(path, 'table_controller');
            } else {
                throwMessages('error', 'Please provide some input.', "table_controller");
            }
        }

        function checkTableExists(table) {
            if(table.val()){
                $.post( "{{ route('admin.modules.check.table') }}", { 'table' : table.val()} )
                .done( function( data ) {
                    throwMessages(data.type, data.message, "table");
                });
            } else {
                 throwMessages('error', "Please provide some input.", "table");
            }

        }

        function checkRepositoryExists(repository) {
            // if(!$("input[name=directory_name]").val()) {
            //     throwMessages('warning', 'Please provide directory name and then click [TAB] here.', "repository");
            // } else {
                if(repository.val() && $("input[name=repo_namespace]").val()){
                    path = getPath( repository_ns, $("input[name=repo_namespace]").val(), repository.val());
                    checkPath(path, 'repository');
                } else {
                    throwMessages('error', 'Please provide some input.', "repository");
                }
            // }
        }

        function checkEventExists(event) {
            if(event.val() && $("input[name=event_namespace]").val()) {
                path = getPath( event_ns, $("input[name=event_namespace]").val(), event.val());
                checkPath(path, 'el');
            } else {
                throwMessages('error', 'Please provide some input.', "el");
            }
        }
        function getPath(ns, namespace, model) {
            if(dir = $("input[name=directory_name]").val()) {
                return ns + namespace + "\\" + dir + "\\" + model;
            } else {
                return ns + namespace + "\\" +  model;
            }
        }

        function checkPath(path, element) {
            $.post( "{{ route('admin.modules.check.namespace') }}", { 'path' : path} )
            .done( function( data ) {
                throwMessages(data.type, data.message, element);
            });
        }

        function throwMessages(type, message, element) {
            appendMessage = '';
            switch(type) {
                case 'warning' :
                    appendMessage = "<span class='"+ element +"-warning'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp; "+ message +"</span>";
                    break;
                case 'error' :
                    appendMessage = "<span class='"+ element +"-error'><i class='fa fa-exclamation-circle' aria-hidden='true'></i>&nbsp; "+ message +"</span>";
                    break;
                case 'success' :
                    appendMessage = "<span class='"+ element +"-success'><i class='fa fa-check' aria-hidden='true'></i>&nbsp; "+ message +"</span>";
            }

            $("."+element+"-messages").html(appendMessage);

        }

        //If any errors occured,
        //the panels should automatically be opened
        //which were opened before
        function handleAllCheckboxes() {
            handleCheckBox($("input[name=model]"), $(".model"));
            handleCheckBox($("input[name=controller]"), $(".controller"));
            handleCheckBox($("input[name=table_controller]"), $(".table_controller"));
            handleCheckBox($("input[name=table]"), $(".table"));
            handleCheckBox($("input[name=route]"), $(".route"));
            handleCheckBox($("input[name=views]"), $(".views"));
            handleCheckBox($("input[name=el]"), $(".el"));
            handleCheckBox($("input[name=repository]"), $(".repository"));
            throwMessages('warning', 'The table name can only contain characters and digits and underscores[_].', 'table');
            throwMessages('warning', 'The files with the same name would be overwritten.', 'views');
        }

        //Handle the checkbox event for that element
        function handleCheckBox(checkbox, element){
            checkboxValue = checkbox.prop('checked');

            // if(!$("input[name=directory_name]").val()) {
            //     throwMessages('warning', 'Please provide directory name and then click [TAB] here.', checkbox.attr('name'));
            // } else {
                if($("."+checkbox.attr('name')+"-messages").children().length == 0) {
                    $("."+checkbox.attr('name')+"-messages").empty();
                }
            // }
            // $(".table-messages").empty();
            if(checkboxValue) {
                element.removeClass('hidden', 3000);
            }
            else {
                element.addClass('hidden', 3000);
            }

            //calling required field handler functions
            switch (checkbox.attr('name')) {
                case 'model' : handleModelRequiredFields(checkboxValue);
                    break;
                case 'controller' : handleControllerRequiredFields(checkboxValue);
                    break;
                case 'table' : handleTableRequiredFields(checkboxValue);
                    break;
                case 'route' : handleRouteRequiredFields(checkboxValue);
                    break;
                case 'repository' : handleRepoRequiredFields(checkboxValue);
                    break;
                case 'el' : handleEventRequiredFields(checkboxValue);
                    break;
            }
        }

        //Model Required fields if that panel is open
        function handleModelRequiredFields(check) {
            // $("input[name=model_namespace]").attr('required', check);
            $("input[name=model_name]").attr('required', check);
        }

        //Controller Required fields if that panel is open
        function handleControllerRequiredFields(check) {
            // $("input[name=controller_namespace]").attr('required', check);
            $("input[name=controller_name]").attr('required', check);
        }

        //Table Required fields if that panel is open
        function handleTableRequiredFields(check) {
            $("input[name=table_name]").attr('required', check);
        }

        //Route Required fields if that panel is open
        function handleRouteRequiredFields(check) {
            $("input[name=route_name]").attr('required', check);
            $("input[name=route_controller_name]").attr('required', check);
        }

        //Repository Required fields if that panel is open
        function handleRepoRequiredFields(check) {
            $("input[name=repo_namespace]").attr('required', check);
            $("input[name=repo_name]").attr('required', check);
        }

        //Events Required fields if that panel is open
        function handleEventRequiredFields(check) {
            $("input[name=event_namespace]").attr('required', check);
            $("input[name='event[]']").attr('required', check);
        }
        //For changing namespace
        // function changeNamespace(val, ns, element) {
        //     if(!val) {
        //         val = ns.replace('/\\\\/g', '');
        //     } else {
        //         val = ns + "\\" + val + "\\";
        //     }
        //     element.text(val);
        // }

        //For only characters
        $(".only-text").on('keyup', function(e) {
            var val = $(this).val();
            if (val.match(/[^a-zA-Z]/g)) {
               $(this).val(val.replace(/[^a-zA-Z]/g, ''));
            }
        });
    </script>
@endsection
