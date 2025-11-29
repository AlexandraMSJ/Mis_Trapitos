<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: productos.php');
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$talla = $_POST['talla'] ?? '';
$precio = $_POST['precio'] ?? 0;
$stock = $_POST['stock_actual'] ?? 0;
$idProveedor = $_POST['id_proveedor'] ?? null;

try {
    $stmt = $pdo->prepare("INSERT INTO Producto (nombre, categoria, talla, precio, stock_actual, id_proveedor) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $categoria, $talla, $precio, $stock, $idProveedor]);
    header('Location: productos.php?msg=Producto guardado correctamente');
} catch (PDOException $e) {
    header('Location: productos.php?msg=Ocurrió un error al guardar: ' . urlencode($e->getMessage()));
}

exit;
?>