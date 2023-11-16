<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
             background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
            color: #333; /* Color de texto principal */
        }

        .container {
            width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: aqua; /* Color de fondo del contenedor */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form input[type="submit"] {
            background-color: #7d7488;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            height: 40px;
            border: none;
        }

        form input[type="submit"]:hover {
            background-color: aqua;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            text-decoration: none;
            color: #7d7488; /* Color del enlace de registro */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Crea tu cuenta</h2>
        <form action="procesar.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Ingresa tu nombre completo:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="user">Crea tu usuario:</label>
                <input type="text" name="user" required>
            </div>
            <div class="form-group">
                <label for="email">Ingresa tu correo:</label>
                <input type="text" name="email" required>
            </div>
            <div class="form-group">
                <label for="pass">Crea tu contraseña:</label>
                <input type="password" name="pass" required>
            </div>
            <div class="form-group">
                <label for="ima">Cargar imagen:</label>
                <input type="file" name="imagenc" required>
            </div>
            <div class="form-group">
                <input type="submit" name="accion" value="Crear Cuenta">
            </div>
        </form>
        <div class="register-link">
            <a href="index.php">Si ya tienes cuenta, inicia sesión</a>
        </div>
    </div>
</body>
</html>

