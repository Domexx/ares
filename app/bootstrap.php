<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Adds dotenv environment.
require_once __DIR__ . '/etc/dotenv.php';

// Adds container initialization.
require_once __DIR__ . '/etc/container.php';

// Adds custom helper functions.
require_once __DIR__ . '/etc/helpers.php';

// Adds custom service providers.
require_once __DIR__ . '/etc/providers.php';

// Adds core slim app.
require_once __DIR__ . '/etc/app.php';

// Adds routing initialization.
require_once __DIR__ . '/etc/routing.php';

// Adds cache service
require_once __DIR__ . '/etc/cache.php';

// Adds app proxy.
require_once __DIR__ . '/etc/proxy.php';

// Adds database initialization.
require_once __DIR__ . '/etc/database.php';

return $app;
