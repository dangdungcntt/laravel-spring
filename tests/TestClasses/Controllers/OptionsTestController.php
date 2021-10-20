<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Options;

#[Controller]
class OptionsTestController
{
    #[Options('my-options-method')]
    public function myOptionsMethod()
    {
    }
}
