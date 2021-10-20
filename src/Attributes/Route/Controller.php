<?php

namespace Nddcoder\LaravelSpring\Attributes\Route;

use Illuminate\Support\Arr;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Controller
{
    public array $middleware;

    public function __construct(
        public ?string $prefix = null,
        public ?string $name = null,
        public ?string $resource = null,
        array|string $middleware = [],
    ) {
        $this->middleware = Arr::wrap($middleware);
    }
}
