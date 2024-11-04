<?php
//productos_salva.php
require "funciones/conecta.php";
$con = conecta();

// Recibe variables
$nombre       = $_REQUEST['nombre'];
$codigo       = $_REQUEST['codigo'];
$descripcion  = $_REQUEST['descripcion'];
$costo        = $_REQUEST['costo'];
$stock        = $_REQUEST['stock'];
$archivo_n    = '';
$archivo      = '';

// Procesa la imagen
if (isset($_FILES['foto'])) {
    $file_name  = $_FILES['foto']['name'];
    $file_tmp   = $_FILES['foto']['tmp_name'];

    $arreglo    = explode(".", $file_name);
    $len        = count($arreglo);
    $pos        = $len - 1;
    $ext        = $arreglo[$pos];
    $dir        = "archivos/";
    $file_enc   = md5_file($file_tmp);

    $archivo_n  = "$file_enc.$ext";
    $archivo    = $dir . $archivo_n;

    move_uploaded_file($file_tmp, $archivo);
}

// Inserta los datos en la base de datos
$sql = "INSERT INTO productos
        (nombre, codigo, descripcion, costo, stock, archivo_n, archivo)
        VALUES ('$nombre', '$codigo', '$descripcion', '$costo', '$stock', '$archivo_n', '$archivo')";

$res = $con->query($sql);

// Redirecciona a la página B2.php después de procesar los datos
header("Location: productos_lista.php");
?>
