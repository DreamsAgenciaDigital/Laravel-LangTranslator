<?php

namespace Dreams\LangTranslatorTests\Fakes;

class FakeLang
{
    public static function get($key, $replace, $locale, $fallback)
    {
        if($key==='tst-tst.key')
            return 'mivalue';

        return $key;
    }
}