<?php
// bienvenido.php

session_start();

if (!isset($_SESSION['idUser'])) {
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

        /* Estilo de la tabla */
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Estilo de las celdas de la tabla */
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        /* Estilo de la cabecera de la tabla */
        th {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #020621;
            color: #ffffff;
            font-size: 30px;
            align: center;
        }

        /* Estilo de los campos de entrada del formulario */
        input,
        select,
        button {
            margin-bottom: 10px;
            padding: 8px;
            align: center;
        }

        input.Regresar {
            background-color: #20cbba;
            color: #ffffff;
            font-size: 30px;
            width: 90%;
        }
    </style>
    <script src="JS/jquery-3.3.1.min.js"></script>
    <script>
        function Alerta() {
            var nombre = document.forms.forma01.nombre.value;
            var codigo = document.forms.forma01.codigo.value;
            var descripcion = document.forms.forma01.descripcion.value;
            var costo = document.forms.forma01.costo.value;
            var stock = document.forms.forma01.stock.value;
            var foto = document.forms.forma01.foto;

            if (nombre && codigo && descripcion && costo && stock && foto.files.length > 0) {
                $('#mensaje').show();
                $('#mensaje').html('Campos llenos');
                setTimeout(function () {
                    $('#mensaje').html('');
                    $('#mensaje').hide();
                    // Habilitar el botón de envío en caso de datos incompletos
                }, 5000);
                // Agrega la llamada a enviarFormulario después de verificar los campos
                enviarFormulario();
            } else {
                $('#mensaje').show();
                $('#mensaje').html('Faltan datos por llenar');
                setTimeout(function () {
                    $('#mensaje').html('');
                    $('#mensaje').hide();
                    // Habilitar el botón de envío en caso de datos incompletos
                }, 5000);
            }
        }

        function verificaCodigo(codigo) {
            $.ajax({
                type: "POST",
                url: "funciones/verificaCodigo.php", // Ajusta la ruta según la ubicación de tu archivo valida.php
                data: { codigo: codigo },
                success: function(response) {
                    if (response != 0) {
                        // El código ya existe, muestra un mensaje de error
                        $('#mensaje').show();
                        $('#mensaje').html('El código ya existe. Por favor, elige otro.');
                        setTimeout(function() {
                            $('#mensaje').html('');
                            $('#mensaje').hide();
                        }, 5000);
                        document.forms.forma01.codigo.value = '';
                    } else {
                        // El código no existe, puedes realizar acciones adicionales si es necesario
                        // Por ejemplo, habilitar el botón de envío o realizar otras validaciones
                    }
                }
            });
        }

        function enviarFormulario() {
            var formulario = document.forms.forma01;
            var formData = new FormData(formulario);

            $.ajax({
                type: "POST",
                url: "productos_salva.php", // Ruta relativa a la ubicación del archivo productos_salva.php
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    // Puedes manejar la respuesta aquí, si es necesario
                    // Redireccionar a la página B2.php después de procesar los datos
                    window.location.href = 'productos_lista.php';
                }
            });
        }

        function regresarAlListado() {
            // Verifica si hay una sesión abierta
            var tieneSesion = <?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>;
            
            // Redirige según la existencia de una sesión
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

        function sale() {
            var codigo = document.forms.forma01.codigo.value;
            $('#mensaje').show();
            $('#mensaje').html('VERIFICANDO');
            setTimeout(function () {
                $('#mensaje').html('');
            }, 5000);
            verificaCodigo(codigo);
        }
    </script>
</head>

<body>
    <!-- Inicio de la tabla -->
    <table align="center">
        <tr>
            <th colspan="2">Formulario de Alta de Productos</th>
        </tr>
        <tr>
            <td>
                <!-- Inicio del formulario -->
                <form name="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre del producto" /><br>
                    <input onfocus="entra()" onblur="sale()" type="text" name="codigo" id="codigo" placeholder="Escribe el código del producto" onblur="verificaCodigo(this.value)"></br>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Escribe la descripción del producto"></br>
                    <input type="text" name="costo" id="costo" placeholder="Escribe el costo del producto"></br>
                    <input type="text" name="stock" id="stock" placeholder="Escribe el stock del producto"></br>
                    <!-- Agregado campo para cargar archivos -->
                    <input type="file" name="foto" accept="image/*">
                    <br>
                    <!-- Cambiado el tipo de botón a "button" y llamando a Alerta() -->
                    <button type="button" name="submitBtn" onclick="Alerta()">Enviar</button>
                    
                   <br> 
                    <a href="#" onclick="regresarAlListado()">
                        <input type="button" class="Regresar" value="Regresar" /><br>
                    </a>
                    <div id="mensaje"></div>
                </form>
                <!-- Fin del formulario -->
            </td>
        </tr>
    </table>
    <!-- Fin de la tabla -->
</body>

</html>
