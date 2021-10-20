<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Config;

use Nddcoder\LaravelSpring\Attributes\Bean;
use Nddcoder\LaravelSpring\Attributes\Configuration;
use Nddcoder\LaravelSpring\Tests\TestClasses\Services\PostService;

#[Configuration]
class AppConfig
{
    #[Bean(primary: true)]
    function postService(): PostService
    {
        return new PostService('primary_bean_endpoint');
    }

    #[Bean]
    function facebookPostService()
    {
        return new PostService('facebook_bean_endpoint');
    }
}
