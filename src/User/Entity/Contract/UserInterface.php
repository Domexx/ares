<?php
/**
 * Basic Interface that declares your table structure
 */

namespace Ares\User\Entity\Contract;

/**
 * Interface UserInterface
 *
 * @package Ares\User\Entity\Contract
 */
interface UserInterface
{
    public const COLUMN_ID = 'id';
    public const COLUMN_USERNAME = 'username';
    public const COLUMN_PASSWORD = 'password';
    public const COLUMN_CREATED_AT = 'created_at';
    public const COLUMN_UPDATED_AT = 'updated_at';
}
