<?php
    include('conectar.php');
    $usr=$_REQUEST['usr'];
    $laty=$_REQUEST['laty'];
    $lonx=$_REQUEST['lonx'];
    $nomInsti=$_REQUEST['comp'];
    $desc=$_REQUEST['desc'];
    $mail=$_REQUEST['mail'];
    $bestprov=$_REQUEST['bestprov'];
    $phpdate=date("Y-m-d H:i:s");

    $asunto = "MobileHunt Android";
    $cuerpo = '
    <html>
    <head>
        <title>Aviso Importante</title>
    </head>
    <body>
        <h1>Aviso Importante</h1>
        <p>
            <b>Estimado usuario, le informamos que el dispositivo con los siguientes datos ha sobrepasado la restricción de área asignada<br>
            </b>
            <b>Fecha:</b> '.$phpdate.'.<br>
            <b>Institución/Compañía:</b> '.$nomInsti.'<br>
            <b>Nombre de usuario:</b> '.$usr.'<br>
            <b>Descripción:</b> '.$desc.'<br>
            <b>Latitud:</b> '.$laty.', <b>Longitud:</b> '.$lonx.', '.$bestprov.'<br>
            Para información más detallada favor de dirigirse a la página http://igconsultores.net/raymundo
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

    //direcciones que recibirán copia
    //$headers .= "Cc: maria@desarrolloweb.com\r\n";

    //direcciones que recibirán copia oculta
    //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

    if(mail($mail,$asunto,$cuerpo,$headers)) $responsePhp="_1|";
    else $responsePhp="_0|";
    print(json_encode($responsePhp));
    mysql_close();
?>