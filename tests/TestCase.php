<?php

namespace Rocktoon\LaravelExpansion\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Rocktoon\LaravelExpansion\LaravelExpansionServiceProvider;

class TestCase extends Orchestra
{
    protected $fakeClient = null;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Rocktoon\\LaravelExpansion\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelExpansionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-expansion_table.php.stub';
        $migration->up();
        */
    }
}
