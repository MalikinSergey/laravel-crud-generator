<?php

namespace Mlsg\LaravelCrudGenerator;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CrudControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     * @var string
     */
    protected $name = 'make:crud-controller';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Create a new controller class with basic CRUD logic';

    /**
     * The type of class being generated.
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['model', InputArgument::REQUIRED, 'The class of the model'],
            ['prefix', InputArgument::OPTIONAL, 'Prefix for routes and views'],
        ];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }

    /**
     * Build the class with the given name.
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $namespace = $this->getNamespace($name);

        $content = str_replace("use {$namespace}\\Controller;\n", '', parent::buildClass($name));

        $model = $this->argument('model');

        $prefix = $this->argument('prefix');

        $search = [
            'dummy_prefix',
            'DummyModel',
            'dummy_model_lower',
            'dummy_model_plural',
            'dummy_message_key',
            'dummy_message_success'
        ];

        $replace = [
            $prefix,
            $model,
            strtolower($model),
            str_plural(strtolower($model)),
            config('crud-make.message_key', 'message'),
            config('crud-make.message_success', 'success'),
        ];

        $content = str_replace($search, $replace, $content);

        return $content;
    }
}