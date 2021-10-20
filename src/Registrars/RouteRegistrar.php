<?php

namespace Nddcoder\LaravelSpring\Registrars;

use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\Attributes\Route\Route;
use Nddcoder\PhpAttributesScanner\Model\ClassInfo;
use Nddcoder\PhpAttributesScanner\ScanResult;

class RouteRegistrar
{
    protected static array $processedClasses = [];

    static array $resourceRouteByMethods = [
        'index'   => ['get', '{name}', '{name}.index'],
        'create'  => ['get', '{name}/create', '{name}.create'],
        'store'   => ['post', '{name}', '{name}.store'],
        'show'    => ['get', '{name}/{{route_key}}', '{name}.show'],
        'edit'    => ['get', '{name}/{{route_key}}/edit', '{name}.edit'],
        'update'  => ['put', '{name}/{{route_key}}', '{name}.update'],
        'destroy' => ['delete', '{name}/{{route_key}}', '{name}.destroy'],
    ];

    public function __construct(
        protected Router $router
    ) {
    }

    public function handle(ScanResult $scanResult): void
    {
        foreach ($scanResult->all() as $classInfo) {
            if (isset(static::$processedClasses[$classInfo->getName()])) {
                continue;
            }

            static::$processedClasses[$classInfo->getName()] = true;

            $this->processClass($classInfo);
        }
    }

    protected function processClass(ClassInfo $classInfo): void
    {
        $controllerAttribute = null;

        foreach ($classInfo->getAttributes() as $attribute) {
            if ($attribute instanceof Controller) {
                $controllerAttribute = $attribute;
                break;
            }
        }

        if (!$controllerAttribute) {
            return;
        }

        foreach ($classInfo->getMethods() as $method) {
            $registered = false;
            foreach ($method->getAttributes() as $methodAttribute) {
                if ($methodAttribute instanceof Route) {
                    $this->registerRoute($classInfo, $controllerAttribute, $methodAttribute, $method->getName());
                    $registered = true;
                }
            }

            if ($registered) {
                continue;
            }

            if ($controllerAttribute->resource && array_key_exists($method->getName(),
                    static::$resourceRouteByMethods)) {
                $params = collect(static::$resourceRouteByMethods[$method->getName()])
                    ->map(fn($param) => $this->replaceResourceInfo($param, $controllerAttribute->resource));

                $this->registerRoute($classInfo, $controllerAttribute, new Route(...$params), $method->getName());
            }
        }
    }

    protected function registerRoute(
        ClassInfo $classInfo,
        Controller $controllerAttribute,
        Route $methodRouteAttribute,
        string $methodName
    ) {
        $httpMethod = $methodRouteAttribute->method;

        $action = $methodName === '__invoke'
            ? $classInfo->getName()
            : [$classInfo->getName(), $methodName];

        /** @var \Illuminate\Routing\Route $route */
        $route = $this->router->$httpMethod($methodRouteAttribute->uri, $action);

        if (is_null($namePrefix = $controllerAttribute->name)) {
            $route->name($methodRouteAttribute->name);
        } else {
            $route
                ->name($namePrefix.$methodRouteAttribute->name);
        }

        if ($uriPrefix = $controllerAttribute->prefix) {
            $route->prefix($uriPrefix);
        }

        $route->middleware([...$controllerAttribute->middleware, ...$methodRouteAttribute->middleware]);
    }

    protected function replaceResourceInfo(string $param, string $resourceName): string
    {
        return strtr($param, [
            '{name}'      => $resourceName,
            '{route_key}' => Str::singular($resourceName)
        ]);
    }
}
