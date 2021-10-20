<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Any;
use Nddcoder\LaravelSpring\Attributes\Route\Controller;

#[Controller]
class AnyTestController
{
    #[Any('my-any-method')]
    public function myAnyMethod()
    {
    }
}
