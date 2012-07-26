<?php
    include('conectar.php');
    //Obtenemos codigo JavaScript de la restricción de área y lo pasamos a android
    $usr=$_REQUEST['usr'];
    echo $usr;
    //obtener id usr
    $qUsr="SELECT idusuarios FROM usuarios WHERE usuario='$usr'";
    echo "<br>".$qUsr;
    $result=mysql_query($qUsr);
    $idUsr=mysql_fetch_array($result);
    //obtenemos restricción
    $query="SELECT restriccion FROM usuarios WHERE idusuarios ='".$idUsr[0]."'";
    echo "<br>".$query;
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
    if($row[0]!=NULL){
        //Si hay restriccion de área?
        $js=$row[0];
        echo "<br>restricción: ".$js."--";
        $phpResponse=$js;
    }
    else $phpResponse="SinRestriccion";
    print(json_encode($phpResponse));
    mysql_close();
?>