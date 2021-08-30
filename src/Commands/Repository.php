<?php

namespace Mrmarchone\Repositories\Commands;

use Illuminate\Console\Command;

class Repository extends Command
{
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nameOfRepository = $this->argument('repo');
        $service = $this->option('service');
        $dist = 'app/Repository/Eloquent/';
        $servicesDist = 'app/Services/';
        if (!file_exists($dist)) {
            mkdir($dist, 0777, true);
        }
        if (!file_exists($dist . $nameOfRepository . 'Repository.php')) {
            $file = fopen($dist . $nameOfRepository . 'Repository.php', 'w') or $this->error('Unable To Create File');
            $thisVar = '$this';
            if ($service) {
                $code = "<?php
namespace App\Repository\Eloquent;
use App\Services\\" . $nameOfRepository . "Service;
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
namespace App\Repository\Eloquent;
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
namespace App\Services;
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