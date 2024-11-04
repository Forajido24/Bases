<?php
// promociones_salva.php
require "funciones/conecta.php";
$con = conecta();

// Validación y limpieza de datos
$nombre = isset($_REQUEST['nombre']) ? mysqli_real_escape_string($con, $_REQUEST['nombre']) : '';

$archivo_n = '';
$archivo = '';

// Procesa la imagen
if (isset($_FILES['foto'])) {
    $file_name = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    $arreglo = explode(".", $file_name);
    $len = count($arreglo);
    $pos = $len - 1;
    $ext = $arreglo[$pos];
    $dir = "archivos/";
    $file_enc = md5_file($file_tmp);

    $archivo_n = "$file_enc.$ext";
    $archivo = $dir . $archivo_n;

    move_uploaded_file($file_tmp, $archivo);
}

// Inserta los datos en la base de datos
$sql = "INSERT INTO promociones (nombre, archivo_n, archivo) VALUES ('$nombre', '$archivo_n', '$archivo')";

// Manejo de errores
if ($con->query($sql)) {
    // Redirecciona a la página de lista de promociones después de procesar los datos
    header("Location: promociones_lista.php");
} else {
    // Manejo de errores
    echo "Error: " . $con->error;
}
?>
