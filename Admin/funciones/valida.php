<?php
// funciones/valida.php

// Inicia la sesión
session_start();

// Incluye el archivo de conexión (asegúrate de que conecta.php esté en la misma carpeta)
include('conecta.php');

// Verifica si se reciben los datos de contraseña
if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];

    $passEnc = md5($pass);

    // Llama a la función de conexión
    $conexion = conecta();

    // Verifica si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Utiliza sentencias preparadas para prevenir SQL injection
    $query = "SELECT id, nombre FROM vendedor WHERE contraseña = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $pass);
    $stmt->execute();
    $stmt->bind_result($id, $nombre);
    $stmt->fetch();

    // Verifica si se encontró un usuario con esa contraseña
    if ($id) {
        // Almacena el ID y el nombre en las variables de sesión
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $nombre;

        // Devuelve el ID como respuesta
        echo $id;
    } else {
        echo 0; // No se encontró un usuario con esa contraseña
    }

    // Cierra la conexión y el statement
    $stmt->close();
    $conexion->close();
} else {
    echo 0; // Datos no recibidos correctamente
}
?>
