<?php
// funciones/valida.php

// Inicia la sesión
session_start();

// Incluye el archivo de conexión (asegúrate de que conecta.php esté en la misma carpeta)
include('conecta.php');

// Verifica si se reciben los datos de email y contraseña
if (isset($_POST['email']) && isset($_POST['pass'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Llama a la función de conexión
    $conexion = conecta();

    // Verifica si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Utiliza sentencias preparadas para prevenir SQL injection
    $query = "SELECT id, nombre FROM comprador WHERE email = ? AND contraseña = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $email, $pass); // Bindea tanto el email como la contraseña encriptada
    $stmt->execute();
    $stmt->bind_result($id, $nombre);
    $stmt->fetch();

    // Verifica si se encontró un usuario con el email y la contraseña correctos
    if ($id) {
        // Almacena el ID y el nombre en las variables de sesión
        $_SESSION['idUser'] = $id;
        $_SESSION['nombreUser'] = $nombre;

        // Devuelve 1 como respuesta de éxito
        echo 1;
    } else {
        echo 0; // No se encontró un usuario con el email y la contraseña proporcionados
    }

    // Cierra la conexión y el statement
    $stmt->close();
    $conexion->close();
} else {
    echo 0; // Datos no recibidos correctamente
}
