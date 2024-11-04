<?php
// bienvenido.php

session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #20cbba;
            color: #ffffff;
            text-align: center;
            padding: 10px;
        }
        td.apartado {
            background-color: #031d36;
            color: #ffffff;
            line-height: 22px;
            font-size: 25px;
        }
        tr.titulo {
            background-color: #020621;
            color: #ffffff;
            line-height: 30px;
            font-size: 30px;
        }
        input {
            background-color: #020621;
            color: #ffffff;
            font-size: 25px;
        }
        input.agregar {
            background-color: #20cbba;
            color: #ffffff;
            font-size: 30px;
            width: 90%;
        }
        a {
            font-size: 24px;
        }
        input.elimina, input.detalles, input.editar {
            width: 100%;
        }
        input.detalles {
            background-color: #38f341;
        }
        input.editar {
            background-color: #ffd700;
        }
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
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <h1>Bienvenido <?php echo $nombreUsuario; ?></h1>
    </header>

    <nav>
        <a href="Bienvenido.php">Inicio</a>
        <a href="productos_lista.php">Productos</a>
        <a href="promociones_lista.php">Promociones</a>
        <a href="cerrar_sesion.php">Cerrar Sesión</a>
    </nav>

    <div style="text-align: center;">
        <h2>Bienvenido al sistema escoge tu opcion</h2>
        <!-- Agregar la imagen centrada -->
        <img src="archivos/HOLA.jpeg" alt="Imagen de ejemplo" style="max-width: 100%; height: auto; margin-top: 20px;">
    </div>
</body>

</html>
