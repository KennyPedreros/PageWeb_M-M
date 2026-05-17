<?php
// ============================================
// Guarda el formulario de contacto vía POST
// ============================================

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'mensaje' => 'Método no permitido.']);
    exit;
}

require __DIR__ . '/conexion.php';

$nombre   = trim($_POST['nombre']   ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$servicio = trim($_POST['servicio'] ?? '');
$mensaje  = trim($_POST['mensaje']  ?? '');

if ($nombre === '' || $telefono === '' || $servicio === '' || $mensaje === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'mensaje' => 'Todos los campos son obligatorios.']);
    exit;
}

if (mb_strlen($nombre) > 100 || mb_strlen($telefono) > 20 || mb_strlen($servicio) > 150) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'mensaje' => 'Algún campo excede la longitud permitida.']);
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'] ?? null;

try {
    $sql = "INSERT INTO contactos (nombre, telefono, servicio, mensaje, ip)
            VALUES (:nombre, :telefono, :servicio, :mensaje, :ip)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre'   => $nombre,
        ':telefono' => $telefono,
        ':servicio' => $servicio,
        ':mensaje'  => $mensaje,
        ':ip'       => $ip,
    ]);

    echo json_encode([
        'ok'      => true,
        'mensaje' => 'Mensaje guardado correctamente.',
        'id'      => $pdo->lastInsertId(),
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'ok'      => false,
        'mensaje' => 'No se pudo guardar el mensaje.',
        'error'   => $e->getMessage(),
    ]);
}
