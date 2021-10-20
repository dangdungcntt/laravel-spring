<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Route;

class RouteNameTestController
{
    #[Route('get', 'my-method', name: 'test-name')]
    public function myMethod()
    {
    }
}
