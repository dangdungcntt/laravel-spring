<?php

namespace Nddcoder\LaravelSpring\Tests\TestClasses\Controllers;

use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Get;
use Nddcoder\LaravelSpring\Attributes\Route\Put;

#[Controller(
    prefix: 'admin',
    name: 'admin.',
    resource: 'posts',
    middleware: 'auth'
)]
class MixResourceTestController
{
    public function index()
    {
    }

    #[Get('posts/create-new-post', name: 'posts.create-new-post', middleware: ['editor'])]
    public function create()
    {
    }

    public function store()
    {
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

    #[Put('posts/{post}/update-status', name: 'posts.update-status', middleware: 'admin')]
    public function updateStatus()
    {
    }
}
