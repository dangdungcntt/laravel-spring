<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteRegistrar\SubDirectory;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;

#[Controller]
class RegistrarTestControllerInSubDirectory
{
    #[Get('in-sub-directory')]
    public function myMethod()
    {
    }
}
