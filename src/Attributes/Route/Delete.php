<?php

namespace Nddcoder\LaravelSpring\Attributes\Route;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Delete extends Route
{
    public function __construct(
        string $uri,
        ?string $name = null,
        array|string $middleware = [],
    ) {
        parent::__construct(
            method: self::DELETE,
            uri: $uri,
            name: $name,
            middleware: $middleware,
        );
    }
}
