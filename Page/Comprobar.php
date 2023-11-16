<?php
include("conexion.php"); // Asegúrate de que el archivo "conexion.php" contenga la función Conectarse() utilizando mysqli_.

$conexion = conectar();

// Obtener los datos del formulario
$username = $_POST["username"];
$pass = $_POST["pass"];

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT * FROM registros WHERE user_new = '$username' AND contrasena = '$pass'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    // Inicio de sesión exitoso
    session_start();
    $_SESSION["username"] = $username;
    header("Location: inicio.php"); // Redirigir a la página de inicio después del inicio de sesión
} else {
    $mensaje = "Error al iniciar sesión: " . mysqli_error($conexion);
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>