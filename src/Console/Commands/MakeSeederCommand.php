<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Support\Facades\Artisan;

class MakeSeederCommand extends MakeStubCommand
{
    protected string $path = 'database/seeders';
    protected string $nameSpace = 'Database\Seeders';
    protected string $suffixFilename = 'Seeder';
    protected string $stub_name = 'seeder.stub';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR . $this->modelName . $this->suffixFilename . '.php';
    }

    public function getStubVariables(): array
    {
        return [
            'namespace' => $this->nameSpace,
            'class' => $this->getSingularClassName($this->modelName) . $this->suffixFilename,
            'model' => $this->getSingularClassName($this->modelName),
            'fill' => (new getSeeder($this->modelName))->get(),
        ];
    }

    public function afterHandle()
    {
        $name = $this->getSingularClassName($this->modelName) . "Seeder";
        Artisan::call('db:seed', [
            '--class' => $name
        ]);

    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }
}