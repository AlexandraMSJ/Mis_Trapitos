<?php
session_start();
// Si no hay usuario logueado, mandar al login, EXCEPTO si ya estamos en login.php
if (!isset($_SESSION['usuario_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit;
}

$currentPage = basename($_SERVER['PHP_SELF']);
$inicioActivos = in_array($currentPage, ['index.php', 'bienvenida.php']);
$productosActivos = in_array($currentPage, ['productos.php', 'agregar_producto.php']);
$proveedoresActivos = in_array($currentPage, ['proveedores.php', 'agregar_proveedor.php']);
$ventasActivos = in_array($currentPage, ['ventas.php', 'registrar_venta.php']);
$empleadosActivos = in_array($currentPage, ['empleados.php', 'agregar_empleado.php']);
$clientesActivos = in_array($currentPage, ['clientes.php', 'agregar_cliente.php']);
$inventarioActivos = in_array($currentPage, ['inventario.php', 'agregar_movimiento.php']);
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
        <li class="dropdown">
            <a href="index.php" class="<?= $inicioActivos ? 'active' : '' ?>">Inicio</a>
            <ul class="dropdown-menu">
                <li><a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">Dashboard</a></li>
                <li><a href="bienvenida.php" class="<?= $currentPage === 'bienvenida.php' ? 'active' : '' ?>">Bienvenida</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="productos.php" class="<?= $productosActivos ? 'active' : '' ?>">Productos</a>
            <ul class="dropdown-menu">
                <li><a href="agregar_producto.php" class="<?= $currentPage === 'agregar_producto.php' ? 'active' : '' ?>">Agregar producto</a></li>
                <li><a href="productos.php" class="<?= $currentPage === 'productos.php' ? 'active' : '' ?>">Consultar inventario</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="proveedores.php" class="<?= $proveedoresActivos ? 'active' : '' ?>">Proveedores</a>
            <ul class="dropdown-menu">
                <li><a href="agregar_proveedor.php" class="<?= $currentPage === 'agregar_proveedor.php' ? 'active' : '' ?>">Agregar proveedor</a></li>
                <li><a href="proveedores.php" class="<?= $currentPage === 'proveedores.php' ? 'active' : '' ?>">Consultar registro</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="ventas.php" class="<?= $ventasActivos ? 'active' : '' ?>">Ventas</a>
            <ul class="dropdown-menu">
                <li><a href="registrar_venta.php" class="<?= $currentPage === 'registrar_venta.php' ? 'active' : '' ?>">Registrar venta</a></li>
                <li><a href="ventas.php" class="<?= $currentPage === 'ventas.php' ? 'active' : '' ?>">Historial</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="empleados.php" class="<?= $empleadosActivos ? 'active' : '' ?>">Empleados</a>
            <ul class="dropdown-menu">
                <li><a href="agregar_empleado.php" class="<?= $currentPage === 'agregar_empleado.php' ? 'active' : '' ?>">Agregar empleado</a></li>
                <li><a href="empleados.php" class="<?= $currentPage === 'empleados.php' ? 'active' : '' ?>">Consultar empleados</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="clientes.php" class="<?= $clientesActivos ? 'active' : '' ?>">Clientes</a>
            <ul class="dropdown-menu">
                <li><a href="agregar_cliente.php" class="<?= $currentPage === 'agregar_cliente.php' ? 'active' : '' ?>">Agregar cliente</a></li>
                <li><a href="clientes.php" class="<?= $currentPage === 'clientes.php' ? 'active' : '' ?>">Consultar clientes</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="inventario.php" class="<?= $inventarioActivos ? 'active' : '' ?>">Inventario</a>
            <ul class="dropdown-menu">
                <li><a href="agregar_movimiento.php" class="<?= $currentPage === 'agregar_movimiento.php' ? 'active' : '' ?>">Registrar movimiento</a></li>
                <li><a href="inventario.php" class="<?= $currentPage === 'inventario.php' ? 'active' : '' ?>">Historial</a></li>
            </ul>
        </li>
        <li><a href="logout.php" style="color: var(--danger);">Salir</a></li>
    </ul>
</nav>
<?php endif; ?>