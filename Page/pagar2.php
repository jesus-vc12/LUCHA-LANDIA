<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye las clases de PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Incluye la librería TCPDF
require 'TCPDF/tcpdf.php';

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
            $imagen = $producto['imagen'];
            
            // Calcula el total
            $total += $precio;
        }

        $mensaje .= "Total: $" . $total;

        // Verifica si se ha ingresado una dirección de correo válida
        if (isset($_POST['correo_destino']) && !empty($_POST['correo_destino'])) {
            // Genera el PDF
            $pdf_content = generarPDF($mensaje, $productos, $total);

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

                // Adjunta el PDF al correo
                $mail->AddStringAttachment($pdf_content, 'recibo_compra.pdf', 'base64', 'application/pdf');

                // Envía el correo
                $mail->send();

                echo "Pago exitoso. El correo con los detalles de la compra y el PDF adjunto se ha enviado a $correo_destino.";
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

function generarPDF($mensaje, $productos, $total) {
    $pdf = new TCPDF();

    // Establece el título y el autor del PDF (opcional)
    $pdf->SetCreator('Mucha Lucha');
    $pdf->SetTitle('Recibo de compra');

    // Agrega una página al PDF
    $pdf->AddPage();

    // Agrega el contenido al PDF
    $html = "<h1>Recibo de compra</h1>";
    $html .= "<p>Detalle de la compra:</p>";
    
    foreach ($productos as $producto) {
        $html .= "Producto: " . $producto['nombre'] . "<br>";
        
        
        $imagen_base64 = base64_encode($producto['imagen']); 
        $html .= "<img src='data:image/jpg;base64," . $imagen_base64 . "' width='50' height='50'><br>";
        $html .= "Precio: $" . $producto['precio'] . "<br><br>";
    }
    
    $html .= "Total: $" . $total;

    $pdf->writeHTML($html, true, false, true, false, '');

    return $pdf->Output('recibo_compra.pdf', 'S'); // Devuelve el contenido del PDF en formato de cadena
}


?>

<form action="" method="post">
    <label for="correo_destino">Dirección de Correo:</label>
    <input type="email" id="correo_destino" name="correo_destino" required>
    <br>
    <input type="submit" value="Enviar y Pagar">
</form>
<p><?php echo $mensaje; ?></p>
