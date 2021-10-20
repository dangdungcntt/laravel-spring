<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;

#[Controller]
class InvokeTestController
{
    #[Get('my-invoke-method')]
    public function __invoke()
    {
    }
}
