<?php declare(strict_types=1);
/**
 * Your custom Entity filled with getter / setter or relations
 *
 * if you want to declare a relation:
 *
 * Build in Methods with the usage of repositories:
 * Use helper method repository() to get the repository and use the methods:
 *
 * @getOneToOne
 * @getOneToMany
 * @getManyToMany
 */

namespace Ares\User\Entity;

use Ares\Framework\Model\DataObject;
use Ares\User\Entity\Contract\UserInterface;
use Ares\User\Repository\UserCurrencyRepository;
/**
 * Class User
 *
 * @package Ares\User\Entity
 */
class User extends DataObject implements UserInterface
{
    /** @var string */
    public const TABLE = 'users';

    /** @var array */
    public const HIDDEN = [
        UserInterface::COLUMN_PASSWORD
    ];

    /** @var array */
    public const RELATIONS = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getData(UserInterface::COLUMN_ID);
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId(int $id): User
    {
        return $this->setData(UserInterface::COLUMN_ID, $id);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getData(UserInterface::COLUMN_USERNAME);
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username): User
    {
        return $this->setData(UserInterface::COLUMN_USERNAME, $username);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getData(UserInterface::COLUMN_PASSWORD);
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        return $this->setData(UserInterface::COLUMN_PASSWORD, $password);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->getData(UserInterface::COLUMN_CREATED_AT);
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt): User
    {
        return $this->setData(UserInterface::COLUMN_CREATED_AT, $createdAt);
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->getData(UserInterface::COLUMN_UPDATED_AT);
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt(\DateTime $updatedAt): User
    {
        return $this->setData(UserInterface::COLUMN_UPDATED_AT, $updatedAt);
    }
}
