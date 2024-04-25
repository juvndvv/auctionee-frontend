<?php

namespace App\UserManagement\Infraestructure\Controllers;

use App\Shared\Domain\Exceptions\NotFoundException;
use App\Shared\Infraestructure\Controllers\CommandController;
use App\Shared\Infraestructure\Controllers\Response;
use App\UserManagement\Application\Commands\DeleteUser\DeleteUserCommand;
use Exception;
use Illuminate\Http\Request;

final class DeleteUserController extends CommandController
{
    public function __invoke(string $uuid)
    {
        try {
            $command = DeleteUserCommand::create($uuid);
            $this->commandBus->handle($command);

            return Response::OK($uuid, "Usuario borrado correctamente");

        } catch (NotFoundException $e) {
            return Response::NOT_FOUND("El usuario $uuid no existe");

        } catch (Exception $e) {
            return Response::SERVER_ERROR();
        }
    }

    static function validate(Request $request): void
    {
        // TODO: Implement validate() method.
    }
}
