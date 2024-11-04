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
<html>
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
        input, select, button {
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
        // Obtén los datos existentes y prellena el formulario
        $(document).ready(function() {
            // Puedes obtener el ID del producto de la URL o de alguna otra manera
            var productoID = obtenerProductoIDDesdeURL();

            // Realiza una petición AJAX para obtener los datos del producto
            $.ajax({
                type: "POST",
                url: "funciones/obtenerProducto.php",
                data: { productoID: productoID },
                dataType: "json",
                success: function(datosProducto) {
                    // Rellena los campos del formulario con los datos obtenidos
                    $("#nombre").val(datosProducto.nombre);
                    $("#codigo").val(datosProducto.codigo);
                    $("#descripcion").val(datosProducto.descripcion);
                    $("#costo").val(datosProducto.costo);
                    $("#stock").val(datosProducto.stock);
                }
            });
        });

        function obtenerProductoIDDesdeURL() {
            // Lógica para obtener el ID del producto desde la URL (puedes modificar según tu estructura de URL)
            // Ejemplo de URL: editar_datos.php?id=1
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        function entra() {
            $('#mensaje').show();
            $('#mensaje').html('ENTRO');
            setTimeout(function() {
                $('#mensaje').html('');
            }, 5000);
        }

        function sale() {
            $('#mensaje').show();
            $('#mensaje').html('VERIFICANDO');
            setTimeout(function() {
                $('#mensaje').html('');
            }, 5000);
        }

        function regresarAlListado() {
            // Redirige al listado de productos
            window.location.href = 'productos_lista.php';
        }

        function validarCampos() {
            // Verifica si los campos están llenos
            var nombre = $("#nombre").val();
            var codigo = $("#codigo").val();
            var descripcion = $("#descripcion").val();
            var costo = $("#costo").val();
            var stock = $("#stock").val();

            if (nombre === '' || codigo === '' || descripcion === '' || costo === '' || stock === '') {
                $('#mensaje').show();
                $('#mensaje').html('Todos los campos son obligatorios');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 5000);
                return false;
            }

            return true;
        }

        function guardarCambios() {
            // Validar campos antes de enviar la solicitud AJAX
            if (!validarCampos()) {
                return;
            }

            // Obtén los datos del formulario
            var nombre = $("#nombre").val();
            var codigo = $("#codigo").val();
            var descripcion = $("#descripcion").val();
            var costo = $("#costo").val();
            var stock = $("#stock").val();
            
            // Obtén el archivo de imagen seleccionado
            var imagen = $("#imagen")[0].files[0];

            // Crear un objeto FormData para enviar datos y archivos
            var formData = new FormData();
            formData.append('productoID', obtenerProductoIDDesdeURL());
            formData.append('nombre', nombre);
            formData.append('codigo', codigo);
            formData.append('descripcion', descripcion);
            formData.append('costo', costo);
            formData.append('stock', stock);
            formData.append('imagen', imagen);

            // Puedes agregar validaciones adicionales si es necesario

            // Realiza una petición AJAX para guardar los cambios
            $.ajax({
                type: "POST",
                url: "funciones/guardarCambiosProducto.php",
                data: formData,
                processData: false,  // No procesar los datos (necesario con FormData)
                contentType: false,  // No establecer el tipo de contenido (necesario con FormData)
                success: function(response) {
                    // Puedes manejar la respuesta aquí
                    console.log(response);
                    $('#mensaje').show();
                    $('#mensaje').html('Cambios guardados exitosamente');
                    setTimeout(function() {
                        $('#mensaje').html('');
                    }, 5000);
                }
            });
        }
    </script>
</head>
<body>
    <!-- Inicio de la tabla -->
    <table align="center">
        <tr>
            <th colspan="2">Formulario de Edición de Productos</th>
        </tr>
        <tr>
            <td>
                <!-- Inicio del formulario -->
                <form name="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre" /><br>
                    <input type="text" name="codigo" id="codigo" placeholder="Escribe el código"></br>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Escribe la descripción"></br>
                    <input type="text" name="costo" id="costo" placeholder="Escribe el costo"></br>
                    <input type="text" name="stock" id="stock" placeholder="Escribe el stock"></br>
                    <!-- Agregado campo de entrada para la imagen -->
                    <input type="file" name="imagen" id="imagen" accept="image/*"></br>
                    <!-- Cambiado el tipo de botón a "button" y llamando a guardarCambios() -->
                    <button type="button" name="submitBtn" onclick="guardarCambios()">Guardar Cambios</button>
                    <div id="mensaje"></div>
                    <a href="productos_lista.php">
                        <input type="button" class="Regresar" value="Regresar al listado" onclick="regresarAlListado()" /><br><br>
                    </a>
                </form>
                <!-- Fin del formulario -->
            </td>
        </tr>
    </table>
    <!-- Fin de la tabla -->
</body>
</html>
