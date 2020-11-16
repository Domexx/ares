<?php
/**
 * @copyright Copyright (c) Ares (https://www.ares.to)
 *  
 * @see LICENSE (MIT)
 */

$alias = 'App';
$proxy = \Ares\Framework\Proxy\App::class;
$manager = new Statical\Manager();
$manager->addProxyInstance($alias, $proxy, $app);
