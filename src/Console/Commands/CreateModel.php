<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Filesystem\Filesystem;
class CreateModel extends Create
{
    private mixed $modelName;
    private string $path = 'app/Models';

    protected string $stub_name = 'model.stub';
    protected string $destinationPath;


    public function __construct($name)
    {
        parent::__construct();
        $this->modelName = $this->getSingularClassName($name);
        $this->destinationPath = base_path($this->path);
    }

    public function make()
    {
        $path = $this->getSourceFilePath();
        $this->makeDirectory(dirname($path));
        $contents = $this->getSourceFile();

        return $this->writeFile($path, $contents);
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return  $this->destinationPath. DIRECTORY_SEPARATOR .$this->getSingularClassName($this->modelName) . '.php';
    }


    public function getStubVariables()
    {
        return [
            'namespace' => 'App\\Models',
            'class' => $this->getSingularClassName($this->modelName),
        ];
    }


    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return parent::getStubPath() . $this->stub_name;
    }


}
