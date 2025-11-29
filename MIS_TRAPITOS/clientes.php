<?php
require 'includes/db.php';
require 'includes/header.php';

$mensaje = isset($_GET['msg']) ? trim($_GET['msg']) : '';
$error = isset($_GET['error']) ? trim($_GET['error']) : '';

$clientes = $pdo->query("SELECT * FROM Cliente ORDER BY id_cliente DESC")->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Clientes</p>
            <h1>Listado de clientes</h1>
            <p class="muted">Administra tus compradores recurrentes y sus datos de contacto.</p>
        </div>
        <a class="btn" href="agregar_cliente.php">Agregar cliente</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="table-wrapper">
        <div class="table-header">
            <h2>Clientes registrados</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clientes) > 0): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                            <td><?= htmlspecialchars($cliente['correo']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center; padding:20px;">Aún no hay clientes registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>