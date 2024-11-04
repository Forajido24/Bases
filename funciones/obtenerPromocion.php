<?php
require "conecta.php";
$con = conecta();

// Recibe el ID de la promoción
$promocionID = $_POST['promocionID'];

// Realiza la consulta para obtener los datos de la promoción
$sql = "SELECT nombre, archivo_n, archivo
        FROM promociones 
        WHERE id = '$promocionID'";

$res = $con->query($sql);

// Verifica si se encontró la promoción
if ($row = $res->fetch_array()) {
    // Crea un array asociativo con los datos de la promoción
    $datosPromocion = array(
        'nombre' => $row['nombre'],
        'archivo_n' => $row['archivo_n'],
        'archivo' => $row['archivo']
    );

    // Devuelve los datos de la promoción en formato JSON
    echo json_encode($datosPromocion);
} else {
    // Puedes manejar la situación si no se encuentra la promoción
    echo "Promoción no encontrada";
}
?>
