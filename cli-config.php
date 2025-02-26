<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/config/doctrine.php';

ConsoleRunner::run(
    new class ($entityManager) implements ContainerInterface {
        private $entityManager;

        public function __construct($entityManager)
        {
            $this->entityManager = $entityManager;
        }

        public function get(string $id)
        {
            if ($id === EntityManager::class) {
                return $this->entityManager;
            }

            throw new Exception("Unknown service: " . $id);
        }

        public function has(string $id): bool
        {
            return $id === EntityManager::class;
        }
    }
);
