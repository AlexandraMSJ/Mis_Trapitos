<?php
session_start();
// Si no hay usuario logueado, mandar al login, EXCEPTO si ya estamos en login.php
if (!isset($_SESSION['usuario_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Moda Manager</title>
    <link rel="stylesheet" href="css/style.css"> </head>
<body>

<?php if (isset($_SESSION['usuario_id'])): ?>
<nav>
    <ul>
            <li>
                <div class="logo">
                    <img src="img/logo.jpg" alt="logo"> MIS TRAPITOS
                </div>
            </li>
    </ul>
    <ul>
        <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])=='index.php'?'active':'' ?>">Dashboard</a></li>
        <li><a href="productos.php" class="<?= basename($_SERVER['PHP_SELF'])=='productos.php'?'active':'' ?>">Inventario</a></li>
        <li><a href="ventas.php">Ventas</a></li>
        <li><a href="logout.php" style="color: var(--danger);">Salir</a></li>
    </ul>
</nav>
<?php endif; ?>

<div class="container"></div>