<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PDOException;
use Symfony\Component\Console\Helper\SymfonyQuestionHelper;
use Symfony\Component\Console\Question\Question;

/**
 * Class InstallAppCommand.
 *
 * @author Ruchit Patel
 */
class InstallAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installation of laravel admin panel.';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * host for the database.
     */
    protected $host;

    /**
     * port for the database.
     */
    protected $port;

    /**
     * Database name.
     */
    protected $database;

    /**
     * Username of database.
     */
    protected $username;

    /**
     * Password for the Database.
     */
    protected $password;

    /**
     * InstallAppCommand constructor.
     *
     * @param Filesystem $files
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
        $this->line('------------------');
        $this->line('Welcome to Laravel Admin Panel.');
        $this->line('------------------');
        exec('composer install'); // composer install

        $extensions = get_loaded_extensions();
        $require_extensions = ['mbstring', 'openssl', 'curl', 'exif', 'fileinfo', 'tokenizer'];
        foreach (array_diff($require_extensions, $extensions) as $missing_extension) {
            $this->error('Missing '.ucfirst($missing_extension).' extension');
        }

        if (!file_exists('.env')) {
            File::copy('.env.example', '.env');
        }

        // Set database credentials in .env and migrate
        $this->setDatabaseInfo();
        $this->line('------------------');

        //Key Generate
        Artisan::call('key:generate');
        $this->line('Key generated in .env file!');
        $this->line('------------------');

        //Cache Clear
        Artisan::call('cache:clear');
        $this->info('Application cache cleared!');
        $this->line('------------------');

        //Route Clear
        Artisan::call('route:clear');
        $this->info('Route cache cleared!');
        $this->line('------------------');

        //Config Clear
        Artisan::call('config:clear');
        $this->info('Configuration cache cleared!');
        $this->line('------------------');

        //View Clear
        Artisan::call('view:clear');
        $this->info('Compiled view cleared!');
        $this->line('------------------');

        $this->info('Now you can access the application on below url!');
        $this->line('Laravel development server started: <http://127.0.0.1:8000>');
        Artisan::call('serve');
    }

    /**
     * Set Database info in .env file.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return void
     */
    protected function setDatabaseInfo()
    {
        $this->info('Setting up database (please make sure you have created database for this site or not to worry you can dump from here)...!');

        $this->host = env('DB_HOST');
        $this->port = env('DB_PORT');
        $this->database = env('DB_DATABASE');
        $this->username = env('DB_USERNAME');
        $this->password = env('DB_PASSWORD');

        while (!checkDatabaseConnection()) {
            // Ask for database details
            $this->host = $this->ask('Enter a host name?', config('config-variables.default_db_host'));
            $this->port = $this->ask('Enter a database port?', config('config-variables.default_db_port'));
            $this->database = $this->ask('Enter a database name', $this->guessDatabaseName());

            $this->username = $this->ask('What is your MySQL username?', config('config-variables.default_db_username'));

            $question = new Question('What is your MySQL password?', '<none>');
            $question->setHidden(true)->setHiddenFallback(true);
            $this->password = (new SymfonyQuestionHelper())->ask($this->input, $this->output, $question);

            if ($this->password === '<none>') {
                $this->password = '';
            }

            // Update DB credentials in .env file.
            $contents = $this->getKeyFile();
            $contents = preg_replace('/('.preg_quote('DB_HOST=').')(.*)/', 'DB_HOST='.$this->host, $contents);
            $contents = preg_replace('/('.preg_quote('DB_PORT=').')(.*)/', 'DB_PORT='.$this->port, $contents);
            $contents = preg_replace('/('.preg_quote('DB_DATABASE=').')(.*)/', 'DB_DATABASE='.$this->database, $contents);
            $contents = preg_replace('/('.preg_quote('DB_USERNAME=').')(.*)/', 'DB_USERNAME='.$this->username, $contents);
            $contents = preg_replace('/('.preg_quote('DB_PASSWORD=').')(.*)/', 'DB_PASSWORD='.$this->password, $contents);

            if (!$contents) {
                throw new Exception('Error while writing credentials to .env file.');
            }

            // Write to .env
            $this->files->put('.env', $contents);

            // Set DB username and password in config
            $this->laravel['config']['database.connections.mysql.username'] = $this->username;
            $this->laravel['config']['database.connections.mysql.password'] = $this->password;

            // Clear DB name in config
            unset($this->laravel['config']['database.connections.mysql.database']);

            if (!checkDatabaseConnection()) {
                $this->error('Can not connect to database!');
            } else {
                $this->info('Connected successfully!');
            }
        }

        $this->createDatabase($this->database); // create database if not exists.
        $this->migrateTables($this->database); // database migration

//        if ($this->confirm('You want to dump database sql ?')) { // uncomment the code if you want to go ahead with existing database.
//            $this->dumpDB($this->database);
//        } else {
//            $this->migrateTables($this->database);
//        }
    }

    /**
     * Guess database name from app folder.
     *
     * @return string
     *
     * @author Ruchit Patel
     */
    protected function guessDatabaseName()
    {
        try {
            $segments = array_reverse(explode(DIRECTORY_SEPARATOR, app_path()));
            $name = explode('.', $segments[1])[0];

            return str_replace('-', '_', Str::slug($name));
        } catch (Exception $e) {
            return '';
        }
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return string
     *
     * @author Ruchit Patel
     */
    protected function getKeyFile()
    {
        return $this->files->exists('.env') ? $this->files->get('.env') : $this->files->get('.env.example');
    }

    /**
     * Create the Database.
     *
     * @param object $database
     */
    protected function createDatabase($database)
    {
        if (!$database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');

            return;
        }

        try {
            $query = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
            if (DB::statement($query)) {
                $this->info("Successfully created $database database");
            } else {
                $this->info('Oops, Something went wrong, please try again or create database manually!');
            }

            return;
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database, $exception->getMessage()));

            return;
        }
    }

    /**
     * Dump the DB.
     *
     * @param object $database
     */
    protected function dumpDB($database)
    {
        if (!empty($database)) {
            // Force the new login to be used
            DB::purge();

            // Switch to use {$this->database}
            DB::unprepared('USE `'.$database.'`');
            DB::connection()->setDatabaseName($database);

            $dumpDB = DB::unprepared(file_get_contents(base_path().'/database/dump/laravel_admin_panel.sql'));

            if ($dumpDB) {
                $this->info('Import default database successfully!');
            }
        }
    }

    /**
     * Migrate Tables.
     *
     * @param object $database
     */
    protected function migrateTables($database)
    {
        DB::unprepared('USE `'.$database.'`');

        Artisan::call('migrate'); // Artisan migration
        $this->info('Migration successfully done!');

        Artisan::call('db:seed'); // Artisan seed
        $this->info('Seeding successfully done!');

//        if ($this->confirm('You want to migrate tables?')) { //uncomment the code if you want to populate mandatory question to user for migration and seed.
//            // Switch to use {$this->database}
//            DB::unprepared('USE `'.$database.'`');
//            //DB::connection()->setDatabaseName($this->database);
//            Artisan::call('migrate'); // Artisan migration
//            $this->info('Migration successfully done!');
//
//            if ($this->confirm('You want to seeding your database?')) {
//                Artisan::call('db:seed'); // Artisan seed
//                $this->info('Seeding successfully done!');
//            }
//        }
    }
}
