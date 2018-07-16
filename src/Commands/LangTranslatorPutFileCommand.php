<?php

namespace Dreams\LangTranslator\Commands;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;

class LangTranslatorPutFileCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'langtranslator:putfile';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:putfile {namespace?} {filePath?} {locale?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put translates from file to storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $namespace = $this->argument('namespace'); // languagebuilder::languagebuilder
        $filePath  = $this->argument('filePath'); // packages/asanzred/languagebuilder/src/language/en/languagebuilder.php
        $locale    = $this->argument('locale'); // en, en-gb

        if(is_null($namespace))
        {
            do
            {
                $namespace = $this->ask('Write a namespace for example, languagebuilder::languagebuilder');
            }
            while(is_null($namespace));
        }

        if(is_null($filePath))
        {
            do
            {
                $filePath = $this->ask('Write a filepath for example, packages/asanzred/languagebuilder/src/language/en/languagebuilder.php');
            }
            while(is_null($filePath));
        }

        if(is_null($locale))
        {
            do
            {
                $locale = $this->ask('Write a locale for example, es-es');
            }
            while(is_null($locale));
        }

        return LangManager::getInstance()->loadTransFromFile($namespace, $filePath, $locale);
    }
}