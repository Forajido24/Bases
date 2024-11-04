<?php
session_start();

if (!isset($_SESSION['idUser'])) {
    header("Location: login.php");
    exit();
}

$nombreUsuario = isset($_SESSION['nombreUser']) ? $_SESSION['nombreUser'] : 'Usuario'; // Verifica si el nombre existe

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketcucei";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener todos los productos
$sql = "SELECT id, nombre, descripcion, precio, archivo FROM productos";
$res = $conn->query($sql);

if ($res === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Listado de Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
            padding: 10px;
           font-size: 24px;
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
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }
        .product-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        img.product-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-description {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }
        .product-price {
            font-size: 16px;
            color: #FF6900;
            margin: 10px 0;
        }
        .view-details {
            background-color: #38f341;
            color: #ffffff;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .view-details:hover {
            background-color: #28a745;
        }
    </style>
    <script>
        function redirigirDetalles(id) {
            var url = 'detalle_producto.php?id=' + id; // Cambia a detalle_producto.php
            window.location.href = url;
        }
    </script>
</head>
<body>
<header>
    <h1>Bienvenido <?php echo htmlspecialchars($nombreUsuario); ?></h1>
</header>
<nav>
    <a href="home.php">Inicio</a>
    <a href="productos.php">Productos</a>
    <a href="">Promociones</a>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</nav>

<div class="grid-container">
    <?php
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_array()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $descripcion = $row["descripcion"];
            $precio = $row["precio"];
            $archivo = $row["archivo"];
            ?>
            <div class="product-card">
                <img class="product-image" src="Admin/funciones/archivos/<?php echo htmlspecialchars($archivo); ?>" alt="Imagen del producto" onclick="redirigirDetalles(<?php echo $id; ?>)">
                <div class="product-name"><?php echo htmlspecialchars($nombre); ?></div>
                <div class="product-description"><?php echo htmlspecialchars($descripcion); ?></div>
                <div class="product-price">Precio: $<?php echo htmlspecialchars($precio); ?></div>
                <button class="view-details" onclick="redirigirDetalles(<?php echo $id; ?>)">Ver Detalles</button>
            </div>
            <?php }
    } else { ?>
        <div style="text-align: center; width: 100%;">No hay productos disponibles.</div>
    <?php } ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
