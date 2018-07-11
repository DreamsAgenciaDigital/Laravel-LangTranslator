<?php

use Dreams\LangTranslator\LangManager;
use Dreams\LangTranslatorFakes\FakeTranslationModel;
use Dreams\LangTranslatorFakes\FakeLoader;

/**
 * Description of LangManagerTest
 *
 * @author jorge
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
