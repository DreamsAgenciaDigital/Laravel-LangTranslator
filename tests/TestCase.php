<?php

namespace Dreams\LangTranslatorTests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Illuminate\Container\Container;
use Dreams\LangTranslatorTests\Fakes\FakeConfig;

class TestCase extends BaseTestCase
{
    protected $app;

    protected function setUp()
    {
        parent::setUp();

        $this->app = Container::getInstance();

        $this->app->singleton('config', function ($app, $name) {
            return new FakeConfig($name);
        });
    }
}