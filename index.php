//1 setInst : 2 setusr


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="height:100%" xmlns="http://www.w3.org/1999/xhtml"> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

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
        ?>
        <input type="submit" value="aceptar" align="center" />
        </form>
    </body>
</html>    