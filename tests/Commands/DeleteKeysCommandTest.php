<?php

namespace Dreams\LangTranslatorTests\Commands;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;
use Dreams\LangTranslatorTests\Fakes\FakeCommand;
use Dreams\LangTranslator\Commands\LangTranslatorDeleteKeysCommand;

/**
 * Description of DeleteKeysCommandTest
 *
 * @author Jorge Lopez
 */
class DeleteKeysCommandTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->app->singleton('translation.loader', function ($app) {
            return new FakeLoader();
        });

    }

    public function testClassIsInstantiable()
    {
        $this->assertInstanceOf(
            LangTranslatorDeleteKeysCommand::class,
            new LangTranslatorDeleteKeysCommand()
        );
    }

    public function testItsWork()
    {
        $command = new FakeCommand();
        $this->assertTrue($command->handle());
    }
}