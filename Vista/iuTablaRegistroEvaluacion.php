<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 2) {
        session_destroy();
        header("Location: ../Vista/iuIngresar.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Consultor</title>
        <link href="css/seguimiento.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico" />
    </head>

    <body id="body">
        <div id="principal_seguimiento">
            <header id="cabecera_seguimiento"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_seguimiento">
                <nav id="menu_seguimiento" >
                    <?php
                    $a = $_GET['a']; // $a -> codigo del consultor
                    $u = $_GET['u']; // $u -> codigo de usuario del consultor
                    echo"<a href='iu.registroProyecto.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registrarProyecto.jpg'/></a>    
                    <a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>
                    <a href='iuAddActividad.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_añadirActividad.jpg'/></a>
                    <a href='iu.foroConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                    <a href='iusubirArchivoConsultor.php?a=$a&u=$u&m=0'><img width='100%' height='48' src='imagenes/btn_subirArchivo.jpg'/></a>
                    <a href='iuSeleccionProyectoEvaluacion.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registroEvaluacion.jpg'/></a>
                    <a href='iuRecursosConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_recursos.jpg'/></a>
                    <a href='../Controlador/ControladorBackup.php'><img width='100%' height='48' src='imagenes/btn_backup.jpg'/></a>
                    <a href='../Vista/iu.consultor.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>";
                    ?>
                </nav>

                <div id="noticias_seguimiento">
                    <h2> Evaluación Final </h2>
                    <?php
                    
                    $proyecto = $_GET['proyecto'];
                    $existe = $_GET['e'];
                    ?>
                    <lbl2>Criterios registrados..</lbl2>

                    <form name="f" action="../Controlador/ControladorSeguimientoGE.php" method="post">
                        <table align=center frame="void" border="0" class="encabezado" width="500" bgcolor=#C6E1E1>
                            <br>
                            <thead>
                            <tbody align="center" style="font:  1.1em/1.1em 'FB Armada' arial">
                                <tr><th>Criterio</th><th>Tipo</th><th>Porcentaje</th></tr>

                                <?php
                                include '../Controlador/controladorTablaEvaluacion.php';

                                $fila = mostrar_tabla_registro($a, $proyecto);
                                foreach ($fila as $elemento) {
                                    ?>
                                    <tr>
                                        <td><?php echo $elemento['criterio'] ?></td>
                                    </tr>
                                <?php } ?>

                            <tbody>
                                </thead>
                        </table> 
                    </form> 
                </div>   
            </article>
            <footer id="pie_seguimiento"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>