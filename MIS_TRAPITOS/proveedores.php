<?php
require 'includes/db.php';
require 'includes/header.php';

$mensaje = isset($_GET['msg']) ? $_GET['msg'] : '';

$proveedores = $pdo->query("SELECT * FROM Proveedor ORDER BY id_proveedor DESC")->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Relaciones</p>
            <h1>Proveedores</h1>
            <p class="muted">Consulta y administra tus aliados comerciales.</p>
        </div>
        <div class="page-actions">
            <a class="btn" href="agregar_proveedor.php">Agregar proveedor</a>
            <a class="btn" href="productos.php">Ver productos</a>
        </div>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="table-wrapper">
        <div class="table-header">
            <h2>Listado</h2>
            <a class="btn" href="agregar_proveedor.php">Nuevo proveedor</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($proveedores) > 0): ?>
                    <?php foreach ($proveedores as $prov): ?>
                        <tr>
                            <td>#<?= $prov['id_proveedor'] ?></td>
                            <td><?= htmlspecialchars($prov['nombre']) ?></td>
                            <td><?= htmlspecialchars($prov['telefono']) ?></td>
                            <td><?= htmlspecialchars($prov['correo']) ?></td>
                            <td><?= htmlspecialchars($prov['direccion']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px;">Aún no hay proveedores registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>