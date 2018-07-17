<?php

namespace Dreams\LangTranslatorTests;

use Dreams\LangTranslatorTests\TestCase;
use Dreams\LangTranslatorTests\Fakes\FakeTranslationModel;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;
use Dreams\LangTranslator\LangManager;

/**
 * Description of LangManagerTest
 *
 * @author Jorge Lopez
 */
class LangManagerTest extends TestCase
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
            LangManager::class,
            LangManager::getInstance()
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_load_from_db()
    {
        $langManager = LangManager::getInstance();

        $this->assertTrue(
            $langManager->loadFromDb(
                new FakeTranslationModel('mikey','mivalue','es-es')
            )
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_load_from_db_and_returns_false()
    {
        $langManager = LangManager::getInstance();

        $this->assertFalse(
            $langManager->loadFromDb(
                new FakeTranslationModel('payloadfalse','mivalue','es-es')
            )
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_set_key_value_and_locale()
    {
        $this->assertTrue(
            LangManager::getInstance()->set('mikey', 'mivalue', 'es-es')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_set_key_value_without_locale()
    {
        $this->assertTrue(
            LangManager::getInstance()->set('mikey', 'mivalue')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_set_key_value_with_namespace()
    {
        $this->assertTrue(
            LangManager::getInstance()->set('namespace::es-es.mikey', 'mivalue')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_set_key_value_with_namespace_and_returns_false()
    {
        $this->assertFalse(
            LangManager::getInstance()->set('amespace::namespace::es-es.asdas.mikey', 'mivalue')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_set_key_value_and_not_set()
    {
        $this->assertFalse(
            LangManager::getInstance()->set('payloadfalse', 'mivalue')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_with_locale()
    {
        $this->assertTrue(
            LangManager::getInstance()->delete('mikey', 'es-es')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_with_locale_and_returns_false()
    {
        $this->assertFalse(
            LangManager::getInstance()->delete('payloadfalse', 'es-es')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_with_locale_and_generate_exception_and_returns_false()
    {
        $this->assertFalse(
            LangManager::getInstance()->delete('exception', 'es-es')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_without_locale()
    {
        $this->assertTrue(
            LangManager::getInstance()->delete('mikey')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_by_prefix()
    {
        $this->assertTrue(
            LangManager::getInstance()->deleteKeys('es-es:')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_by_prefix_and_not_set()
    {
        $this->assertFalse(
            LangManager::getInstance()->deleteKeys('payloadfalse', 'mivalue')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_key_by_prefix_and_generate_exception_and_returns_false()
    {
        $this->assertFalse(
            LangManager::getInstance()->deleteKeys('exception')
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_delete_keys_with_wildcard()
    {
        $this->assertTrue(
            LangManager::getInstance()->deleteKeys('*')
        );
    }
}