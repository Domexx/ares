<?php
/**
 * @copyright Copyright (c) Ares (https://www.ares.to)
 *
 * @see LICENSE (MIT)
 */

// Instantiate LeagueContainer
$container = new \League\Container\Container();

// Enable Auto-wiring for our dependencies..
$container->delegate(
    (new League\Container\ReflectionContainer)->cacheResolutions()
);
