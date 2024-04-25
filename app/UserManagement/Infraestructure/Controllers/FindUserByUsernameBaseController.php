<?php

namespace App\UserManagement\Infraestructure\Controllers;

use App\Shared\Domain\Exceptions\NotFoundException;
use App\Shared\Infraestructure\Controllers\QueryController;
use App\Shared\Infraestructure\Controllers\Response;
use App\UserManagement\Application\Queries\FindByUsername\FindByUsernameQuery;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class FindUserByUsernameBaseController extends QueryController
{
    public function __invoke(string $id): JsonResponse
    {
        try {
            $query = FindByUsernameQuery::create($id);
            $result = $this->queryBus->handle($query);

            return new JsonResponse($result);

        } catch (NotFoundException $e) {
            return Response::NO_CONTENT();

        } catch (Exception $e) {
            return Response::SERVER_ERROR();
        }
    }
}
