<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;
use Nddcoder\LaravelSpring\Tests\TestClasses\Middleware\TestMiddleware;

#[Controller]
class RouteMiddlewareTestController
{
    #[Route('get', 'my-method', middleware: TestMiddleware::class)]
    public function myMethod()
    {
    }
}
