<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Route;

class InvokableRouteGetTestController
{
    #[Route('get', 'my-invokable-route')]
    public function __invoke()
    {
    }
}
