<?php

namespace Dreams\LangTranslatorTests\Commands;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;
use Dreams\LangTranslatorTests\Fakes\FakeAddKeyCommand;
use Dreams\LangTranslator\Commands\LangTranslatorAddKeyCommand;

/**
 * Description of DeleteKeysCommandTest
 *
 * @author Jorge Lopez
 */
class AddKeyCommandTest extends TestCase
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
            LangTranslatorAddKeyCommand::class,
            new LangTranslatorAddKeyCommand()
        );
    }

    /**
     * @test
     * @return void
     */
    public function its_work()
    {
        $command = new FakeAddKeyCommand();
        $this->assertTrue($command->handle());
    }
}