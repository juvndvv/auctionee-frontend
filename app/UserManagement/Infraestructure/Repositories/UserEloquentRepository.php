<?php

namespace App\UserManagement\Infraestructure\Repositories;

use App\Shared\Infraestructure\Repositories\BaseRepository;
use App\UserManagement\Domain\Models\User;
use App\UserManagement\Domain\Ports\Outbound\UserRepositoryPort;
use App\UserManagement\Infraestructure\Repositories\Models\EloquentUserModel;

class UserEloquentRepository extends BaseRepository implements UserRepositoryPort
{
    private const ENTITY_NAME = 'user';

    public function __construct()
    {
        $this->setBuilderFromModel(EloquentUserModel::query()->getModel());
        $this->setEntityName(self::ENTITY_NAME);
    }

    public function findByUuid(string $uuid): User
    {
        $userDb = parent::findOneByPrimaryKeyOrFail($uuid);
        return User::fromPrimitives($userDb->toArray());
    }

    public function findByUsername(string $username): User
    {
        $userDb = parent::findByFieldValue(User::SERIALIZED_USERNAME, $username);
        return User::fromPrimitives($userDb->toArray());
    }

    public function updateName(string $uuid, string $name): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_NAME, $name);
    }

    public function updateUsername(string $uuid, string $username): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_USERNAME, $username);
    }

    public function updateEmail(string $uuid, string $email): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_EMAIL, $email);
    }

    public function updatePassword(string $uuid, string $password): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_PASSWORD, $password);
    }

    public function updateAvatar(string $uuid, string $avatar): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_AVATAR, $avatar);
    }

    public function block(string $uuid): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_ROLE, User::BLOCKED_ROLE);
    }

    public function unblock(string $uuid): void
    {
        parent::updateFieldByPrimaryKey($uuid, User::SERIALIZED_ROLE, User::USER_ROLE);
    }
}
