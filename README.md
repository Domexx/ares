## Ares

[![CodeFactor](https://www.codefactor.io/repository/github/domexx/ares/badge/master)](https://www.codefactor.io/repository/github/domexx/ares/overview/master) [![GitHub license](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)](https://github.com/Domexx/aresd/blob/master/LICENSE) 
==========================

## Introduction
This project is based on the micro framework slim.
It can be used for creating and expanding fast apis.

## Base Features:
- Responses
- Exceptions
- Validation
- Authentication
- Locales & Translations
- Cache
- Request Throttle
- Database
- Illuminate QueryBuilder
- Slugs
- Configs
- Dotenv
- Logging
- DI Container
- Routing (Slim)

## Installation

##### 1. Clone / Require project. 
```console
$ git clone https://github.com/Domexx/ares.git
or
$ composer require domexx/ares
```
##### 2. Change directory to project.
```console
$ cd ares
```
##### 3. Copy dotenv config.
```console
$ cp .env.example .env 
```
##### 4. Install composer dependencies.
```console
$ composer install 
```
##### 5. Give rights to the folder.
```console
$ chmod -R 775 {dir name} 
```

## Configuration
##### Configure your .env:

```text
# Database Credentials
DB_HOST=db
DB_PORT=db
DB_NAME="ares"
DB_USER="ares"
DB_PASSWORD="your_password"

# development / production
API_DEBUG="production"

WEB_NAME="Ares"
# Defines the link to your frontend application // For CORS purpose (*) to allow all
WEB_FRONTEND_LINK="*"

# 1 = Enabled, 0 = Disabled
CACHE_ENABLED=1
# "Files" for Filecache, "Predis" for Redis
CACHE_TYPE="Files"
# Defines the cache alive time in seconds
CACHE_TTL=950

# Redis Host
CACHE_REDIS_HOST=127.0.0.1
# Redis Port, standard Port is 6379
CACHE_REDIS_PORT=6379

# Only works with Redis // Enables Throttling // Enables that people only can call the endpoint certain times in a short period
THROTTLE_ENABLED=0

TOKEN_ISSUER="Ares-Issuer"
TOKEN_DURATION=86400

# The secret must be at least 12 characters in length; contain numbers; upper and lowercase letters; and one of the following special characters *&!@%^#$
TOKEN_SECRET="Secret123!456$"
```

## Expand project

### Create custom Module:

##### 1. Create controller class which extends BaseController
In the controller class you can define functions that are called by calling a route,
which can be defined in the app/routes/routes.php.
Auth protected routes can be used with setting middleware 'AuthMiddleware',
between route path and route action call.
 
```php
<?php

namespace Ares\CustomModule\Controller;

use Ares\Framework\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class Controller
 *
 * @package Ares\CustomModule\Controller
 */
class Controller extends BaseController
{
    /**
     * Reveals a custom response to the user
     *
     * @param Request  $request  The current incoming Request
     * @param Response $response The current Response
     *
     * @return Response Returns a Response with the given Data
     */
    public function customResponse(Request $request, Response $response): Response
    {
        /** @var string $customResponse */
        $customResponse = 'your custom response';

        return $this->respond(
            $response,
            response()
                ->setData($customResponse)
        );
    }
}
```

##### 2. Register your custom route in app/routes.php that calls a controller function
```php
return function (App $app) {
    // Registers our custom routes that calls the customResponse function in our custom controller
    $app->get('/custom', \Ares\CustomModule\Controller\Controller::class . ':customResponse');
};
```

### Create custom Service Provider:

##### 1. Create new Service Provider with extending AbstractServiceProvider
```php
<?php

namespace Ares\CustomModule\Provider;

use Ares\CustomModule\Model\Custom;
use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Class CustomServiceProvider
 *
 * @package Ares\CustomModule\Provider
 */
class CustomServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Custom::class
    ];

    /**
     * Registers new service.
     */
    public function register()
    {
        $container = $this->getContainer();

        $container->add(Custom::class, function () {
            return new Custom();
        });
    }
}
```

##### 2. Register the new created Service Provider in app/etc/providers.php
```php
    // Adds our CustomProvider to add Customs
    $container->addServiceProvider(
        new \Ares\CustomModule\Provider\CustomServiceProvider()
    );
```

## Credits
If you got questions or feedback feel free to contact us.

- Discord: Dome#9999
- Mail: dominik-forschner@web.de
----------------------------------
- Discord: s1njar#0066
- Mail: s1njar.mail@gmail.com

## Links

- [Slim Framework](https://www.slimframework.com/)
- [Ares Core Module](https://github.com/Domexx/Ares-Core.git)

## License

The MIT License (MIT).
