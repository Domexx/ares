<?php declare(strict_types=1);
/**
 * Here is a custom Controller that handles your User
 *
 * Includes:
 * - Gets authenticated User with the user() helper function
 */

namespace Ares\User\Controller;

use Ares\Framework\Controller\BaseController;
use Ares\Framework\Exception\AuthenticationException;
use Ares\Framework\Exception\NoSuchEntityException;
use Ares\User\Entity\User;
use Ares\User\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class UserController
 *
 * @package Ares\User\Controller
 */
class UserController extends BaseController
{
    /**
     * UserController constructor.
     *
     * @param   UserRepository  $userRepository
     */
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * Retrieves the logged in User via JWT - Token
     *
     * @param Request  $request  The current incoming Request
     * @param Response $response The current Response
     *
     * @return Response Returns a Response with the given Data
     * @throws AuthenticationException
     * @throws NoSuchEntityException
     */
    public function user(Request $request, Response $response): Response
    {
        /** @var User $user */
        $user = user($request);

        return $this->respond(
            $response,
            response()
                ->setData($user)
        );
    }
}
