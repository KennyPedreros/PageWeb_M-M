<?php
// ============================================
// Conexión a la base de datos MySQL
// ============================================

$DB_HOST = 'localhost';
$DB_NAME = 'automotriz_mm';
$DB_USER = 'root';
$DB_PASS = '';
$DB_CHARSET = 'utf8mb4';

$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'ok'      => false,
        'mensaje' => 'Error al conectar con la base de datos.',
        'error'   => $e->getMessage(),
    ]);
    exit;
}
