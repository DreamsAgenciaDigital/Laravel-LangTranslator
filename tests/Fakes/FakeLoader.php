<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\LoaderInterface;
use InvalidArgumentException;

class FakeLoader implements LoaderInterface
{
    public function get(string $key)
    {
        if($key==='namespace:es-es:mikey' || $key==='es-es:mikey' || $key==='en-gb:mikey')
        {
            return base64_encode('mivalue');
        }
        else if($key==='es-es:exception')
        {
            throw new InvalidArgumentException('error connection fakeredis');
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