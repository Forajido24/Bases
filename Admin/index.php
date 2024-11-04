<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        #mensaje {
            width: 100%;
            height: 25px;
            background: #EFEFEF;
            border-radius: 5px;
            color: #F00;
            font-size: 35px;
            line-height: 25px;
            text-align: center;
            margin-top: 20px;
            padding: 5px;
            display: none;
        }

        table {
            width: 95%;
            height: 95%;
            border-collapse: collapse;
            margin-top: 60px;
            color: #81888fb6;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            background-color: #81888fb6;
        }

        th {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #020621;
            color: #ffffff;
            font-size: 30px;
        }

        input {
            text-align: center;
            margin-bottom: 10px;
            padding: 15px;
            width: 97%;
            font-size: 30px;
        }

        input.Regresar {
            background-color: #20cbba;
            color: #ffffff;
            font-size: 35px;
            width: 100%;
        }

        button {
            background-color: #ff6600;
            color: #ffffff;
            font-size: 35px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }
    </style>

    <script src="JS/jquery-3.3.1.min.js"></script>
    <script>
        function VerificarUsuarioYContrasena() {
            var correo = document.getElementById('correo').value;
            var pass = document.getElementById('pass').value;

            if (correo && pass) {
                $.ajax({
                    type: "POST",
                    url: 'funciones/valida.php',
                    data: { email: correo, pass: pass }, // Cambia 'correo' a 'email' para que coincida con valida.php
                    success: function(resp) {
                        console.log('Respuesta del servidor:', resp);

                        if (resp == 1) {
                            window.location.href = 'Bienvenido.php';
                        } else {
                            $('#mensaje').show().html('Correo o contraseña incorrectos');
                            setTimeout(function() {
                                $('#mensaje').html('').hide();
                            }, 5000);
                        }
                    }
                });
            } else {
                $('#mensaje').show().html('Faltan datos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('').hide();
                }, 5000);
            }
        }
    </script>
</head>

<body>
    <table align="center">
        <tr>
            <th colspan="2">Formulario de Inicio de Sesión</th>
        </tr>
        <tr>
            <td>
                <form id="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="text" name="correo" id="correo" placeholder="Ingrese su correo">
                    <input type="password" name="pass" id="pass" placeholder="Contraseña">
                    <button type="button" name="submitBtn" onclick="VerificarUsuarioYContrasena()">Iniciar Sesión</button>
                    <a href="Bienvenido.php">
                        <input type="button" class="Regresar" value="Registrate" /></a>
                    <div id="mensaje"></div>
                </form>
            </td>
        </tr>
    </table>
</body>

</html>
