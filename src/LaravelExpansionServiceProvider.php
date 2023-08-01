<?php

namespace Rocktoon\LaravelExpansion;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Rocktoon\LaravelExpansion\Commands\LaravelExpansionCommand;

class LaravelExpansionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-expansion')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-expansion_table')
            ->hasCommand(LaravelExpansionCommand::class);
    }
}
