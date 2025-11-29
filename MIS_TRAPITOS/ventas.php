<?php
require 'includes/db.php';
require 'includes/header.php';

$mensaje = isset($_GET['msg']) ? trim($_GET['msg']) : '';
$error = isset($_GET['error']) ? trim($_GET['error']) : '';

$sql = "SELECT v.*, c.nombre AS cliente_nombre, e.nombre AS empleado_nombre
        FROM Venta v
        LEFT JOIN Cliente c ON v.id_cliente = c.id_cliente
        INNER JOIN Empleado e ON v.id_empleado = e.id_empleado
        ORDER BY v.fecha DESC";
$ventas = $pdo->query($sql)->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Ventas</p>
            <h1>Historial de ventas</h1>
            <p class="muted">Consulta y administra las ventas registradas.</p>
        </div>
        <a class="btn" href="registrar_venta.php">Registrar venta</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="table-wrapper">
        <div class="table-header">
            <h2>Ventas recientes</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Empleado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($ventas) > 0): ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($venta['fecha']))) ?></td>
                            <td><?= $venta['cliente_nombre'] ? htmlspecialchars($venta['cliente_nombre']) : 'Público general' ?></td>
                            <td><?= htmlspecialchars($venta['empleado_nombre']) ?></td>
                            <td>$<?= number_format($venta['total'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px;">Aún no hay ventas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>