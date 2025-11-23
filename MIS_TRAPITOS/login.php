<?php
require 'includes/db.php';
session_start();

// Si ya está logueado, enviar al inicio
if(isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Buscamos al empleado por su USUARIO
    $stmt = $pdo->prepare("SELECT * FROM Empleado WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $empleado = $stmt->fetch();

    if ($empleado && $password === $empleado['contrasena']) {
        $_SESSION['usuario_id'] = $empleado['id_empleado'];
        $_SESSION['nombre'] = $empleado['nombre'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><div class="logo">
                <img src="img/logo.jpg" alt="logo"> MIS TRAPITOS
                </div>
            </li>
        </ul>
    </nav>
    <div class="login-layout">
        <div class="login-side">
            <div class="login-header">
                <h1>¡Bienvenido de nuevo!</h1>
                <p>Ingresa tus datos para gestionar tu tienda.</p>
            </div>
            <form method="POST"> 
                
                <div class="form-group">
                    <label class="form-label">Usuario</label>
                    
                    <input type="text" name="usuario" class="form-input" placeholder="Ej. admin" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Contraseña</label>
                    
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-primary btn-block">Ingresar al Sistema</button>

                <div class="auth-links">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>

            </form>
        </div>
        <div class="image-side">
            </div>
    </div>
</body>
</html>