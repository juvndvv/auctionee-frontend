<?php

namespace App\User\Infrastructure\Controllers;

use App\Shared\Domain\Exceptions\NotFoundException;
use App\Shared\Infrastructure\Controllers\QueryController;
use App\Shared\Infrastructure\Controllers\Response;
use App\User\Application\Queries\FindByUsername\FindByUsernameQuery;
use Exception;
use Illuminate\Http\JsonResponse;

final class FindUserByUsernameController extends QueryController
{
    public function __invoke(string $username): JsonResponse
    {
        try {
            $query = FindByUsernameQuery::create($username);
            $result = $this->queryBus->handle($query);

            return Response::OK($result, "Usuario encontrado satisfactoriamente");

        } catch (NotFoundException $e) {
            return Response::NOT_FOUND("El usuario $username no existe");

        } catch (Exception) {
            return Response::SERVER_ERROR();
        }
    }
}
