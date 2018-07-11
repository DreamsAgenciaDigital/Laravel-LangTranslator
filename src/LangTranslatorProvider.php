<?php

namespace Dreams\LangTranslator;

use Illuminate\Support\ServiceProvider;
use Dreams\LangTranslator\LangTranslator;
use Dreams\LangTranslator\RedisLoader;
use Dreams\LangTranslator\Commands\LangTranslatorPutFileCommand;
use Dreams\LangTranslator\Commands\LangTranslatorPutFolderCommand;
use Dreams\LangTranslator\Commands\LangTranslatorDeleteKeysCommand;
use Dreams\LangTranslator\Commands\LangTranslatorPutFromDbCommand;

class LangTranslatorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();
        $this->registerCommand();

        $this->app->singleton('translator', function ($app) {

            $trans  = new LangTranslator($app['translation.loader'], $app['config']['app.locale']);

            $trans->setFallback($app['config']['app.fallback_locale']);

            return $trans;
        });
    }

    /**
     * Register the translation loader
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new RedisLoader('trans');
        });
    }

    protected function registerCommand()
    {
        $this->commands([
            LangTranslatorPutFileCommand::class,
            LangTranslatorPutFolderCommand::class,
            LangTranslatorDeleteKeysCommand::class,
            LangTranslatorPutFromDbCommand::class
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['translator', 'translation.loader'];
    }
}
