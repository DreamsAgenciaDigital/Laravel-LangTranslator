<?php

namespace Dreams\LangTranslator;

use Illuminate\Translation\Translator;
use Dreams\LangTranslator\LoaderInterface;
use Exception;

class LangTranslator extends Translator
{
    // FYI view this file => namespace Illuminate\Translation\Translator
    // FYI view this file => namespace Symfony\Component\Translation\TranslatorInterface
    // FYI view this file => namespace Illuminate\Translation\TranslationServiceProvider
    /**
     * The loader implementation.
     *
     * @var \Illuminate\Translation\LoaderInterface
     */
    protected $loader;

    /**
     * The default locale being used by the translator.
     *
     * @var string
     */
    protected $locale;

    /**
     * The fallback locale used by the translator.
     *
     * @var string
     */
    protected $fallback;

    /**
     * The array of loaded translation groups.
     *
     * @var array
     */
    protected $loaded = [];

    /**
     * Create a new translator instance.
     *
     * @param  \Illuminate\Translation\LoaderInterface  $loader
     * @param  string  $locale
     * @return void
     */
    public function __construct(LoaderInterface $loader, string $locale)
    {
        $this->loader = $loader;
        $this->locale = $locale;
    }

    /**
     * Get the translation for the given key.
     *
     * @param  string  $key
     * @param  array   $replace
     * @param  string|null  $locale
     * @param  bool  $fallback
     * @return string
     */
    public function get($key, array $replace = [], $locale = null, $fallback = true)
    {
        $line   = null;
        $locale = ($locale) ? $locale : $this->locale;

        if(strpos($key, '::'))
        {
            $namespace = explode('::', $key)[0].':';
            $locale    = explode('.', explode('::', $key)[1])[0];
            $key       = explode($namespace.':'.$locale.'.', $key)[1];
        }
        else
            $namespace = '';

        try
        {
            $line = base64_decode($this->loader->get($namespace.$locale.':'.$key));
            $line = $this->makeReplacements($line, $replace);

            if(! $line)
                return $key;

            return $line;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Override laravel original function to get
     * translations from REDIS
     * Get from JSON File it not supported with
     * this package, only REDIS
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string  $locale
     * @return string|array|null
     */
    public function getFromJson($key, array $replace = [], $locale = null)
    {
        $line   = null;
        $locale = ($locale) ? $locale : $this->locale;

        if(strpos($key, '::'))
        {
            $namespace = explode('::', $key)[0].':';
            $locale    = explode('.', explode('::', $key)[1])[0];
            $key       = explode($namespace.':'.$locale.'.', $key)[1];
        }
        else
            $namespace = '';

        try
        {
            $line = base64_decode($this->loader->get($namespace.$locale.':'.$key));
            $line = $this->makeReplacements($line, $replace);

            if(! $line)
                return $key;

            return $line;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

    /**
     * Get a translation according to an integer value.
     *
     * @param  string  $key
     * @param  int|array|\Countable  $number
     * @param  array   $replace
     * @param  string  $locale
     * @return string
     */
    public function transChoice($key, $number, array $replace = [], $locale = null)
    {
        throw new Exception("Not implemented yet!", 1);
    }

    /**
     * Get a translation according to an integer value.
     *
     * @param  string  $key
     * @param  int|array|\Countable  $number
     * @param  array   $replace
     * @param  string  $locale
     * @return string
     */
    public function choice($key, $number, array $replace = [], $locale = null)
    {
        throw new Exception("Not implemented yet!", 1);
    }

    /**
     * Add translation lines to the given locale.
     *
     * @param  array  $lines
     * @param  string  $locale
     * @param  string  $namespace
     * @return void
     */
    public function addLines(array $lines, $locale, $namespace = '*')
    {
        throw new Exception("Not implemented yet!", 1);
    }

    /**
     * Add a new JSON path to the loader.
     *
     * @param  string  $path
     * @return void
     */
    public function addJsonPath($path)
    {
       throw new Exception("Not implemented yet!", 1);
    }

    /**
     * Parse a key into namespace, group, and item.
     *
     * @param  string  $key
     * @return array
     */
    public function parseKey($key)
    {
        throw new Exception("Not implemented yet!", 1);
    }
}
