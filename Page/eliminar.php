<?php
$eliminar = $_GET['eliminar'];

include("conexion.php"); 
$conexion = conectar();

$sql ="DELETE FROM inventario where id = '".$eliminar."'";
$resultado = mysqli_query($conexion, $sql);

header("Location:update_art.php");
