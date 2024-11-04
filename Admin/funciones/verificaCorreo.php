<?php
// funciones/valida.php

// Incluye el archivo de conexión (asegúrate de que conecta.php esté en la misma carpeta)
include('conecta.php');

// Verifica si se reciben los datos de correo
if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];

    // Llama a la función de conexión
    $conexion = conecta();

    // Verifica si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Utiliza sentencias preparadas para prevenir SQL injection
    $query = "SELECT id FROM vendedor WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();

    // Devuelve el ID si el correo existe, de lo contrario, devuelve 0
    echo ($id) ? $id : 0;

    // Cierra la conexión y el statement
    $stmt->close();
    $conexion->close();
} else {
    echo 0; // Datos no recibidos correctamente
}
?>
