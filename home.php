<?php
// bienvenido.php

session_start();

// Verificar si el usuario ha iniciado sesión
$usuarioIniciado = isset($_SESSION['idUser']);
$nombreUsuario = $usuarioIniciado ? $_SESSION['nombreUser'] : '';

// Conexión a la base de datos
require_once 'funciones/conecta.php';
$conn = conecta();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* General */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }

        /* Encabezado */
        header {
            background-color: #FF6900;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            font-size: 24px;
            position: relative;
        }
        
        .login-option {
            float: right;
        }
        .welcome-message {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 16px;
            color: #ffffff;
        }


        

        /* Navegación */
        nav {
            background-color: #333;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Contenido principal */
        .main-content {
            text-align: center;
            padding: 20px;
        }

        .welcome-image {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Home</h1>
        <?php if ($usuarioIniciado): ?>
            <p class="welcome-message">Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?></p>
        <?php endif; ?>
        
    </header>

    <nav>
        <a href="home.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="#">Promociones</a>
        <?php if ($usuarioIniciado): ?>
        <a href="cerrar_sesion.php" class="login-option">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php" class="login-option">Iniciar Sesión</a>
        <?php endif; ?>
    </nav>

    <div class="main-content">
        <h2>Bienvenido al sistema, escoge tu opción</h2>
        <img src="archivos/HOLA.jpeg" alt="Imagen de ejemplo" class="welcome-image">
    </div>
</body>

</html>

<?php
$conn->close();
?>
