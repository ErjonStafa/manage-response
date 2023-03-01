<?php

namespace Erjon\ManageResponse\Traits;

use Illuminate\Filesystem\Filesystem;

trait CreatesLayout
{
    public function __construct(private Filesystem $filesystem)
    {
        parent::__construct();
    }

    public function create($path, $toastrPath): void
    {
        try {
            $toastrNameSpace = str_replace('/', '.', $toastrPath);
            $path = str_replace('\\', '/', $path);
            $toastrPath = str_replace('\\', '/', $toastrPath);

            $path = base_path("resources/views/{$path}.blade.php");
            $toastrPath = base_path("resources/views/{$toastrPath}.blade.php");

            $this->createDirectory($path, $toastrPath);

            if (! \File::exists($path)) {
                $stub = \File::get(__DIR__ . '/stubs/app.stub');

                $stub = str_replace("{{ toastrPath }}", $toastrNameSpace, $stub);
                \File::put($path, $stub);

                $this->info("Created the layout");
            } else {
                $this->warn('Layout already exists');
            }

            if ( ! \File::exists($toastrPath))
            {
                \File::put($toastrPath, \File::get(__DIR__ . '/stubs/toastr.stub'));

                $this->info("Created the toastr file");
            } else {
                $this->warn('Toastr file already exists');
            }

        } catch (\Exception $exception) {
            $this->error($exception->getMessage() . " ". $exception->getLine());
        }
    }

    public function createDirectory($path, $toastrPath)
    {
        $path = explode('/', $path);
        $path = implode('/', array_diff($path, array_slice($path, -1)));

        $toastrPath = explode('/', $toastrPath);
        $toastrPath = implode('/', array_diff($toastrPath, array_slice($toastrPath, -1)));


        if (! \File::isDirectory($path)) {
            \File::makeDirectory($path, 0777, true);
        }

        if (! \File::isDirectory($toastrPath)) {
            \File::makeDirectory($toastrPath, 0777, true);
        }
    }
}
