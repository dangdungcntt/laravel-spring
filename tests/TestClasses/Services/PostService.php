<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Services;

class PostService
{
    public function __construct(
        public string $endpoint = 'default_endpoint'
    ) {
    }
}
