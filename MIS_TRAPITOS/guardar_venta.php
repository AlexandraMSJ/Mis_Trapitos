<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ventas.php');
    exit;
}

$idCliente = isset($_POST['id_cliente']) && $_POST['id_cliente'] !== '' ? (int) $_POST['id_cliente'] : null;
$idEmpleado = isset($_POST['id_empleado']) ? (int) $_POST['id_empleado'] : 0;
$total = isset($_POST['total']) ? trim($_POST['total']) : '';

if ($idEmpleado === 0 || $total === '' || !is_numeric($total)) {
    $params = http_build_query([
        'error' => 'Empleado y total son obligatorios.',
        'cliente' => $idCliente,
        'empleado' => $idEmpleado,
        'total' => $total
    ]);
    header('Location: registrar_venta.php?' . $params);
    exit;
}

$totalDecimal = number_format((float)$total, 2, '.', '');

try {
    $stmt = $pdo->prepare('INSERT INTO Venta (id_cliente, id_empleado, total) VALUES (?, ?, ?)');
    $stmt->execute([$idCliente, $idEmpleado, $totalDecimal]);
    header('Location: ventas.php?msg=Venta registrada correctamente');
    exit;
} catch (PDOException $e) {
    $params = http_build_query([
        'error' => 'No se pudo guardar la venta. Revisa los datos.',
        'cliente' => $idCliente,
        'empleado' => $idEmpleado,
        'total' => $total
    ]);
    header('Location: registrar_venta.php?' . $params);
    exit;
}