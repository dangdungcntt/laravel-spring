<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Put;

#[Controller]
class PutTestController
{
    #[Put('my-put-method')]
    public function myPutMethod()
    {
    }
}
