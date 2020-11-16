<?php

namespace Ares\User\Service\Auth;

/**
 * Class DetermineIpService
 *
 * @package Ares\User\Service\Auth
 */
class DetermineIpService
{
    /**
     * Determines the requested ip
     *
     * @return string|null
     */
    public function execute(): ?string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
