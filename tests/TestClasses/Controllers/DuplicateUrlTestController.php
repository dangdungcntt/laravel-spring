<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Priority;
use Nddcoder\LaravelSpring\Attributes\Route\Route;

#[Controller]
#[Priority(1)]
class DuplicateUrlTestController
{
    #[Route(Route::GET, 'duplicate-uri')]
    public function myGetMethod()
    {
    }
}
