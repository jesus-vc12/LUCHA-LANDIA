<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye las clases de PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Obtiene la información del carrito
        $productos = $_SESSION['carrito'];
        $total = 0;

        // Construye un mensaje con los detalles de la compra
        $mensaje = "Detalle de la compra:\n\n";

        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            $precio = $producto['precio'];

            // Agrega la información del producto al mensaje
            $mensaje .= "Producto: $nombre\n";
            $mensaje .= "Precio: $precio\n\n";

            // Calcula el total
            $total += $precio;
        }

        $mensaje .= "Total: $" . $total;

        // Verifica si se ha ingresado una dirección de correo válida
        if (isset($_POST['correo_destino']) && !empty($_POST['correo_destino'])) {
            // Código de envío de correo con PHPMailer
            try {
                // Crea una instancia de PHPMailer
                $mail = new PHPMailer(true);

                // Configura el servidor SMTP (Gmail en este caso)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'juanpabloespinosarodriguez10@gmail.com'; // Cambia esto a tu dirección de correo electrónico
                $mail->Password = 'hyfvxppyctbghnan'; // Cambia esto a tu contraseña de correo electrónico
                $mail->SMTPSecure = 'tls'; // Puede ser 'tls' o 'ssl'
                $mail->Port = 587; // Puerto SMTP

                // Configura el remitente y el destinatario
                $correo_destino = filter_var($_POST['correo_destino'], FILTER_SANITIZE_EMAIL);
                $mail->setFrom('juanpabloespinosarodriguez10@gmail.com', 'Mucha Lucha'); // Remitente
                $mail->addAddress($correo_destino); // Destinatario

                // Asunto y cuerpo del correo
                $mail->Subject = 'Recibo de compra';
                $mail->isHTML(false); // No habilita el soporte HTML para mantener el formato de texto sin formato
                $mail->Body = $mensaje;

                // Envía el correo
                $mail->send();

                echo "Pago exitoso. El correo con los detalles de la compra se ha enviado a $correo_destino.";
            } catch (Exception $e) {
                echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
            }

            // Limpia el carrito después del "pago" (este paso es opcional).
            $_SESSION['carrito'] = array();
        } else {
            $mensaje = "Por favor, proporcione una dirección de correo válida.";
        }
    } else {
        $mensaje = "El carrito está vacío. No se pudo procesar el pago.";
    }
}
?>

<form action="" method="post">
    <label for="correo_destino">Dirección de Correo:</label>
    <input type="email" id="correo_destino" name="correo_destino" required>
    <br>
    <input type="submit" value="Enviar Correo">
</form>
<p><?php echo $mensaje; ?></p>
