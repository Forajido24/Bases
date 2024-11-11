<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketcucei";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function obtenerReporteVentas($conn, $idVendedor, $fechaInicio, $fechaFin) {
    $sql = "
        SELECT ventas.fecha, productos.nombre AS producto, ventas.id_comprador, detallesventa.precio
        FROM ventas
        INNER JOIN detallesventa ON ventas.id = detallesventa.id_venta
        INNER JOIN productos ON detallesventa.id_producto = productos.id
        WHERE ventas.id_vendedor = ? AND ventas.fecha BETWEEN ? AND ?
        ORDER BY ventas.fecha
    ";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("iss", $idVendedor, $fechaInicio, $fechaFin);
    $stmt->execute();
    return $stmt->get_result();
}

$reporteGenerado = false;
$ventas = [];
$totalMonto = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fechaInicio = $_POST["fecha_inicio"];
    $fechaFin = $_POST["fecha_fin"];
    $idVendedor = $_SESSION['id'];
    
    // Validar que las fechas no sean nulas o vacías
    if (empty($fechaInicio) || empty($fechaFin)) {
        die("Por favor, seleccione fechas válidas para el reporte.");
    }

    $resultado = obtenerReporteVentas($conn, $idVendedor, $fechaInicio, $fechaFin);
    if ($resultado !== false) {
        while ($row = $resultado->fetch_assoc()) {
            $ventas[] = $row;
            $totalMonto += $row["precio"];
        }
        $reporteGenerado = true;

        // Agregar mensaje de depuración
        echo "Ventas encontradas: " . count($ventas) . "<br>";
        var_dump($ventas);
    } else {
        // Agregar mensaje de depuración
        echo "No se encontraron resultados para el rango de fechas proporcionado.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
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

    form {
        text-align: center;
        margin: 20px;
    }

    input[type="date"] {
        padding: 10px;
        font-size: 16px;
        margin: 0 10px;
    }

    input[type="submit"] {
        background-color: #FF6900;
        color: #ffffff;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #e55d00;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
        text-align: center;
    }

    th {
        background-color: #020621;
        color: #ffffff;
        font-size: 20px;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    td {
        font-size: 16px;
        border: 1px solid #ddd;
    }

    .total-row td {
        font-weight: bold;
        background-color: #f0f0f0;
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
        <a href="reporte_ventas.php">Reporte de ventas</a>
        <a href="cerrar_sesion.php">Cerrar Sesión</a>
    </nav>

    <form method="POST" action="">
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        <input type="submit" value="Generar Reporte">
    </form>

    <?php if ($reporteGenerado && !empty($ventas)) : ?>
    <table border="3">
        <tr class="titulo">
            <th>Fecha de Venta</th>
            <th>Producto</th>
            <th>ID Comprador</th>
            <th>Monto</th>
        </tr>
        <?php foreach ($ventas as $venta) : ?>
        <tr>
            <td><?php echo htmlspecialchars($venta["fecha"]); ?></td>
            <td><?php echo htmlspecialchars($venta["producto"]); ?></td>
            <td><?php echo htmlspecialchars($venta["id_comprador"]); ?></td>
            <td><?php echo htmlspecialchars($venta["precio"]); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td colspan="3">Total</td>
            <td><?php echo htmlspecialchars($totalMonto); ?></td>
        </tr>
    </table>
    <?php elseif ($reporteGenerado) : ?>
    <p style="text-align: center;">No se encontraron ventas en el periodo seleccionado.</p>
    <?php endif; ?>
</body>

</html>

<?php
$conn->close();
?>
