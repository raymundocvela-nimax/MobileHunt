<?php if (!isset($_SESSION))session_start(); else echo "sesión iniciada"; ?>
<!--iniciamos variables de sessión
//2 setusr : 3 getpuntos-->
<!doctype html>
<!--	-//1 setInst : 2 setusr -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!--Calendario-->
        <link rel="stylesheet" href="build/kalendae.css" type="text/css" charset="utf-8">
        <script src="build/kalendae.js" type="text/javascript" charset="utf-8"></script>
        <!-- Script para desplegar calendario-->
        <script type="text/javascript" src="/js/popcalendar.js"></script>
        <script type="text/javascript">
            function validar(){
                fecha=document.frmUsr.fecha.value
                if(fecha!="" && fecha.length==10 && fecha.charAt(2)=='-' && fecha.charAt(5)=='-'){
                    return true;
                }
                else{
                    alert("Debes ingresar una fecha con el formato dd-mm-aaaa (ejemplo: 07-07-2012)-"+fecha.charAt(3)+"-"+fecha.charAt(6) )
                    //document.frmUsr.fecha.backgroundColor("CCFFCC")
                    document.frmUsr.fecha.focus()
                    return false;
                }
            }
        </script>
        <title>Mobile Hunt - Selecciona Usuario</title>
        <meta name="description" content="Proyecto Terminal: Mobile Hunt - UAM Azcapotzalco Ingeniería en Computación">
        <meta name="author" content="Jorge Raymundo Castillo Velázquez">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/libs/modernizr-2.0.6.min.js"></script>
    </head>
    <body>
        <div id="header-container">
            <header class="wrapper clearfix">
                <h1 id="title">Proyecto: Mobile Hunt</h1>
                <br>
                <h1 id="title2"> UAM Azcapotzalco</h1>
            </header>
        </div>
        <div id="main-container">
            <div id="main" class="wrapper clearfix">
                <header>
                    <h2>Selecciona Usuario y Fecha de Consulta:</h2>
                </header>
                <article>
                    <form name="frmUsr" id="frmUsr" action="getpuntosgl_1.php" onSubmit="return validar()" method="POST">
                        <?php
                            include('conectar.php');
                            include('deletefile.php');
                            $file='/home/aiturbe/public_html/raymundo/files/ruta.kml';
                            delete($file);
                            //obtener menor año de los datos de posiciones
                            //CAMBIAR CUANDO DB fecha este bien
                            //$query=mysql_query("SELECT MIN(YEAR(fecha)) FROM puntos ") or die("error".mysql_error());
                            $query=mysql_query("SELECT MAX(YEAR(fecha)) FROM puntos ") or die("error".mysql_error());
                            $rowYear=mysql_fetch_array($query);
                            $minYear=$rowYear[0];
                            //echo'<a href="javascript:history.go(-1)">&lt&ltatrás</a>';
                            //echo"año min $minYear <br>";
                            //adecuar valor idIns
                            $idInsti=$_REQUEST['ins'];
                            //$_SESSION["idInsti"]=$idInsti;
                            //echo $_SESSION['idInsti'];
                            //obtener nombre Insti
                            $result=mysql_query("SELECT nombre FROM institucion WHERE idinstitucion='".$idInsti."'") or die("error".mysql_error());
                            $row=mysql_fetch_array($result);
                            $nomInsti=$row[0];
                            $_SESSION["nomInsti"]=$nomInsti;
                            //usuarios segun idinstitucion
                            $result=mysql_query("SELECT idusuarios,usuario FROM usuarios WHERE institucion_idinstitucion='".$idInsti."'") or die("error".mysql_error());
                            $option="";
                            while ($row=mysql_fetch_array($result)){
                                $option=$option."<option value='$row[0]'>$row[0] $row[1]</option>";
                            }
                            //echo"Institucion/Compañia:<br> <input type='text' name='nomInsti' id='nomInsti' disabled='disabled' value='$nomInsti'/><br>";
                            echo"Selecciona el nombre de usuario que identifica al dispositivo móvil que desas ubicar, así como la fecha de consulta.<br>
                            <b>Institución/Compañia:<br>".$nomInsti."<br><br>
                            Usuario:
                            <br><select name='idUsr' id='idUsr' >$option</select><br><br>";
                            //pasamos variable de php a javascript
                            //                                echo
                            //                                "<script languaje='JavaScript'>
                            //                                var minYear='".$minYear."';
                            //                                </script>";
                            mysql_close($con);
                        ?>
                        Fecha de consulta(dd-mm-aaaa):</b><br>
                        <input type="text" required="required" name="fecha" id="dateArrival" class="auto-kal" data-kal="format:'DD-MM-YYYY', weekStart:'1', selected:Kalendae.moment()" size="10"><br>
                        <!--
                        <input name="fecha" type="text" id="dateArrival" onClick="popUpCalendar(this, frmUsr.dateArrival, 'dd-mm-yyyy',minYear);" size="10" ><br><br>
                        -->
                        <input type="submit" value="aceptar" align="center" />
                    </form>
                </article>
                <aside>
                    <nav>
                        <ul>
                            <li><a href="javascript:history.go(-1)">&lt&lt atrás</a></li>
                            <!--                		<li><a href="index.php">Principal</a></li>
                            -->
                        </ul>
                    </nav>
                    <br><h3>Descripción</h3>
                    <p>	Mobile Hunt es el nombre del Proyecto Terminal desarrollado para la obtención del grado académico de Ingeniero en Computación por parte de la Universidad Autónoma Metropolitana Unidad Azcapotzalco (UAM-A).</p>
                    <p>Este proyecto  fué diseñado e implementado por el alumno <b>Jorge Raymundo Castillo Velázquez</b> con ayuda y asesoría del <b>Ing. Marío Alberto Lagos Acosta</b>.</p>
                    <p>El Proyecto consta de:
                        <ul>
                            <li><strong>Una aplicación</strong> para dispositivos móviles con Sistema Operativo Android, que permite obtener su ubicación en coordenadas geográficas decimales (Latitud y Longitud) y transmitirlas a un servidor web cada determinado tiempo.</li>
                            <li><strong>Un conjunto de servicios web</strong> que permiten registrar y procesar las ubicaciones enviadas por la aplicación móvil.</li>
                            <li><strong>Esta página web</strong>, donde se podrá consultar en Tiempo Real las últimas ubicaciones del dispositivo móvil, además de poder delimitar mediante un polígono un área geográfica, que en caso de ser sobrepasadas, se envía un mail al administrador de la aplicación notificando el suceso y emitiendo una señal de alarma en el dispositivo móvil.</li>
                        </ul>
                    </p>
                </aside>
            </div> <!-- #main -->
        </div> <!-- #main-container -->
        <div id="footer-container">
            <footer class="wrapper">
                <!--Botones Sociales-->
                <div id="fb-root"></div>
                <div id="plusone-div"></div>
                <div class="fb-like"></div>
                <script type="text/javascript">
                    function renderPlusone() {
                        gapi.plusone.render("plusone-div");}
                    function renderIlike() {
                        var element = document.createElement('script');
                        element.type = "text/javascript";
                        element.id = "facebook-jssdk"
                        element.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(element, s);};
                    window.onload=function(){
                        renderPlusone();
                        renderIlike();}
                </script>
                <script type="text/javascript" src="https://apis.google.com/js/plusone.js">{"parsetags": "onload"}
                </script>
            </footer>
        </div>
    </body>
</html>