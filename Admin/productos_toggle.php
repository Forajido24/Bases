<?php
require "funciones/conecta.php";
$con = conecta();

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE productos SET eliminado = ? WHERE id = ?";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $con->error);
    }

    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "El estado del producto ha sido actualizado.";
    } else {
        echo "No se pudo actualizar el estado del producto.";
    }

    $stmt->close();
} else {
    http_response_code(400); // Código de respuesta HTTP 400 Bad Request
}
$con->close();
?>