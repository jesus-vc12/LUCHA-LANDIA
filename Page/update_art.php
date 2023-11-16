<?php
include("conexion.php"); 

$conexion = conectar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
</head>

<body>
    <table>
        <tr>
            <th></th>
            <th>Nombre del Producto</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad en Stock</th>
            <th>Imagen</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
<?php
   $query = mysqli_query($conexion, "SELECT * FROM inventario");
   $result = mysqli_num_rows($query);
   if($result>0){
       while($data = mysqli_fetch_array($query)){
           ?>
           <tr>
           <form action="actualizar.php" method="post">
        <td><input type="text" name="id" value="<?php echo $data['id'] ?>"hidden></td>
        <td><input type="text" name="nombre_p" value="<?php echo $data['nombre_p'] ?>" ></td>
        <td><input type="text" name="descripcion" value="<?php echo $data['descripcion'] ?>"></td>
        <td><input type="text" name="precio" value="<?php echo $data['precio'] ?>"></td>
        <td><input type="text" name="cantidad" value="<?php echo $data['cantidad'] ?>"></td>
        <td><img height= "100px" src="data:image/jpg;base64,  <?php echo base64_encode($data['imagen_p']) ?>"></td>
        <td><input type="submit" value="Actualizar"></td>
         </form>    

         <td><a href="eliminar.php?eliminar=<?php echo $data['id'] ?>"><button>Eliminar</button></a>
         </tr>

            
       <?php
       }
   }
   ?>

       <table>
       
</body>

</html> 
