<?php

namespace Erjon\ManageResponse\Console\Commands;


use Erjon\ManageResponse\Traits\CreatesLayout;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'create:layout')]
class CreateLayout extends Command
{
    use CreatesLayout;

    private int $fileCreated = 1;

    protected $signature = 'create:layout {--path=layouts/app} {--toastr=layouts/includes/toastr}';

    protected $description = "Create a default layout";

    public function handle(): int
    {
        $path = $this->option('path');
        $toastrPath = $this->option('toastr');

        $this->create($path, $toastrPath);

        return 1;
    }

}
