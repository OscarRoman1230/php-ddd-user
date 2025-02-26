<?php

namespace App\Infrastructure\Controller;

use App\Application\RegisterUser\RegisterUserRequest;
use App\Application\RegisterUser\RegisterUserUseCase;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    #[Route('/register', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'], $data['email'], $data['password'])) {
            return new JsonResponse(['error' => 'Faltan datos obligatorios'], 400);
        }

        try {
            $registerRequest = new RegisterUserRequest($data['name'], $data['email'], $data['password']);
            $this->registerUserUseCase->execute($registerRequest);

            return new JsonResponse(['message' => 'Usuario registrado exitosamente'], 201);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}