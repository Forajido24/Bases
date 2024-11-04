<?php
require "conecta.php";
$con = conecta();

// Recibe los datos del formulario
$empleadoID = $_POST['empleadoID'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$rol = $_POST['rol'];

// Actualiza solo los campos necesarios en la base de datos
$sql = "UPDATE empleados
        SET nombre = '$nombre',
            apellidos = '$apellidos',
            correo = '$correo',
            rol = '$rol'
        WHERE id = '$empleadoID'";

$res = $con->query($sql);

// Puedes agregar manejo de errores y enviar respuestas personalizadas según sea necesario

echo "Cambios guardados exitosamente";
?>
