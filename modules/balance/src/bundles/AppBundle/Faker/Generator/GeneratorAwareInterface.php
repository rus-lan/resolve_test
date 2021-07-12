<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Faker\Generator;

if (!class_exists('\\Faker\\Generator')) {
    return 0;
}

interface GeneratorAwareInterface
{
    public function getGenerator(): ?\Faker\Generator;

    /**
     * @param \Faker\Generator|null $generator
     *
     * @return static
     */
    public function setGenerator(?\Faker\Generator $generator = null);
}
