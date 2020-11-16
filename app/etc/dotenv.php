<?php
/**
 * @copyright Copyright (c) Ares (https://www.ares.to)
 *  
 * @see LICENSE (MIT)
 */

$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__, '../../.env');
if (file_exists(__DIR__ . '/../../.env')) {
    $dotEnv->load();
}
