<?php

namespace App\Review\Domain\Events;

use App\Shared\Domain\Events\DomainEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class ReviewPlacedEvent extends DomainEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(array $payload, string $occurredOn, string $eventId = null)
    {
        parent::__construct($occurredOn, $payload, self::eventName(), $eventId);
    }

    public function broadcastOn(): array
    {
        return ['reviews'];
    }

    public function broadcastAs(): string
    {
        return ReviewPlacedEvent::eventName();
    }

    public static function eventName(): string
    {
        return 'review.placed';
    }
}
