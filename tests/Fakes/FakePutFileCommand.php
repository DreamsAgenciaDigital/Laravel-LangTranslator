<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\Commands\LangTranslatorPutFileCommand;

class FakePutFileCommand extends LangTranslatorPutFileCommand
{
    public $namespace;
    public $filePath;
    public $locale;

    public function __construct()
    {
        $this->namespace = 'othertest-othertest';
        $this->filePath  = '/var/www/html/tests/Fakes/fakeslang/othertest-othertest/generic.php';
        $this->locale    = 'othertest-othertest';
    }

    public function argument($key=null)
    {
        if($key==='namespace')
            return $this->namespace;

        if($key==='filePath')
            return $this->filePath;

        if($key==='locale')
            return $this->locale;
    }

    public function ask($question, $default = NULL)
    {
        return 'es-es:*';
    }
}