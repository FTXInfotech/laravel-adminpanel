<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\DetectsApplicationNamespace;

class ModuleGenerator extends Command
{
    use DetectsApplicationNamespace;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "generate:module {--model= : Model Name} {--controller= : Name of the controller} {--t= : If table Controller should be made} {--res : If the controller should be resourceful} {--table= : Name of the table} {--routes= : Route Name} {--route_controller= : Route Controller} {--views= : If the views should be made} {--el= : If events and listeners should be made} {--repo= : If Repository should be made}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It creates module\'s basic scaffolding like (Controllers, Model, Migration, Routes and Views)';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Making model
        if( $this->option('model') ) {
            $model = $this->parseModel($this->option('model'));
            $a = Artisan::call("make:model", ["name" => $model]);
            $this->line(Artisan::output());
        }
        
        //Making Controller
        if( $this->option( 'controller' ) ) {
            $controller = $this->parseModel($this->option('controller'));
            Artisan::call("make:controller", ["name" => $controller, '--resource' => $this->option('res')]);
            $this->line(Artisan::output());
            //Making Table Controller
            if( $this->option( 't' ) ) {
                $tableController = $this->parseModel($this->option('t'));
                Artisan::call("make:controller", ["name" => $tableController]);
                $this->line("Table ".Artisan::output());
            }
        }

        //Making Migration
        if( $table = $this->option( 'table' ) ) {
            Artisan::call("make:migration", [
                "name" => 'create_'.$table.'_table',
                "--create" => $table
            ]);
            $this->line(Artisan::output());
        }

        //Making Events and Listeners
        if( $this->option( 'el' ) ) {

            $el = explode(',', $this->option( 'el' ) );
            
            foreach($el as $e) {
                
                $event = $this->parseModel($e);

                Artisan::call('make:event', [
                    'name' => $event
                ]);
                $this->line(Artisan::output());
                Artisan::call('make:listener', [
                    'name' => $event.'Listener',
                    '--event' => $event
                ]);
                $this->line(Artisan::output());
            }
        }

        //Creating Routes
        if( ( $route_name = $this->option( 'routes' ) ) && $this->option( 'route_controller' ) ) {
            $base_path = base_path('routes/Backend');
            $controller = class_basename( $this->option( 'controller' ) );

            if( $this->option( 'model' ) ) {
                $filename = class_basename( $this->option( 'model' ) );
            } else {
                $filename = ucfirst($route_name);
            }

            $this->checkAndCreateDir($base_path);
            $file_content = $this->files->get( $this->getStub( $this->option( 'res' ) ? 'resource' : false ) );
            
            $file_content = str_replace(
                ['dummy_name', 'DummyModel', 'DummyController'],
                [$route_name, $filename, $controller],
                $file_content
            );
            $this->files->put( $base_path.'/'.$filename.'.php', $file_content);
            $this->line("Route File generated Successfully");
        }

        //Creating Views
        if( $this->option( 'views' ) ) {
            $view_folder_name = strtolower( $this->option( 'views' ) );
            $base_path = resource_path('views/backend');
            $path = $base_path.'/'.$view_folder_name;
            $this->checkAndCreateDir($path);
            $this->createViewFiles($path);
            $this->line("View Files generated successfully");
        }

        //Creating Repository
        if( $repo = $this->option( 'repo' ) ) {
            $class_name = class_basename($repo);
            $repo = str_replace($class_name, '', $repo);
            $base_path = base_path('app/Repositories/'.$repo);
            $this->checkAndCreateDir($base_path);
            $this->createRepoFile($repo, $class_name);
            $this->line("Repository generated successfully"); 
        }
    }

    /**
     * Creating REpository File
     * 
     * @param  string $path
     * @param  string $class
     * @return none
    */
    public function createRepoFile($path, $class)
    {
        $rootNamespace = $this->laravel->getNamespace().'Repositories\\';
        $newPath = str_replace( '/', '\\', $path );
        $namespace = trim( str_replace( '/', '\\', $rootNamespace.$newPath ), '\\' );
        $file_contents = $this->files->get( __DIR__.'/Stubs/repository.stub' );
        $file_contents = str_replace(
            [ 'DummyNamespace', 'DummyClass' ],
            [ $namespace, $class ],
            $file_contents
        );
        $path = base_path( 'app/Repositories/'.$path.'/'.$class );
        $this->files->put( $path, $file_contents );
    }    

    /**
     * Creating View Files (index, create, edit, form)
     * 
     * @param  string $path
     * @return none
    */
    public function createViewFiles($path)
    {
        $files = [ "/index.blade.php", "/create.blade.php", "/edit.blade.php", "/form.blade.php" ];

        foreach($files as $file) {
            $this->files->put( $path.$file, $this->files->get( $this->getStub( false, true ) ) );
        }
    }

    /**
     * Return Stub
     * 
     * @param  boolean  $res
     * @return file
    */
    public function getStub($res = false, $view = false)
    {
        if($view) {
            return __DIR__.'/Stubs/view.stub';
        } else {
            if( $res && $res == 'resource') {
                return __DIR__.'/Stubs/resourceRoute.stub';
            } else {
                return __DIR__.'/Stubs/route.stub';
            }
        }
    }

    /**
     * Creating Directory
     *
     * @param  string  $model
     * @return string
    */
    public function checkAndCreateDir($path)
    {
        if(is_dir($path))
        {
            return $path;
        }

        mkdir($path, 0777, true);

        return $path;
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        return $model;
    }
}
