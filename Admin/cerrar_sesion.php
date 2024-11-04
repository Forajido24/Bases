<?php
// cerrar_sesion.php

session_start();

// Destruir todas las variables de sesión
$_SESSION = array();


// Destruir la sesión
session_destroy();

// Redirigir al index.php después de cerrar sesión
header("Location: index.php");
exit();
?>
