<?php

namespace App\UserManagement\Application\Commands\UpdateName;

use App\Shared\Application\Commands\CommandHandler;
use App\Shared\Infraestructure\Bus\EventBus;
use App\UserManagement\Domain\Ports\Outbound\UserRepositoryPort;

class UpdateNameCommandHandler extends CommandHandler
{
    public function __construct(
        private readonly EventBus           $eventBus,
        private readonly UserRepositoryPort $userRepository
    )
    {}

    public function __invoke(UpdateNameCommand $command): void
    {
        $uuid = $command->uuid();
        $name = $command->name();

        $user = $this->userRepository->findByUuid($uuid);           // Query
        $user->updateName($name);                                   // Use case
        $this->userRepository->updateName($uuid, $user->name());    // Persistence
        $this->eventBus->dispatch(...$user->pullDomainEvents());    // Publish events
    }
}
