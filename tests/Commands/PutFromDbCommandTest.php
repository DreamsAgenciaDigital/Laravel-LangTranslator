<?php

namespace Dreams\LangTranslatorTests\Commands;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;
use Dreams\LangTranslatorTests\Fakes\FakeTranslationModel;
use Dreams\LangTranslator\Commands\LangTranslatorPutFromDbCommand;

/**
 * Description of PutFromDbCommandtest
 *
 * @author Jorge Lopez
 */
class PutFromDbCommandtest extends TestCase
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
            LangTranslatorPutFromDbCommand::class,
            new LangTranslatorPutFromDbCommand()
        );
    }

    public function testItsWork()
    {
        $command = new LangTranslatorPutFromDbCommand();
        $this->assertTrue(
            $command->handle(
                new FakeTranslationModel(
                    'mikey',
                    'mivalue',
                    'es-es'
                )
            )
        );
    }
}