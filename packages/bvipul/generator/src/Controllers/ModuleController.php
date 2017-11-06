<?php

namespace Bvipul\Generator\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\Permission\Permission;
use Bvipul\Generator\Repositories\ModuleRepository;

/**
 * Class ModuleController.
 *
 * @author Vipul Basapati <basapativipulkumar@gmail.com | https://github.com/bvipul>
 */
class ModuleController extends Controller
{
    public $repository;
    public $generator;
    public $event_namespace = 'app\\Events\\Backend\\';

    /**
     * Constructor.
     *
     * @param ModuleRepository $repository
     */
    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
        $this->generator = new Generator();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('generator::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('generator::create')
            ->with('model_namespace', $this->generator->getModelNamespace())
            ->with('request_namespace', $this->generator->getRequestNamespace())
            ->with('controller_namespace', $this->generator->getControllerNamespace())
            ->with('event_namespace', $this->event_namespace)
            ->with('repo_namespace', $this->generator->getRepoNamespace())
            ->with('route_path', $this->generator->getRoutePath())
            ->with('view_path', $this->generator->getViewPath());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $this->repository->create($request->all(), $this->generator->getPermissions());

        return redirect()->route('admin.modules.index')->withFlashSuccess('Module Generated Successfully!');
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

    public function checkPermission(Request $request)
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
