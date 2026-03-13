<?php

// Vercel's read-only filesystem requires us to use /tmp for storage and cache
$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';

// Create necessary directories if they don't exist
$directories = [
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $cachePath,
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

// Set the storage path for Laravel
// This environment variable is checked by Laravel's Application class
putenv('APP_STORAGE=' . $storagePath);

// Forward Vercel requests to the normal Laravel public/index.php
require __DIR__ . '/../public/index.php';

