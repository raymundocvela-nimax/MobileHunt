<?php
    if (!isset($_SESSION))session_start();
    else echo "sesión iniciada";
?>
<!DOCTYPE html>
<html style="height:100%"> <!--style="height:100%" es para poder ocupar el porcentaje en el div del mapa, si no se pone el div q se genera es de altura � height 0-->
    <head>
        <meta charset="utf-8" />
        <title>Mobile Hunt - Proyecto Terminal Ingeniería en Computación UAM Azcapotzalco</title>

        <!-- API Google MAPS muestra configuración Mapa-->
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

        <!-- Hoja de Estilo-->
        <link href="Style/HuntGPS.css" rel="stylesheet" type="text/css" />

        <!--Favicon-->
        <link REL="SHORTCUT ICON" HREF="image/Favicon.ico">

        <!--Reloj-->
        <script type="text/javascript"><!--
            var rutaKml=0;
            var rutaLayer;
            var it;//poligono
            //var map;
            var hayRestriccion;
            var existLoc;
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
                HoraCompleta= hora + ":" + minuto + ":" + segundo+" - ";
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
                map = new google.maps.Map(document.getElementById("map_canvas"), settings);
            }

            function loadKml(chkboxRuta){
                /*
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
                var map = new google.maps.Map(document.getElementById("map_canvas"), settings)*/
                if(existLoc==1){
                    if(chkboxRuta.checked){
                        rutaLayer = new google.maps.KmlLayer('http://igconsultores.net/raymundo/'+rutaKml);
                        rutaLayer.setMap(map);
                    }
                    else rutaLayer.setMap(null)
                    //window.open("https://maps.google.com/maps?q=http:%2F%2Figconsultores.net%2Fraymundo%2Ffiles%2F"+"1340900465.kml");
                }
                else alert("No hay Datos");

            }

            function showRestriccion(chkboxRestriccion){
                /*
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
                */
                if(chkboxRestriccion.checked){
                    it = new google.maps.Polygon(polyOptions)
                    it.setMap(map)
                }
                else it.setMap(null)
            }

            function abrirPag(url){
                if(hayRestriccion==1){
                    mensaje=confirm("Ya existe una restricción, ¿deseas eliminarla y agregar una nueva?");
                    if(mensaje) window.location.href = url; //abre la pagina en la misma ventana si da click en ACEPTAR
                }
                else window.location.href = url; //abre la pagina en la misma ventana
                //window.open(url,"","algun parametro que desees"); abre la pagina en nueva ventana
            }

            function funciones(){//Juntamos las funciones en una sola, para poderlas ejecutar en el onload del body
                initialize();
                HoraActual(<?php echo date("H",time()/*-3600*/).", ".date("i").", ".date("s"); ?>); //time()-3600 resta 1 hora al tiempo del servidor para ajustarlo a nuestra hora
            }
        </script>
    </head>
    <body onLoad="funciones()">
        <!-- dothird(); para cargar otra accion en el body -->
        <div class="contenedor">
            <div class="encabezado">
                <h1 id="title">Proyecto: Mobile Hunt</h1><br>
                <h1 id="title2">UAM Azcapotzalco</h1>
            </div>
            <div class="menu" align="center">
                <div class="encabezadoMenu"><h2>Panel de Administración</h2></div>
                <nav>
                <ul>
                    <li><a href="javascript:history.go(-1)">atrás</a></li>
                    <li><a href="index.php">Principal</a></li>
                </ul>
                </nav>
                <div class="relojMenu" id="relojMenu"></div>
                <div class="fechaMenu"><?php $fecha=date("d/m/y"/*." "."h:i:s"*/); echo $fecha;?> </div>
                <div id="user" align="justify">
                <?
                    //Restricción
                    include('conectar.php');
                    $idUsr=$_REQUEST['idUsr'];
                    //adecuar ID usr
                    //$nomInsti=$_SESSION['nomInsti'];
                    $_SESSION['idUsr']=$idUsr;

                    //recuperar fecha
                    $fechaExplode=explode('-',$_REQUEST['fecha']);
                    //$fechaQuery=date('Y-m-d',mktime(0,0,0,$fechaExplode[1],$fechaExplode[0],$fechaExplode[2]));
                    $fechaQuery=date('d-m-Y',mktime(0,0,0,$fechaExplode[1],$fechaExplode[0],$fechaExplode[2]));
                    //echo $fechaQuery."<br>";
                    //print_r $fechaQuery;

                    //obtener nombre Usr segun id
                    $result=mysql_query("SELECT usuario FROM usuarios WHERE idusuarios='".$idUsr."'") or die("error".mysql_error());
                    $row=mysql_fetch_array($result);
                    $nomUsr=$row[0];

                    $_SESSION['nomUsr']=$nomUsr;
                    $nomInsti=$_SESSION['nomInsti'];
                    echo"<br><br><b>Institucion/Compania: $nomInsti<br>";
                    echo"Nombre de Usuario: $nomUsr <br>";
                    echo"Fecha:".$fechaQuery."<br></b>";
                    echo"<p>A continuación, si es el caso, se muestran las ubicaciones registradas según los parámetros seleccionados; así mismo se brinda la opción de mostrar la restricción de área y las ubicaciones en el mapa de la derecha.</p>";
                    $query="SELECT restriccion FROM usuarios WHERE idusuarios ='".$idUsr."'";
                    echo "idUsr $idUsr == ".$_SESSION['idUsr']."-si?-";
                    //echo "<br>".$query."<br>";
                    $result=mysql_query($query);
                    $row=mysql_fetch_array($result);
                    echo "<b>";
                    if($row[0]!=null){
                        $js=$row[0];
                        echo '<script type="text/javascript">'.$js.'</script>';
                        echo '<script type="text/javascript">hayRestriccion=1;</script>';
                        echo '<input type="checkbox" name="chkboxRes"  onclick="showRestriccion(this)" >Mostrar Restricción</input>';
                        echo  "";
                    }
                    else{
                        echo "<br>El usuario:".$nomUsr." no cuenta con restricción de área<br>";
                        echo '<script type="text/javascript">hayRestriccion=0;</script>';
                    }
                ?>
                <button type="button" align="center" onClick="abrirPag('v3tool_restricciones.html')">Establecer Restricción</button><br />
                <input type="checkbox" name="chkboxRuta"  onclick="loadKml(this)" >Mostrar Ruta </input>
                </div>
                <div class="formulario" id="formulario">
                    <!-- verificamos si existe restricción guardada-->
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
                //$nomInsti=$_SESSION['nomInsti'];
                //$_SESSION['idUsr']=$idUsr;

                //recuperar fecha
                $fechaExplode=explode('-',$_REQUEST['fecha']);
                //$fechaQuery=date('Y-m-d',mktime(0,0,0,$fechaExplode[1],$fechaExplode[0],$fechaExplode[2]));
                $fechaQuery=date('d-m-Y',mktime(0,0,0,$fechaExplode[1],$fechaExplode[0],$fechaExplode[2]));
                //echo $fechaQuery."<br>";
                //print_r $fechaQuery;

                //obtener nombre Usr segun id
