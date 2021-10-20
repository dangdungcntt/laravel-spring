<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteRegistrar;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;

#[Controller]
class RegistrarTestFirstController
{
    #[Get('first-method')]
    public function myMethod()
    {
    }
}
