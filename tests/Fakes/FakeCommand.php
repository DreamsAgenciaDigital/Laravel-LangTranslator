<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\Commands\LangTranslatorDeleteKeysCommand;

class FakeCommand extends LangTranslatorDeleteKeysCommand
{
    public function argument($key=null)
    {
        return 'es-es:*';
    }

    public function ask($key=null)
    {
        return 'es-es:*';
    }
}