<?php

namespace Dreams\LangTranslator;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;

class LangTranslatorPutFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:putfile {namespace} {filePath} {locale}';

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

        $state = LangManager::getInstance()->loadTransFromFile($namespace, $filePath, $locale);

        if(! $state)
            return false;

        return true;
    }
}
