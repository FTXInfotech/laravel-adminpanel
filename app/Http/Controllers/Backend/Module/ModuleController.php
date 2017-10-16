<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Modules\CreateModuleRequest;
use App\Http\Requests\Backend\Modules\ManageModuleRequest;
use App\Http\Requests\Backend\Modules\StoreModuleRequest;
use App\Models\Access\Permission\Permission;
use App\Models\Module\Module;
use App\Repositories\Backend\Module\ModuleRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use App\Http\Utilities\Generator;

class ModuleController extends Controller
{
    public $files;
    public $model;
    public $table;
    public $repository;
    public $directory;
    public $generator;
    public $attribute = 'Attribute';
    public $trait_directory = 'Traits';
    public $relationship = 'Relationship';
    public $route_path = 'routes\\Backend\\';
    public $event_namespace = 'app\\Events\\Backend\\';
    public $model_namespace = 'app\\Models\\';
    public $view_path = 'resources\\views\\backend\\';
    public $repo_namespace = 'app\\Repositories\\Backend\\';
    public $request_namespace = 'app\\Http\\Requests\\Backend\\';
    public $controller_namespace = 'app\\Http\\Controllers\\Backend\\';

    /**
     * Constructor.
     *
     * @param Filesystem       $files
     * @param ModuleRepository $repository
     */
    public function __construct(Filesystem $files, ModuleRepository $repository)
    {
        $this->files = $files;
        $this->repository = $repository;
        $this->generator = new Generator();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageModuleRequest $request)
    {
        return view('backend.modules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateModuleRequest $request)
    {
        return view('backend.modules.create')
            ->with('model_namespace', $this->model_namespace)
            ->with('request_namespace', $this->request_namespace)
            ->with('controller_namespace', $this->controller_namespace)
            ->with('event_namespace', $this->event_namespace)
            ->with('repo_namespace', $this->repo_namespace)
            ->with('route_path', $this->route_path)
            ->with('view_path', $this->view_path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModuleRequest $request)
    {
        $this->generator->initialize($request->all());
        $this->generator->createMigration();
        $this->generator->createModel();
        $this->generator->createRequests();
        $this->generator->createRepository();
        $this->generator->createController();
        $this->generator->createTableController();
        $this->generator->createRouteFiles();
        $this->generator->insertToLanguageFiles();
        $this->generator->createViewFiles();
        $this->generator->createEvents();
        //Creating the Module
        $this->repository->create( $request->all(), $this->generator->getPermissions() );

        return redirect()->route('admin.modules.index')->withFlashSuccess('Module Generated Successfully!');
    }

    /**
     * Creating Event Files.
     *
     * @param array $input
     */
    public function createEvents($input)
    {
        $events = array_filter($input['event']);
        if (!empty($events)) {
            $base_path = 'Backend\\';
            if (!empty($input['directory_name'])) {
                $base_path .= $this->directory;
            }
            $base_path = escapeSlashes($base_path);

            $this->checkAndCreateDir(base_path($base_path));

            foreach ($events as $event) {
                $path = escapeSlashes($base_path.DIRECTORY_SEPARATOR.$event);
                $model = str_replace(DIRECTORY_SEPARATOR, '\\', $path);

                Artisan::call('make:event', [
                    'name' => $model,
                ]);
                Artisan::call('make:listener', [
                    'name'    => $model.'Listener',
                    '--event' => $model,
                ]);
            }

            return 'Events and Listerners generated successfully';
        }
    }

    /**
     * Creating Repository File.
     *
     * @param array $input
     */
    public function createRepoFile($input)
    {
        //Directory
        $directory = $this->directory;
        //Model Namespace
        $model_namespace = ucfirst(trim(str_replace('//', '\\', $this->model_namespace), '\\'));
        //Model
        $model = $this->model;
        //Model lowercase plural
        $model_small_plural = strtolower(str_plural($model));
        //Standardizing Slashes
        $base_path = escapeSlashes($this->repo_namespace);
        //namespace
        $namespace = ucfirst($this->repo_namespace);
        //Repository Name
        $repository = str_plural($model).'Repository';
        //Creating Directory for Repository
        $this->checkAndCreateDir(base_path($base_path));
        //Appending Repository name to base_path
        $base_path = escapeSlashes($base_path.DIRECTORY_SEPARATOR.$repository);
        //Getting stub file content
        $file_contents = $this->files->get($this->getStubPath().'Repository.stub');
        //If Model Create is checked
        if (!isset($input['model_create'])) {
            $file_contents = $this->delete_all_between('@startCreate', '@endCreate', $file_contents);
        } else {//If it isn't
            $file_contents = $this->delete_all_between('@startCreate', '@startCreate', $file_contents);
            $file_contents = $this->delete_all_between('@endCreate', '@endCreate', $file_contents);
        }
        //If Model Edit is Checked
        if (!isset($input['model_edit'])) {
            $file_contents = $this->delete_all_between('@startEdit', '@endEdit', $file_contents);
        } else {//If it isn't
            $file_contents = $this->delete_all_between('@startEdit', '@startEdit', $file_contents);
            $file_contents = $this->delete_all_between('@endEdit', '@endEdit', $file_contents);
        }
        //If Model Delete is Checked
        if (!isset($input['model_delete'])) {
            $file_contents = $this->delete_all_between('@startDelete', '@endDelete', $file_contents);
        } else {//If it isn't
            $file_contents = $this->delete_all_between('@startDelete', '@startDelete', $file_contents);
            $file_contents = $this->delete_all_between('@endDelete', '@endDelete', $file_contents);
        }
        //Replacements to be done in repository stub file
        $replacements = [
                'DummyNamespace'                => $namespace,
                'DummyModelNamespace'           => $model_namespace.'\\'.$model,
                'DummyRepoName'                 => $repository,
                'dummy_model_name'              => $model,
                'dummy_small_model_name'        => strtolower($model),
                'model_small_plural'            => $model_small_plural,
                'dummy_small_plural_model_name' => str_plural(strtolower($model)),
        ];
        //Generating the repo file
        $this->generateFile(false, $replacements, $base_path, $file_contents);

        return $base_path;
    }

    /**
     * Creating View Files.
     *
     * @param array $input
     */
    public function createViewFiles($input)
    {
        //Getiing model
        $model = $this->model;
        //lowercase version of model
        $model_lower = strtolower($model);
        //lowercase and plural version of model
        $model_lower_plural = str_plural($model_lower);
        //View folder name
        $view_folder_name = $model_lower_plural;
        //View path
        $path = escapeSlashes(strtolower(str_plural($this->view_path)));
        //Header buttons folder
        $header_button_path = $path.DIRECTORY_SEPARATOR.'partials';
        //This would create both the directory name as well as partials inside of that directory
        $this->checkAndCreateDir(base_path($header_button_path));
        //Header button full path
        $header_button_file_path = $header_button_path.DIRECTORY_SEPARATOR."$model_lower_plural-header-buttons.blade";
        //Getting stub file content
        $header_button_contents = $this->files->get($this->getStubPath().'header-buttons.stub');
        if (empty($input['model_create'])) {
            $header_button_contents = $this->delete_all_between('@create', '@endCreate', $header_button_contents);
        } else {
            $header_button_contents = $this->delete_all_between('@create', '@create', $header_button_contents);
            $header_button_contents = $this->delete_all_between('@endCreate', '@endCreate', $header_button_contents);
        }
        //Generate Header buttons file
        $this->generateFile(false, ['dummy_small_plural_model' => $model_lower_plural, 'dummy_small_model' => $model_lower], $header_button_file_path, $header_button_contents);
        //Index blade
        $index_path = $path.DIRECTORY_SEPARATOR.'index.blade';
        //Generate the Index blade file
        $this->generateFile('index_view', ['dummy_small_plural_model' => $model_lower_plural], $index_path);
        //Create Blade
        if (isset($input['model_create'])) {
            //Create Blade
            $create_path = $path.DIRECTORY_SEPARATOR.'create.blade';
            //Generate Create Blade
            $this->generateFile('create_view', ['dummy_small_plural_model' => $model_lower_plural, 'dummy_small_model' => $model_lower], $create_path);
        }
        //Edit Blade
        if (isset($input['model_edit'])) {
            //Edit Blade
            $edit_path = $path.DIRECTORY_SEPARATOR.'edit.blade';
            //Generate Edit Blade
            $this->generateFile('edit_view', ['dummy_small_plural_model' => $model_lower_plural, 'dummy_small_model' => $model_lower], $edit_path);
        }
        //Form Blade
        if (isset($input['model_create']) || isset($input['model_edit'])) {
            //Form Blade
            $form_path = $path.DIRECTORY_SEPARATOR.'form.blade';
            //Generate Form Blade
            $this->generateFile('form_view', [], $form_path);
        }
        //BreadCrumbs Folder Path
        $breadcrumbs_path = escapeSlashes('app\\Http\\Breadcrumbs\\Backend');
        //Breadcrumb File path
        $breadcrumb_file_path = $breadcrumbs_path.DIRECTORY_SEPARATOR.$this->model;
        //Generate BreadCrumb File
        $this->generateFile('Breadcrumbs', ['dummy_small_plural_model' => $model_lower_plural], $breadcrumb_file_path);
        //Backend File of Breadcrumb
        $breadcrumb_backend_file = $breadcrumbs_path.DIRECTORY_SEPARATOR.'Backend.php';
        //file_contents of Backend.php
        $file_contents = file_get_contents(base_path($breadcrumb_backend_file));
        //If this is already not there, then only append
        if (!strpos($file_contents, "require __DIR__.'/$this->model.php';")) {
            //Appending into BreadCrumb backend file
            file_put_contents(base_path($breadcrumb_backend_file), "\nrequire __DIR__.'/$this->model.php';", FILE_APPEND);
        }
    }

    /**
     * Creating Route File.
     *
     * @param array $input
     */
    public function createRouteFiles($controller_path, $table_controller_name, $input)
    {
        //Model Name
        $model = $this->model;
        //Base Path for the routes
        $base_path = $this->route_path;
        //Creating Directory for the Route if not already present
        $this->checkAndCreateDir(base_path(escapeSlashes($base_path)));
        //Route name to use
        $route_name = strtolower(str_plural($model));
        //Controller Full Path
        $full_path = str_replace(DIRECTORY_SEPARATOR, '\\', $controller_path);
        //Model name lower case
        $argument = strtolower($model);
        //Controller Name
        $controller = class_basename($full_path);
        //Full Path after removing Controller name
        $full_path = trim(str_replace($controller, '', $full_path), '\\');
        //Directory in which the controller is made
        $controller_directory = $this->directory;
        //full path with file name of the route file to be generated
        $base_path .= DIRECTORY_SEPARATOR.$model;
        //If all the checkboxes of operations are selected
        if (isset($input['model_create']) && isset($input['model_edit']) && isset($input['model_delete'])) {//Then get the resourceRoute stub
            //Getting stub file content
            $file_contents = $this->files->get($this->getStubPath().'resourceRoute.stub');
            $file_contents = $this->delete_all_between('@startNamespace', '@startNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@endNamespace', '@endNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startWithoutNamespace', '@endWithoutNamespace', $file_contents);
        } else {//Get the basic route stub
            //Getting stub file content
            $file_contents = $this->files->get($this->getStubPath().'route.stub');
            $file_contents = $this->delete_all_between('@startNamespace', '@startNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@endNamespace', '@endNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startWithoutNamespace', '@endWithoutNamespace', $file_contents);
            //If create is checked
            if (isset($input['model_create'])) {
                $file_contents = $this->delete_all_between('@startCreate', '@startCreate', $file_contents);
                $file_contents = $this->delete_all_between('@endCreate', '@endCreate', $file_contents);
            } else {//If it isn't
                $file_contents = $this->delete_all_between('@startCreate', '@endCreate', $file_contents);
            }
            //If Edit is checked
            if (isset($input['model_edit'])) {
                $file_contents = $this->delete_all_between('@startEdit', '@startEdit', $file_contents);
                $file_contents = $this->delete_all_between('@endEdit', '@endEdit', $file_contents);
            } else {//if it isn't
                $file_contents = $this->delete_all_between('@startEdit', '@endEdit', $file_contents);
            }
            //If delete is checked
            if (isset($input['model_delete'])) {
                $file_contents = $this->delete_all_between('@startDelete', '@startDelete', $file_contents);
                $file_contents = $this->delete_all_between('@endDelete', '@endDelete', $file_contents);
            } else {//If it isn't
                $file_contents = $this->delete_all_between('@startDelete', '@endDelete', $file_contents);
            }
        }
        //Generate the Route file
        $this->generateFile(false, [
            'DummyModuleName'      => $input['name'],
            'DummyModel'           => $controller_directory,
            'dummy_name'           => $route_name,
            'DummyController'      => $controller,
            'DummyTableController' => $table_controller_name,
            'dummy_argument_name'  => $argument,
        ], $base_path, $file_contents);
    }

    /**
     * Creating Table File.
     *
     * @param array $input
     */
    public function createMigration($input)
    {
        $table = $this->table;

        if (Schema::hasTable($table)) {
            return 'Table Already Exists!';
        } else {
            //Calling Artisan command to create table
            Artisan::call('make:migration', [
                'name'      => 'create_'.$table.'_table',
                '--create'  => $table,
            ]);

            return Artisan::output();
        }
    }

    /**
     * Creating Model File.
     *
     * @param array $input
     */
    public function createModel($input)
    {
        $base_path = $this->model_namespace;
        //Standardizing the slashes
        $base_path = escapeSlashes($base_path);
        //namespace
        $namespace = trim(str_replace(DIRECTORY_SEPARATOR, '\\', $base_path), '\\');
        //trait path
        $trait_path = escapeSlashes($namespace.DIRECTORY_SEPARATOR.$this->trait_directory);
        //Creating Directory if isn't already
        $this->checkAndCreateDir(base_path($base_path));
        $this->checkAndCreateDir(base_path($trait_path));
        //Making app to App in namespace and trait_path
        $namespace = ucfirst($namespace);
        $trait_path = ucfirst($trait_path);
        //model name
        $model = $this->model;
        //base path of the file to be generated
        $base_path = escapeSlashes($base_path.DIRECTORY_SEPARATOR.$model);
        //If files are already present and override checkbox was checked
        if ((!empty($input['override'])) && file_exists(base_path($base_path.'.php'))) {
            return;
        }
        //Attribute File Name
        $attribute_name = str_plural($model).$this->attribute;
        //Relationship File Name
        $relationship_name = str_plural($model).$this->relationship;
        //Namespace of the Traits Directory
        $trait_namespace = ucfirst(trim(str_replace(DIRECTORY_SEPARATOR, '\\', $trait_path), '\\'));
        //App to app
        $trait_path = lcfirst($trait_path);
        //Get the Directory
        $attribute = str_replace(DIRECTORY_SEPARATOR, '\\', $trait_path.DIRECTORY_SEPARATOR.$attribute_name);
        $relationship = str_replace(DIRECTORY_SEPARATOR, '\\', $trait_path.DIRECTORY_SEPARATOR.$relationship_name);

        //Generate Attribute File
        $this->generateFile('Attribute', [
            'AttributeNamespace' => $trait_namespace,
            'AttributeClass'     => $attribute_name,
        ], $attribute);
        //Generate Relationship File
        $this->generateFile('Relationship', [
            'RelationshipNamespace' => $trait_namespace,
            'RelationshipClass'     => $relationship_name,
        ], $relationship);
        //Generate Model File
        $this->generateFile('Model', [
            'DummyNamespace'    => $namespace,
            'DummyAttribute'    => ucfirst($attribute),
            'DummyRelationship' => ucfirst($relationship),
            'AttributeName'     => $attribute_name,
            'RelationshipName'  => $relationship_name,
            'DummyModel'        => $model,
            'table_name'        => $this->table,
        ], $base_path);

        return $base_path;
    }

    /**
     * Generating the file by
     * replacing placeholders in stub file.
     *
     * @param $stub_name Name of the Stub File
     * @param $replacements [array] Array of the replacement to be done in stub file
     * @param $file [string] full path of the file
     * @param $contents [string][optional] file contents
     */
    public function generateFile($stub_name, $replacements, $file, $contents = null)
    {
        if ($stub_name) {
            //Getting the Stub Files Content
            $file_contents = $this->files->get($this->getStubPath().$stub_name.'.stub');
        } else {
            //Getting the Stub Files Content
            $file_contents = $contents;
        }
        //Replacing the stub
        $file_contents = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $file_contents
        );
        $this->files->put(base_path(escapeSlashes($file)).'.php', $file_contents);
    }

    /**
     * getting the stub folder path.
     *
     * @return string
     */
    public function getStubPath()
    {
        return app_path('Console'.DIRECTORY_SEPARATOR.'Commands'.DIRECTORY_SEPARATOR.'Stubs'.DIRECTORY_SEPARATOR);
    }

    /**
     * Creating Controller.
     *
     * @param array $input
     */
    public function createController($input, $model_path)
    {
        $base_path = $this->controller_namespace;
        //Standardizing the slashes
        $base_path = escapeSlashes($base_path);
        //namespace
        $namespace = trim(str_replace(DIRECTORY_SEPARATOR, '\\', $base_path), DIRECTORY_SEPARATOR);
        //Creating Directory if isn't already
        $this->checkAndCreateDir(base_path($base_path));
        //Making app to App in namespace and trait_path
        $namespace = ucfirst($namespace);
        //controller_name
        $controller = str_plural($this->model).'Controller';
        //base path of the file to be generated
        $contents = $this->modifyControllerContents($input, $base_path, $model_path);
        //contents of controller stub
        $file_contents = $contents['contents'];
        //Manage Request base path
        $manage_request_base_path = $contents['manage_request'];
        //Appending Controller Name to Base path
        $base_path = escapeSlashes($base_path.DIRECTORY_SEPARATOR.$controller);
        //Create the Repository
        $repo_base_path = $this->createRepoFile($input);
        $repo_namespace = ucfirst(trim(str_replace(DIRECTORY_SEPARATOR, '\\', $repo_base_path)));

        //Generating Controller File
        $this->generateFile(false, [
            'DummyController'          => $controller,
            'DummyNamespace'           => $namespace,
            'DummyRepositoryNamespace' => $repo_namespace,
            'dummy_repository'         => class_basename($repo_base_path),
            'dummy_small_plural_model' => strtolower(str_plural($this->model)),

        ], $base_path, $file_contents);
        //Create Table Controller
        $table_controller_name = $this->createTableController($input, $repo_base_path, $manage_request_base_path);
        //Create the route file
        $this->createRouteFiles($base_path, $table_controller_name, $input);
        //Insert To Language Files
        $this->insertToLanguageFiles($input);
        //Create View Files
        $this->createViewFiles($input);
    }

    /**
     * This would enter the necessary language file contents to respective language files.
     *
     * @param [array] $input
     */
    public function insertToLanguageFiles($input)
    {
        //Getting Model Name
        $model = $this->model;
        //Model singular version
        $model_singular = ucfirst(str_singular($model));
        //Model Plural version
        $model_plural = strtolower(str_plural($model));
        //Model plural with capitalize
        $model_plural_capital = ucfirst($model_plural);
        //Findind which locale is being used
        $locale = config('app.locale');
        //Path to that language files
        $path = resource_path('lang'.DIRECTORY_SEPARATOR.$locale);
        //config folder path
        $config_path = config_path('module.php');
        //Creating directory if it isn't
        $path = $this->checkAndCreateDir($path);
        //Labels file
        $labels = [
            'create'        => "Create $model_singular",
            'edit'          => "Edit $model_singular",
            'management'    => "$model_singular Management",
            'title'         => "$model_plural_capital",

            'table'         => [
                'id'             => 'Id',
                'createdat'      => 'Created At',
            ],
        ];
        //Pushing values to labels
        add_key_value_in_file($path.'/labels.php', [$model_plural => $labels], 'backend');
        //Menus file
        $menus = [
            'all'        => "All $model_plural_capital",
            'create'     => "Create $model_singular",
            'edit'       => "Edit $model_singular",
            'management' => "$model_singular Management",
            'main'       => "$model_plural_capital",
        ];
        //Pushing to menus file
        add_key_value_in_file($path.'/menus.php', [$model_plural => $menus], 'backend');
        //Exceptions file
        $exceptions = [
            'already_exists'    => "That $model_singular already exists. Please choose a different name.",
            'create_error'      => "There was a problem creating this $model_singular. Please try again.",
            'delete_error'      => "There was a problem deleting this $model_singular. Please try again.",
            'not_found'         => "That $model_singular does not exist.",
            'update_error'      => "There was a problem updating this $model_singular. Please try again.",
        ];
        //Alerts File
        $alerts = [
            'created' => "The $model_singular was successfully created.",
            'deleted' => "The $model_singular was successfully deleted.",
            'updated' => "The $model_singular was successfully updated.",
        ];
        //Pushing to menus file
        add_key_value_in_file($path.'/alerts.php', [$model_plural => $alerts], 'backend');
        //Pushing to exceptions file
        add_key_value_in_file($path.'/exceptions.php', [$model_plural => $exceptions], 'backend');
        //config file "module.php"
        $config = [
            $model_plural => [
                'table' => $this->table,
            ],
        ];
        //Pushing to config file
        add_key_value_in_file($config_path, $config);
    }

    /**
     * For Creating Table Controller.
     *
     * @param array  $input
     * @param string $repo_base_path
     * @param string $manage_request_base_path
     */
    public function createTableController($input, $repo_base_path, $manage_request_base_path)
    {
        //Repository namespace
        $repo_namespace = ucfirst($this->repo_namespace);
        //Request namespace
        $request_namespace = ucfirst($this->request_namespace);
        //base path
        $base_path = $this->controller_namespace;
        //Standardizing the slashes
        $base_path = escapeSlashes($base_path);
        //namespace
        $namespace = trim(str_replace(DIRECTORY_SEPARATOR, '\\', $base_path), '\\');
        //Creating Directory if isn't already
        $this->checkAndCreateDir(base_path($base_path));
        //Making app to App in namespace and trait_path
        $namespace = ucfirst($namespace);
        //Model Name
        $model = $this->model;
        //controller_name
        $controller = str_plural($model).'TableController';
        //Adding Controller name to base path
        $base_path .= DIRECTORY_SEPARATOR.$controller;
        //replacements to be done in table controller stub
        $replacements = [
            'DummyNamespace'                => $namespace,
            'DummyRepositoryNamespace'      => $repo_namespace.'\\'.class_basename($repo_base_path),
            'DummyManageRequestNamespace'   => $request_namespace.'\\'.class_basename($manage_request_base_path),
            'DummyTableController'          => $controller,
            'dummy_repository'              => class_basename($repo_base_path),
            'dummy_small_repo_name'         => strtolower($model),
            'dummy_manage_request_name'     => class_basename($manage_request_base_path),
        ];
        //generating the file
        $this->generateFile('TableController', $replacements, $base_path);

        return $controller;
    }

    /**
     * For Modifying controller stub content.
     *
     * @param array  $input
     * @param string $controller_path
     *
     * @return [type]
     */
    public function modifyControllerContents($input, $controller_path, $model_path)
    {
        //Getting stub file content
        $file_contents = $this->files->get($this->getStubPath().'Controller.stub');
        //Getting Model name
        $model = $this->model;
        //Making namespace by removing model from last of $model_path
        $model_namespace = $this->model_namespace;
        //requests file path
        $request_path = $this->request_namespace;
        //Creating Directory (if not exists, already)
        $this->checkAndCreateDir(base_path(escapeSlashes($request_path)));
        //request files namespaces
        $request_namespace = ucfirst($request_path);
        //manage request file name
        $manage_request_name = 'Manage'.str_plural($model).'Request';
        //base path of the manage request file
        $manage_request_base_path = $request_path.'\\'.$manage_request_name;
        //Replacements to be done in controller stub
        $replacements = [
            'DummyModelNamespace'         => $model_namespace,
            'DummyModel'                  => $model,
            'DummyArgumentName'           => strtolower($model),
            'DummyManageRequestNamespace' => $request_namespace.'\\'.$manage_request_name,
            'DummyManageRequest'          => $manage_request_name,
        ];
        //Generate Manage Request File
        $this->generateFile('Request', ['DummyNamespace' => $request_namespace, 'DummyClass' => $manage_request_name, 'permission' => strtolower('view-'.$model)], $manage_request_base_path);
        $namespaces = '';
        //If create option is not checked in form
        if (!isset($input['model_create'])) {
            //Delete everything between delimeters @startCreate and @endCreate
            // $file_contents = $this->delete_all_between('@startCreateNamespace', '@endCreateNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startCreate', '@endCreate', $file_contents);
        } else {//If it is checked
            //Remove the delimiters(@startCreate and @endCreate) above methods
            // $file_contents = $this->delete_all_between('@startCreateNamespace', '@startCreateNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@endCreateNamespace', '@endCreateNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startCreate', '@startCreate', $file_contents);
            $file_contents = $this->delete_all_between('@endCreate', '@endCreate', $file_contents);
            //Create Request Name
            $create_request_name = 'Create'.str_plural($model).'Request';
            //Create Request Base Path
            $create_request_base_path = $request_path.'\\'.$create_request_name;
            //Store Request Name
            $store_request_name = 'Store'.str_plural($model).'Request';
            //Store Request Base Path
            $store_request_base_path = $request_path.'\\'.$store_request_name;

            //Generate CreateRequest File
            $this->generateFile('Request', ['DummyNamespace' => $request_namespace, 'DummyClass' => $create_request_name, 'permission' => strtolower('create-'.$model)], $create_request_base_path);

            //Generate Store Request File
            $this->generateFile('Request', ['DummyNamespace' => $request_namespace, 'DummyClass' => $store_request_name, 'permission' => strtolower('store-'.$model)], $store_request_base_path);

            $namespaces .= 'use '.$request_namespace.'\\'.$create_request_name.";\n";
            $namespaces .= 'use '.$request_namespace.'\\'.$store_request_name.";\n";
            //replacements
            $replacements['DummyCreateRequest'] = $create_request_name;
            $replacements['DummyStoreRequest'] = $store_request_name;
        }
        //If edit option is not checked in model form
        if (!isset($input['model_edit'])) {
            //Delete everything between delimeters @startEdit and @endEdit
            // $file_contents = $this->delete_all_between('@startEditNamespace', '@endEditNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startEdit', '@endEdit', $file_contents);
        } else {//If it is checked
            //Remove the delimiters(@startEdit and @endEdit) above methods
            $file_contents = $this->delete_all_between('@startEditNamespace', '@startEditNamespace', $file_contents);
            // $file_contents = $this->delete_all_between('@endEditNamespace', '@endEditNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startEdit', '@startEdit', $file_contents);
            $file_contents = $this->delete_all_between('@endEdit', '@endEdit', $file_contents);

            //Edit Request Name
            $edit_request_name = 'Edit'.str_plural($model).'Request';
            //Edit Request Base Path
            $edit_request_base_path = $request_path.'\\'.$edit_request_name;
            //Update Request Name
            $update_request_name = 'Update'.str_plural($model).'Request';
            //Update Request Base Path
            $update_request_base_path = $request_path.'\\'.$update_request_name;

            //Generate Edit Request File
            $this->generateFile('Request', ['DummyNamespace' => $request_namespace, 'DummyClass' => $edit_request_name, 'permission' => strtolower('edit-'.$model)], $edit_request_base_path);

            //Generate Update Request File
            $this->generateFile('Request', ['DummyNamespace' => $request_namespace, 'DummyClass' => $update_request_name, 'permission' => strtolower('update-'.$model)], $update_request_base_path);

            $namespaces .= 'use '.$request_namespace.'\\'.$edit_request_name.";\n";
            $namespaces .= 'use '.$request_namespace.'\\'.$update_request_name.";\n";
            //replacements
            $replacements['DummyEditRequest'] = $edit_request_name;
            $replacements['DummyUpdateRequest'] = $update_request_name;
        }
        //If delete option is not checked in model form
        if (!isset($input['model_delete'])) {
            //Delete everything between delimeters @startDelete and @endDelete
            // $file_contents = $this->delete_all_between('@startDeleteNamespace', '@endDeleteNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startDelete', '@endDelete', $file_contents);
        } else {//If it is checked
            //Remove the delimiters(@startDelete and @endDelete) above methods
            // $file_contents = $this->delete_all_between('@startDeleteNamespace', '@startDeleteNamespace', $file_contents);
            // $file_contents = $this->delete_all_between('@endDeleteNamespace', '@endDeleteNamespace', $file_contents);
            $file_contents = $this->delete_all_between('@startDelete', '@startDelete', $file_contents);
            $file_contents = $this->delete_all_between('@endDelete', '@endDelete', $file_contents);

            //Delete Request Name
            $delete_request_name = 'Delete'.str_plural($model).'Request';
            //Delete Request Base Path
            $delete_request_base_path = $request_path.'\\'.$delete_request_name;
            //Generate Delete Request File
            $this->generateFile('Request', ['DummyNamespace' => $request_namespace, 'DummyClass' => $delete_request_name, 'permission' => strtolower('update-'.$model)], $delete_request_base_path);
            $namespaces .= 'use '.$request_namespace.'\\'.$delete_request_name.";\n";
            //replacements
            $replacements['DummyDeleteRequest'] = $delete_request_name;
        }

        //replacing placeholders with actual values from $file_contents
        $file_contents = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $file_contents
        );
        //Putting Namespaces in Controller
        $file_contents = str_replace('@Namespaces', $namespaces, $file_contents);

        return ['contents' => $file_contents, 'manage_request' => $manage_request_base_path];
    }

    /**
     * Modify strings by removing content between $beginning and $end.
     *
     * @param string $beginning
     * @param string $end
     * @param string $string
     *
     * @return string
     */
    public function delete_all_between($beginning, $end, $string)
    {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
            return $string;
        }

        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

        return str_replace($textToDelete, '', $string);
    }

