<?php

namespace Nddcoder\LaravelSpring;

use Nddcoder\LaravelSpring\Attributes\Autowire;
use Nddcoder\PhpAttributesScanner\Model\ParameterInfo;
use RuntimeException;

class LaravelSpring
{
    protected static array $beans = [];
    protected static array $primaryBeanNameByClassName = [];

    public static function addBean(?string $type, string $name, bool $isPrimary, \Closure $builder)
    {
        if (isset(static::$beans[$name])) {
            throw new RuntimeException('Duplicate bean '.$name);
        }

        static::$beans[$name] = $builder;

        if (is_null($type)) {
            return;
        }

        if (!isset(static::$primaryBeanNameByClassName[$type])) {
            static::$primaryBeanNameByClassName[$type] = $name;
            return;
        }

        if ($isPrimary) {
            throw new RuntimeException('Duplicate primary bean for type '.$type);
        }
    }

    public static function beanExists(?string $name): bool
    {
        return isset(static::$beans[$name]);
    }

    public static function getPrimaryBeanName(string $className): ?string
    {
        return static::$primaryBeanNameByClassName[$className] ?? null;
    }

    public static function getBean(string $name): mixed
    {
        if (!isset(static::$beans[$name])) {
            throw new RuntimeException("Bean $name not found");
        }

        $builder = static::$beans[$name];

        return $builder();
    }

    /**
     * @param  array<\Nddcoder\PhpAttributesScanner\Model\ParameterInfo>  $parameterInfos
     * @return array
     */
    public static function resolveDependencies(array $parameterInfos): array
    {
        $results = [];

        foreach ($parameterInfos as $parameterInfo) {
            $results[] = static::makeParam($parameterInfo);
        }

        return $results;
    }


    protected static function makeParam(ParameterInfo $parameterInfo)
    {
        $type      = $parameterInfo->getType();
        $className = null;
        if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
            $className = $type->getName();
        }

        foreach ($parameterInfo->getAttributes() as $attribute) {
            if ($attribute instanceof Autowire) {
                $beanName = $attribute->beanName ?? $parameterInfo->getName();
                if (!static::beanExists($beanName)) {
                    $beanName = static::$primaryBeanNameByClassName[$className] ?? null;
                }
                if (static::beanExists($beanName)) {
                    return static::getBean($beanName);
                }

                if (config('spring.fallback_bean_to_laravel_container')) {
                    return app()->make($className);
                }

                throw new RuntimeException("Cannot find Bean for class $className");
            }
        }

        if ($className) {
            return app()->make($className);
        }

        throw new RuntimeException("Cannot resolve $".$parameterInfo->getName());
    }

    public static function teardown()
    {
        static::$beans                      = [];
        static::$primaryBeanNameByClassName = [];
    }
}
