<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\LangTranslatorProvider;
use Dreams\LangTranslatorTests\Fakes\FakeLoader;

class FakeLangTranslatorProvider extends LangTranslatorProvider
{
    /**
     * Register the translation loader
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new FakeLoader('trans');
        });
    }
}