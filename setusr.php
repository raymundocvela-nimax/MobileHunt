
//2 setusr : 3 getpuntos

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="height:100%" xmlns="http://www.w3.org/1999/xhtml"> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <title> Mobile Hunt - Proyecto Terminal Ingeniería en Computación UAM Azcapotzalco</title>
    </head>
    <body>
    
        <form name="frmUsr" id="frmUsr" action="getpuntosgl_1.php" method="get">
        <?php 
            include('conectar.php');
            include('deletefile.php');
            $file='/home/aiturbe/public_html/raymundo/files/ruta.kml';
            delete($file);
            //obtener Id institucion
            
            //$qUsr="SELECT nombre FROM institucion WHERE idinstitucion='".$_REQUEST['ins']."'";
            //$result=mysql_query($qUsr);
            //$idInsti=mysql_fetch_array($result);
            
            
            //adecuar valor idIns
            $idInsti=$_REQUEST['ins']+1;
            
            //obtener nombre Insti
            $result=mysql_query("SELECT nombre FROM institucion WHERE idinstitucion='".$idInsti."'") or die("error".mysql_error());
            $row=mysql_fetch_array($result);
            $nomInsti=$row[0];
            
            
            //usuarios segun idinstitucion
            $result=mysql_query("SELECT idusuarios,usuario FROM usuarios WHERE institucion_idinstitucion='".$idInsti."'") or die("error".mysql_error());                                    
            $option="<option value=''>Elige usuario</option>";
            //$cont=0;
            while ($row=mysql_fetch_array($result)){
                $option=$option."<option value='$row[0]'>$row[0] $row[1]</option>";
                //$cont++;
            }
            echo"Institucion/Compania: <input type='text' name='nomInsti' id='nomInsti' value='$nomInsti'/><br>";
            echo "<select name='usr' id='usr'>$option</select>";
        ?>
        <input type="submit" value="aceptar" align="center" />          e</form>
    </body>
</html>    