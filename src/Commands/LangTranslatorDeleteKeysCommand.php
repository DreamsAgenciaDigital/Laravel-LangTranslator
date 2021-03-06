<?php

namespace Dreams\LangTranslator\Commands;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;

class LangTranslatorDeleteKeysCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'langtranslator:deletekeys';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:deletekeys {prefix?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete translates from storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prefix = $this->argument('prefix'); // "*" to all or "es-es:*"

        if(is_null($prefix))
        {
            do
            {
                $prefix = $this->ask('Write a key "*" to all or "es-es:*" for filter key: ');
            }
            while(is_null($prefix));
        }

        return LangManager::getInstance()->deleteKeys($prefix);
    }
}