    /**
     * Checking the path for a file if exists.
     *
     * @param Request $request
     */
    public function checkNamespace(Request $request)
    {
        if (isset($request->path)) {
            $path = $this->parseModel($request->path);
            $path = base_path(trim(str_replace('\\', '/', $request->path)), '\\');
            $path = str_replace('App', 'app', $path);
            if (file_exists($path.'.php')) {
                return response()->json((object) [
                    'type'    => 'error',
                    'message' => 'File exists Already',
                ]);
            } else {
                return response()->json((object) [
                    'type'    => 'success',
                    'message' => 'File can be generated at this location',
                ]);
            }
        } else {
            return response()->json((object) [
                'type'    => 'error',
                'message' => 'Please provide some value',
            ]);
        }
    }

    /**
     * Checking if the table exists.
     *
     * @param Request $request
     */
    public function checkTable(Request $request)
    {
        if ($request->table) {
            if (Schema::hasTable($request->table)) {
                return response()->json((object) [
                    'type'    => 'error',
                    'message' => 'Table exists Already',
                ]);
            } else {
                return response()->json((object) [
                    'type'    => 'success',
                    'message' => 'Table Name Available',
                ]);
            }
        } else {
            return response()->json((object) [
                'type'    => 'error',
                'message' => 'Please provide some value',
            ]);
        }
    }

