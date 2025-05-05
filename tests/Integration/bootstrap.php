<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

$envFile = __DIR__ . '/../../.env.testing';
if (!file_exists($envFile)) {
    echo "ERROR: .env.testing file not found. Please create one by copying .env.example\n";
    exit(1);
}

try {
    $dotenv = \Dotenv\Dotenv::createMutable(__DIR__ . '/../../', ['.env.testing']);
    $dotenv->load();

    if (empty($_ENV['LIVEPEER_API_KEY'])) {
        echo "WARNING: LIVEPEER_API_KEY is empty in .env file\n";
        exit(1);
    } else {
        echo "Successfully loaded LIVEPEER_API_KEY from .env file\n";
    }
} catch (\Exception $e) {
    echo "ERROR loading .env file: " . $e->getMessage() . "\n";
    exit(1);
}

function testResourceName($prefix = 'Test')
{
    return $prefix . ' ' . uniqid();
}
