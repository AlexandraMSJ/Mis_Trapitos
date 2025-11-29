<?php
session_start();
// Si no hay usuario logueado, mandar al login, EXCEPTO si ya estamos en login.php
if (!isset($_SESSION['usuario_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit;
}

$currentPage = basename($_SERVER['PHP_SELF']);
$inicioActivos = $currentPage === 'index.php';
$productosActivos = $currentPage === 'productos.php';
$proveedoresActivos = $currentPage === 'proveedores.php';
$ventasActivos = $currentPage === 'ventas.php';
$empleadosActivos = $currentPage === 'empleados.php';
$clientesActivos = $currentPage === 'clientes.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Moda Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (isset($_SESSION['usuario_id'])): ?>
<nav>
    <ul class="nav-brand">
        <li>
            <div class="logo">
                <img src="img/logo.jpg" alt="logo"> MIS TRAPITOS
            </div>
        </li>
    </ul>
    <ul class="nav-links">
        <li>
            <a href="index.php" class="<?= $inicioActivos ? 'active' : '' ?>">Inicio</a>
        </li>
        <li>
            <a href="proveedores.php" class="<?= $proveedoresActivos ? 'active' : '' ?>">Proveedores</a>
        </li>
        <li>
            <a href="productos.php" class="<?= $productosActivos ? 'active' : '' ?>">Productos</a>
        </li>
        <li>
            <a href="empleados.php" class="<?= $empleadosActivos ? 'active' : '' ?>">Empleados</a>
        </li>
        <li>
            <a href="ventas.php" class="<?= $ventasActivos ? 'active' : '' ?>">Ventas</a>
        </li>
        <li>
            <a href="clientes.php" class="<?= $clientesActivos ? 'active' : '' ?>">Clientes</a>
        </li>
        <li><a href="logout.php" style="color: var(--danger);">Salir</a></li>
    </ul>
</nav>
<?php endif; ?>