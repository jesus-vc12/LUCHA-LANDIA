<?php
include("conexion.php"); 

$conexion = conectar();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Listado de Productos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        th, td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h2>Listado de Productos</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre del Producto</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cantidad en Stock</th>
        <th>Imagen</th>
        <
    </tr>


   <?php
   $query = mysqli_query($conexion, "SELECT * FROM inventario");
   $result = mysqli_num_rows($query);
   if($result>0){
       while($data = mysqli_fetch_array($query)){
           ?>
           <tr>
        <td><?php echo $data['id'] ?></td>
        <td><?php echo $data['nombre_p'] ?></td>
        <td><?php echo $data['descripcion'] ?></td>
        <td><?php echo $data['precio'] ?></td>
        <td><?php echo $data['cantidad'] ?></td>
        <td><img height= "100px" src="data:image/jpg;base64,  <?php echo base64_encode($data['imagen_p']) ?>"></td>
            
        

       <?php
       }
   }
   ?>
</table>
   <?php
   $query = "SELECT nombre_p, cantidad FROM inventario";
   $resultado = $conexion->query($query);
   $productos=[];
   $cantidades=[];

   while($row = $resultado->fetch_assoc()){
    $productos[]=$row['nombre_p'];
    $cantidades[]= $row['cantidad'];
   }
   ?>
   

   <canvas id="myChart" width="30" height="10"></canvas>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var productos = <?php echo json_encode($productos); ?>;
    var cantidades = <?php echo json_encode($cantidades); ?>;

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productos, // Utiliza los nombres de los productos como etiquetas.
            datasets: [{
                label: 'Cantidad por Producto',
                data: cantidades, // Utiliza las cantidades de productos.
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



</body>
</html>
