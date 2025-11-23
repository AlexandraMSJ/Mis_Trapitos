<?php
// 1. Incluir conexión y seguridad (header ya tiene session_start)
require 'includes/db.php';
require 'includes/header.php';

// 2. CONSULTAS SQL PARA LAS ESTADÍSTICAS (KPIs)
// Total de Productos
$stmt = $pdo->query("SELECT COUNT(*) FROM Producto");
$totalProductos = $stmt->fetchColumn();

// Productos con Stock Bajo (Menos de 5 unidades)
$stmt = $pdo->query("SELECT COUNT(*) FROM Producto WHERE stock_actual <= 5");
$stockBajo = $stmt->fetchColumn();

// Total de Proveedores
$stmt = $pdo->query("SELECT COUNT(*) FROM Proveedor");
$totalProveedores = $stmt->fetchColumn();

// 3. CONSULTA PARA LA TABLA (Últimos 5 productos agregados)
// Hacemos un JOIN con Proveedor para mostrar el nombre de la empresa y no solo el ID
$sqlRecientes = "SELECT p.*, pr.nombre as nombre_proveedor 
                 FROM Producto p 
                 JOIN Proveedor pr ON p.id_proveedor = pr.id_proveedor 
                 ORDER BY p.id_producto DESC LIMIT 5";
$stmt = $pdo->query($sqlRecientes);
$productosRecientes = $stmt->fetchAll();
?>

<div class="dashboard-container">
    
    <div class="welcome-banner">
        <h1>Hola, <?= htmlspecialchars($_SESSION['nombre']) ?> 👋</h1>
        <p>Aquí tienes el resumen de lo que pasa en tu tienda hoy.</p>
    </div>

    <div class="stats-grid">
        
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Productos</h3>
                <span class="stat-number"><?= $totalProductos ?></span>
            </div>
            <div class="stat-icon" style="color: var(--primary);">👕</div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #ef4444;">
            <div class="stat-info">
                <h3>Stock Bajo</h3>
                <span class="stat-number" style="color: #ef4444;"><?= $stockBajo ?></span>
            </div>
            <div class="stat-icon" style="color: #ef4444;">⚠️</div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Proveedores</h3>
                <span class="stat-number"><?= $totalProveedores ?></span>
            </div>
            <div class="stat-icon" style="color: var(--text-muted);">🚚</div>
        </div>
        
    </div>

    <div class="table-container">
        <div class="table-header">
            <h2>📦 Últimos Productos Agregados</h2>
            <a href="productos.php" class="btn" style="width: auto; padding: 8px 15px; font-size: 0.9rem;">Ver todo</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Proveedor</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($totalProductos > 0): ?>
                    <?php foreach ($productosRecientes as $prod): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($prod['nombre']) ?></strong>
                                <br>
                                <span style="font-size:0.8rem; color:#888;">Talla: <?= $prod['talla'] ?></span>
                            </td>
                            <td><?= htmlspecialchars($prod['categoria']) ?></td>
                            <td>$<?= number_format($prod['precio'], 2) ?></td>
                            <td>
                                <?php if($prod['stock_actual'] <= 5): ?>
                                    <span class="badge badge-low"><?= $prod['stock_actual'] ?> Unid.</span>
                                <?php else: ?>
                                    <span class="badge badge-ok"><?= $prod['stock_actual'] ?> Unid.</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($prod['nombre_proveedor']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px; color: #888;">
                            Aún no hay productos registrados. <br>
                            <a href="productos.php" style="color:var(--primary); font-weight:bold;">¡Agrega el primero aquí!</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>