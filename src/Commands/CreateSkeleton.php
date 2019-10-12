<?php
namespace Jakerw\Utility\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class CreateSkeleton extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:framework'; // Consider adding some options for Model View Controller


    ## Model
    #
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the initial framework';
    
    /** @var string */
    protected $appDir;

    /** @var string */
    protected $viewsDir;

    /** @var array */
    protected $baseDirs;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();        

        $this->baseDirs = [           
            'routes.backend.dashboard',
            'routes.frontend.home',
            'resources.views.frontend.home',
            'resources.views.frontend.partials.header',
            'resources.views.frontend.partials.footer',
            'resources.views.backend.dashboard',
            'resources.views.backend.partials.datepicker',
            'app.Http.Controllers.Backend.DashboardController',
            'app.Http.Controllers.Frontend.HomeController'
        ];
        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->appDir = base_path();
        $this->createBaseDirs();
    }

    protected function getPaths($path)
    {
        $this->viewsDir = getcwd();
        $paths = explode('.', $path);
        $fileName = $paths[count($paths) - 1];
        
        if (strpos($path, 'resources') !== false && strpos($fileName, '.blade.php') == false) {
            $fileName .= '.blade.php';
        }
        
        if (strpos($fileName, '.php') == false) {
            $fileName .= '.php';
        }
        unset($paths[count($paths) - 1]);
        $basePath = $this->viewsDir.'/'.implode('/', $paths);
        return [Str::finish($basePath, '/'), $fileName];
    }

    protected function createBaseDirs()
    {

        foreach ( $this->baseDirs as $path ) {
            [$baseDir, $fileName] = $this->getPaths($path);            
            
            $this->createDirectory($baseDir);           
            
            if (! $this->createFile($baseDir.$fileName)) {
                continue;
            }
        }

    }

    protected function createViews()
    {
        $this->createDirectory($this->viewsDir);
        $this->createView($this->viewBlades);
    }

    protected function createDirectory($baseDir)
    {
        if (! file_exists($baseDir)) {
            $this->line('Directory created - ' . $baseDir);
            mkdir($baseDir, 0777, true);
            return true;
        }  

        $this->warn('Directory already exists - '. $baseDir);
    }

    protected function createFile($filePath)
    {
        
        if (file_exists($filePath)) {
            $this->warn('File already exists - ' . $filePath);
            return false;
        }
        file_put_contents($filePath, '');
        $this->info('File created: '.$filePath);
        return true;
    }
   

    
}
