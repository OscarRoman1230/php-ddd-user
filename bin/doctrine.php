<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Cargar el EntityManager desde la configuración
$entityManager = require __DIR__ . '/../config/doctrine.php';

// Ejecutar la consola de Doctrine
ConsoleRunner::run(new SingleManagerProvider($entityManager));
