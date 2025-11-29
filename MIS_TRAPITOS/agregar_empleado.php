<?php
require 'includes/db.php';
require 'includes/header.php';

$error = isset($_GET['error']) ? trim($_GET['error']) : '';
$nombreAnterior = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
$usuarioAnterior = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$rolAnterior = isset($_GET['rol']) ? trim($_GET['rol']) : '';
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Personal</p>
            <h1>Agregar empleado</h1>
            <p class="muted">Crea nuevas cuentas para tu equipo de trabajo.</p>
        </div>
        <a class="btn" href="empleados.php">Ver empleados</a>
    </div>

    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="guardar_empleado.php" class="form-grid">
            <div class="form-group">
                <label class="form-label">Nombre completo <span class="required">*</span></label>
                <input type="text" name="nombre" class="form-input" required value="<?= htmlspecialchars($nombreAnterior) ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Usuario <span class="required">*</span></label>
                <input type="text" name="usuario" class="form-input" required value="<?= htmlspecialchars($usuarioAnterior) ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Contraseña <span class="required">*</span></label>
                <input type="password" name="contrasena" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Rol</label>
                <input type="text" name="rol" class="form-input" placeholder="Ej. Administrador" value="<?= htmlspecialchars($rolAnterior) ?>">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar empleado</button>
                <a class="btn" href="empleados.php">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>