<?php
    /*
    Web service que recibe consulta la restricción de un determinado usuario, inserta una localización a la DB
    y responde indicando _1| si se inserto o _0| en caso contrario + el código en JAvaScript de la restricción de área del usuario
    */
    include('conectar.php');
    $usr=$_REQUEST['usr'];
//    echo $usr;
    //obtener id usr
    $qUsr="SELECT idusuarios FROM usuarios WHERE usuario='$usr'";
 //   echo "<br>".$qUsr;
    $result=mysql_query($qUsr);
    $idUsr=mysql_fetch_array($result);
    //obtenemos restricción
    $query="SELECT restriccion FROM usuarios WHERE idusuarios ='".$idUsr[0]."'";
//    echo "<br>".$query;
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
    if($row[0]!=NULL){
        //Si hay restriccion de área?
        $js=$row[0];
        $pattern=array("(\r\n)", "(\n\r)", "(\n)", "(\r)");
        $js=preg_replace($pattern," ",$js);

        $pattern=array("(\")");
        $js=preg_replace($pattern,"<comas>",$js);


//        echo "<br>restricción: ".$js."--\n";
        $laty=$_REQUEST['laty'];//longitud
        $lonx=$_REQUEST['lonx'];//latitud
        //Crea el poligono
        /*
        echo "<br>usr:".$_REQUEST['usr'];
        echo "<br>laty:".$_REQUEST['laty'];
        echo "<br>lonx:".$_REQUEST['lonx']."<br>";
        */

        //Se pasa el valor de javascript
        //$inOut="<script>document.write(inOut)</script>";
    }
    else {
        echo "no hay restricción de área";
        $js="-SR-";
    }
    //Insertamos localizacion en DB
    //$phpdate=date("Y-m-d H:i:s",strtotime($_REQUEST['timestamp']));
    //$phpdate=date("Y-m-d H:i:s",($_REQUEST['timestamp']));
    $phpdate=date("d-m-Y H:i:s");
    //$query="INSERT INTO puntos (usuarios_idUsuarios, longitud, latitud, fecha, provider) VALUES ('".$idUsr[0]."','".$_REQUEST['lonx']."','".$_REQUEST['laty']."','".$_REQUEST['timeStamp']."','".$_REQUEST['bestprov']."')";
    $query="INSERT INTO puntos (usuarios_idUsuarios, latitud, longitud, fecha, provider) VALUES ('".$idUsr[0]."','".$_REQUEST['laty']."','".$_REQUEST['lonx']."','".$phpdate."','".$_REQUEST['bestprov']."')";
    $insert=mysql_query($query);
    if(!$insert){
        $responsePhp="_0|".$js;
    }
    else $responsePhp="_1|".$js;
    //echo $responsePhp."phpdate: ".$phpdate."consulta: ".$query;
    print(json_encode($responsePhp));
    mysql_close();
?>