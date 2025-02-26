<?php

namespace App\Domain\User;

use InvalidArgumentException;

class Password
{
    private string $hashedValue;

    public function __construct(string $plainPassword) {
        if (!$this->isValid($plainPassword)) {
            throw new InvalidArgumentException("La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un número y un carácter especial.");
        }

        $this->hashedValue = password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    private function isValid(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedValue);
    }

    public function getValue(): string
    {
        return $this->hashedValue;
    }

}