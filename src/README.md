# INSTALLATION PACKAGE

This package provide a Translator Provider for configure Laravel Translations in different storages.

* Redis
* Database
* Files
* Other implementations.

For default implements Redis. You are free to implement other storage, only need inject new provider to LangTranslator class.

```php
# Add to psr-4 composer.json in each project
"psr-4": {
    "Dreams\\LangTranslator\\": "packages/dreams/langtranslator/src"
}

# Add to composer.json in adm project
# This add translations from files to redis when dumpautoload project
# It's recommended add this to boot start server
"post-autoload-dump": [
    "php artisan langtranslator:putfile languagebuilder::languagebuilder packages/asanzred/languagebuilder/src/language/en-gb/languagebuilder.php en-gb",
    "php artisan langtranslator:putfile languagebuilder::languagebuilder packages/asanzred/languagebuilder/src/language/en/languagebuilder.php en",
    "php artisan langtranslator:putfolder resources/lang"
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
```