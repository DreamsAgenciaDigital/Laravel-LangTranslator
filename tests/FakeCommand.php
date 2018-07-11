<?php

namespace Dreams\LangTranslatorFakes;

use Dreams\LangTranslator\Commands\LangTranslatorDeleteKeysCommand;

class FakeCommand extends LangTranslatorDeleteKeysCommand
{
    public function argument($key=null)
    {
        return 'es-es';
    }
}
