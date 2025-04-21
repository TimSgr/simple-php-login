<?php
require_once __DIR__ . '/inc/session_helper.php';

session_start_secure();

require_once __DIR__ . '/inc/database_setup.php';

$db = new DatabaseConnection();
$connection = $db->getConnection();

function db(): DatabaseConnection
{
    return $GLOBALS['db'];
}

function url()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

function redirect(string $path)
{
    $baseUrl = url();
    header('Location: ' . $baseUrl . $path);
    exit;
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
