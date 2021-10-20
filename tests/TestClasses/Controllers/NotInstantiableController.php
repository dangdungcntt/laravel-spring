<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Bean;

#[Bean]
class NotInstantiableController
{
    public function __construct(int $a)
    {
    }
}
