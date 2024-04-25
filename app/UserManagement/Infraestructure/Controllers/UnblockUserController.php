<?php

namespace App\UserManagement\Infraestructure\Controllers;

use App\Shared\Infraestructure\Controllers\CommandController;
use App\Shared\Infraestructure\Controllers\Response;
use App\UserManagement\Application\Commands\UnblockUser\UnblockUserCommand;
use Illuminate\Http\Request;

final class UnblockUserController extends CommandController
{
    public function __invoke(string $uuid)
    {
        $command = UnblockUserCommand::create($uuid);
        $this->commandBus->handle($command);
        return Response::OK($uuid, "Usuario desbloqueado correctamente.");
    }

    static function validate(Request $request): void
    {
        // TODO: Implement validate() method.
    }
}
