<?php
/**
 * Here you can define your own routes
 */

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Enables Lazy CORS - Preflight Request
    $app->options('/{routes:.+}', function ($request, $response, $arguments) {
        return $response;
    });

    $app->group('/{locale}', function (RouteCollectorProxy $group) {
        // Only Accessible if LoggedIn
        $group->group('', function ($group) {
            // De-Authentication
            $group->post('/logout', \Ares\User\Controller\AuthController::class . ':logout');
        })->add(\Ares\Framework\Middleware\AuthMiddleware::class);

        // Authentication
        $group->post('/login', \Ares\User\Controller\AuthController::class . ':login');
        $group->post('/register', \Ares\User\Controller\AuthController::class . ':register');

    })->add(\Ares\Framework\Middleware\LocaleMiddleware::class)
        ->add(\Ares\Framework\Middleware\ThrottleMiddleware::class);

    // Catches every route that is not found
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        throw new \Slim\Exception\HttpNotFoundException($request);
    });
};
