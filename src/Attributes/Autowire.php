<?php

namespace Nddcoder\LaravelSpring\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER)]
class Autowire
{
    public function __construct(
        public ?string $beanName = null
    ) {
    }
}
