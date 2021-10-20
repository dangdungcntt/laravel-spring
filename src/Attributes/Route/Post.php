<?php

namespace Nddcoder\LaravelSpring\Attributes\Route;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Post extends Route
{
    public function __construct(
        string $uri,
        ?string $name = null,
        array|string $middleware = [],
    ) {
        parent::__construct(
            method: self::POST,
            uri: $uri,
            name: $name,
            middleware: $middleware,
        );
    }
}
