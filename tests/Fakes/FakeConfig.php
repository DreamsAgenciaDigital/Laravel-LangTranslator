<?php

namespace Dreams\LangTranslatorTests\Fakes;

class FakeConfig
{
    public function get($name)
    {
        return 'es-es';
    }
}