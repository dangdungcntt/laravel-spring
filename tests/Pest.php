<?php

use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Arr;
use Nddcoder\LaravelSpring\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function getRouteCollection(): RouteCollection
{
    return app()->router->getRoutes();
}

function assertRouteRegistered(
    string $controller,
    ?string $controllerMethod = 'myMethod',
    string $httpMethod = 'get',
    string $uri = 'my-method',
    string|array $middleware = [],
    ?string $name = null,
    string|array $where = [],
) {
    if (!is_array($middleware)) {
        $middleware = Arr::wrap($middleware);
    }

    $routeRegistered = collect(getRouteCollection()->getRoutes())
//        ->map(fn(Route $route) => get_class($route->getController()).':'.$route->uri)
//        ->dd()
        ->contains(function (Route $route) use (
            $name,
            $middleware,
            $controllerMethod,
            $controller,
            $uri,
            $httpMethod,
            $where
        ) {
            if (strtoupper($httpMethod) == 'ANY') {
                if (array_diff($route->methods, \Illuminate\Routing\Router::$verbs)) {
                    return false;
                }
            } else {
                if (!in_array(strtoupper($httpMethod), $route->methods)) {
                    return false;
                }
            }

            if ($route->uri() !== $uri) {
                return false;
            }

            if (get_class($route->getController()) !== $controller) {
                return false;
            }


            if ($route->getActionMethod() !== $controllerMethod) {
                return false;
            }

            if (array_diff($route->middleware(), $middleware)) {
                return false;
            }

            if ($route->getName() !== $name) {
                return false;
            }

            if (array_diff($route->wheres, $where)) {
                return false;
            }

            return true;
        });

    test()->assertTrue($routeRegistered, 'The expected route was not registered');
}
