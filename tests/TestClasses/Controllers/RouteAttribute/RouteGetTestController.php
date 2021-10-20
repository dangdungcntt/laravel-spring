<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller]
class RouteGetTestController
{
    #[Route(Route::GET, 'my-get-method')]
    public function myGetMethod()
    {
    }
}
