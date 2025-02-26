<?php

namespace Integration;

use PHPUnit\Framework\TestCase;
use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\Name;
use App\Domain\User\Email;
use App\Domain\User\Password;
use App\Infrastructure\Persistence\DoctrineUserRepository;

class DoctrineUserRepositoryTest extends TestCase
{
    private DoctrineUserRepository $userRepository;
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = require __DIR__ . '/../../config/doctrine.php';
        $this->userRepository = new DoctrineUserRepository($this->entityManager);
    }

    public function testSaveAndFindUserById()
    {
        $user = new User(new UserId(), new Name("John Doe"), new Email("john@example.com"), new Password("SecurePass123!"));
        $this->userRepository->save($user);

        $retrievedUser = $this->userRepository->findById(new UserId($user->getId()));

        $this->assertNotNull($retrievedUser);
        $this->assertEquals($user->getId(), $retrievedUser->getId());
    }

    public function testFindByEmail()
    {
        $user = new User(new UserId(), new Name("Jane Doe"), new Email("jane@example.com"), new Password("SecurePass123!"));
        $this->userRepository->save($user);

        $retrievedUser = $this->userRepository->findByEmail(new Email("jane@example.com"));

        $this->assertNotNull($retrievedUser);
        $this->assertEquals("jane@example.com", $retrievedUser->getEmail());
    }
}