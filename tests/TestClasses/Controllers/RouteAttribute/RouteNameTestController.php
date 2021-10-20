<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller]
class RouteNameTestController
{
    #[Route(Route::GET, 'my-method', name: 'test-name')]
    public function myMethod()
    {
    }
}