    /**
     * Checking if the table exists.
     *
     * @param Request $request
     */
    public function checkRoute(Request $request)
    {
        if ($request->table) {
            if (Schema::hasTable($request->table)) {
                return response()->json((object) [
                    'type'    => 'error',
                    'message' => 'Table exists Already',
                ]);
            } else {
                return response()->json((object) [
                    'type'    => 'success',
                    'message' => 'Table Name Available',
                ]);
            }
        } else {
            return response()->json((object) [
                'type'    => 'error',
                'message' => 'Please provide some value',
            ]);
        }
    }

    /**
     * Creating Directory.
     *
     * @param string $model
     *
     * @return string
     */
    public function checkAndCreateDir($path)
    {
        if (is_dir($path)) {
            return $path;
        }
        mkdir($path, 0777, true);

        return $path;
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param string $model
     *
     * @return string
     */
    public function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        return $model;
    }

    public function checkPermission(ManageModuleRequest $request)
    {
        $permission = $request->permission;

        if ($permission) {
            $per = Permission::where('name', $permission)->first();

            if ($per) {
                return response()->json((object) [
                    'type'    => 'success',
                    'message' => 'Permission Exists',
                ]);
            } else {
                return response()->json((object) [
                    'type'    => 'error',
                    'message' => 'Permission does not exists',
                ]);
            }
        } else {
            return response()->json((object) [
                'type'    => 'error',
                'message' => 'Please provide some value',
            ]);
        }
    }
}
