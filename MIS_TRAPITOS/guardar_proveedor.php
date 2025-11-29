<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: proveedores.php');
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$correo = $_POST['correo'] ?? '';
$direccion = $_POST['direccion'] ?? '';

try {
    $stmt = $pdo->prepare("INSERT INTO Proveedor (nombre, telefono, correo, direccion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $telefono, $correo, $direccion]);
    header('Location: proveedores.php?msg=Proveedor guardado correctamente');
} catch (PDOException $e) {
    header('Location: proveedores.php?msg=Ocurrió un error al guardar: ' . urlencode($e->getMessage()));
}

exit;
?>