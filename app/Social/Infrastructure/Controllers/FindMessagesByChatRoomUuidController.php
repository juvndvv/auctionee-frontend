<?php

namespace App\Social\Infrastructure\Controllers;

use App\Shared\Infrastructure\Controllers\QueryController;
use App\Shared\Infrastructure\Controllers\Response;
use App\Social\Application\Queries\FindMessagesByChatRoomUuid\FindMessagesByChatRoomUuidQuery;

final class FindMessagesByChatRoomUuidController extends QueryController
{
    public function __invoke(string $uuid)
    {
        $messages = $this->queryBus->handle(new FindMessagesByChatRoomUuidQuery($uuid));
        return Response::OK($messages, "Mensajes encontrados satisfactoriamente");
    }
}
