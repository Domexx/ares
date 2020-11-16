<?php declare(strict_types=1);
/**
 * Here you can do you custom Database Stuff and use the build in QueryBuilder
 *
 * For example: public function getAllUsersOrganized /
 *
 * Custom Functions are available like: getList, getPaginatedList, getOneBy.
 */

namespace Ares\User\Repository;

use Ares\User\Entity\User;
use Ares\Framework\Repository\BaseRepository;

/**
 * Class UserRepository
 *
 * @package Ares\User\Repository
 */
class UserRepository extends BaseRepository
{
    /** @var string */
    protected string $entity = User::class;

    /**
     * Determines the Cache-key for a single Entity
     *
     * @var string
     */
    protected string $cachePrefix = 'ARES_USER_';

    /**
     * Determines the Cache-key for a Collection
     *
     * @var string
     */
    protected string $cacheCollectionPrefix = 'ARES_USER_COLLECTION_';
}
