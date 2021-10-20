<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Post;

#[Controller]
class PostTestController
{
    #[Post('my-post-method')]
    public function myPostMethod()
    {
    }
}
