<?php declare(strict_types=1);
/**
 * Here is a custom Controller that handles your Authentication stuff
 *
 * Includes:
 * - Login
 * - Register
 * - Logout
 */

namespace Ares\User\Controller;

use Ares\Framework\Controller\BaseController;
use Ares\Framework\Exception\DataObjectManagerException;
use Ares\Framework\Exception\NoSuchEntityException;
use Ares\Framework\Exception\ValidationException;
use Ares\Framework\Service\ValidationService;
use Ares\User\Entity\Contract\UserInterface;
use Ares\User\Exception\LoginException;
use Ares\User\Service\Auth\LoginService;
use Ares\User\Service\Auth\RegisterService;
use Ares\User\Service\Auth\TicketService;
use Exception;
use PHLAK\Config\Config;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ReallySimpleJWT\Exception\ValidateException;

/**
 * Class AuthController
 *
 * @package Ares\User\Controller\Auth
 */
class AuthController extends BaseController
{
    /**
     * AuthController constructor.
     *
     * @param ValidationService $validationService
     * @param LoginService $loginService
     * @param RegisterService $registerService
     * @param Config $config
     */
    public function __construct(
        private ValidationService $validationService,
        private LoginService $loginService,
        private RegisterService $registerService,
        private Config $config
    ) {}

    /**
     * Logs the User in and parses a generated Token into response
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return Response Returns a Response with the given Data
     * @throws DataObjectManagerException
     * @throws LoginException
     * @throws ValidateException
     * @throws ValidationException
     * @throws NoSuchEntityException
     */
    public function login(Request $request, Response $response): Response
    {
        /** @var array $parsedData */
        $parsedData = $request->getParsedBody();

        $this->validationService->validate($parsedData, [
            UserInterface::COLUMN_USERNAME => 'required',
            UserInterface::COLUMN_PASSWORD => 'required'
        ]);

        $customResponse = $this->loginService->login($parsedData);

        return $this->respond(
            $response,
            $customResponse
        );
    }

    /**
     * Registers the User and parses a generated Token into the response
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response Returns a Response with the given Data
     * @throws Exception
     */
    public function register(Request $request, Response $response): Response
    {
        /** @var array $parsedData */
        $parsedData = $request->getParsedBody();

        $this->validationService->validate($parsedData, [
            UserInterface::COLUMN_USERNAME => 'required|min:3|max:12|regex:/^[a-zA-Z\d]+$/',
            UserInterface::COLUMN_PASSWORD => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        $customResponse = $this->registerService->register($parsedData);

        return $this->respond(
            $response,
            $customResponse
        );
    }

    /**
     * Returns a response without the Authorization header
     * We could blacklist the token with redis-cache
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response Returns a Response with the given Data
     */
    public function logout(Request $request, Response $response): Response
    {
        return $response->withoutHeader('Authorization');
    }
}
