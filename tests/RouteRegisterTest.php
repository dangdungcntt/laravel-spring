<?php

use Nddcoder\LaravelSpring\Attributes\Route\Route;
use Nddcoder\LaravelSpring\LaravelSpring;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\AnyTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\DeleteTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\DuplicateUrlTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\MiddlewareTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\MixResourceTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\NameTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\OptionsTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\PatchTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\PostTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\PrefixTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\PutTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute\InvokableRouteGetTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute\RouteGetTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute\RouteMiddlewareTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute\RouteNameTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute\RoutePostTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteAttribute\RouteWhereTestController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\RouteRegistrar\RegistrarTestFirstController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Middleware\OtherTestMiddleware;
use Nddcoder\LaravelSpring\Tests\TestClasses\Middleware\TestMiddleware;

afterEach(function () {
    LaravelSpring::teardown();
});

it('should_register_route', function () {
    expect(getRouteCollection())
        ->toHaveCount(27);
});

it('registered_route', function (...$params) {
    assertRouteRegistered(...$params);
})->with([
    [InvokableRouteGetTestController::class, InvokableRouteGetTestController::class, Route::GET, 'route-attribute/invokable-test'],
    [RouteGetTestController::class, 'myGetMethod', Route::GET, 'route-attribute/get-test'],
    [RouteMiddlewareTestController::class, 'myMethod', Route::GET, 'route-attribute/middleware-test', TestMiddleware::class],
    [RouteNameTestController::class, 'myMethod', Route::GET, 'route-attribute/name-test', [], 'test-name'],
    [RoutePostTestController::class, 'myPostMethod', Route::POST, 'route-attribute/post-test'],
    [RouteWhereTestController::class, 'show', Route::GET, 'route-attribute/users/{id}', [], null, ['id' => '[a-fA-F0-9]{24}']],
    [RegistrarTestFirstController::class, 'myMethod', Route::GET, 'first-method'],
    [AnyTestController::class, 'myAnyMethod', Route::ANY, 'my-any-method'],
    [DeleteTestController::class, 'myDeleteMethod', Route::DELETE, 'my-delete-method'],
    [MiddlewareTestController::class, 'singleMiddleware', Route::GET, 'single-middleware', TestMiddleware::class],
    [MiddlewareTestController::class, 'multipleMiddleware', Route::GET, 'multiple-middleware', [TestMiddleware::class, OtherTestMiddleware::class]],
    [MixResourceTestController::class, 'index', Route::GET, 'admin/posts', 'auth', 'admin.posts.index'],
    [MixResourceTestController::class, 'create', Route::GET, 'admin/posts/create-new-post', ['auth', 'editor'], 'admin.posts.create-new-post'],
    [MixResourceTestController::class, 'store', Route::POST, 'admin/posts', ['auth', 'editor'], 'admin.posts.store'],
    [MixResourceTestController::class, 'show', Route::GET, 'admin/posts/{post}', 'auth', 'admin.posts.show'],
    [MixResourceTestController::class, 'edit', Route::GET, 'admin/posts/{post}/edit', 'auth', 'admin.posts.edit'],
    [MixResourceTestController::class, 'update', Route::PUT, 'admin/posts/{post}', 'auth', 'admin.posts.update'],
    [MixResourceTestController::class, 'destroy', Route::DELETE, 'admin/posts/{post}', 'auth', 'admin.posts.destroy'],
    [MixResourceTestController::class, 'updateStatus', Route::PUT, 'admin/posts/{post}/update-status', ['auth', 'admin'], 'admin.posts.update-status'],
    [NameTestController::class, 'nameTest', Route::GET, 'name-test', [], 'my-name.name-test'],
    [OptionsTestController::class, 'myOptionsMethod', Route::OPTIONS, 'my-options-method'],
    [PatchTestController::class, 'myPatchMethod', Route::PATCH, 'my-patch-method'],
    [PostTestController::class, 'myPostMethod', Route::POST, 'my-post-method'],
    [PrefixTestController::class, 'myGetMethod', Route::GET, 'my-prefix/my-get-method'],
    [PrefixTestController::class, 'myPostMethod', Route::POST, 'my-prefix/my-post-method'],
    [PutTestController::class, 'myPutMethod', Route::PUT, 'my-put-method'],
    [DuplicateUrlTestController::class, 'myGetMethod', Route::GET, 'duplicate-uri'],
]);
