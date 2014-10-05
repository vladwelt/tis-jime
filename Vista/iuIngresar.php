<?php
session_start(); 
session_unset(); 
session_destroy();
?>
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>INGRESAR</title>
        <link href="css/ingreso.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico">
    </head>

    <body id="body">
        <div id="principal">

            <header id="cabecera"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="encabezado2" /></header>
            <nav id="menu"><a href="iuIngresar.php"/><img src="imagenes/btn_ingresar.jpg" width="24%" height="46" alt="btn_ingresar" /></a><a href="iu.noticias.php"><img src="imagenes/btn_noticias.jpg" width="25%" height="46" alt="btn_noticias" /></a><a href="iu.foro.php"><img src="imagenes/btn_foro.jpg" width="25%" height="46" alt="btn_foro" /></a><a href="iu.nosotros.html"><img src="imagenes/btn_nosotros.jpg" width="25%" height="46" alt="btn_nosotros" /></a></nav>
            <article id="contenido"> 
                <div id="validacion">
                    <form id="ingreso_sistema" name="ingreso_sistema" method="post" action="../Controlador/ControladorAccesoUsuarios.php">
                        <table width="200" border="0">
                            <tr>
                                <td align="right">Usuario:</td>
                                <td><input type="text" name="usr" id="usr" required /></td>
                            </tr>
                            <tr>
                                <td align="right">Contraseña:</td>
                                <td><input type="password" name="pass" id="pass" required/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" id="submit" value="Entrar" />
                                    <a href="iu.registroEmpresas.html"><input type="button" name="registrar" id="registrar" value="Registrar" /></a></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="imagen_validacion"><img src="imagenes/prohibir_copiado_web.jpg" width="230" height="193" alt="img_login" /></div>
            </article>
            <footer id="pie">
                <p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleón Software </p>

            </footer>


        </div>

    </body>
</html>
