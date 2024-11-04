<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario'; // Verifica si el nombre existe

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketcucei";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener productos del usuario logueado
$idVendedor = $_SESSION['id'];
$sql = "SELECT id, nombre, descripcion, precio, archivo FROM productos WHERE id_vendedor = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $idVendedor);
$stmt->execute();
$res = $stmt->get_result();

if ($res === false) {
    die("Error executing query: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Listado de Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function eliminarfila(id) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este producto?");
            if (confirmacion) {
                $.ajax({
                    type: "POST",
                    url: 'productos_elimina.php',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        $('#fila' + id).hide();
                    },
                    error: function() {
                        alert("Error al eliminar");
                    }
                });
            }
        }
        function redirigirDetalles(id) {
            var url = 'productos_detalles.php?id=' + id;
            window.location.href = url;
        }
        function redirigirEdicion(id) {
            var url = 'productos_edita.php?id=' + id;
            window.location.href = url;
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        header {
            background-color: #FF6900;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 16px;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        a {
            font-size: 24px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #020621;
            color: #ffffff;
            font-size: 20px;
        }
        .apartado {
            background-color: #031d36;
            color: #ffffff;
            font-size: 18px;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        td {
            font-size: 16px;
            border: 1px solid #ddd;
        }
        img.product-image {
            width: 80px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
        }
        input.elimina, input.detalles, input.editar, input.agregar {
            color: #ffffff;
            font-size: 16px;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input.elimina {
            background-color: #e63946;
        }
        input.detalles {
            background-color: #38f341;
        }
        input.editar {
            background-color: #ffd700;
        }
        input.agregar {
            background-color: #20cbba;
            font-size: 20px;
            width: 50%;
            margin: 20px auto;
        }
        input:hover {
            opacity: 0.8;
        }
        img.product-image {
        width: 150px; /* Ajusta el ancho que desees */
        height: auto; /* Esto mantiene la proporción de la imagen */
        border: 2px solid #ddd; /* Opcional: un borde para que se vea más elegante */
        border-radius: 5px; /* Opcional: esquinas redondeadas */
        padding: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Opcional: sombra para destacar la imagen */
    }
    </style>
</head>

<body>
<header>
    <h1>Bienvenido <?php echo htmlspecialchars($nombreUsuario); ?></h1>
</header>
<nav>
    <a href="Bienvenido.php">Inicio</a>
    <a href="productos_lista.php">Tus productos</a>
    <a href="">Eventos</a>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</nav>

<table border="3">
    <tr class="titulo">
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DESCRIPCIÓN</th>
        <th>PRECIO</th>
        <th>IMAGEN</th>
        <th>ELIMINACIÓN</th>
        <th>VER DETALLES</th>
        <th>EDICIÓN</th>
    </tr>
    <?php
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_array()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $descripcion = $row["descripcion"];
            $precio = $row["precio"];
            $archivo = $row["archivo"];
            ?>
            <tr id="fila<?php echo $id; ?>">
                <td><?php echo $id; ?></td>
                <td><?php echo htmlspecialchars($nombre); ?></td>
                <td><?php echo htmlspecialchars($descripcion); ?></td>
                <td><?php echo htmlspecialchars($precio); ?></td>
                <td><img class="product-image" src="funciones/archivos/<?php echo htmlspecialchars($archivo); ?>" alt="Imagen del producto"></td>
                <td><input class="elimina" onclick="eliminarfila(<?php echo $id; ?>)" type="button" value="Eliminar"></td>
                <td><input class="detalles" onclick="redirigirDetalles(<?php echo $id; ?>)" type="button" value="Detalles =>"></td>
                <td><input class="editar" onclick="redirigirEdicion(<?php echo $id; ?>)" type="button" value="Editar =>"></td>
            </tr>
        <?php }
    } else { ?>
        <tr><td colspan="8">No hay productos disponibles.</td></tr>
    <?php } ?>
    <tr>
        <td colspan="8" style="text-align: center;">
            <a href="productos_alta.php">
                <input class="agregar" value="Agregar Producto" type="button">
            </a>
        </td>
    </tr>
</table>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
