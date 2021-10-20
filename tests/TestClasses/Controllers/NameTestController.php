<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;
use Nddcoder\LaravelSpring\Attributes\Route\Post;

#[Controller(name: 'my-name.')]
class NameTestController
{
    #[Get('my-get-method', name: 'my-get-method')]
    public function myGetMethod()
    {
    }

    #[Post('my-post-method')]
    public function myPostMethod()
    {
    }
}
