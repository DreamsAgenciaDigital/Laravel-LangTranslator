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
    /**
     * SetUp and fake dependencies
     */
    protected function setUp()
    {
        parent::setUp();

        $this->app->singleton('translation.loader', function ($app) {
            return new FakeLoader();
        });

    }

    /**
     * @test
     * @return void
     */
    public function it_class_is_instantiable()
    {
        $this->assertInstanceOf(
            LangTranslatorDeleteKeysCommand::class,
            new LangTranslatorDeleteKeysCommand()
        );
    }

    /**
     * @test
     * @return void
     */
    public function its_work()
    {
        $command = new FakeCommand('es-es:*');
        $this->assertTrue($command->handle());
    }

    /**
     * @test
     * @return void
     */
    public function its_work_with_null_prefix()
    {
        $command = new FakeCommand();
        $this->assertTrue($command->handle());
    }
}