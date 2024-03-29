<?php

use Nddcoder\LaravelSpring\LaravelSpring;
use Nddcoder\LaravelSpring\Registrars\BeanRegistrar;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\BeanRegistrar\PostController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\BeanRegistrar\UserController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Controllers\NotInstantiableController;
use Nddcoder\LaravelSpring\Tests\TestClasses\Services\PostService;

afterEach(function () {
    LaravelSpring::teardown();
    BeanRegistrar::teardown();
});

it('should_register_bean', function () {
    expect(LaravelSpring::beanExists(UserController::class))->toBeTrue()
        ->and(LaravelSpring::beanExists(PostController::class))->toBeTrue()
        ->and(LaravelSpring::beanExists('postService'))->toBeTrue()
        ->and(LaravelSpring::beanExists('facebookPostService'))->toBeTrue()
        ->and(LaravelSpring::getPrimaryBeanName(PostService::class))->toEqual('postService')
        ->and(LaravelSpring::getPrimaryBeanName(UserController::class))->toEqual(UserController::class)
        ->and(LaravelSpring::getPrimaryBeanName(PostController::class))->toEqual(PostController::class);
});

it('can_autowire_to_get_bean', function () {
    $postController = app()->make(PostController::class);

    expect($postController->primaryPostService->endpoint)
        ->toEqual('primary_bean_endpoint')
        ->and($postController->facebookPostService->endpoint)
        ->toEqual('facebook_bean_endpoint')
        ->and($postController->qualifiedPostService->endpoint)
        ->toEqual('facebook_bean_endpoint')
        ->and($postController->nonAutowirePostService->endpoint)
        ->toEqual('default_endpoint');
});

it('should_not_override_primary_bean', function () {
    LaravelSpring::addBean(PostService::class, 'postService1', false, fn() => null);
    expect(LaravelSpring::getPrimaryBeanName(PostService::class))->toEqual('postService');
});

it('should_throw_exception_when_not_found_bean', function () {
    config()->set('spring.fallback_bean_to_laravel_container', false);
    app()->make(PostController::class);
})->throws(RuntimeException::class,
    'Cannot find Bean for class '.\Nddcoder\LaravelSpring\Tests\TestClasses\Services\CommentService::class);

it('should_throw_exception_when_duplicate_bean', function () {
    LaravelSpring::addBean(PostService::class, 'postService', false, fn() => null);
})->throws(RuntimeException::class,
    'Duplicate bean postService');

it('should_throw_exception_when_duplicate_primary_bean', function () {
    LaravelSpring::addBean(PostService::class, 'postService1', true, fn() => null);
})->throws(RuntimeException::class,
    'Duplicate primary bean for type ' . PostService::class);

it('should_throw_exception_when_get_not_exists_bean', function () {
    LaravelSpring::getBean('not_exists_bean');
})->throws(RuntimeException::class,
    'Bean not_exists_bean not found');

it('should_throw_exception_when_cannot_build_bean', function () {
    LaravelSpring::getBean(NotInstantiableController::class);
})->throws(RuntimeException::class,
    'Cannot resolve $a');
