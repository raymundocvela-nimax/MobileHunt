<?php
    include('conectar.php');
    $usr=$_REQUEST['usr'];
    $laty=$_REQUEST['laty'];
    $lonx=$_REQUEST['lonx'];
    $bestprov=$_REQUEST['bestprov'];
    $phpdate=date("Y-m-d H:i:s");
    $qUsr="SELECT institucion_idinstitucion, descripcion, mail FROM usuarios WHERE usuario='$usr'";
    $result=mysql_query($qUsr);
    $row=mysql_fetch_array($result);
    if($row[0]!=NULL) $idInsti=$row[0];
    else $idInsti="Sin Dato";
    if($row[1]!=NULL)$desc=$row[1];
    else $desc="Sin Dato";
    if($row[2]!=NULL) $mail=$row[2];
    else $mail="raymundoc.vela@hotmail.com";

    //obtenemos nom Insti
    $query="SELECT nombre FROM institucion WHERE institucion_idinstitucion ='".$idInsti."'";
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
    $nomInsti=$row[0];
    $asunto = "MobileHunt Android";
    $cuerpo = '
    <html>
    <head>
    <title>Aviso Importante</title>
    </head>
    <body>
    <h1>Aviso Importante</h1>
    <p>
    <b>Estimado usuario, le informamos que el dispositivo con los siguientes datos ha sobrepasado la restricción de área asignada '.$phpdate.'.\n
    </b>
    Institución/Compañía:'.$nomInsti.'\n
    Nombre de usuario:'.$usr.'\n
    Descripción:'.$desc.'\n
    Latitud:'.$laty.', Longitud: '.$lonx.', '.$bestprov.'\n
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

    //direcciones que recibián copia
    //$headers .= "Cc: maria@desarrolloweb.com\r\n";

    //direcciones que recibirán copia oculta
    //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

    if(mail($mail,$asunto,$cuerpo,$headers)) $responsePhp="_1|";
    else $responsePhp="_0|";
?>