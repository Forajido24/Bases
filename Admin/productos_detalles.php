<?php
// bienvenido.php

session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];
?>
<?php
// productos_detalles.php
require "funciones/conecta.php";
$con = conecta();

// Obtener la posición desde la URL
$posicion_deseada = isset($_GET['posicion']) ? intval($_GET['posicion']) : 1;

$sql = "SELECT *
        FROM productos
        WHERE eliminado = 0";
$res = $con->query($sql);

// Mover el puntero a la posición deseada
mysqli_data_seek($res, $posicion_deseada - 1);

// Obtener los datos de la posición deseada
if ($row = $res->fetch_array()) {
    $id = $row["id"];
    $nombre = $row["nombre"];
    $codigo = $row["codigo"];
    $descripcion = $row["descripcion"];
    $costo = $row["costo"];
    $stock = $row["stock"];
    $archivo_n = $row["archivo_n"];
    $archivo_path = "archivos/" . $archivo_n; // Construir la ruta completa
} else {
    echo "No hay datos en la posición especificada.";
    exit; // Salir para evitar que se ejecute el resto del código
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        td {
            background-color: #031d36;
            color: #ffffff;
            line-height: 22px;
            font-size: 25px;
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        input.Regresar {
            font-size: 25px;
            background-color: #38f341;
            width: 100%;
        }
    </style>
</head>

<body>
    <table border="3" width="40%" height="150%" align="center">
        <tr>
            <td>
                ID: <?php echo $id; ?>
            </td>
        </tr>
        <tr>
            <td>
                NOMBRE: <?php echo $nombre; ?>
            </td>
        </tr>
        <tr>
            <td>
                CÓDIGO: <?php echo $codigo; ?>
            </td>
        </tr>
        <tr>
            <td>
                DESCRIPCIÓN: <?php echo $descripcion; ?>
            </td>
        </tr>
        <tr>
            <td>
                COSTO: <?php echo $costo; ?>
            </td>
        </tr>
        <tr>
            <td>
                STOCK: <?php echo $stock; ?>
            </td>
        </tr>
        <tr>
            <td>
                <!-- Muestra la imagen si hay, de lo contrario, muestra el mensaje -->
                <?php if (!empty($archivo_path) && file_exists($archivo_path)) : ?>
                    <img src="<?php echo $archivo_path; ?>" alt="Imagen del producto">
                <?php else : ?>
                    <p>No hay imagen para mostrar.</p>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a href="productos_lista.php">
                    <input class="Regresar" value="<= Regresar" type="button">
                </a>
            </td>
        </tr>
    </table>
</body>

</html>
