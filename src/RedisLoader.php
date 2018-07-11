<?php 

namespace Dreams\LangTranslator;

use Dreams\LangTranslator\LoaderInterface;
use Illuminate\Support\Facades\Redis;

class RedisLoader implements LoaderInterface
{
    /**
     * Recdis implementation with connection.
     *
     * @var \Illuminate\Support\Facades\Redis
     */
    private $instance;

    /**
     * All of the namespace hints.
     *
     * @var array
     */
    protected $hints = [];

    /**
     * Create a new RedisLoader instance.
     * @param string $connectionName
     * @return void
     */
    public function __construct(string $connectionName)
    {
        $this->instance = Redis::connection($connectionName);
    }

    /**
     * Get a Language Translate from Redis Implementation
     * @param  string $key
     * @return string
     */
    public function get(string $key)
    {
        return $this->instance->get($key);
    }

    /**
     * Save a Language Translate from Redis Implementation
     * @param string $key
     * @param string $value
     * @return string
     */
    public function set(string $key, string $value)
    {
        return $this->instance->set($key, $value);
    }

    /**
     * Delete a Language Translate from Redis Implementation
     * @param  string $key
     * @return string
     */
    public function delete(string $key)
    {
        return $this->instance->del($key);
    }

    /**
     * Delete all keys from Redis Implementation
     * @return string
     */
    public function flush()
    {
        return $this->instance->flushAll();
    }

    /**
     * Get Keys from Redis Implementation
     * @param  string|null $key
     * @return string
     */
    public function keys($prefix=null)
    {
        if($prefix)
            return $this->instance->keys($prefix);
        else
            return $this->instance->keys('*');
    }

    /**
     * Add a new namespace to the loader.
     *
     * @param  string  $namespace
     * @param  string  $hint
     * @return void
     */
    public function addNamespace($namespace, $hint)
    {
        $this->hints[$namespace] = $hint;
    }
}