<?php
require "conecta.php";
$con = conecta();

// Recibe los datos del formulario
$productoID = $_POST['productoID'];
$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$stock = $_POST['stock'];

// Verifica si se envió un archivo de imagen
if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Define la carpeta donde se guardará la imagen
    $carpeta_destino = 'ruta/donde/guardar/imagenes/';

    // Genera un nombre único para la imagen
    $nombre_archivo = uniqid('imagen_', true) . '_' . $_FILES['imagen']['name'];

    // Construye la ruta completa del archivo de imagen
    $ruta_imagen = $carpeta_destino . $nombre_archivo;

    // Mueve el archivo de la ubicación temporal a la carpeta de destino
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);

    // Agrega la ruta de la imagen a la consulta SQL
    $sql = "UPDATE productos
            SET nombre = '$nombre',
                codigo = '$codigo',
                descripcion = '$descripcion',
                costo = '$costo',
                stock = '$stock',
                ruta_imagen = '$ruta_imagen'
            WHERE id = '$productoID'";
} else {
    // Si no se envió una nueva imagen, actualiza solo los otros campos
    $sql = "UPDATE productos
            SET nombre = '$nombre',
                codigo = '$codigo',
                descripcion = '$descripcion',
                costo = '$costo',
                stock = '$stock'
            WHERE id = '$productoID'";
}

$res = $con->query($sql);

// Puedes agregar manejo de errores y enviar respuestas personalizadas según sea necesario

echo "Cambios guardados exitosamente";
?>
