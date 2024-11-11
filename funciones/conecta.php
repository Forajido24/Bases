<?php
//funciones/conecta.php
define("HOST", 'localhost');
define("BD",'marketcucei');
define("USER_BD", 'root');
define("PASS_BD", '');

function conecta(){
    $con = new mysqli(HOST, USER_BD, PASS_BD, BD);

    if ($con->connect_error) {
        error_log("Error de conexión: " . $con->connect_error);
        die("Error de conexión: " . $con->connect_error);
    }

    return $con;
}
?>