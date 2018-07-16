<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\Translation;

class FakeTranslationModel extends Translation
{
    public $key;
    public $valuevalue;
    public $locale;

    public function __construct($key, $value, $locale)
    {
        $this->key    = $key;
        $this->value  = $value;
        $this->locale = $locale;
    }

    public function where($a, $b)
    {
        return $this;
    }

    public function get()
    {
        return array(
            new self(
                $this->key,
                $this->value,
                $this->locale
            )
        );
    }
}
