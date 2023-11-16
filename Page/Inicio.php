<?php
// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['username'])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php"); 
    exit;
}
// Obtener el nombre del usuario desde la sesión
$nombreUsuario = $_SESSION['username']; 
?>

<?php
include("conexion.php"); 
$conexion = conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: blue;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 25px;
            text-align: left;
            text-decoration: none;
            font-size: 18px;
            color: yellow ;
            display: block;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
       

    </style>
</head>
<body>

    <div class="sidebar">
    <?php 
$query = mysqli_query($conexion, "SELECT imagen FROM registros");
$result = mysqli_num_rows($query);
if($result>0){
    while($data = mysqli_fetch_array($query)){
        ?>
        <img height= "50px" src="data:image/jpg;base64,  <?php echo base64_encode($data['imagen']) ?>">
        <?php echo $nombreUsuario; ?>   
    <?php
    }
}
?>

        <a href="inicio.php" >Inicio</a>
        <a href="inventario.php" target="programaIframe" >Inventario</a>
        <a href="stock_adm.php" target="programaIframe" >Stock</a>
        <a href="update_art.php" target="programaIframe" >Actualizar</a>
        <a href="productos.php" target="programaIframe">Venta</a>
|       <a href="objeto.php" target="programaIframe">Figura</a>        
    </div>

    <div class="content">
        
        <h1>Bienvenido a la página de administración</h1>

        <iframe src="" name="programaIframe" width="100%" height="610"></iframe>

    </div>
</body>
</html>