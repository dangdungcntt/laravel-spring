<?php

namespace Nddcoder\LaravelSpring\Tests;

use Nddcoder\LaravelSpring\LaravelSpringServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelSpringServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('spring.scan_folders', [
            __DIR__.'/TestClasses' => 'Nddcoder\LaravelSpring\Tests\TestClasses',
            __DIR__.'/TestClasses/Config' => 'Nddcoder\LaravelSpring\Tests\TestClasses\Config',
        ]);
    }
}
