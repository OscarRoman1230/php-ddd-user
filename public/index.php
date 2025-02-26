<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Infrastructure\Middleware\ExceptionHandlerMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar las rutas
$routes = require __DIR__ . '/../config/routes.php';

// Crear el contexto de la solicitud
$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$exceptionMiddleware = new ExceptionHandlerMiddleware();
$response = $exceptionMiddleware($request, function($req) use ($matcher) {
    try {
        $attributes = $matcher->match($req->getPathInfo());
        $controller = $attributes['_controller'];
        return call_user_func($controller, $req);
    } catch (Throwable $e) {
        return new JsonResponse([
            'error' => 'Ocurrió un error inesperado.',
            'details' => $e->getMessage()
        ], 500);
    }
});

$response->send();
