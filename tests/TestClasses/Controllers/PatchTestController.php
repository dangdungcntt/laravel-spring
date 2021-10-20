<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Patch;

#[Controller]
class PatchTestController
{
    #[Patch('my-patch-method')]
    public function myPatchMethod()
    {
    }
}
