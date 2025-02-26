<?php

use PHPUnit\Framework\TestCase;
use App\Domain\User\UserId;

class UserIdTest extends TestCase
{
    public function testUserIdIsValidUuid()
    {
        $userId = new UserId();
        $this->assertMatchesRegularExpression('/^[0-9a-fA-F-]{36}$/', $userId->getValue());
    }

    public function testInvalidUserIdThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new UserId("invalid-uuid");
    }
}