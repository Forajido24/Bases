<?php
require "funciones/conecta.php";
$con = conecta();

// Obtener el ID desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "ID de producto no válido.";
    exit();
}

$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

// Obtener los datos del producto
if ($row = $res->fetch_array()) {
    $nombre = $row["nombre"];
    $descripcion = $row["descripcion"];
    $precio = $row["precio"];
    $archivo = $row["archivo"];
    $archivo_path = "Admin/funciones/archivos/" . $archivo; // Construir la ruta completa
} else {
    echo "No se encontró el producto especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav {
            background-color: #333;
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 14px 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            margin-top: 20px;
            background-color: #ffffff;
            width: 60%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            text-align: center;
            font-size: 20px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            background-color: #f9f9f9;
            color: #333;
        }

        img {
            max-width: 80%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        .Regresar {
            background-color: #38a1db;
            color: #ffffff;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .Regresar:hover {
            background-color: #2c81b3;
        }

        .no-image {
            color: #999;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="productos.php">Regresar</a>
    </nav>
    <table border="3" width="40%" height="150%" align="center">
        <tr>
            <td>ID: <?php echo $id; ?></td>
        </tr>
        <tr>
            <td>NOMBRE: <?php echo $nombre; ?></td>
        </tr>
        <tr>
            <td>DESCRIPCIÓN: <?php echo $descripcion; ?></td>
        </tr>
        <tr>
            <td>PRECIO: <?php echo $precio; ?></td>
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
                <a href="productos.php">
                    <input class="Regresar" value="<= Regresar" type="button">
                </a>
            </td>
        </tr>
    </table>
</body>

</html>
