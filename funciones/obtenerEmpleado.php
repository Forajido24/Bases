<?php
require "conecta.php";
$con = conecta();

// Recibe el ID del empleado
$empleadoID = $_POST['empleadoID'];

// Realiza la consulta para obtener los datos del empleado
$sql = "SELECT nombre, apellidos, correo, rol
        FROM empleados 
        WHERE id = '$empleadoID'";

$res = $con->query($sql);

// Verifica si se encontró al empleado
if ($row = $res->fetch_array()) {
    // Crea un array asociativo con los datos del empleado
    $datosEmpleado = array(
        'nombre' => $row['nombre'],
        'apellidos' => $row['apellidos'],
        'correo' => $row['correo'],
        'rol' => $row['rol']
    );

    // Devuelve los datos del empleado en formato JSON
    echo json_encode($datosEmpleado);
} else {
    // Puedes manejar la situación si no se encuentra al empleado
    echo "Empleado no encontrado";
}
?>
