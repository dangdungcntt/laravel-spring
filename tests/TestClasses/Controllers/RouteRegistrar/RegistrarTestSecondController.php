<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteRegistrar;

use Nddcoder\LaravelSpring\Attributes\Route\Get;

class RegistrarTestSecondController
{
    #[Get('second-method')]
    public function myMethod()
    {
    }
}
