<?php

use PHPUnit\Framework\TestCase;
use App\Application\RegisterUser\RegisterUserUseCase;
use App\Application\RegisterUser\RegisterUserRequest;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Event\EventDispatcher;

class RegisterUserUseCaseTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws Exception
     */
    public function testUserRegistration()
    {
        $mockRepository = $this->createMock(UserRepositoryInterface::class);
        $mockRepository->method('findByEmail')->willReturn(null);
        $mockRepository->expects($this->once())->method('save');

        $mockEventDispatcher = $this->createMock(EventDispatcher::class);
        $mockEventDispatcher->expects($this->once())->method('dispatch');

        $useCase = new RegisterUserUseCase($mockRepository, $mockEventDispatcher);
        $request = new RegisterUserRequest("Jane Doe", "jane@example.com", "SecurePass123!");

        $useCase->execute($request);
        $this->assertTrue(true);
    }
}