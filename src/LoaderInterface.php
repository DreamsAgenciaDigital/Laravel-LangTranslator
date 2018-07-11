<?php 

namespace Dreams\LangTranslator;

interface LoaderInterface
{
    public function get(string $key);
    public function set(string $key, string $value);
    public function delete(string $key);
    public function flush();
    public function addNamespace($namespace, $hint);
}