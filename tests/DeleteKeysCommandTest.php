<?php

use Dreams\LangTranslator\Commands\LangTranslatorDeleteKeysCommand;
use Dreams\LangTranslatorFakes\FakeLoader;
use Dreams\LangTranslatorFakes\FakeCommand;

/**
 * Description of LangManagerTest
 *
 * @author jorge
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