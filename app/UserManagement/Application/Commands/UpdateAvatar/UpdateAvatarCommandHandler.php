<?php

namespace App\UserManagement\Application\Commands\UpdateAvatar;

use App\Shared\Domain\Ports\Inbound\ImageRepositoryPort;
use App\Shared\Application\Commands\CommandHandler;
use App\Shared\Infraestructure\Bus\EventBus;
use App\UserManagement\Domain\Ports\Outbound\UserRepositoryPort;

class UpdateAvatarCommandHandler extends CommandHandler
{
    public function __construct(
        private readonly EventBus               $eventBus,
        private readonly ImageRepositoryPort    $imageRepository,
        private readonly UserRepositoryPort     $userRepository
    )
    {}

    public function __invoke(UpdateAvatarCommand $command): string
    {
        $uuid = $command->uuid();
        $new = $command->new();

        $user = $this->userRepository->findByUuid($uuid);
        $old = $user->avatar();

        // Delete image if is not default
        if ($old !== env("DEFAULT_AVATAR")) {
            $this->imageRepository->delete($old);
        }

        // Save new avatar
        $newPath = $this->imageRepository->store("avatars", $new);
        $user->updateAvatar($newPath);
        $this->userRepository->updateAvatar($uuid, $newPath);

        $this->eventBus->dispatch(...$user->pullDomainEvents());

        return $newPath;
    }
}
