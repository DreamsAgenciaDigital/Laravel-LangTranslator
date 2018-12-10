<?php

namespace Dreams\LangTranslatorTests;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslator\LangTranslatorProvider;
use Dreams\LangTranslatorTests\Fakes\FakeLangTranslatorProvider;

/**
 * Description of LangManagerTest
 *
 * @author Jorge Lopez
 */
class LangTranslatorProviderTest extends TestCase
{
    private $class;

    /**
     * SetUp and fake dependencies
     */
    protected function setUp()
    {
        parent::setUp();

        $this->class = new LangTranslatorProvider($this->app);
    }

    /**
     * @test
     * @return void
     */
    public function it_class_is_instantiable()
    {
        $this->assertInstanceOf(
            LangTranslatorProvider::class,
            $this->class
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_works_boot()
    {
        $this->class->boot();

        $this->assertInstanceOf(
            LangTranslatorProvider::class,
            $this->class
        );
        $this->assertTrue(true);
    }

    /**
     * @test
     * @return void
     */
    public function it_works_register()
    {
        $class = new FakeLangTranslatorProvider($this->app);
        $class->register();

        $this->assertInstanceOf(
            LangTranslatorProvider::class,
            $class
        );
        $this->assertTrue(true);
    }

    /**
     * @test
     * @return void
     */
    public function it_works_provides()
    {
        $this->class->provides();

        $this->assertInstanceOf(
            LangTranslatorProvider::class,
            $this->class
        );
        $this->assertTrue(true);
    }
}