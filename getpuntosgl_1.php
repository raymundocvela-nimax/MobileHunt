<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html style="height:100%" xmlns="http://www.w3.org/1999/xhtml"> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->



<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title> Hunt GPS - Proyecto Terminal Ingeniería en Computación UAM Azcapotzalco</title>

    <!-- API Google MAPS muestra configuración Mapa-->
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> 
    
    <!-- Hoja de Estilo-->
    <link href="Style/HuntGPS.css" rel="stylesheet" type="text/css" />

    <!--Favicon-->
    <link REL="SHORTCUT ICON" HREF="image/Favicon.ico">

    <!--Reloj-->
        <script type="text/javascript"><!--

        //se ponen <!-- por si el explorador no es compatibel con Javascript no salga impreso el codigo            
            function HoraActual(hora, minuto, segundo){
                segundo = segundo + 1;
                if(segundo == 60) {
                    minuto = minuto + 1;
                    segundo = 0;
                    if(minuto == 60) {
                        minuto = 0;
                        hora = hora + 1;
                        if(hora == 24) {
                            hora = 0;
                        }
                    }
                }

                if(hora < 10) hora = '0' + hora;
                if(minuto < 10) minuto = '0' + minuto;
                if(segundo < 10) segundo = '0' + segundo;
                HoraCompleta= hora + " : " + minuto + " : " + segundo;
                document.getElementById('relojMenu').innerHTML = HoraCompleta;
                setTimeout("HoraActual("+hora+", "+minuto+", "+segundo+")", 1000);
            } 

//    <!-- API Google MAPS muestra configuración Mapa-->
            
 //     <!-- Primer Mapa usado-->
            function initialize() {
                var latlng = new google.maps.LatLng(23.919722222222223, -102.1625); //Centro del Mapa
                var settings = {
                    zoom: 6,
                    center: latlng,
                    mapTypeControl: true,
                    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                    navigationControl: true,
                    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
            }
           
           
           function loadkml(){
                var latlng = new google.maps.LatLng(23.919722222222223, -102.1625); //Centro del Mapa
                var settings = {
                    zoom: 6,
                    center: latlng,
                    mapTypeControl: true,
                    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                    navigationControl: true,
                    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), settings)
               var rutaLayer = new google.maps.KmlLayer('http://igconsultores.net/raymundo/files/ruta.kml');
               //var rutaLayer = new google.maps.KmlLayer('/home/aiturbe/public_html/raymundo/files/ruta.kml');
               //var rutaLayer = new google.maps.KmlLayer('/ruta.kml');
               rutaLayer.setMap(map);
           }
          
            

            function funciones(){//Juntamos las funciones en una sola, para poderlas ejecutar en el onload del body

                initialize();
                HoraActual(<?php echo date("H",time()/*-3600*/).", ".date("i").", ".date("s"); ?>); //time()-3600 resta 1 hora al tiempo del servidor para ajustarlo a nuestra hora
            }
          </script>
      

</head>     



<body onload="funciones()">
<!-- dothird(); para cargar otra accion en el body -->


	<div class="contenedor">
    	<div class="encabezado">
            <h1>Mobile Hunt - Proyecto Terminal
             <br />Ingeniería en Computación UAM Azcapotzalco</h1>
        </div>        
        <div class="menu">
			<div class="encabezadoMenu"><h1>Panel de Administración</h1>
            	<div class="fechaMenu"><?php $fecha=date("d/m/y"/*." "."h:i:s"*/); echo $fecha;?> </div><!--fecha-->
                <div class="relojMenu" id="relojMenu"></div>
            </div>

            <div class="formulario" id="formulario" style="overflow:auto">
            	div form
                <div class="usr" id="usr" style="overflow:auto">
                    div usr
                </div>
                
                
                <button type="button" value="aceptar" align="center" onclick="loadkml()">Ver ruta </button>
                <?php obtenerDatos();?>
                

            </div>     
        </div>
        <div class="mapa" id="map_canvas">Mapa</div>
        <div class="pie">Pie</div>
	</div>

    

	<?php
    function obtenerDatos(){
        include('conectar.php');
        include('makerutakml_1.php');
        
        //adecuar ID usr
        $idUsr=$_REQUEST['usr'];
        $nomInsti=$_REQUEST['nomInsti'];
        
        //obtener nombre Usr segun id
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
        echo "fintabla";
        
        mk($idUsr,$nomUsr,$nomInsti);        
        echo"kml creado";
    }

          
            
?>            

    
</body>
</html>

