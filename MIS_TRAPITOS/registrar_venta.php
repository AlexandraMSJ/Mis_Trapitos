<?php
require 'includes/db.php';
require 'includes/header.php';

$error = isset($_GET['error']) ? trim($_GET['error']) : '';
$totalAnterior = isset($_GET['total']) ? trim($_GET['total']) : '';
$clienteAnterior = isset($_GET['cliente']) ? trim($_GET['cliente']) : '';
$empleadoAnterior = isset($_GET['empleado']) ? trim($_GET['empleado']) : '';

$clientes = $pdo->query("SELECT id_cliente, nombre FROM Cliente ORDER BY nombre ASC")->fetchAll();
$empleados = $pdo->query("SELECT id_empleado, nombre FROM Empleado ORDER BY nombre ASC")->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Ventas</p>
            <h1>Registrar venta</h1>
            <p class="muted">Captura una nueva venta y asigna el empleado responsable.</p>
        </div>
        <a class="btn" href="ventas.php">Ver historial</a>
    </div>

    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="guardar_venta.php" class="form-grid">
            <div class="form-group">
                <label class="form-label">Cliente</label>
                <select name="id_cliente" class="form-input">
                    <option value="">Público general</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['id_cliente'] ?>" <?= $clienteAnterior == $cliente['id_cliente'] ? 'selected' : '' ?>><?= htmlspecialchars($cliente['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Empleado responsable <span class="required">*</span></label>
                <select name="id_empleado" class="form-input" required>
                    <option value="">Seleccione...</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?= $empleado['id_empleado'] ?>" <?= $empleadoAnterior == $empleado['id_empleado'] ? 'selected' : '' ?>><?= htmlspecialchars($empleado['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Total de la venta (MXN) <span class="required">*</span></label>
                <input type="number" name="total" step="0.01" min="0" class="form-input" required value="<?= htmlspecialchars($totalAnterior) ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar venta</button>
                <a class="btn" href="ventas.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>