<?php
require 'includes/db.php';
require 'includes/header.php';

$mensaje = isset($_GET['msg']) ? trim($_GET['msg']) : '';
$error = isset($_GET['error']) ? trim($_GET['error']) : '';

$empleados = $pdo->query("SELECT * FROM Empleado ORDER BY id_empleado DESC")->fetchAll();
?>

<div class="container">
    <div class="page-header">
        <div>
            <p class="eyebrow">Personal</p>
            <h1>Empleados</h1>
            <p class="muted">Consulta y administra a las personas que operan la tienda.</p>
        </div>
        <a class="btn" href="agregar_empleado.php">Agregar empleado</a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="table-wrapper">
        <div class="table-header">
            <h2>Equipo registrado</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($empleados) > 0): ?>
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                            <td><?= htmlspecialchars($empleado['usuario']) ?></td>
                            <td><?= htmlspecialchars($empleado['rol']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center; padding:20px;">Aún no hay empleados registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>