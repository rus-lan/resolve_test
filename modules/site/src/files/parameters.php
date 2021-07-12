<?php

namespace Ifmo\ResolveTest;

use TarsyClub\YamlCsFix\YamlCsFixBundle\YamlCsFixBundle;
use RusLan\ResolveTest\Site\AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;

function parameters(): array
{
    return [
        MonologBundle::class => ['envs' => ['all' => true]],
        FrameworkBundle::class => ['envs' => ['all' => true]],
        WebProfilerBundle::class => ['envs' => ['dev' => true, 'local' => true], 'routes' => true],
        TwigBundle::class => ['envs' => ['all' => true], 'routes' => true],
        AppBundle::class => ['envs' => ['all' => true], 'routes' => true],
        YamlCsFixBundle::class => ['envs' => ['local' => true]],
    ];
}
