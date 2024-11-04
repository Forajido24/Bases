<?php
// cerrar_sesion.php

session_start();

// Destruir solo las variables de sesión específicas
unset($_SESSION['idUser']);
unset($_SESSION['nombreUser']);

// Opcional: Puedes verificar si otras variables de sesión están activas o destruir la sesión si está completamente vacía
if (empty($_SESSION)) {
    session_destroy();
}

// Redirigir al login después de cerrar sesión
header("Location: login.php");
exit();
?>
