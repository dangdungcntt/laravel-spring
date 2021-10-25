<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;
use Nddcoder\LaravelSpring\Tests\TestClasses\Middleware\TestMiddleware;

#[Controller('route-attribute')]
class RouteMiddlewareTestController
{
    #[Route(Route::GET, 'middleware-test', middleware: TestMiddleware::class)]
    public function myMethod()
    {
    }
}
