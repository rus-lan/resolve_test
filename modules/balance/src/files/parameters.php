<?php

namespace Ifmo\ResolveTest;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use TarsyClub\ContainerBundle\ContainerBundle;
use TarsyClub\YamlCsFix\YamlCsFixBundle\YamlCsFixBundle;
use RusLan\ResolveTest\Balance\AppBundle\AppBundle;
use RusLan\ResolveTest\Balance\ConfiguratorBundle\ConfiguratorBundle;
use Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Yoanm\SymfonyJsonRpcHttpServer\JsonRpcHttpServerBundle;
use Yoanm\SymfonyJsonRpcHttpServerDoc\JsonRpcHttpServerDocBundle;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\JsonRpcHttpServerOpenAPIDocBundle;
use Yoanm\SymfonyJsonRpcParamsSfConstraintsDoc\JsonRpcParamsSfConstraintsDocBundle;
use Yoanm\SymfonyJsonRpcParamsValidator\JsonRpcParamsValidatorBundle;

function parameters(): array
{
    return [
        MonologBundle::class => ['envs' => ['all' => true]],
        FrameworkBundle::class => ['envs' => ['all' => true]],
        WebProfilerBundle::class => ['envs' => ['dev' => true, 'local' => true], 'routes' => true],
        TwigBundle::class => ['envs' => ['all' => true], 'routes' => true],
        DoctrineBundle::class => ['envs' => ['all' => true]],
        DoctrineMigrationsBundle::class => ['envs' => ['all' => true]],
        DoctrineFixturesBundle::class => ['envs' => ['test' => true, 'dev' => true, 'local' => true]],
        StofDoctrineExtensionsBundle::class => ['envs' => ['all' => true]],
        AppBundle::class => ['envs' => ['all' => true], 'routes' => true],
        YamlCsFixBundle::class => ['envs' => ['local' => true]],
        JsonRpcHttpServerBundle::class => ['envs' => ['all' => true]],
        JsonRpcParamsValidatorBundle::class => ['envs' => ['all' => true]],
        JsonRpcHttpServerDocBundle::class => ['envs' => ['all' => true]],
        JsonRpcHttpServerOpenAPIDocBundle::class => ['envs' => ['all' => true]],
        JsonRpcParamsSfConstraintsDocBundle::class => ['envs' => ['all' => true]],
    ];
}
