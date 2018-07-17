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
     * @return void
     */
    public function it_works_lang_helper()
    {
        $this->assertSame(
            'mivalue',
            lang('tst-tst.key')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_works_lang_helper_and_not_found_trans_and_return_key()
    {
        $this->assertSame(
            'tst-tst.abc',
            lang('tst-tst.abc')
        );
    }
}