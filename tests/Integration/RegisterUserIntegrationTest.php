<?php

use PHPUnit\Framework\TestCase;
use App\Application\RegisterUser\RegisterUserUseCase;
use App\Application\RegisterUser\RegisterUserRequest;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Infrastructure\Event\EventDispatcher;
use App\Domain\User\Email;

class RegisterUserIntegrationTest extends TestCase
{
    private RegisterUserUseCase $registerUserUseCase;
    private DoctrineUserRepository $userRepository;
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = require __DIR__ . '/../../config/doctrine.php';
        $this->userRepository = new DoctrineUserRepository($this->entityManager);
        $eventDispatcher = new EventDispatcher();

        $this->registerUserUseCase = new RegisterUserUseCase($this->userRepository, $eventDispatcher);
    }

    public function testUserRegistration()
    {
        $request = new RegisterUserRequest("Test User", "testuser@example.com", "SecurePass123!");

        $this->registerUserUseCase->execute($request);

        $retrievedUser = $this->userRepository->findByEmail(new Email("testuser@example.com"));

        $this->assertNotNull($retrievedUser);
        $this->assertEquals("testuser@example.com", $retrievedUser->getEmail());
    }
}
