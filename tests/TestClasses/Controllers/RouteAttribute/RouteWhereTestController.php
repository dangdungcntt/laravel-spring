<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller]
class RouteWhereTestController
{
    #[Route(Route::GET, 'users/{id}', domain: 'mydomain.com', where: [
        'id' => '[a-fA-F0-9]{24}'
    ])]
    public function myPostMethod()
    {
    }
}
