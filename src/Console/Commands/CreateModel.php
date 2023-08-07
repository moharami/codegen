<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Filesystem\Filesystem;

class CreateModel extends Create
{
    protected string $stub_name = 'model.stub';
    protected string $fillable_name = 'fillable.stub';
    protected string $destinationPath;
    protected array $fields;
    private mixed $modelName;
    private string $path = 'app/Models';

    public function __construct($name, array $fields)
    {
        parent::__construct();
        $this->modelName = $this->getSingularClassName($name);
        $this->destinationPath = base_path($this->path);
        $this->fields = $fields;
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
        return $this->destinationPath . DIRECTORY_SEPARATOR . $this->getSingularClassName($this->modelName) . '.php';
    }


    public function getStubVariables()
    {
        return [
            'namespace' => 'App\\Models',
            'class' => $this->getSingularClassName($this->modelName),
            'fillable' => $this->fillable(),
        ];
    }

    private function fillable()
    {
        if ($this->fields){
            return $this->getStubContents($this->getStubFillabePath(), $this->fillableVariable());
        }
    }

    public function getStubFillabePath()
    {
        return parent::getStubPath() . $this->fillable_name;
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

    private function fillableVariable()
    {
        $content ='';
        foreach ($this->fields as $key => $field) {
            $content .= "'" . $field . "',";
            if ($key !== count($this->fields) - 1) {
                $content .= "\n\t\t";
            }
        }

        return [
            'fill' => $content,
        ];
    }


}
