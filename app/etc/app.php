<?php
/**
 * @copyright Copyright (c) Ares (https://www.ares.to)
 *  
 * @see LICENSE (MIT)
 */

use Slim\App;

// Create App instance
$app = $container->get(App::class);;

$middleware = require_once __DIR__ . '/middleware.php';
$middleware($app);
