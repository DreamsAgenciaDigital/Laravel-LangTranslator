<?php

if (! function_exists('lang'))
{
    function lang($key, array $replace = [], $locale = null, $fallback = true)
    {
        return app('Lang')->get($key, $replace, $locale, $fallback);
    }
}