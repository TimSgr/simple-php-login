<?php
require_once __DIR__ . '/inc/database_setup.php';

$db = new DatabaseConnection();
$connection = $db->getConnection();

function db(): DatabaseConnection
{
    return $GLOBALS['db'];
}

// Speicher $db global für die Funktion
$GLOBALS['db'] = $db;

// Ab hier dein Routing:
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$pageFile = __DIR__ . '/pages/' . ($request === '' ? 'home' : $request) . '.php';

if (file_exists($pageFile)) {
    require $pageFile;
    exit;
}

http_response_code(404);
require __DIR__ . '/pages/404.php';
exit;
