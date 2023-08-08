<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Support\Str;

class MakeControllerCommand extends MakeStubCommand
{
    protected string $path = 'app/Http/Controllers/Api/V1';
    protected string $suffixFilename = 'Controllers';

    protected string $stub_name = 'controller.model.api.stub';

    protected string $controllerNamespace = 'App\\Http\\Controllers\\Api\\V1';
    protected string $modelNamespace = 'App\\Models\\';

    protected string $rootNamespace = 'App\\Http\\Controllers\\Api\\BaseController';
    protected string $requestbase = 'App\\Http\\Requests\\';
    private string $modelUpdateRequest = 'UpdateRequest';
    private string $modelStoreRequest = 'SaveRequest';


    public function getDestinationPath(): string
    {
        return parent::getDestinationPath() . DIRECTORY_SEPARATOR .  $this->modelName . $this->suffixFilename .'.php';
    }

    public function getStubVariables(): array
    {
        return [
            'class' => $this->modelName,
            'namespace' => $this->controllerNamespace,
            'namespacedModel' => $this->modelNamespace . $this->name,
            'rootNamespace' =>$this->rootNamespace,
            'namespacedSaveRequests' => $this->requestbase . $this->name .  $this->modelStoreRequest,
            'namespacedUpdateRequests' => $this->requestbase . $this->name .'UpdateRequest',
            'storeRequest'=> $this->name .  $this->modelStoreRequest,
            'updateRequest'=> $this->name .  $this->modelUpdateRequest,
            'model'=> $this->modelName,
            'modelVariable' =>str::lower($this->modelName)
        ];
    }

    protected function getStub(): string
    {
        return $this->getRootStubPath() . $this->stub_name;
    }

}