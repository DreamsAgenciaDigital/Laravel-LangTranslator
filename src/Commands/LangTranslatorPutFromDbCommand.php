<?php

namespace Dreams\LangTranslator\Commands;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;
use Dreams\LangTranslator\Translation;

class LangTranslatorPutFromDbCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'langtranslator:putfromdb';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:putfromdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put translates from db storage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Translation $translationModel)
    {
        return LangManager::getInstance()->loadFromDb($translationModel);
    }
}
