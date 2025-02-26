<?php

namespace App\Domain\User;

use InvalidArgumentException;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 3 || strlen($value) > 50) {
            throw new InvalidArgumentException("The name must be between 3 and 50 characters.");
        }

        if (!preg_match('/^[a-zA-Z\s]+$/', $value)) {
            throw new InvalidArgumentException("The name can only contain letters and spaces.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}