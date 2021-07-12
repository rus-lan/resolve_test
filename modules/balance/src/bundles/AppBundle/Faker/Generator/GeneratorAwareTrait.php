<?php

namespace RusLan\ResolveTest\Balance\AppBundle\Faker\Generator;

if (!class_exists('\\Faker\\Generator')) {
    return 0;
}

trait GeneratorAwareTrait
{
    /**
     * @var \Faker\Generator|null
     */
    protected $generator;

    public function getGenerator(): ?\Faker\Generator
    {
        return $this->generator;
    }

    /**
     * @param \Faker\Generator|null $generator
     *
     * @return static
     */
    public function setGenerator(?\Faker\Generator $generator = null)
    {
        $this->generator = $generator;

        return $this;
    }
}
