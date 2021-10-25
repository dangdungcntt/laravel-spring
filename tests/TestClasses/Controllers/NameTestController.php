<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;

#[Controller(name: 'my-name.')]
class NameTestController
{
    #[Get('name-test', name: 'name-test')]
    public function nameTest()
    {
    }
}
