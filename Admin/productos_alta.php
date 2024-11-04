<?php
// bienvenido.php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        #mensaje {
            width: 200px;
            height: 25px;
            background: #EFEFEF;
            border-radius: 5px;
            color: #F00;
            font-size: 16px;
            line-height: 25px;
            text-align: center;
            margin-top: 20px;
            padding: 5px;
            display: none;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #020621;
            color: #ffffff;
            font-size: 30px;
        }

        input,
        select,
        button {
            margin-bottom: 10px;
            padding: 8px;
        }

        input.Regresar {
            background-color: #20cbba;
            color: #ffffff;
            font-size: 30px;
            width: 90%;
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
    <script src="JS/jquery-3.3.1.min.js"></script>
    <script>
        function enviarFormulario() {
            var formulario = document.forms.forma01;
            var formData = new FormData(formulario);

            $.ajax({
                type: "POST",
                url: "funciones/productos_salva.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    //window.location.href = 'productos_lista.php';
                }
            });
        }

        function Alerta() {
            var nombre = document.forms.forma01.nombre.value;
            var descripcion = document.forms.forma01.descripcion.value;
            var costo = document.forms.forma01.costo.value;
            var foto = document.forms.forma01.foto;

            if (nombre && descripcion && costo && foto.files.length > 0) {
                $('#mensaje').show();
                $('#mensaje').html('Campos llenos');
                setTimeout(function () {
                    $('#mensaje').html('');
                    $('#mensaje').hide();
                }, 5000);
                enviarFormulario();
            } else {
                $('#mensaje').show();
                $('#mensaje').html('Faltan datos por llenar');
                setTimeout(function () {
                    $('#mensaje').html('');
                    $('#mensaje').hide();
                }, 5000);
            }
        }

        

        function regresarAlListado() {
            var tieneSesion = <?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>;
            var destino = tieneSesion ? 'index.php' : 'productos_lista.php';
            window.location.href = destino;
        }

        function entra() {
            $('#mensaje').show();
            $('#mensaje').html('ENTRO');
            setTimeout(function () {
                $('#mensaje').html('');
            }, 5000);
        }
    </script>
</head>

<body>
    
    <nav>
        <a href="productos_lista.php">Regresar</a>
    </nav>
    <table align="center">
        <tr>
            <th colspan="2">Formulario de Alta de Productos</th>
        </tr>
        <tr>
            <td>
                <form name="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre del producto" /><br>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Escribe la descripción del producto"><br>
                    <input type="text" name="costo" id="costo" placeholder="Escribe el costo del producto"><br>
                    <input type="file" name="foto" accept="image/*"><br>
                    <button type="button" name="submitBtn" onclick="Alerta()">Enviar</button>
                    
                    <br> 
                    <a href="#" onclick="regresarAlListado()">
                        <input type="button" class="Regresar" value="Regresar" /><br>
                    </a>
                    <div id="mensaje"></div>
                </form>
            </td>
        </tr>
    </table>
</body>

</html>
