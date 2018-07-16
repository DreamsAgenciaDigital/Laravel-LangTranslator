<?php

namespace Dreams\LangTranslator\Commands;

use Illuminate\Console\Command;
use Dreams\LangTranslator\LangManager;

class LangTranslatorAddKeyCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'langtranslator:addkey';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'langtranslator:addkey {key?} {value?} {locale?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add translate key from input';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key    = $this->argument('key');
        $value  = $this->argument('value');
        $locale = $this->argument('locale');

        if(is_null($key))
        {
            do
            {
                $key = $this->ask('Write a key');
            }
            while(is_null($key));
        }

        if(is_null($value))
        {
            do
            {
                $value = $this->ask('Write a value for the key: '.$key);
            }
            while(is_null($value));
        }

        if(is_null($locale))
        {
            do
            {
                $locale = $this->ask('Write a locale for the key: '.$key.':'.$value);
            }
            while(is_null($locale));
        }

        return LangManager::getInstance()->set($key, $value, $locale);
    }
}