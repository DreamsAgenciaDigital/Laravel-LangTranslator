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
}