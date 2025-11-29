<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: inventario.php');
    exit;
}

$idProducto = isset($_POST['id_producto']) ? (int) $_POST['id_producto'] : 0;
$tipo = isset($_POST['tipo_movimiento']) ? trim($_POST['tipo_movimiento']) : '';
$cantidad = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : 0;
$observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

if ($idProducto === 0 || $tipo === '' || $cantidad < 0) {
    $params = http_build_query([
        'error' => 'Producto, tipo y cantidad son obligatorios.',
        'producto' => $idProducto,
        'tipo' => $tipo,
        'cantidad' => $cantidad,
        'obs' => $observaciones
    ]);
    header('Location: agregar_movimiento.php?' . $params);
    exit;
}

try {
    $pdo->beginTransaction();

    // Obtener stock actual
    $stmt = $pdo->prepare('SELECT stock_actual FROM Producto WHERE id_producto = ? FOR UPDATE');
    $stmt->execute([$idProducto]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        throw new Exception('Producto no encontrado');
    }

    $stockActual = (int) $producto['stock_actual'];
    $nuevoStock = $stockActual;

    if ($tipo === 'Entrada') {
        $nuevoStock = $stockActual + $cantidad;
    } elseif ($tipo === 'Salida') {
        if ($cantidad > $stockActual) {
            throw new Exception('No hay stock suficiente para la salida.');
        }
        $nuevoStock = $stockActual - $cantidad;
    } elseif ($tipo === 'Ajuste') {
        $nuevoStock = $cantidad;
    } else {
        throw new Exception('Tipo de movimiento no válido.');
    }

    // Insertar movimiento
    $stmtMovimiento = $pdo->prepare('INSERT INTO Inventario (id_producto, tipo_movimiento, cantidad, observaciones) VALUES (?, ?, ?, ?)');
    $stmtMovimiento->execute([$idProducto, $tipo, $cantidad, $observaciones]);

    // Actualizar stock
    $stmtProducto = $pdo->prepare('UPDATE Producto SET stock_actual = ? WHERE id_producto = ?');
    $stmtProducto->execute([$nuevoStock, $idProducto]);

    $pdo->commit();

    header('Location: inventario.php?msg=Movimiento registrado');
    exit;
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $params = http_build_query([
        'error' => $e->getMessage(),
        'producto' => $idProducto,
        'tipo' => $tipo,
        'cantidad' => $cantidad,
        'obs' => $observaciones
    ]);
    header('Location: agregar_movimiento.php?' . $params);
    exit;
}