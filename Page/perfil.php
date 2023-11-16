<!DOCTYPE html>
<html>
<head>
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>

    <?php
    
    session_start();
    include "./../includes/base.php";
  
    $sql = "SELECT nombre, usr, imagen FROM dt_usr WHERE id = '".$_SESSION['user']."'";
    $respuesta = mysqli_query($conexion, $sql);
    

    while ($fila = mysqli_fetch_array($respuesta)) {
 
        $nombre = $fila["nombre"];
        $usuario = $fila["usr"];
        $foto = $fila["imagen"];

        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Usuario:</strong> $usuario</p>";
        echo "<img src='$foto' alt='Foto de perfil'>";
    
    }
    ?>
</body>
</html>