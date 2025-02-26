<?php

namespace App\Infrastructure\Middleware;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ExceptionHandlerMiddleware
{
    public function __invoke(Request $request, callable $next)
    {
        try {
            return $next($request);
        } catch (HttpExceptionInterface $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (Throwable $e) {
            return new JsonResponse([
                'error' => 'Ocurrió un error inesperado.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
