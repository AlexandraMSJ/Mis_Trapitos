<?php
require 'includes/db.php';
require 'includes/header.php';

$error = isset($_GET['error']) ? trim($_GET['error']) : '';
$nombreAnterior = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
$telefonoAnterior = isset($_GET['telefono']) ? trim($_GET['telefono']) : '';
$correoAnterior = isset($_GET['correo']) ? trim($_GET['correo']) : '';
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Clientes</p>
            <h1>Agregar cliente</h1>
            <p class="muted">Registra nuevos clientes para vincularlos a ventas futuras.</p>
        </div>
        <a class="btn" href="clientes.php">Ver clientes</a>
    </div>

    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="guardar_cliente.php" class="form-grid">
            <div class="form-group">
                <label class="form-label">Nombre completo <span class="required">*</span></label>
                <input type="text" name="nombre" class="form-input" required value="<?= htmlspecialchars($nombreAnterior) ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-input" placeholder="Ej. 555-123-4567" value="<?= htmlspecialchars($telefonoAnterior) ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-input" placeholder="correo@ejemplo.com" value="<?= htmlspecialchars($correoAnterior) ?>">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar cliente</button>
                <a class="btn" href="clientes.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>