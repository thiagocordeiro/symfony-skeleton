<?php declare(strict_types=1);

namespace App\Framework\Controller\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\Exception\UnableToSaveUserException;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserUpdateService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateUserController
{
    private UserUpdateService $updater;

    public function __construct(UserUpdateService $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        $data = json_decode((string) $request->getContent(), true);
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';

        try {
            $this->updater->update($id, $name, $email);
        } catch (InvalidEmailException | InvalidNameException $e) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, $e->getMessage(), $e);
        } catch (UserNotFoundException $e) {
            throw new HttpException(Response::HTTP_NOT_FOUND, $e->getMessage(), $e);
        } catch (UnableToSaveUserException $e) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage(), $e);
        }

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
