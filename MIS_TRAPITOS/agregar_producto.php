<?php
require 'includes/db.php';
require 'includes/header.php';

$mensaje = isset($_GET['msg']) ? $_GET['msg'] : '';

// Obtener proveedores para el formulario
$stmt = $pdo->query("SELECT id_proveedor, nombre FROM Proveedor ORDER BY nombre");
$proveedores = $stmt->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Inventario</p>
            <h1>Agregar producto</h1>
            <p class="muted">Completa los datos del artículo y vincúlalo a un proveedor.</p>
        </div>
        <a class="btn" href="productos.php">Volver a inventario</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="card">
        <h2>Nuevo producto</h2>
        <form action="guardar_producto.php" method="POST" class="form-grid">
            <div class="form-group">
                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-input" type="text" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="categoria">Categoría</label>
                <input class="form-input" type="text" name="categoria" id="categoria" placeholder="Ej. Camisas" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="talla">Talla</label>
                <input class="form-input" type="text" name="talla" id="talla" placeholder="S, M, L" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="color">Color</label>
                <input class="form-input" type="text" name="color" id="color" placeholder="Ej. Negro" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="precio">Precio ($)</label>
                <input class="form-input" type="number" step="0.01" min="0" name="precio" id="precio" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="stock_actual">Stock actual</label>
                <input class="form-input" type="number" min="0" name="stock_actual" id="stock_actual" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="id_proveedor">Proveedor</label>
                <select class="form-input" name="id_proveedor" id="id_proveedor" required>
                    <option value="">Selecciona proveedor</option>
                    <?php foreach ($proveedores as $prov): ?>
                        <option value="<?= $prov['id_proveedor'] ?>"><?= htmlspecialchars($prov['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar producto</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>