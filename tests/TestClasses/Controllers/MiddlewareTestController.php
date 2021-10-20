<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;
use Nddcoder\LaravelSpring\Tests\TestClasses\Middleware\OtherTestMiddleware;
use Nddcoder\LaravelSpring\Tests\TestClasses\Middleware\TestMiddleware;

#[Controller(middleware: TestMiddleware::class)]
class MiddlewareTestController
{
    #[Route(Route::GET, 'single-middleware')]
    public function singleMiddleware()
    {
    }

    #[Route(Route::GET, 'multiple-middleware', middleware: OtherTestMiddleware::class)]
    public function multipleMiddleware()
    {
    }
}
