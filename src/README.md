# INSTALLATION PACKAGE

This package provide a Translator Provider for configure Laravel Translations in different storages.

* Redis
* Database
* Files
* Other implementations.

For default implements Redis. You are free to implement other storage, only need inject new provider to LangTranslator class.

```php
# Add require composer.json in each project
"require": {
    "dreams/langtranslator": "^1.0"
},

# Add to end of composer.json in each project
"repositories": [
    {
        "type": "vcs",
        "url": "https://dev.dreams.es/Packages/Laravel-LangTranslator.git"
    }
]
```

# CONFIGURATION PACKAGE IN LARAVEL

```php
# Add to database.php config redis in transactional project

'trans' => array(
    'host'       => '192.168.1.225',
    'password'   => null,
    'port'       => 6379,
    'database'   => 3
),

# Add to database.php config redis in adm,www,api and services project
'trans' => [
    'host' => env('REDIS_HOST', 'localhost'),
    'password' => env('REDIS_PASSWORD', null),
    'port' => env('REDIS_PORT', 6379),
    'database' => env('REDIS_TRANS_DB', 3)
],

# Add to .env config in adm,www,api and services project
REDIS_TRANS_DB="3"

# Comment Translate Autoload Service Provider app.php config
Illuminate\Translation\TranslationServiceProvider::class,

# Add to Autoload Service Providers app.php config
Dreams\LangTranslator\LangTranslatorProvider::class, 

# Run dumpautoload
php composer.phar dumpautoload

# Run publish config vendor
php artisan vendor:publish --provider="Dreams\LangTranslator\LangTranslatorProvider"
```