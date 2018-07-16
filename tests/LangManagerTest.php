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
            LangManager::class,
            LangManager::getInstance()
        );
    }

    public function testIfLoadFromDb()
    {
        $langManager = LangManager::getInstance();

        $this->assertTrue(
            $langManager->loadFromDb(
                new FakeTranslationModel('mikey','mivalue','es-es')
            )
        );
    }

    public function testItSet()
    {
        $this->assertTrue(
            LangManager::getInstance()->set('mikey', 'mivalue', 'es-es')
        );
    }

    public function testItSetWithoutLocale()
    {
        $this->assertTrue(
            LangManager::getInstance()->set('mikey', 'mivalue')
        );
    }

    public function testItDelete()
    {
        $this->assertTrue(
            LangManager::getInstance()->delete('mikey', 'es-es')
        );
    }

    public function testItDeleteWithoutLocale()
    {
        $this->assertTrue(
            LangManager::getInstance()->delete('mikey')
        );
    }

    public function testItDeleteKeys()
    {
        $this->assertTrue(
            LangManager::getInstance()->deleteKeys('es-es:')
        );
    }

    public function testItDeleteKeysWildcard()
    {
        $this->assertTrue(
            LangManager::getInstance()->deleteKeys('*')
        );
    }
}
