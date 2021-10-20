<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;

#[Controller]
class GetTestController
{
    #[Get('my-get-method')]
    public function myGetMethod()
    {
    }
}
