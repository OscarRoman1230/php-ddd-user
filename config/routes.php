<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Infrastructure\Controller\RegisterUserController;
use App\Application\RegisterUser\RegisterUserUseCase;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Infrastructure\Event\EventDispatcher;
use App\Infrastructure\Event\SendWelcomeEmailListener;

// Cargar el EntityManager
$entityManager = require __DIR__ . '/doctrine.php';

// Crear las dependencias necesarias
$userRepository = new DoctrineUserRepository($entityManager);
$eventDispatcher = new EventDispatcher();
$eventDispatcher->subscribe(App\Domain\User\UserRegisteredEvent::class, new SendWelcomeEmailListener());

$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventDispatcher);
$registerUserController = new RegisterUserController($registerUserUseCase);

// Definir las rutas
$routes = new RouteCollection();
$routes->add('register_user', new Route('/register', [
    '_controller' => [$registerUserController, '__invoke']
], [], [], '', [], ['POST']));

return $routes;
