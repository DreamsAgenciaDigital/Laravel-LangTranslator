<?php

namespace Dreams\LangTranslatorTests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Illuminate\Container\Container as Container;
use Illuminate\Support\Facades\Facade as Facade;
use Dreams\LangTranslatorTests\Fakes\FakeLog;
use Dreams\LangTranslatorTests\Fakes\FakeConfig;
use Dreams\LangTranslatorTests\Fakes\FakeLang;

class TestCase extends BaseTestCase
{
    protected $app;

    protected function setUp()
    {
        parent::setUp();

        $this->app = Container::getInstance();

        /**
        * Setup a new app instance container
        *
        * @var Illuminate\Container\Container
        */
        //$this->app = new Container();
        //$this->app->singleton('app', 'Illuminate\Container\Container');

        /**
        * Set $app as FacadeApplication handler
        */
        //Facade::setFacadeApplication($this->app);

        $this->app->singleton('config', function ($app, $name) {
            return new FakeConfig($name);
        });

        $this->app->singleton('Log', function ($app) {
            return new FakeLog();
        });

        $this->app->singleton('Lang', function ($app) {
            return new FakeLang();
        });

        $this->app->singleton('path.config', function ($app, $name) {
            return 'es-es';
        });

        //function basePath() {};

        //$this->app->bindMethod('basePath', 'RealRandom');

        //$this->app->call('basePath');

        /*$this->app->singleton('translation.loader', function ($app) {
            return new FakeLoader();
        });*/
    }
}