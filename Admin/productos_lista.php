<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];

// Database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "marketcucei"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products for the logged-in user
$idVendedor = $_SESSION['id'];
$sql = "SELECT id, nombre, descripcion, precio, id_vendedor FROM productos WHERE id_vendedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idVendedor);
$stmt->execute();
$res = $stmt->get_result();

if (!$res) {
    die("Error executing query: " . $conn->error);
}

// Close the statement and connection

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
        }
        header {
            background-color: #20cbba;
            color: #ffffff;
            text-align: center;
            padding: 10px;
        }
        td.apartado {
            background-color: #031d36;
            color: #ffffff;
            line-height: 22px;
            font-size: 25px;
        }
        tr.titulo {
            background-color: #020621;
            color: #ffffff;
            line-height: 30px;
            font-size: 30px;
        }
        input {
            background-color: #020621;
            color: #ffffff;
            font-size: 25px;
        }
        input.agregar {
            background-color: #20cbba;
            color: #ffffff;
            font-size: 30px;
            width: 90%;
        }
        a {
            font-size: 24px;
        }
        input.elimina, input.detalles, input.editar {
            width: 100%;
        }
        input.detalles {
            background-color: #38f341;
        }
        input.editar {
            background-color: #ffd700;
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
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body>
<header>
    <h1>Bienvenido <?php echo $nombreUsuario; ?></h1>
</header>
<nav>
        <a href="Bienvenido.php">Inicio</a>
        <a href="productos_lista.php">Productos</a>
        <a href="promociones_lista.php">Eventos</a>
        <a href="cerrar_sesion.php">Cerrar Sesión</a>
</nav>
<table border="3" width="70%" height="150%" align="center">
    <tr class="titulo">
        <th colspan="8">Listado de productos</th>
    </tr>
    <tr>
        <td class="apartado">ID</td>
        <td class="apartado">NOMBRE</td>
        <td class="apartado">DESCRIPCIÓN</td>
        <td class="apartado">PRECIO</td>
        <td class="apartado">ID VENDEDOR</td>
        <td class="apartado">ELIMINACIÓN</td>
        <td class="apartado">VER DETALLES</td>
        <td class="apartado">EDICIÓN</td>
    </tr>
    <?php
    $posicion = 1;
    while ($row = $res->fetch_array()) {
        $id = $row["id"];
        $nombre = $row["nombre"];
        $descripcion = $row["descripcion"];
        $precio = $row["precio"];
        $id_vendedor = $row["id_vendedor"];
    ?>
        <tr class="fila" id="fila<?php echo $id; ?>">
            <td><?php echo $id; ?></td>
            <td><?php echo $nombre; ?></td>
            <td><?php echo $descripcion; ?></td>
            <td><?php echo $precio; ?></td>
            <td><?php echo $id_vendedor; ?></td>
            <td><input class="elimina" onclick="eliminarfila(<?php echo $id; ?>)" type="button" value="Eliminar"></td>
            <td><input class="detalles" onclick="redirigirDetalles(<?php echo $id; ?>)" type="button" value="Detalles =>"></td>
            <td><input class="editar" onclick="redirigirEdicion(<?php echo $id; ?>)" type="button" value="Editar =>"></td>
        </tr>
    <?php 
        $posicion++;
    } ?>
    <tr align="center">
        <td colspan="8">
            <a href="productos_alta.php">
                <input class="agregar" value="Agregar" type="button">
            </a>
        </td>
    </tr>
</table>
</body>
</html>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>