/*
                $result=mysql_query("SELECT usuario FROM usuarios WHERE idusuarios='".$_SESSION['idUsr']."'") or die("error".mysql_error());
                $row=mysql_fetch_array($result);
                $nomUsr=$row[0];
                $_SESSION['nomUsr']=$nomUsr;
                */

                //puntos segun idUsr
                /*consulta original
                $result=mysql_query("SELECT idpuntos,longitud,latitud,fecha,provider FROM puntos WHERE usuarios_idUsuarios='".$idUsr."' AND fecha='".$fechaQuery."'") or die("error".mysql_error());
                */
                $query=mysql_query("SELECT idpuntos,latitud,longitud,fecha,provider FROM puntos WHERE usuarios_idUsuarios='".$_SESSION['idUsr']."' AND DATE_FORMAT(fecha,'%d-%m-%Y')='".$fechaQuery."'") or die("error".mysql_error());
                //echo "consulta SELECT idpuntos,longitud,latitud,fecha,provider FROM puntos WHERE usuarios_idUsuarios='".$idUsr."' AND DATE_FORMAT(fecha,'%d-%m-%Y')='".$fechaQuery."')";
                $numRow=mysql_num_rows($query);
                if($numRow!=0){
                    //creamos tabla
                     echo "<table align='center' border = '1'> ";
                    //nombre filas
                    echo "<tr> ";
                    echo "<td><b>ID</b></td> ";
                    echo "<td><b>Latitud (y)</b></td> ";
                    echo "<td><b>Longitud (x)</b></td> ";
                    echo "<td><b>Fecha y hora</b></td> ";
                    echo "<td><b>Provedor</b></td> ";
                    echo "</tr> ";
                    while ($row=mysql_fetch_array($query)){
                        echo "<tr> ";
                        echo "<td>$row[0]</td> ";
                        echo "<td>$row[1]</td> ";
                        echo "<td>$row[2]</td> ";
                        echo "<td>$row[3]</td> ";
                        $provider=preg_replace("(_PROVIDER)","",$row[4]);
                        echo "<td>$provider</td> ";
                        echo "</tr> ";
                    }
                    echo "</table> ";
                    //creamos KML y obtenemos nombre archivo
                    $rutaKml=mk($_SESSION['idUsr'],$nomUsr,$nomInsti,$fechaQuery);
                    if($rutaKml!=null)
                    {
                        echo"<br>nombre kml: ".$rutaKml;
                        //pasamos valor a variable de javascript para mostrar kml
                        echo '<script type="text/javascript">rutaKml="'.$rutaKml.'"</script>';
                        echo '<script type="text/javascript">existLoc=1;</script>';
                    }
                    else 'Error en KML<script type="text/javascript">existLoc=0;</script>';
                }
                else{
                    echo '<script type="text/javascript">existLoc=0;</script>';
                    echo '<b><br>No existen localizaciones asociadas a esta fecha:</b>'.$fechaQuery;
                }
            }
        ?>
    </body>
</html>