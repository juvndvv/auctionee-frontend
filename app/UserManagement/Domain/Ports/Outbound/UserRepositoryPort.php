<?php

namespace App\UserManagement\Domain\Ports\Outbound;

use App\Shared\Domain\Ports\Outbound\BaseRepositoryPort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepositoryPort extends BaseRepositoryPort
{
    /**
     * Busca el usuario por el nombre de usuario. Lanza ModelNotFound si no lo encuentra
     *
     * @param string $username
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findByUsername(string $username): Model;

    /**
     * Actualiza el nombre del usuario. Lanza excepcion si no existe.
     *
     * @param string $uuid
     * @param string $name
     * @return void
     * @throws ModelNotFoundException
     */
    public function updateName(string $uuid, string $name): void;

    /**
     * Actualiza la password del usuario. Lanza excepcion si no existe.
     *
     * @param string $uuid
     * @param string $password
     * @return void
     * @throws ModelNotFoundException
     */
    public function updatePassword(string $uuid, string $password): void;

    /**
     * Actualiza el email del usuario. Lanza excepcion si no existe
     *
     * @param string $uuid
     * @param string $email
     * @return void
     * @throws ModelNotFoundException
     */
    public function updateEmail(string $uuid, string $email): void;

    /**
     * Actualiza el avatar del usuario. Lanza excepcion si no existe.
     *
     * @param string $uuid
     * @param string $avatar
     * @return void
     */
    public function updateAvatar(string $uuid, string $avatar): void;

    /**
     * Elimina el usuario. Lanza excepcion si no existe.
     *
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void;

    /**
     * Bloquea al usuario. Lanza excepcion si no existe.
     *
     * @param string $uuid
     * @return void
     */
    public function block(string $uuid): void;

    /**
     * Desbloquea al usuario. Lanza excepcion si no existe
     *
     * @param string $uuid
     * @return void
     */
    public function unblock(string $uuid): void;
}
