<?php

namespace Dreams\LangTranslatorTests;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;
use Dreams\LangTranslator\LangTranslator;

/**
 * Description of LangTranslatorTest
 *
 * @author Jorge Lopez
 */
class LangTranslatorTest extends TestCase
{
    private $lang;

    /**
     * SetUp and fake dependencies
     */
    public function setUp()
    {
        parent::setUp();
        $this->lang = 'es-es';
    }

    /**
     * @test
     * @return void
     */
    public function it_class_is_instantiable()
    {
        $this->assertInstanceOf(
            LangTranslator::class,
            new LangTranslator(
                new FakeLoader(),
                $this->lang
            )
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_get_translation_with_key()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('mivalue', $translator->get('mikey'));
    }

    /**
     * @test
     * @return void
     */
    public function it_get_translation_with_namespace()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('mivalue', $translator->get('namespace::es-es.mikey'));
    }

    /**
     * @test
     * @return void
     */
    public function it_get_translation_and_get_exception_if_redis_is_offline()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('error connection fakeredis', $translator->get('exception'));
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_key_when_not_found_key()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('miotrakey', $translator->get('miotrakey'));
    }

    /**
     * @test
     * @return void
     */
    public function it_get_translation_with_replacements()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals(
            'mivalue',
            $translator->get(
                'mikey',
                ['replace' => 'replace']
            )
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_get_translations_with_replacements_and_locale()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals(
            'mivalue',
            $translator->get(
                'mikey',
                ['replace' => 'replace'],
                'en-gb'
            )
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_returns_key_when_not_found_key_with_replacements_and_locale()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals(
            'mikey',
            $translator->get(
                'mikey',
                ['replace' => 'replace'],
                'fr-fr'
            )
        );
    }
}