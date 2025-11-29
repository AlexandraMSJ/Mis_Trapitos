<?php
require 'includes/db.php';
require 'includes/header.php';

$mensaje = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Relaciones</p>
            <h1>Agregar proveedor</h1>
            <p class="muted">Ingresa los datos básicos para vincularlos a tus compras.</p>
        </div>
        <a class="btn" href="proveedores.php">Volver al listado</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="card">
        <h2>Nuevo proveedor</h2>
        <form method="POST" action="guardar_proveedor.php" class="form-grid">
            <div class="form-group">
                <label class="form-label" for="nombre">Nombre de la empresa</label>
                <input class="form-input" type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="telefono">Teléfono</label>
                <input class="form-input" type="tel" name="telefono" id="telefono" placeholder="(XXX) XXX-XXXX">
            </div>
            <div class="form-group">
                <label class="form-label" for="correo">Correo electrónico</label>
                <input class="form-input" type="email" name="correo" id="correo" placeholder="correo@empresa.com">
            </div>
            <div class="form-group">
                <label class="form-label" for="direccion">Dirección</label>
                <input class="form-input" type="text" name="direccion" id="direccion" placeholder="Calle, número, ciudad">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar proveedor</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>