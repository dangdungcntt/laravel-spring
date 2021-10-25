<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller('route-attribute')]
class RouteNameTestController
{
    #[Route(Route::GET, 'name-test', name: 'test-name')]
    public function myMethod()
    {
    }
}
