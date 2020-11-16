<?php

namespace Ares\User\Service\Auth;

use Ares\Framework\Exception\DataObjectManagerException;
use Ares\Framework\Interfaces\CustomResponseInterface;
use Ares\Framework\Service\TokenService;
use Ares\User\Entity\User;
use Ares\User\Exception\RegisterException;
use Ares\User\Repository\UserRepository;
use Exception;
use PHLAK\Config\Config;
use ReallySimpleJWT\Exception\ValidateException;

/**
 * Class RegisterService
 *
 * @package Ares\User\Service\Auth
 */
class RegisterService
{
    /**
     * LoginService constructor.
     *
     * @param UserRepository        $userRepository
     * @param TokenService          $tokenService
     * @param TicketService         $ticketService
     * @param HashService           $hashService
     * @param Config                $config
     * @param CreateCurrencyService $createCurrencyService
     */
    public function __construct(
        private UserRepository $userRepository,
        private TokenService $tokenService,
        private TicketService $ticketService,
        private HashService $hashService,
        private Config $config,
        private CreateCurrencyService $createCurrencyService
    ) {}

    /**
     * Registers a new User.
     *
     * Returns a custom JWT Token
     *
     * @param array $data
     *
     * @return CustomResponseInterface
     * @throws RegisterException
     * @throws ValidateException
     * @throws DataObjectManagerException
     * @throws Exception
     */
    public function register(array $data): CustomResponseInterface
    {
        /** @var User $isAlreadyRegistered */
        $isAlreadyRegistered = $this->userRepository->get($data['username'], 'username', true);

        if ($isAlreadyRegistered) {
            throw new RegisterException(__('Username is already taken'), 422);
        }

        /** @var User $user */
        $user = $this->userRepository->save($this->getNewUser($data));

        /** @var TokenService $token */
        $token = $this->tokenService->execute($user->getId());

        return response()
            ->setData([
                'token' => $token
            ]);
    }

    /**
     * Returns new user.
     *
     * @param array $data
     *
     * @return User
     * @throws Exception
     */
    private function getNewUser(array $data): User
    {
        $user = new User();

        return $user
            ->setUsername($data['username'])
            ->setPassword($this->hashService->hash($data['password']))
            ->setCreatedAt(new \DateTime());
    }
}
