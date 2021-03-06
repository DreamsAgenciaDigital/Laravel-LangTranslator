<?php

namespace Dreams\LangTranslator;

use Dreams\LangTranslator\LoaderInterface;
use Dreams\LangTranslator\Models\Translation;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Exception;
use InvalidArgumentException;

class LangManager
{
    /**
     * The Singleton Instance
     *
     * @var App\Libraries\DrsLangTranslator\LangManager
     */
    private static $instance = NULL;

    /**
     * The loader implementation.
     *
     * @var \App\Libraries\DrsLangTranslator\LoaderInterface
     */
    protected $loader;

    /**
     * The default locale being used by the translator.
     *
     * @var string
     */
    protected $locale;

    /**
     * Logger
     * @var \Monolog\Logger
     */
    protected $log;

    /**
     * Create a new private LangManager instance.
     *
     * @param  \Illuminate\Translation\LoaderInterface  $loader
     * @param  string  $locale
     * @return void
     */
    private function __construct(LoaderInterface $loader, string $locale)
    {
        $this->loader = $loader;
        $this->locale = $locale;
        $this->startLogger();
    }

    /**
     * Disable public clone
     */
    private function __clone() { }

    /**
     * Check if DreamsRedisLoader is configured
     * @return boolean
     */
    public static function isActive()
    {
        if(get_class(app('translation.loader')) == 'Dreams\LangTranslator\RedisLoader')
            return true;

        return false;
    }

    /**
     * Instance of LangManager object with injections
     * @return App\Libraries\DrsLangTranslator\LangManager
     */
    public static function getInstance()
    {
        if(! self::isActive())
            throw new Exception('Dreams\LangTranslator\RedisLoader not configured!');

        if (is_null(self::$instance)) {
            self::$instance = new LangManager(app('translation.loader'), config('app.locale'));
        }

        return self::$instance;
    }

    private function startLogger()
    {
        if(__DIR__ === '/var/www/html/src')
        {
            $logDir = '/var/www/html/logs';
        }
        else
        {
            $logDir = __DIR__ . '/../../../../storage/logs';
        }

        if(! file_exists($logDir))
        {
            mkdir($logDir);
        }

        $this->log    = new Logger('LangManager');
        $this->log->pushHandler(new StreamHandler($logDir.'/langmanager.log', Logger::WARNING));
    }

    /**
     * Save Language Translate
     * @param string $key
     * @param string $value
     * @param string|null $locale
     * @return boolean
     */
    public function set(string $key, string $value, $locale = null)
    {
        $locale = ($locale) ? $locale : $this->locale;

        try
        {
            if(strpos($key, '::'))
            {
                $namespace = explode('::', $key)[0].':';
                $locale    = explode('.', explode('::', $key)[1])[0];
                $key       = explode($namespace.':'.$locale.'.', $key)[1];
            }
            else
                $namespace = '';

            $status = $this->loader->set($namespace.strtolower($locale).':'.$key, base64_encode($value));

            if($status->getPayload() != 'OK')
                return false;

            return true;
        }
        catch(Exception $e)
        {
            $this->log->error($e->getMessage());
            return false;
        }
    }

    /**
     * Get Language Translates from file and save
     * @param  string $fileName
     * @param  string $filePath
     * @param  string|null $locale
     * @return boolean
     */
    public function loadTransFromFile(string $fileName, string $filePath, $locale = null)
    {
        $locale           = ($locale) ? $locale : $this->locale;
        //** $filePathOriginal = $filePath;
        $expression       = str_replace('/', '\/', $filePath);

        //** if(! preg_match("/".$expression."/", $filePath))
        //**     $filePath = base_path($filePath);
        //** else
        //**     $filePath = $filePathOriginal;

        //** Se comenta para que siempre sea ruta absoluta

        try
        {
            if(! file_exists($filePath))
                return false;

            foreach (include $filePath as $key => $value)
            {
                if(is_array($value))
                {
                    foreach ($value as $key2 => $value2)
                    {
                        if(is_array($value2))
                            throw new InvalidArgumentException();

                        $this->set($fileName.'.'.$key.'.'.$key2, $value2, $locale);
                    }
                }
                else
                {
                    $this->set($fileName.'.'.$key, $value, $locale);
                }
            }

            return true;
        }
        catch(Exception $e)
        {
            $this->log->error($e->getMessage());
            return false;
        }
    }

    /**
     * Scan dir and load trans from each file found
     * @param  string $dirPath
     * @return boolean
     */
    public function loadTransFromDir(string $dirPath)
    {
        try
        {
            $baseFolder    = $dirPath; //base_path($dirPath); //** Se comenta para que siempre sea ruta absoluta
            $notprocessing = array('..', '.');
            $langs         = array_diff(scandir($baseFolder), $notprocessing);

            foreach ($langs as $lang)
            {
                $files = array_diff(scandir($baseFolder.'/'.$lang), $notprocessing);

                foreach ($files as $file)
                {
                    $path = $dirPath.'/'.$lang.'/'.$file;
                    $file = str_replace('.php', '', $file);
                    $this->loadTransFromFile($file, $path, $lang);
                }
            }

            return true;
        }
        catch(Exception $e)
        {
            $this->log->error($e->getMessage());
            return false;
        }
    }

    /**
     * Load Translates from DB to Redis Storage
     * Need a TranslationModel
     * @param Translation $translationsModel
     */
    public function loadFromDb(Translation $translationsModel)
    {
        $translates = $translationsModel->where('status', 1)->get();

        foreach ($translates as $trans)
        {
            $status = $this->set($trans->key, $trans->value, $trans->locale);

            if(! $status)
            {
                $this->log->error('Error al guardar la traduccion:'.$trans->key);
                return false;
            }
        }

        return true;
    }

    /**
     * Delete a Language Translate
     * @param  string $key
     * @param  string|null $locale
     * @return boolean
     */
    public function delete(string $key, $locale = null)
    {
        $locale = ($locale) ? $locale : $this->locale;

        try
        {
            $status = $this->loader->delete($locale.':'.$key);

            if(! $status)
                return false;

            return true;
        }
        catch(Exception $e)
        {
            $this->log->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete all keys from storage
     * @param  string $prefix
     * @return boolean
     */
    public function deleteKeys(string $prefix)
    {
        try
        {
            if($prefix === '*')
            {
                $status = $this->loader->flush();
            }
            else
            {
                $keys = $this->loader->keys($prefix);

                foreach ($keys as $key)
                {
                    $status = $this->loader->delete($key);
                }
            }

            if(! $status)
                return false;

            return true;
        }
        catch(Exception $e)
        {
            $this->log->error($e->getMessage());
            return false;
        }
    }
}
