<?php
function conectar(){
    $user = "root";
    $pass = "";
    $server = "localhost";
    $db = "luchas";
    
    $con = mysqli_connect($server, $user, $pass, $db);

    if (!$con) {
        die("No hay conexión a la base de datos: " . mysqli_connect_error());
    }

    return $con;
}
?>

