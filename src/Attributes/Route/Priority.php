<?php

namespace Nddcoder\LaravelSpring\Attributes\Route;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Priority
{
    public function __construct(
        public string $priority,
    ) {
    }
}
