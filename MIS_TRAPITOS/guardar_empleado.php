<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: clientes.php');
    exit;
}

$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';

if ($nombre === '') {
    $params = http_build_query([
        'error' => 'El nombre es obligatorio.',
        'telefono' => $telefono,
        'correo' => $correo
    ]);
    header('Location: agregar_cliente.php?' . $params);
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO Cliente (nombre, telefono, correo) VALUES (?, ?, ?)');
    $stmt->execute([$nombre, $telefono, $correo]);
    header('Location: clientes.php?msg=Cliente registrado correctamente');
    exit;
} catch (PDOException $e) {
    $params = http_build_query([
        'error' => 'No se pudo guardar el cliente. Inténtalo de nuevo.',
        'nombre' => $nombre,
        'telefono' => $telefono,
        'correo' => $correo
    ]);
    header('Location: agregar_cliente.php?' . $params);
    exit;
}