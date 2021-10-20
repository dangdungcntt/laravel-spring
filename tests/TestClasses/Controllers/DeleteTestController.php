<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Delete;

#[Controller]
class DeleteTestController
{
    #[Delete('my-delete-method')]
    public function myDeleteMethod()
    {
    }
}
