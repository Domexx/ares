<?php

namespace Ares\User\Service\Auth;

/**
 * Class HashService
 *
 * @package Ares\User\Service\Auth
 */
class HashService
{
    /**
     * HashService constructor.
     *
     * @param Config $config
     */
    public function __construct(
        private Config $config
    ) {}

    /**
     * Takes a normal password and hashes it in the given Algorithm
     *
     * @param string $password
     *
     * @return string
     */
    public function hash(string $password): string
    {
        return password_hash(
            $password,
            $this->config->get('api_settings.password.algorithm'),
            [
                'memory_cost' => $this->config->get('api_settings.password.memory_cost'),
                'time_cost' => $this->config->get('api_settings.password.time_cost'),
                'threads' => $this->config->get('api_settings.password.threads')
            ]
        );
    }
}
