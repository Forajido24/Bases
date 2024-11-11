<?php
// productos_salva.php
require "../funciones/conecta.php";
session_start();

$con = conecta();
$con->autocommit(FALSE); // Deshabilita autocommit para controlar la transacción

// Verifica si la conexión a la base de datos fue exitosa
if ($con->connect_error) {
    error_log("Error en la conexión: " . $con->connect_error);
    die("Connection failed: " . $con->connect_error);
} else {
    error_log("Conexión a la base de datos exitosa");
}

// Verifica si el usuario está logueado
if (isset($_SESSION['id'])) {
    $idVendedor = $_SESSION['id'];
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $costo = $_REQUEST['costo'];
    $archivo_n = '';
    $archivo = '';

    // Procesa la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        $arreglo = explode(".", $file_name);
        $ext = end($arreglo);
        $dir = "../Admin/funciones/archivos/";
        $file_enc = md5_file($file_tmp);

        $archivo_n = "$file_enc.$ext";
        $archivo = $dir . $archivo_n;

        // Verificar si la carpeta existe, si no, crearla
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        if (move_uploaded_file($file_tmp, $archivo)) {
            error_log("Archivo movido exitosamente a: " . $archivo);
            // Inserta los datos en la base de datos con imagen
            $sql = "INSERT INTO productos (nombre, descripcion, precio, id_vendedor, archivo)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            if ($stmt === false) {
                error_log("Error en la preparación del statement: " . $con->error);
                die("Error preparing statement: " . $con->error);
            }
            $stmt->bind_param("ssdss", $nombre, $descripcion, $costo, $idVendedor, $archivo_n);
        } else {
            error_log("Error al mover el archivo");
            echo "Error al mover el archivo";
            exit;
        }
    } else {
        // Inserta los datos en la base de datos sin imagen
        $sql = "INSERT INTO productos (nombre, descripcion, precio, id_vendedor)
                VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            error_log("Error en la preparación del statement: " . $con->error);
            die("Error preparing statement: " . $con->error);
        }
        $stmt->bind_param("ssdi", $nombre, $descripcion, $costo, $idVendedor);
    }

    // Verifica si la consulta se ejecutó correctamente
    if ($stmt->execute()) {
        error_log("Producto agregado exitosamente con ID: " . $stmt->insert_id);
        echo "Producto agregado exitosamente con ID: " . $stmt->insert_id;
        $con->commit(); // Confirma la transacción
        // Usa redirección con script para evitar errores
        echo "<script>window.location.href='../Admin/productos_lista.php';</script>";
        exit;
    } else {
        error_log("Error al ejecutar la consulta: " . $stmt->error);
        echo "Error al agregar el producto: " . $stmt->error;
        $con->rollback(); // Revierte la transacción en caso de error
    }

    $stmt->close();
} else {
    error_log("Error: sesión no iniciada");
    echo "Error: sesión no iniciada";
}

$con->close();
?>