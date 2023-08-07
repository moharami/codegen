<?php

namespace Moharamiamir\codegen\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

class Create
{
    private mixed $files;

    public function __construct()
    {
        $this->files = app()->make(Filesystem::class);
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        $theme = 'custom';
        return dirname(__DIR__, 2) . '/stubs/' . $theme . DIRECTORY_SEPARATOR;
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }
        return $contents;
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */


    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }



    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        $this->files->ensureDirectoryExists($path);
    }

    protected function writeFile($path,  $contents)
    {
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            return "File : {$path} created";
        } else {
            return "File : {$path} already exits";
        }
    }
}
