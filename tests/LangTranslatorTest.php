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

    public function setUp()
    {
        parent::setUp();
        $this->lang = 'es-es';
    }

    public function testClassIsInstantiable()
    {
        $this->assertInstanceOf(
            LangTranslator::class,
            new LangTranslator(
                new FakeLoader(),
                $this->lang
            )
        );
    }

    public function testItGetTranslation()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('mivalue', $translator->get('mikey'));
    }

    public function testItGetTranslationWithNamespace()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('mivalue', $translator->get('namespace::es-es.mikey'));
    }

    public function testItGetTranslationWithException()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('error connection fakeredis', $translator->get('exception'));
    }

    public function testItNotGetTranslation()
    {
        $translator = new LangTranslator(
            new FakeLoader(),
            $this->lang
        );

        $this->assertEquals('miotrakey', $translator->get('miotrakey'));
    }

    public function testItGetTranslationWithReplace()
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

    public function testItGetTranslationWithReplaceWithLocale()
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

    public function testItNotGetTranslationWithReplaceWithLocale()
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