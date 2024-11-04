<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        /* Login container */
        .login-container {
            width: 450px;
            text-align: center;
            background-color: white;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            background-color: #00bcd4;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1em;
            font-size: 24px;
        }

        label {
            font-weight: bold;
            display: block;
            text-align: left;
            margin-bottom: 0.5em;
            font-size: 18px;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5em;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            padding-left: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f5f5f5;
            font-size: 18px;
        }

        .input-group .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #666;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: #00bcd4;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 1em;
        }

        .login-button:hover {
            background-color: #0097a7;
        }

        .signup-link {
            margin-top: 1em;
            font-size: 16px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        #mensaje {
            width: 100%;
            height: 25px;
            background: #EFEFEF;
            border-radius: 5px;
            color: #F00;
            font-size: 18px;
            line-height: 25px;
            text-align: center;
            margin-top: 20px;
            padding: 5px;
            display: none;
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
                            window.location.href = 'home.php';
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
    <div class="login-container">
        <h1>Formulario de Inicio de Sesión</h1>
        <form id="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name="correo" id="correo" placeholder="Ingrese su correo">
            </div>
            <div class="input-group">
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <button type="button" class="login-button" onclick="VerificarUsuarioYContrasena()">Iniciar Sesión</button>
            <div class="signup-link">
                <a href="home.php">Registrate</a>
            </div>
            <div id="mensaje"></div>
        </form>
    </div>
</body>

</html>
