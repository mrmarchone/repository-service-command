<?php

namespace Mrmarchone\Repositories\Console;

use Illuminate\Console\Command;

class RepositoryCommand extends Command
{
    protected $hidden = false;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:repo {repo} {--service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make New Repository With it\'s interface';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nameOfRepository = $this->argument('repo');
        $service = $this->option('service');
        $dist = 'app/Repository/';
        $servicesDist = 'app/Services/';
        $nameSpace = '\\';
        if (strpos($nameOfRepository, '/') !== false) {
            $folders = explode('/', $nameOfRepository);
            $nameOfRepository = $folders[count($folders) - 1];
            array_pop($folders);
            $folderString = implode('/', $folders);
            $dist .= $folderString . '/';
            $servicesDist .= $folderString . '/';
            $nameSpace .= str_replace('/', '\\', $folderString);
        }
        if (!file_exists($dist)) {
            mkdir($dist, 0777, true);
        }
        if (!file_exists($dist . $nameOfRepository . 'Repository.php')) {
            $file = fopen($dist . $nameOfRepository . 'Repository.php', 'w') or $this->error('Unable To Create File');
            $thisVar = '$this';
            if ($service) {
                $code = "<?php
namespace App\Repository$nameSpace;
use App\Services" . $nameSpace . '\\' . $nameOfRepository . "Service;
class " . $nameOfRepository . "Repository
{
    protected $$nameOfRepository;
    public function __construct(" . $nameOfRepository . "Service $$nameOfRepository)
    {
        $thisVar->$nameOfRepository = $$nameOfRepository;
    }
}";
            } else {
                $code = "<?php
namespace App\Repository$nameSpace;
class " . $nameOfRepository . "Repository
{
}";
            }
            fwrite($file, $code);
            fclose($file);
        } else {
            $this->error("Repository is already exists");
            return false;
        }
        if ($service) {
            if (!file_exists($servicesDist)) {
                mkdir($servicesDist, 0777, true);
            }
            if (!file_exists($servicesDist . $nameOfRepository . 'Service.php')) {
                $file_two = fopen($servicesDist . $nameOfRepository . 'Service.php', 'w') or $this->error('Unable To Create File');
                $code_service = "<?php
namespace App\Services$nameSpace;
class " . $nameOfRepository . "Service
{
}";
                fwrite($file_two, $code_service);
                fclose($file_two);
            } else {
                $this->error("Service is already exists");
                return false;
            }
        }
        $this->info('Repository Successfully Created ! Great :D');
    }
}