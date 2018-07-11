<?php

namespace Dreams\LangTranslatorFakes;

use Dreams\LangTranslator\LoaderInterface;

class FakeLoader implements LoaderInterface
{
    public function get(string $key)
    {
        if($key==='es-es:mikey' || $key==='en-gb:mikey')
        {
            return base64_encode('mivalue');
        }
        else
        {
            return null;
        }
    }

    public function set(string $key, string $value)
    {
        return $this;
    }

    public function delete(string $key)
    {
        return true;
    }

    public function flush()
    {
        return true;
    }

    public function addNamespace($namespace, $hint)
    {
        return true;
    }

    public function getPayload()
    {
        return "OK";
    }

    public function keys()
    {
        return array('es-es','en-gb');
    }
}