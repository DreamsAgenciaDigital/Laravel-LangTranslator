<?php

namespace Dreams\LangTranslator;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;

class LangTranslatorPutFolderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:putfolder {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put translates from folder to storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $folder    = $this->argument('folder'); //resources/lang

        $state = LangManager::getInstance()->loadTransFromDir($folder);

        if(! $state)
            return false;

        return true;
    }
}
