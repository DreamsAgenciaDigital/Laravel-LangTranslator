<?php

namespace Dreams\LangTranslator\Commands;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;

class LangTranslatorPutFolderCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'langtranslator:putfolder';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:putfolder {folder?}';

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
        $folder = $this->argument('folder'); //resources/lang

        if(is_null($folder))
        {
            do
            {
                $folder = $this->ask('Write a folder to import for example resources/lang: ');
            }
            while(is_null($folder));
        }

        return LangManager::getInstance()->loadTransFromDir($folder);
    }
}
