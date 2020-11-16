<?php

namespace Ares\User\Service\Auth;

use Ares\Framework\Exception\DataObjectManagerException;
use Ares\Framework\Exception\NoSuchEntityException;
use Ares\Framework\Interfaces\CustomResponseInterface;
use Ares\Framework\Service\TokenService;
use Ares\User\Entity\User;
use Ares\User\Exception\LoginException;
use Ares\User\Repository\UserRepository;
use ReallySimpleJWT\Exception\ValidateException;

/**
 * Class LoginService
 *
 * @package Ares\User\Service\Auth
 */
class LoginService
{
    /**
     * LoginService constructor.
     *
     * @param UserRepository $userRepository
     * @param TokenService   $tokenService
     */
    public function __construct(
        private UserRepository $userRepository,
        private TokenService $tokenService
    ) {}

    /**
     * Custom method to perform a Login request
     *
     * Returns a custom JWT Token
     *
     * @param array $data
     *
     * @return CustomResponseInterface
     * @throws BanException
     * @throws DataObjectManagerException
     * @throws LoginException
     * @throws ValidateException
     * @throws NoSuchEntityException
     */
    public function login(array $data): CustomResponseInterface
    {
        /** @var User $user */
        $user = $this->userRepository->get($data['username'], 'username', true);

        if (!$user || !password_verify($data['password'], $user->getPassword())) {
            throw new LoginException(__('Data combination was not found'), 403);
        }

        $this->userRepository->save($user);

        /** @var TokenService $token */
        $token = $this->tokenService->execute($user->getId());

        return response()
            ->setData([
                'token' => $token
            ]);
    }
}

