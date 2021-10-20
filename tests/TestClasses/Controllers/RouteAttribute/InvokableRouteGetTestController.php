<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller]
class InvokableRouteGetTestController
{
    #[Route(Route::GET, 'my-invokable-route')]
    public function __invoke()
    {
    }
}
