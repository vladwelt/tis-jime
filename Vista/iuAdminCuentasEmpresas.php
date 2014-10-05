<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 1) {
        session_destroy();
        header("Location: ../Vista/iuIngresar.php");
    }
}
?>
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>REGISTRAR</title>
        <link href="css/administrador.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico">
    </head>

    <body id="body">
        <div id="principal">
            <header id="cabecera"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="encabezado2" /></header>
            <article id="contenido"> 
                <nav id="menu_administrador" >
                    <a href="iuAdminCuentasConsultores.php"><img width="100%" height="48" src="imagenes/btn_admin_consultores.png"/></a>
                    <a href="iuAdminCuentasEmpresas.php"><img width="100%" height="48" src="imagenes/btn_admin_empresas.png"/></a>
                    <a href="iuRegistroConsultor.php"><img width="100%" height="48" src="imagenes/btn_crearCuenta.png"/></a>
                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>
                </nav>
                <section id="contenido_administrador">
                    
                    <?php
                    require '../Controlador/ControladorTablasEmpresas.php';
                    require ('../Vista/Otros/tablaEmpresas.data');
                    ?>    
                </section>
            </article>
            <footer id="pie">
                <p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleón Software </p>

            </footer>


        </div>

    </body>
</html>