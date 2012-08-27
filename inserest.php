<?php if (!isset($_SESSION))session_start(); else echo "sesión iniciada"; ?>
<!doctype html>
<!--	-//1 setInst : 2 setusr -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mobile Hunt - Guardar Restricón de área</title>
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
                    <h2>Guardar Restricón de área</h2>
                </header>
                <article>
                    <p><?php
                            $js="";
                            include('conectar.php');
                            //echo '<a href="javascript:history.go(-2)">&lt&ltRegresar</a> | ';
                            echo '<A HREF="index.php">Pagina principal</A>';
                            $js=$_REQUEST['coords1'];
                            if($js!=""&&(strstr($js,"google.maps.LatLng"))){
                                $query="UPDATE usuarios SET restriccion='".$js."' WHERE idusuarios ='".$_SESSION['idUsr']."'";
                                $result=mysql_query($query) or die ("error".mysql_error());
                                if($result=1)
                                    echo "<br>Restriccion agregada exitosamente";
                                else echo "<br>Error al agregar restricción ".$result;
                            }
                            else echo"<br>La restricción no es un código Java Script válido";
                            mysql_close();
                        ?>
                    </p>
                </article>
                <aside>
                    <nav>

                        <a href="index.php">Principal</a>

                    </nav>
                    <br>

                    <h3>Descripción</h3>
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