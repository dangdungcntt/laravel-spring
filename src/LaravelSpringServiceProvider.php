<?php

namespace Nddcoder\LaravelSpring;

use Nddcoder\LaravelSpring\Registrars\BeanRegistrar;
use Nddcoder\LaravelSpring\Registrars\RouteRegistrar;
use Nddcoder\PhpAttributesScanner\Scanner;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSpringServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-spring')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        collect(config('spring.scan_folders'))
            ->each(fn($namespace, $folder) => $this->scan($namespace, $folder));
    }

    protected function scan($namespace, $folder)
    {
        $scanResult = Scanner::in($folder, $namespace)->scan();

        (new BeanRegistrar())->handle($scanResult);
        (new RouteRegistrar(app()->router))->handle($scanResult);
    }
}
