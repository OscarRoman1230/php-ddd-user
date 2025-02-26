<?php

namespace App\Domain\User;

use InvalidArgumentException;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}