<div class="box-body">
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="alert alert-warning">
                Note : You need to have 0777 permission to all folders of the project.
            </div>
        </div>
    </div>
    <!-- Module Name -->
    <div class="form-group">
        {{ Form::label('name', trans('generator::labels.modules.form.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog', 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div>

    <!-- Directory -->
    <div class="form-group">
        {{ Form::label('directory_name', trans('generator::labels.modules.form.directory_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('directory_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog', 'required' => true]) }}
        </div><!--col-lg-10-->
    </div>
    <!-- End Directory -->

    <!-- Model Name -->
    <div class="form-group">
        {{ Form::label('model_name', trans('generator::labels.modules.form.model_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('model_name', null, ['class' => 'form-control box-size only-text', 'placeholder' => 'e.g., Blog', 'required' => true]) }}
            <div class="model-messages"></div>
        </div>
    </div>
    <!-- End Model Name -->

    <!-- Table Name -->
    <div class="form-group">
        {{ Form::label('table_name', trans('generator::labels.modules.form.table_name'), ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('table_name', null, ['class' => 'form-control box-size', 'placeholder' => 'e.g., Blog']) }}
            <div class="table-messages"></div>
        </div><!--col-lg-10-->
    </div>
    <!-- End Table Name -->

    <!-- Crud Operations Create/Edit/Delete to be added to the field (Read operation is given by default)-->
    <div class="form-group">
        {{ Form::label('operations', 'CRUD Operations', ['class' => 'col-lg-2 control-label']) }}
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
    <div class="box-header text-center">
        <hr width=60%/>
        <h3 class="box-title"> Optional </h3>
        <hr width=60%/>
    </div><!-- /.box-header -->
    <!-- Events --> 
    <div class="events-div">
        <div class="form-group event clearfix">
            {{ Form::label('event[]', trans('generator::labels.modules.form.event'), ['class' => 'col-lg-2 control-label']) }}

            <div class="col-lg-6">
                {{ Form::text('event[]', null, ['class' => 'form-control box-size', 'placeholder' => trans('generator::labels.modules.form.event'), 'style' => 'width:100%']) }}
            </div><!--col-lg-10-->
            <a href="#" class="btn btn-danger btn-md remove-field hidden">Remove Event</a>
            <a href="#" class="btn btn-primary btn-md add-field">Add Event</a>
        </div><!--form control-->
    </div>

    <div class="el-messages">
    </div>
    <!-- End Events -->

    <!-- To Show the generated File -->
    <div class="box-body">
        <!--All Files -->
        <div class="form-group">
            <label class="col-lg-2 control-label">Files To Be Generated</label>
            <div class="col-lg-10">
                <textarea class="form-control box-size files" contenteditable="true" rows=15 readonly="">
                </textarea>
            </div>
        </div>
        <!-- All Files -->
    </div>
    <!-- End The File Generated Textbox -->

    <!-- Override CheckBox -->
    <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <p><strong>Note : </strong> The Files would be overwritten, if already exists. Please look at files (and their respective paths) carefully before creating.</p>
        </div><!--form control-->
    </div>
    <!-- end Override Checkbox -->
</div>
@section("after-scripts")
    {!! Html::script('js/backend/pluralize.js') !!}
    <script type="text/javascript">
        //When the DOM is ready to be manipulated
        $(document).ready(function(){
            model_ns = {!! json_encode($model_namespace) !!};
            controller_ns = {!! json_encode($controller_namespace) !!};
            event_ns = {!! json_encode($event_namespace) !!};
            request_ns = {!! json_encode($request_namespace) !!};
            repo_ns = {!! json_encode($repo_namespace) !!};
            route_path = {!! json_encode($route_path) !!};
            view_path = {!! json_encode($view_path) !!};

            //If any errors occured
            handleAllCheckboxes();
            //events and listeners checkbox change event
            $("input[name=el]").on('change', function(e){
                handleCheckBox($(this), $(".el"));
            });
            //Add field in event panel
            $(document).on('click', ".add-field", function(e){
                e.preventDefault();
                clone = $(".event").first().clone();
                clone.find(".remove-field").removeClass('hidden');
                clone.appendTo(".events-div");
            });
            //remove field in event panel
            $(document).on('click', ".remove-field", function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            });
            //model name on blur event
            $(document).on('blur', "input[name=model_name]", function(e){
                getFilesGenerated();
                table = pluralize($(this).val());
                $("input[name=table_name]").val(table.toLowerCase());
            });
            //Directory name blur event
            $(document).on('blur', "input[name=directory_name]", function(e){
                getFilesGenerated();
            });
            //Model Create Checkbox change event
            $(document).on('change', "input[name=model_create]", function(e){
                getFilesGenerated();
            });
            //Model Edit Checkbox change event
            $(document).on('change', "input[name=model_edit]", function(e){
                getFilesGenerated();
            });
            //Model Delete Checkbox change event
            $(document).on('change', "input[name=model_delete]", function(e){
                getFilesGenerated();
            });
            //table name on blur event
            $(document).on('blur', "input[name=table_name]", function(e){
                checkTableExists($(this));
            });
            //Events Change Event
            $(document).on('change', "input[name='event[]']", function(e){
                getFilesGenerated();
            });
        });

        function checkModelExists(model) {
            if(model.val()) {
                path = getPath( model_ns, $("input[name=model_namespace]").val(), model.val());
                checkPath(path, 'model');
            } else {
                throwMessages('error', 'Please provide some input.', "model");
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
        function getFilesGenerated() {
            model = $("input[name=model_name]").val();
            if(model) {
                separator = "" ;
                if(dir = $("input[name=directory_name]").val()) {
                    model_nspace = model_ns + dir;
                    controller_nspace = controller_ns + dir;
                    request_nspace = request_ns + dir;
                    repo_nspace = repo_ns + dir;
                    event_nspace = event_ns + dir;
                    views_path = view_path + pluralize(dir.toLowerCase());
                    separator = "\\";
                }
                else {
                    model_nspace = model_ns;
                    controller_nspace = controller_ns;
                    request_nspace = request_ns;
                    repo_nspace = repo_ns;
                    event_nspace = event_ns;
                    views_path = view_path;
                }
                list_nspace = event_nspace.replace("Events", "Listeners");
                directory_separator = "\\";
                files = [];
                model_plural = pluralize(model);
                files.push(model_nspace + separator + model + ".php\n");
                files.push(model_nspace + separator + "Traits" + directory_separator + model_plural + "Attribute.php\n");
                files.push(model_nspace + separator + "Traits" + directory_separator + model_plural + "Relationship.php\n");
                files.push("\n" + controller_nspace + separator +model_plural + "Controller.php\n");
                files.push(controller_nspace + separator +model_plural + "TableController.php\n");
                create = $("input[name=model_create]").prop('checked');
                edit = $("input[name=model_edit]").prop('checked');
                del = $("input[name=model_delete]").prop('checked');
                files.push("\n");
                if(create) {
                    files.push(request_nspace + separator + "Create" + model_plural + "Request.php\n");
                    files.push(request_nspace + separator + "Store" + model_plural + "Request.php\n");
                }
                if(edit) {
                    files.push(request_nspace + separator + "Edit" + model_plural + "Request.php\n");
                    files.push(request_nspace + separator + "Update" + model_plural + "Request.php\n");
                }
                if(del) {
                    files.push(request_nspace + separator + "Delete" + model_plural + "Request.php\n");
                }
                files.push("\n" + views_path + separator + "index.blade.php\n");
                if(create) {
                    files.push(views_path + separator + "create.blade.php\n");
                }
                if(edit) {
                    files.push(views_path + separator + "edit.blade.php\n");
                }
                if(create || edit) {
                    files.push(views_path + separator + "form.blade.php\n");
                }
                files.push("\n");
                files.push(route_path + model + ".php\n");
                files.push("\n");
                files.push(repo_nspace + separator + model_plural + "Repository.php\n");
                files.push("\n");
                $(document).find('input[name="event[]"]').each(function(){
                    if(e = $(this).val()) {
                        files.push(event_nspace + separator + e + ".php\n");
                        files.push(list_nspace + separator + e + "Listener.php\n");
                    }
                });
                files = files.toString().replace (/,/g, "");
                $(".files").val(files);
            }
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
            if($("."+checkbox.attr('name')+"-messages").children().length == 0) {
                $("."+checkbox.attr('name')+"-messages").empty();
            }
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
        $( document ).on('keyup', ".only-text", function(e) {
            var val = $(this).val();
            if (val.match(/[^a-zA-Z]/g)) {
               $(this).val(val.replace(/[^a-zA-Z]/g, ''));
            }
        });
    </script>
@endsection
