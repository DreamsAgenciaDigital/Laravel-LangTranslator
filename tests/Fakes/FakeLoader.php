<?php

namespace Dreams\LangTranslatorTests\Fakes;

use Dreams\LangTranslator\LoaderInterface;
use InvalidArgumentException;

class FakeLoader implements LoaderInterface
{
    private $key;
    private $value;

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
        $this->key   = $key;
        $this->value = $value;

        return $this;
    }

    public function delete(string $key)
    {
        if($key==='es-es:exception')
            throw new \Exception("Error Processing Request", 1);

        if($key==='es-es:payloadfalse')
            return false;

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
        if($this->key==='es-es:payloadfalse')
            return false;

        return "OK";
    }

    public function keys($prefix)
    {
        if($prefix==='exception')
            throw new \Exception("Error Processing Request", 1);

        if($prefix==='payloadfalse')
            return array('es-es:'.$prefix);

        return array('es-es','en-gb');
    }
}