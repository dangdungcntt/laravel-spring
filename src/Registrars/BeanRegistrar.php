<?php

namespace Nddcoder\LaravelSpring\Registrars;

use Illuminate\Support\Facades\App;
use Nddcoder\LaravelSpring\Attributes\Bean;
use Nddcoder\LaravelSpring\Attributes\Configuration;
use Nddcoder\LaravelSpring\Attributes\Route\Controller;
use Nddcoder\LaravelSpring\LaravelSpring;
use Nddcoder\PhpAttributesScanner\Model\ClassInfo;
use Nddcoder\PhpAttributesScanner\Model\MethodInfo;
use Nddcoder\PhpAttributesScanner\ScanResult;

class BeanRegistrar
{
    protected static array $processedClasses = [];

    public function handle(ScanResult $scanResult): void
    {
        foreach ($scanResult->all() as $classInfo) {
            if (isset(static::$processedClasses[$classInfo->getName()])) {
                continue;
            }

            static::$processedClasses[$classInfo->getName()] = true;

            foreach ($classInfo->getAttributes() as $classAttribute) {
                if ($classAttribute instanceof Bean || $classAttribute instanceof Controller) {
                    $this->createClassBean($classInfo, $classAttribute);
                    break;
                }
            }

            foreach ($classInfo->getAttributes() as $classAttribute) {
                if ($classAttribute instanceof Configuration) {
                    collect($classInfo->getMethods())
                        ->each(function (MethodInfo $methodInfo) use ($classInfo) {
                            foreach ($methodInfo->getAttributes() as $methodAttribute) {
                                if ($methodAttribute instanceof Bean) {
                                    $this->createMethodBean($classInfo, $methodInfo, $methodAttribute);
                                }
                            }
                        });
                    break;
                }
            }
        }
    }

    protected function createClassBean(ClassInfo $classInfo, Bean|Controller $beanDefinition)
    {
        if ($beanDefinition instanceof Controller) {
            $beanDefinition = new Bean(name: $classInfo->getName(), type: $classInfo->getName());
        }
        $beanType = $beanDefinition->type ?? $classInfo->getName();
        $beanName = $beanDefinition->name ?? $classInfo->getName();

        $beanBuilder = function () use ($classInfo) {
            $params = LaravelSpring::resolveDependencies($classInfo->getConstructor()?->getParameters() ?? []);
            return $classInfo->getReflection()->newInstanceArgs($params);
        };

        LaravelSpring::addBean(
            $beanType,
            $beanName,
            $beanDefinition->primary,
            $beanBuilder
        );

        App::bind($classInfo->getName(), $beanBuilder);
    }

    protected function createMethodBean(ClassInfo $classInfo, MethodInfo $methodInfo, Bean $beanDefinition)
    {
        $beanType = $beanDefinition->type;
        $beanName = $beanDefinition->name ?? $methodInfo->getName();

        if (!$beanType) {
            $returnType = $methodInfo->getReflection()->getReturnType();
            if ($returnType instanceof \ReflectionNamedType) {
                $beanType = $returnType->getName();
            }
        }

        LaravelSpring::addBean(
            $beanType,
            $beanName,
            $beanDefinition->primary,
            function () use ($classInfo, $methodInfo) {
                $className = $classInfo->getName();
                $params    = LaravelSpring::resolveDependencies($methodInfo->getParameters());
                return app()->make($className)->{$methodInfo->getName()}(...$params);
            }
        );
    }

    public static function teardown()
    {
        static::$processedClasses = [];
    }
}
