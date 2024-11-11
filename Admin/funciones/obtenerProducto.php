<?php
require "conecta.php";
$con = conecta();

if (isset($_POST['productoID'])) {
    $productoID = $_POST['productoID'];

    // Agregar registro para depuración
    error_log("ID del producto recibido: " . $productoID);

    // Ajustar la consulta según las columnas existentes en la base de datos
    $sql = "SELECT nombre, descripcion, precio, archivo, baja, eliminado FROM productos WHERE id = ?";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $con->error);
        echo json_encode(['error' => 'Error al preparar la consulta']);
        exit;
    }

    $stmt->bind_param("i", $productoID);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'ID del producto no proporcionado']);
}

$con->close();
?>