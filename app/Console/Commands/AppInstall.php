<?php

namespace App\Console\Commands;

use App\User;
use App\Writer\EnvFileWriter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Welcome this is the inteview of Logicsofts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EnvFileWriter $env)
    {
        parent::__construct();
        $this->getLaravel()['env'] = 'local';
        $this->env = $env;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->alert('Hello Neha, Hope you\'re doing well.\n');
        $this->alert('Please follow the instructions below to install the application.');

        $connected = false;

        while (!$connected) {
            $host = $this->askDatabaseHost();
            $username = $this->askDatabaseUsername();
            $password = $this->askDatabasePassword();
            $database = $this->askDatabaseName();

            if ($this->databaseConnectionIsValid($host, $username, $password, $database)) {
                config(['database.connections.mysql.host' => $host]);
                config(['database.connections.mysql.username' => $username]);
                config(['database.connections.mysql.password' => $password]);
                config(['database.connections.mysql.database' => $database]);
                $connected = true;
            } else {
                $this->error('Please ensure your database credentials are valid.');
            }
        }
        if($this->confirm('Do you want to clear database? [y|N]')) {
            $this->call('migrate:fresh');

        }else{
            $this->call('migrate');
        }
        if($this->confirm('Do you want to setup intial user? [y|N]')) {
            $this->askForUser();
        }
        $this->env->write($database, $username, $password, $host);
        $this->info('Database successfully configured.');

        return 0;
    }

    /**
     * @return string
     */
    protected function askDatabaseHost()
    {
        $host = $this->ask('Enter your database host.', '127.0.0.1');

        return $host;
    }

    /**
     * @return string
     */
    protected function askDatabaseName()
    {
        $database = $this->ask('Enter your database name.', 'basicstuff');

        return $database;
    }

    /**
     * @param
     *
     * @return string
     */
    protected function askDatabaseUsername()
    {
        $username = $this->ask('Enter your database username.', 'root');

        return $username;
    }

    /**
     * @param
     *
     * @return string
     */
    protected function askDatabasePassword()
    {
        $databasePassword = $this->secret('Enter your database password (type blank for no password).', 'blank');

        return ($databasePassword === 'blank') ? '' : $databasePassword;
    }

    /**
     * Is the database connection valid?
     *
     * @return bool
     */
    protected function databaseConnectionIsValid($host, $username, $password, $database)
    {
        try {
            // dd($host, $username, $password, $database);
            $link = @mysqli_connect($host, $username, $password, $database);

            if (!$link) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    protected function askForUser()
    {
        $username = $this->ask('Enter your user username.', 'user');
        $password = $this->secret('Enter your user password.', 'user');
        $email = $this->ask('Enter your user email.', 'hi@mepsd.me');
        $this->info('Creating user user...');
        User::create([
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
