<?php
include("conexion.php"); 
$conexion = conectar();
?>

<?php
// Inicializa o carga la sesión para mantener la información del carrito
session_start();


if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    // Realiza una consulta para obtener los detalles del producto
    $sql = "SELECT nombre_p, precio, imagen_p FROM inventario WHERE id = $producto_id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Almacena la información del producto en la sesión (carrito)
        $producto = array(
            'nombre' => $row['nombre_p'],
            'precio' => $row['precio'],
            'imagen' => $row['imagen_p'],
        
        );

        $_SESSION['carrito'][] = $producto;

    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        .carrito-container {
            margin-top: 20px;
        }

        .delete-button {
        background-color: #ff0000;
        color: #ffffff;
        border: none;
        padding: 5px 20px;
        cursor: pointer;
    }

    .delete-button:hover {
        background-color: #83bb75;
    }


    .pay-button {
        background-color: #75bb99;
        color: #ffffff;
        border: none;
        padding: 5px 25px;
        cursor: pointer;
    }

    .pay-button:hover {
        background-color: #83bb75;
    }

    </style>
</head>
<body>
    <h1>Carrito de Compras</h1>

    <?php
// Mostrar los productos en el carrito
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    echo "<table>";
    echo "<tr><th>Producto</th>
    <th>Precio</th>
    <th>Imagen</th>
    <th>Quitar Producto</th>
    </tr>";
    
    $total = 0; // Inicializamos la variable total
    
    foreach ($_SESSION['carrito'] as $clave => $producto) {
        echo "<tr>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>$" . $producto['precio'] . "</td>";
        echo "<td><img src='data:image/jpg;base64, " . base64_encode($producto['imagen']) . "'></td>";
        
        // Calculamos el precio total para este producto y lo sumamos al total general
        $precioTotalProducto = $producto['precio'];
        $total += $precioTotalProducto;
        
        echo "<td><form method='post' action='eproducto.php'>";
        echo "<input type='hidden' name='indice' value='$clave'>";
        echo "<button type='submit' class='delete-button'>Eliminar</button>";
        echo "</form></td>";
        
        echo "</tr>";
    }
    
    // Mostramos el total y el botón de "Pagar"
    echo "<tr>";
    echo "<td><strong>Total:</strong></td>";
    echo "<td><strong>$" . $total . "</strong></td>";
    echo "<td></td>";
    echo "<td><form method='post' action='pagar2.php'>"; 
    echo "<button type='submit' class='pay-button'>Pagar</button>";
    echo "</form></td>";
    echo "</tr>";
    
    echo "</table>";
} else {
    echo "El carrito está vacío.";
}
?>



</body>
</html>