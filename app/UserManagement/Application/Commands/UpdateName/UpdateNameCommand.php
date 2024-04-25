<?php

namespace App\UserManagement\Application\Commands\UpdateName;

use App\Shared\Application\Command;

class UpdateNameCommand extends Command
{
    private function __construct(
        private readonly string $uuid,
        private readonly string $name
    )
    {}

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }
}
