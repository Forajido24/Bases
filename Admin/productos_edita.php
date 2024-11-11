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

    /* Tu CSS existente aquí */
    </style>
    <script src="JS/jquery-3.3.1.min.js"></script>
    <script>
    $(document).ready(function() {
        var productoID = obtenerProductoIDDesdeURL();

        // Realiza una petición AJAX para obtener los datos del producto
        if (productoID) {
            $.ajax({
                type: "POST",
                url: "funciones/obtenerProducto.php",
                data: {
                    productoID: productoID
                },
                dataType: "json",
                success: function(datosProducto) {
                    if (datosProducto && !datosProducto.error) {
                        $("#productoID").val(productoID).attr('readonly',
                            true); // Mostrar el ID y hacerlo no editable
                        $("#nombre").val(datosProducto.nombre);
                        $("#descripcion").val(datosProducto.descripcion);
                        $("#precio").val(datosProducto.precio);
                        $("#baja").val(datosProducto.baja);
                        $("#eliminado").val(datosProducto.eliminado);
                    } else {
                        $('#mensaje').show().html('Producto no encontrado');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud AJAX: " + textStatus, errorThrown);
                    $('#mensaje').show().html('Error al obtener los datos del producto: ' +
                        textStatus);
                }
            });
        } else {
            $('#mensaje').show().html('ID del producto no proporcionado en la URL');
        }
    });

    function obtenerProductoIDDesdeURL() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('id');
    }

    function validarCampos() {
        var nombre = $("#nombre").val();
        var descripcion = $("#descripcion").val();
        var precio = $("#precio").val();
        var baja = $("#baja").val();
        var eliminado = $("#eliminado").val();

        if (nombre === '' || descripcion === '' || precio === '' || baja === '' || eliminado === '') {
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
        if (!validarCampos()) {
            return;
        }

        var formData = new FormData();
        formData.append('productoID', $("#productoID").val());
        formData.append('nombre', $("#nombre").val());
        formData.append('descripcion', $("#descripcion").val());
        formData.append('precio', $("#precio").val());
        formData.append('baja', $("#baja").val());
        formData.append('eliminado', $("#eliminado").val());

        if ($("#imagen")[0].files.length > 0) {
            formData.append('imagen', $("#imagen")[0].files[0]);
        }

        $.ajax({
            type: "POST",
            url: "funciones/guardarCambiosProducto.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#mensaje').show().html('Cambios guardados exitosamente');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 5000);
            },
            error: function() {
                $('#mensaje').show().html('Error al guardar los cambios');
            }
        });
    }
    </script>
</head>

<body>
    <table align="center">
        <tr>
            <th colspan="2">Formulario de Edición de Productos</th>
        </tr>
        <tr>
            <td>
                <form name="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="text" name="productoID" id="productoID" placeholder="ID del producto" readonly /><br>
                    <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre" /><br>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Escribe la descripción"></br>
                    <input type="text" name="precio" id="precio" placeholder="Escribe el precio"></br>
                    <input type="text" name="baja" id="baja" placeholder="Baja"></br>
                    <input type="text" name="eliminado" id="eliminado" placeholder="Eliminado"></br>
                    <input type="file" name="imagen" id="imagen" accept="image/*"></br>
                    <button type="button" name="submitBtn" onclick="guardarCambios()">Guardar Cambios</button>
                    <div id="mensaje"></div>
                    <a href="productos_lista.php">
                        <input type="button" class="Regresar" value="Regresar al listado"
                            onclick="regresarAlListado()" /><br><br>
                    </a>
                </form>
            </td>
        </tr>
    </table>
</body>

</html>