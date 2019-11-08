<?php

namespace Dreams\LangTranslatorTests;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslator\LangTranslatorProvider;
use Dreams\LangTranslatorTests\Fakes\FakeLang;
/**
 * Description of LangTranslatorTest
 *
 * @author Jorge Lopez
 */
class LangTranslatorHelperTest extends TestCase
{
    /**
     * SetUp and fake dependencies
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @test
     * @expectedException \Error
     * @return void
     */
    public function it_works_lang_helper()
    {
        lang('tst-tst.key');

        /*$this->assertSame(
            'mivalue',
            lang('tst-tst.key')
        );*/
    }
}