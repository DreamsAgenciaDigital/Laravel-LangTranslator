## IN DEVELOPMENT !! DONT USE FOR NOW!
======================================


# INSTALLATION PACKAGE

This package provide a Translator Provider for configure Laravel Translations in different storages.

* Redis
* Database
* Files
* Other implementations.

For default implements Redis. You are free to implement other storage, only need inject new provider to LangTranslator class.

```php
# Add require composer.json in each project
composer require dreams/langtranslator
```

# CONFIGURATION PACKAGE IN LARAVEL

```php
# Add to database.php config redis in laravel 3 project

'trans' => array(
    'host'       => 'X.X.X.X',
    'password'   => null,
    'port'       => 6379,
    'database'   => X
),

# Add to database.php config redis in > laravel 5 project
'trans' => [
    'host' => env('REDIS_HOST', 'localhost'),
    'password' => env('REDIS_PASSWORD', null),
    'port' => env('REDIS_PORT', 6379),
    'database' => env('REDIS_TRANS_DB', X)
],

# Add to .env config in > laravel 5 project
REDIS_TRANS_DB="X"

# Comment Translate Autoload Service Provider app.php config
Illuminate\Translation\TranslationServiceProvider::class,

# Add to Autoload Service Providers app.php config
Dreams\LangTranslator\LangTranslatorProvider::class, 

# Run dumpautoload
php composer.phar dumpautoload

# Run publish config vendor
php artisan vendor:publish --provider="Dreams\LangTranslator\LangTranslatorProvider"
```

# RUN TESTS IN DOCKER
```

Create a .env for up dev stack with next content:

IMAGE_PROXY=jwilder/nginx-proxy
IMAGE="your_php_apache_docker_image"
DNS="your_dns_resolver"
HOST="your_dev_domain"
USER="your_username"

Todos los tests => vendor/bin/phpunit --testsuite alltest
Todos los tests de una clase => vendor/bin/phpunit --testsuite alltest --filter=LangTranslatorProviderTest
Un test de una clase => vendor/bin/phpunit --testsuite alltest --filter=LangTranslatorProviderTest::it_works_boot
```
