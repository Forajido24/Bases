<?php
require "conecta.php";
$con = conecta();

// Recibe los datos del formulario
if (isset($_POST['productoID'])) {
    $productoID = $_POST['productoID'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $baja = isset($_POST['baja']) ? (int) $_POST['baja'] : 0;
    $eliminado = isset($_POST['eliminado']) ? (int) $_POST['eliminado'] : 0;

    // Verifica si se envió un archivo de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $carpeta_destino = 'funciones/archivos/'; // Asegúrate de que esta ruta exista

        $nombre_archivo = uniqid('imagen_', true) . '_' . $_FILES['imagen']['name'];

        $ruta_imagen = $carpeta_destino . $nombre_archivo;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, archivo = ?, baja = ?, eliminado = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssdsiii", $nombre, $descripcion, $precio, $ruta_imagen, $baja, $eliminado, $productoID);
    } else {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, baja = ?, eliminado = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssdsii", $nombre, $descripcion, $precio, $baja, $eliminado, $productoID);
    }

    $stmt->execute();

    echo "Cambios guardados exitosamente";

    $stmt->close();
} else {
    echo "ID del producto no proporcionado";
}

$con->close();