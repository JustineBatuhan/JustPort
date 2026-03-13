<?php

// --- NUCLEAR VERCEL OVERRIDES ---
// Ensure PHP uses /tmp for all temporary operations
ini_set('sys_temp_dir', '/tmp');
ini_set('upload_tmp_dir', '/tmp');
ini_set('session.save_path', '/tmp');

if (!is_writable('/tmp')) {
    error_log("CRITICAL: /tmp is not writable on this Vercel instance.");
}


// Force critical environment variables into superglobals
// This bypasses issues where Laravel might load old .env or cached config
$overrides = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'LOG_CHANNEL' => 'stderr',
    'VIEW_COMPILED_PATH' => '/tmp',
    'CACHE_STORE' => 'array',
    'SESSION_DRIVER' => 'cookie',
    'QUEUE_CONNECTION' => 'sync',
    'APP_STORAGE' => '/tmp/storage',
];

foreach ($overrides as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// Ensure critical directories exist
$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';
$directories = [
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/cache/data',
    $storagePath . '/app/public',
    $storagePath . '/logs',
    $cachePath,
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

// Handle SQLite database migration to /tmp
$dbPath = __DIR__ . '/../database/database.sqlite';
$tmpDbPath = '/tmp/database.sqlite';
if (file_exists($dbPath) && !file_exists($tmpDbPath)) {
    copy($dbPath, $tmpDbPath);
}
putenv('DB_DATABASE=' . $tmpDbPath);
$_ENV['DB_DATABASE'] = $tmpDbPath;
$_SERVER['DB_DATABASE'] = $tmpDbPath;

// Define constant for bootstrap/app.php to use
if (!defined('VERCEL_STORAGE_PATH')) {
    define('VERCEL_STORAGE_PATH', $storagePath);
}

// Forward to Laravel
require __DIR__ . '/../public/index.php';
