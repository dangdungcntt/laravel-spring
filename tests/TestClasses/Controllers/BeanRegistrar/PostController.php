<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\BeanRegistrar;

use Nddcoder\LaravelSpring\Attributes\Autowire;
use Nddcoder\LaravelSpring\Attributes\Bean;
use Nddcoder\LaravelSpring\Tests\TestClasses\Services\CommentService;
use Nddcoder\LaravelSpring\Tests\TestClasses\Services\PostService;

#[Bean]
class PostController
{
    public function __construct(
        #[Autowire] public PostService $primaryPostService,
        #[Autowire] public PostService $facebookPostService,
        #[Autowire('facebookPostService')] public PostService $qualifiedPostService,
        public PostService $nonAutowirePostService,
        #[Autowire] public CommentService $commentService,
    ) {
    }

    public function index()
    {
    }

    public function store()
    {
    }
}
