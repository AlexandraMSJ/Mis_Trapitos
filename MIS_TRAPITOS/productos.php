<?php
require 'includes/db.php';
require 'includes/header.php';

// Obtener listado de productos con información de proveedor
$sqlProductos = "SELECT p.*, pr.nombre AS proveedor_nombre
                 FROM Producto p
                 LEFT JOIN Proveedor pr ON p.id_proveedor = pr.id_proveedor
                 ORDER BY p.id_producto DESC";
$productos = $pdo->query($sqlProductos)->fetchAll();

$mensaje = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Inventario</p>
            <h1>Productos</h1>
            <p class="muted">Revisa existencias, precios y proveedores asignados.</p>
        </div>
        <div class="page-actions">
            <a class="btn" href="agregar_producto.php">Agregar producto</a>
            <a class="btn" href="inventario.php">Ver movimientos</a>
        </div>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="table-wrapper">
        <div class="table-header">
            <h2>Inventario actual</h2>
            <a class="btn" href="agregar_producto.php">Nuevo producto</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($productos) > 0): ?>
                    <?php foreach ($productos as $prod): ?>
                        <tr>
                            <td><?= htmlspecialchars($prod['nombre']) ?></td>
                            <td><?= htmlspecialchars($prod['categoria']) ?></td>
                            <td><?= htmlspecialchars($prod['talla']) ?></td>
                            <td><?= htmlspecialchars($prod['color']) ?></td>
                            <td><?= $prod['proveedor_nombre'] ? htmlspecialchars($prod['proveedor_nombre']) : 'Sin asignar' ?></td>
                            <td>$<?= number_format($prod['precio'], 2) ?></td>
                            <td>
                                <?php if($prod['stock_actual'] <= 5): ?>
                                    <span class="badge badge-low"><?= $prod['stock_actual'] ?> unid.</span>
                                <?php else: ?>
                                    <span class="badge badge-ok"><?= $prod['stock_actual'] ?> unid.</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">Aún no hay productos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>