<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Registro Articulo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
        }

        .formulario {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 0 auto;
            margin-top: 30px;
        }

        .formulario label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .formulario input[type="text"],
        .formulario input[type="password"],
        .formulario input[type="email"],
        .formulario input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .formulario input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .formulario input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-link {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            display: block;
        }

        .back-link i {
            margin-right: 5px;
        }
    </style>
   </head>
<body>
<h1>Registro de Articulo</h1>
    <a class="back-link" href="index.php?mensaje=11"><i class="fas fa-arrow-left"></i> Regresar a la página de inicio</a>
    <?php
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establece la conexión a la base de datos (debes configurar las credenciales de acceso)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lg";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
        }

        // Obtiene los datos del formulario
        $nombre = $_POST['Articulo'];
        $Precio = $_POST['Precio'];
        $Stock = $_POST['Stock'];
        $Descripcion = $_POST['Descr'];
         // Hashea la contraseña antes de almacenarla en la base de datos

        // Manejar la carga de la imagen
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_tamano = $_FILES['imagen']['size'];

        // Verifica que se haya seleccionado un archivo de imagen
        if (!empty($imagen_nombre)) {
            $ruta_destino = "../assets/resources" . $imagen_nombre;

            
            if (move_uploaded_file($imagen_temp, $ruta_destino)) {
                
                $ruta_imagen_bd = "../assets/resources" . $imagen_nombre;

                // Prepara y ejecuta la consulta SQL para insertar los datos en la tabla "dt_usr" (incluyendo la imagen)
                $sql = "INSERT INTO dt_usr (nombre, ap, am, telefono, correo, usr, contrasena, imagen, fecha_r)
                VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$telefono', '$correo', '$usuario', '$contrasena', '$ruta_imagen_bd', NOW())";

                if ($conn->query($sql) === TRUE) {
                    echo "Registro exitoso. Los datos se han guardado en la base de datos.";
                } else {
                    echo "Error al registrar los datos: " . $conn->error;
                }
            } else {
                echo "Error al cargar la imagen.";
            }
        } else {
            echo "Por favor, selecciona una imagen.";
        }

      
        $conn->close();
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" required><br><br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="apellido_materno" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <label for="imagen">Imagen de perfil:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
