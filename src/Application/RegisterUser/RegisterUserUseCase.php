<?php

namespace App\Application\RegisterUser;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\Name;
use App\Domain\User\Email;
use App\Domain\User\Password;
use App\Domain\User\UserRegisteredEvent;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Event\EventDispatcher;
use Exception;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(UserRepositoryInterface $userRepository, EventDispatcher $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @throws Exception
     */
    public function execute(RegisterUserRequest $request): void
    {
        if ($this->userRepository->findByEmail(new Email($request->getEmail())) !== null) {
            throw new Exception("El email ya está en uso.");
        }

        $user = new User(
            new UserId(),
            new Name($request->getName()),
            new Email($request->getEmail()),
            new Password($request->getPassword())
        );

        $this->userRepository->save($user);

        // Disparar evento de usuario registrado
        $event = new UserRegisteredEvent($user->getId(), $user->getEmail());
        $this->eventDispatcher->dispatch($event);
    }
}
