<?php

namespace Nddcoder\LaravelSpring\Attributes\Route;

use Attribute;
use Illuminate\Support\Arr;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    public const ANY = 'any';
    public const GET = 'get';
    public const PUT = 'put';
    public const POST = 'post';
    public const PATCH = 'patch';
    public const DELETE = 'delete';
    public const OPTIONS = 'options';

    public array $middleware;

    public function __construct(
        public string $method,
        public ?string $uri,
        public ?string $name = null,
        public ?string $domain = null,
        array|string $middleware = [],
        public array $where = [],
    ) {
        $this->middleware = Arr::wrap($middleware);
    }
}
