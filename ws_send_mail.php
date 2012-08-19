<?php
$destinatario = "raymundoc.vela@hotmail.com";
$asunto = "MobileHunt Android";
$cuerpo = '
<html>
<head>
    <title>Aviso Importante</title>
</head>
<body>
    <h1>Aviso Importante</h1>
    <p>
        <b>Estimado usuario, le informamos que el dispositivo con los siguientes datos ha sobrepasado la restricción de área asignada.\n
        </b>
        Institución/Compañía:\n
        Nombre de usuario:\n
        Descripción:\n
        Para información más detallada favor de dirigirse a la página igconsultores.net/raymundo
        </p>
</body>
</html>
';

//para el envío en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

//dirección del remitente
$headers .= "From: MobileHunt Android <raymundoc.vela@hotmail.com>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: raymundoc.vela@hotmail.com\r\n";

//ruta del mensaje desde origen a destino
$headers .= "Return-path: raymundoc.vela@hotmail.com\r\n";

//direcciones que recibián copia
//$headers .= "Cc: maria@desarrolloweb.com\r\n";

//direcciones que recibirán copia oculta
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

mail($destinatario,$asunto,$cuerpo,$headers)
?>
