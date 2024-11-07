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
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            background-color: #020621;
            color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            font-size: 30px;
            margin-bottom: 20px;
        }

        #mensaje {
            width: 100%;
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

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .login-button, .back-button, .signup-button {
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
            padding: 15px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-button {
            background-color: #ff6600;
        }

        .login-button:hover {
            background-color: #e55b00;
        }

        .back-button {
            background-color: #6c757d;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .signup-button {
            background-color: #20cbba;
        }

        .signup-button:hover {
            background-color: #1aa697;
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
                    data: { email: correo, pass: pass },
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

        function regresarPaginaAnterior() {
            window.history.back();
        }
    </script>
</head>

<body>
    <div class="login-container">
        <h1>Vendedores cucei</h1>
        <form id="forma01" method="post" action="#" onsubmit="return false;" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name="correo" id="correo" placeholder="Ingrese su correo">
            </div>
            <div class="input-group">
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <button type="button" class="login-button" onclick="VerificarUsuarioYContrasena()">Iniciar Sesión</button>
            <button type="button" class="signup-button" onclick="window.location.href='Bienvenido.php'">Registrate</button>
            <button type="button" class="back-button" onclick="window.location.href='../login.php'">¿Quieres comprar?</button>
            <div id="mensaje"></div>
        </form>
    </div>
</body>
</html>
