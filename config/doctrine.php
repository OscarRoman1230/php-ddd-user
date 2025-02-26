<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

require_once __DIR__ . '/../vendor/autoload.php';

// Configuración de la caché usando Symfony Cache
$cache = new FilesystemAdapter(); // Esto ya es compatible con PSR-6

// Configuración del mapeo de entidades (usando atributos)
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../src/Domain/User'],
    isDevMode: true,
    cache: $cache // Ahora pasamos FilesystemAdapter directamente
);

// Configuración de la conexión a la base de datos
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$connectionParams = [
    'dbname'   => $_ENV['DB_DATABASE'],
    'user'     => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'host'     => $_ENV['DB_HOST'],
    'driver'   => 'pdo_mysql',
];


$connection = DriverManager::getConnection($connectionParams, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;
