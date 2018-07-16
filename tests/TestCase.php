<?php

namespace Dreams\LangTranslatorTests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Illuminate\Container\Container;

class TestCase extends BaseTestCase
{
    protected $app;

    protected function setUp()
    {
        parent::setUp();

        $this->app = new Container();
    }
}