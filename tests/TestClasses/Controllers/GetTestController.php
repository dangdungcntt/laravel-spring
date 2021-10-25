<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;

#[Controller]
class GetTestController
{
    #[Get('duplicate-uri')]
    public function myGetMethod()
    {
    }
}
