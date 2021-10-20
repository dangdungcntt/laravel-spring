<?php

namespace Nddcoder\LaravelSpring\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
class Bean
{
    public function __construct(
        public ?string $name = null,
        public ?string $type = null,
        public bool $primary = false,
    ) {
    }
}
