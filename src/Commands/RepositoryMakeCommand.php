<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class RepositoryMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    protected $type = 'Repository';

    private $repositoryClass;
    private $model;
    private $files;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files=$files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $modelName = ucwords(strtolower($this->argument('modelName')));

        $repoDir = app_path() .'/Repositories';
        $repoFilename = $modelName . 'Repository.php';
        $repoPath = $repoDir .'/' . $repoFilename;

        if($this->files->isDirectory($repoDir)){
            if($this->files->isFile($repoFilename))
                return $this->error($repoFilename.' File Already exists!');

            if(!$this->files->put($repoPath, $this->getContent($modelName)))
                return $this->error('Something went wrong!');
            $this->info("Repository Created Successfully!");
        }
    }


    protected function getContent($modelName): string
    {
        return '<?php
namespace App\Repositories;

use App\Models\\'. $modelName .';
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ' . $modelName .'Repository
{
    private $model;
    public function __construct(' . $modelName .' $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }

    public function create($request): bool
    {

        return $this->model->save();

    }
    public function update($request, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }



        return $item->save();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }

        return $item->delete();
    }

}';
    }
}
