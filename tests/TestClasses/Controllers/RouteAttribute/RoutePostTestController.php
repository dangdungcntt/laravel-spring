<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller]
class RoutePostTestController
{
    #[Route('post', 'my-post-method')]
    public function myPostMethod()
    {
    }
}
