<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\Commands\LangTranslatorDeleteKeysCommand;

class FakeCommand extends LangTranslatorDeleteKeysCommand
{
    public $key;

    public function __construct($key=null)
    {
        if(! is_null($key))
            $this->key = 'es-es:*';
    }

    public function argument($key=null)
    {
        return $this->key;
    }

    public function ask($question, $default = NULL)
    {
        return 'es-es:*';
    }
}