<?if (!isset($_SESSION))session_start();else echo "sesión iniciada";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="height:100%" xmlns="http://www.w3.org/1999/xhtml"> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
</head>
<?php
    $js="";
    include('conectar.php');
    echo '<a href="javascript:history.go(-1)">&lt&ltatrás</a> | ';
    echo '<A HREF="index.php">Pagina principal</A>';
    $js=$_REQUEST['coords1'];
    if($js!=""){
        $query="UPDATE usuarios SET restriccion='".$js."' WHERE idusuarios ='".$_SESSION['idUsr']."'";
        $result=mysql_query($query) or die ("error".mysql_error());
        if($result=1)
            echo "<br>Restriccion agregada correctamente";
        else echo "<br>Error al agregar restriccion ".$result;
    }
    else echo"<br>El Java Script no contiene informacion";
    mysql_close();
?>
</html>