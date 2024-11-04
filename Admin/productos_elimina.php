<?php
// productos_eliminar.php
require "funciones/conecta.php";
$con = conecta();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
    $res = $con->query($sql);

    // No es necesario imprimir nada en la respuesta
} else {
    // En caso de que el ID de producto no sea proporcionado
    http_response_code(400); // Código de respuesta HTTP 400 Bad Request
}
?>
