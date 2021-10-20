<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Route;

class RoutePostTestController
{
    #[Route('post', 'my-post-method')]
    public function myPostMethod()
    {
    }
}
