<?php
require 'includes/db.php';
require 'includes/header.php';

$error = isset($_GET['error']) ? trim($_GET['error']) : '';
$cantidadAnterior = isset($_GET['cantidad']) ? trim($_GET['cantidad']) : '';
$observacionesAnterior = isset($_GET['obs']) ? trim($_GET['obs']) : '';
$productoAnterior = isset($_GET['producto']) ? trim($_GET['producto']) : '';
$tipoAnterior = isset($_GET['tipo']) ? trim($_GET['tipo']) : '';

$productos = $pdo->query("SELECT id_producto, nombre, talla, color FROM Producto ORDER BY nombre ASC")->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Inventario</p>
            <h1>Registrar movimiento</h1>
            <p class="muted">Controla entradas, salidas y ajustes de tus productos.</p>
        </div>
        <a class="btn" href="inventario.php">Ver historial</a>
    </div>

    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="guardar_movimiento.php" class="form-grid">
            <div class="form-group">
                <label class="form-label">Producto <span class="required">*</span></label>
                <select name="id_producto" class="form-input" required>
                    <option value="">Seleccione...</option>
                    <?php foreach ($productos as $prod): ?>
                        <option value="<?= $prod['id_producto'] ?>" <?= $productoAnterior == $prod['id_producto'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($prod['nombre']) ?> (<?= htmlspecialchars($prod['talla']) ?> - <?= htmlspecialchars($prod['color']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Tipo de movimiento <span class="required">*</span></label>
                <select name="tipo_movimiento" class="form-input" required>
                    <option value="">Seleccione...</option>
                    <option value="Entrada" <?= $tipoAnterior === 'Entrada' ? 'selected' : '' ?>>Entrada (+)</option>
                    <option value="Salida" <?= $tipoAnterior === 'Salida' ? 'selected' : '' ?>>Salida (-)</option>
                    <option value="Ajuste" <?= $tipoAnterior === 'Ajuste' ? 'selected' : '' ?>>Ajuste (fijar stock)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Cantidad <span class="required">*</span></label>
                <input type="number" name="cantidad" class="form-input" min="0" step="1" required value="<?= htmlspecialchars($cantidadAnterior) ?>">
                <p class="muted" style="margin-top:4px;">Para ajustes, la cantidad será el nuevo stock.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-input" rows="3" placeholder="Ej. Entrada por compra" ><?= htmlspecialchars($observacionesAnterior) ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar movimiento</button>
                <a class="btn" href="inventario.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>