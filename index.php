//1 setInst : 2 setusr
<!DOCTYPE html>
<html> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->
    <head>
        <meta charset="utf-8" />
        <title> Mobile Hunt</title>
    </head>
    <body>
        Elige Institución o Compañia:
        <form name="frmComp" id="frmComp" action="setusr.php" method="get">
            <?php 
                include('conectar.php');
                //institucion
                $result=mysql_query("SELECT DISTINCT nombre FROM institucion") or die("error".mysql_error());                                    
                $option="<option value=''>Elige Institución/Compañia</option>";
                $cont=0;
                while ($row=mysql_fetch_array($result)){
                    $option=$option."<option value='$cont'>$row[0]</option>";
                    $cont++;
                }
                echo  ("<select name='ins' id='ins'>$option</select>");
                mysql_close();
            ?>
            <input type="submit" value="aceptar" align="center" />
        </form>
    </body>
</html>    