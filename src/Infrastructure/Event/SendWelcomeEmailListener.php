<?php

namespace App\Infrastructure\Event;

use App\Domain\User\UserRegisteredEvent;

class SendWelcomeEmailListener
{
    public function __invoke(UserRegisteredEvent $event): void
    {
        // Simulación de envío de email
        echo "Enviando email de bienvenida a " . $event->getEmail() . "\n";
    }
}
