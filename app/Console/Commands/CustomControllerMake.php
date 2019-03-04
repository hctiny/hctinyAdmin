<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CustomControllerMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'custom:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('model')) {
            $replace = $this->buildReplacements($replace);
        }

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $modelClass]);
            }
        }

        $requestClass = $this->parseRequest('Admin/'.$this->option('model').'Request');
        if (! class_exists($requestClass)){
            if ($this->confirm("A {$requestClass} request does not exist. Do you want to generate it?", true)) {
                $this->call('make:request', ['name' => $requestClass]);
            }
        }

        $serviceClass = $this->parseService('Admin/'.$this->option('model').'Service');
        if (! class_exists($serviceClass)){
            if ($this->confirm("A {$serviceClass} service does not exist. Do you want to generate it?", true)) {
                $this->call('custom:service', ['name' => $serviceClass, '--model' => $modelClass]);
            }
        }

        return array_merge($replace, [
            'DummyModel' => class_basename($modelClass),
            'DummyFullModel' => $modelClass,
            'DummyViewModel' => $this->humpToLine(lcfirst(class_basename($modelClass))),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (! Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    /**
     * Get the fully-qualified request class name.
     *
     * @param  string  $request
     * @return string
     */
    protected function parseRequest($request)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $request)) {
            throw new InvalidArgumentException('Request name contains invalid characters.');
        }

        $request = trim(str_replace('/', '\\', $request), '\\');

        if (! Str::startsWith($request, $rootNamespace = $this->laravel->getNamespace())) {
            $request = $rootNamespace.'Http\Requests\\'.$request;
        }

        return $request;
    }

    /**
     * Get the fully-qualified service class name.
     *
     * @param  string  $service
     * @return string
     */
    protected function parseService($service)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $service)) {
            throw new InvalidArgumentException('Service name contains invalid characters.');
        }

        $service = trim(str_replace('/', '\\', $service), '\\');

        if (! Str::startsWith($service, $rootNamespace = $this->laravel->getNamespace())) {
            $service = $rootNamespace.'Http\Services\\'.$service;
        }

        return $service;
    }

    /**
     * 驼峰命名转下划线命名
     */
    protected function humpToLine($str){
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        }, $str);
        return $str;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Generate a resource controller for the given model.'],
        ];
    }
}
