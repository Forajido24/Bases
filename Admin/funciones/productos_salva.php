<?php
//productos_salva.php
session_start();
require "conecta.php";
$con = conecta();

// Recibe variables del formulario
$nombre       = $_REQUEST['nombre'];
$descripcion  = $_REQUEST['descripcion'];
$costo        = $_REQUEST['costo'];  // Cambia esto a costo

// Toma el id del vendedor desde la sesión
$idVendedor = $_SESSION['id'];

// Procesa la imagen
$archivo = '';
if (isset($_FILES['foto'])) {
    $file_name  = $_FILES['foto']['name'];
    $file_tmp   = $_FILES['foto']['tmp_name'];
    $dir        = "archivos/";

    // Guarda el archivo en la carpeta "archivos" con su nombre original
    $archivo    = $file_name;
    move_uploaded_file($file_tmp, $archivo);
}

// Inserta los datos en la base de datos
$sql = "INSERT INTO productos
        (nombre, descripcion, precio, id_vendedor, archivo)
        VALUES ('$nombre', '$descripcion', '$costo', '$idVendedor', '$archivo')";

$res = $con->query($sql);

// Redirecciona a la página productos_lista.php después de procesar los datos
//header("Location: productos_lista.php");
//exit();

?>
