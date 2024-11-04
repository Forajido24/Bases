<?php
require "conecta.php";
$con = conecta();

// Recibe el ID del producto
$productoID = $_POST['productoID'];

// Realiza la consulta para obtener los datos del producto
$sql = "SELECT nombre, codigo, descripcion, costo, stock
        FROM productos 
        WHERE id = '$productoID'";

$res = $con->query($sql);

// Verifica si se encontró el producto
if ($row = $res->fetch_array()) {
    // Crea un array asociativo con los datos del producto
    $datosProducto = array(
        'nombre' => $row['nombre'],
        'codigo' => $row['codigo'],
        'descripcion' => $row['descripcion'],
        'costo' => $row['costo'],
        'stock' => $row['stock']
    );

    // Devuelve los datos del producto en formato JSON
    echo json_encode($datosProducto);
} else {
    // Puedes manejar la situación si no se encuentra el producto
    echo "Producto no encontrado";
}
?>
