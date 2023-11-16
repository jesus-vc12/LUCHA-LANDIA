<?php

include ("conexion.php");

$conexion = conectar();

$sql = "UPDATE inventario SET
nombre_p = '" . $_POST['nombre_p'] . "',
descripcion = '" . $_POST['descripcion'] . "',
precio = '" . $_POST['precio'] . "',
cantidad = '" . $_POST['cantidad'] . "'
WHERE id = '" . $_POST['id'] . "'";


$resultado = mysqli_query($conexion, $sql);

header("location:update_art.php");
//estructura para el update   