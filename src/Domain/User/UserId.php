<?php

namespace App\Domain\User;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class UserId
{
    private string $value;

    public function __construct(?string $value = null) // ✅ Declaramos explícitamente que puede ser null
    {
        if ($value === null) {
            $value = Uuid::uuid4()->toString();
        }

        if (!Uuid::isValid($value)) {
            throw new InvalidArgumentException("Invalid UUID format.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
