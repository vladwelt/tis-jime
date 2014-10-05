<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>NOTICIAS</title>
        <link href="css/noticias.css" rel="stylesheet" type="text/css" />
        <link href="css/alertas.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico"/>
    </head>

    <body id="body">
        <div id="principal_noticias">
            <header id="cabecera_noticias"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <nav id="menu_noticias"><a href="iuIngresar.php"/><img src="imagenes/btn_ingresar.jpg" width="24%" height="46" alt="btn_ingresar" /><a href="iu.noticias.php"><img src="imagenes/btn_noticias.jpg" width="25%" height="46" alt="btn_noticias" /></a><a href="iu.Foro.php"><img src="imagenes/btn_foro.jpg" width="25%" height="46" alt="btn_foro" /></a><a href="iu.nosotros.html"><img src="imagenes/btn_nosotros.jpg" width="25%" height="46" alt="btn_nosotros" /></a></nav>
            <article id="contenido_noticias"> 
                <?php
                require_once '../Controlador/ControladorRecursosPublicos.php';
                require_once  '../Controlador/ControladorActividad.php';
                echo obtenerActividades();
                echo mostrarRecursosPublicos();
                ?>

            </article>

            <footer id="pie_noticias">
                <p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p>
            </footer>
        </div>
    </body>
</html>
<script>
    function openWin(cod_actividad) {
        window.open("../Vista/popUpNoticias.php?cod=" + cod_actividad + "", "Mas de la Act.", "width=600, height=500");
    }
</script>