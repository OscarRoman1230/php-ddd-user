<?php

namespace App\Domain\User;

class UserRegisteredEvent
{
    private string $userId;
    private string $email;

    public function __construct(string $userId, string $email) // ✅ Ahora recibe strings
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
