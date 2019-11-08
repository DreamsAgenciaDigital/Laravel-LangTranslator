<?php

namespace Dreams\LangTranslatorTests\Commands;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;
use Dreams\LangTranslatorTests\Fakes\FakePutFileCommand;
use Dreams\LangTranslator\Commands\LangTranslatorPutFileCommand;

/**
 * Description of DeleteKeysCommandTest
 *
 * @author Jorge Lopez
 */
class PutFileCommandTest extends TestCase
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
            LangTranslatorPutFileCommand::class,
            new LangTranslatorPutFileCommand()
        );
    }

    /**
     * @test
     * @return void
     */
    public function its_work()
    {
        $command = new FakePutFileCommand();
        $this->assertTrue($command->handle());
    }
}