
//3 getpuntos
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="height:100%" xmlns="http://www.w3.org/1999/xhtml"> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <title> Mobile Hunt - Proyecto Terminal Ingeniería en Computación UAM Azcapotzalco</title>
    </head>
    <body>
    
        <form name="frmUsr" id="frmUsr" action="" method="post">
        <?php 
            include('conectar.php');
            //adecuar ID usr
            $idUsr=$_REQUEST['usr'];
            
            //obtener nombre Usr
            $result=mysql_query("SELECT usuario FROM usuarios WHERE idusuarios='".$idUsr."'") or die("error".mysql_error());
            $row=mysql_fetch_array($result);
            $nomUsr=$row[0];
            
            
            //puntos segun idUsr
            $result=mysql_query("SELECT idpuntos,longitud,latitud,fecha,provider FROM puntos WHERE usuarios_idUsuarios='".$idUsr."'") or die("error".mysql_error());

            echo"Institucion/Compania:".$_REQUEST['nomInsti']."<br>";
            echo"Nombre de Usuario: $nomUsr <br>";
            //creamos tabla
            echo "<table border = '1'> ";
            //nombre filas
            echo "<tr> ";
            echo "<td><b>ID</b></td> ";
            echo "<td><b>Longitud (x)</b></td> ";
            echo "<td><b>Latitud (y)</b></td> ";
            echo "<td><b>Fecha y hora</b></td> ";
            echo "<td><b>Provedor de localización</b></td> ";
            echo "</tr> ";
            //datos
            while ($row=mysql_fetch_array($result)){
                echo "<tr> ";
                echo "<td>$row[0]</td> ";
                echo "<td>$row[1]</td> ";
                echo "<td>$row[2]</td> ";
                echo "<td>$row[3]</td> ";
                echo "<td>$row[4]</td> ";
                echo "</tr> ";        
            }

                echo "</table> ";


            
        ?>
        <input type="submit" value="aceptar" align="center" />
        </form>
    </body>
</html>    