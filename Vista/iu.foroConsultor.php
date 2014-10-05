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
        <title>CONSULTOR</title>
        <link href="css/consultor.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico"/>
    </head>

    <body id="body">
        <div id="principal_consultor">
            <header id="cabecera_consultor"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_consultor">
            <?php
            $a=$_GET['a'];// $a -> codigo del consultor
            $u=$_GET['u'];// $u -> codigo de usuario del consultor
            echo"<nav id='menu_consultor' >
                
                  <a href='iu.registroProyecto.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registrarProyecto.jpg'/></a>    
                    <a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>
                    <a href='iuAddActividad.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_añadirActividad.jpg'/></a>
                    <a href='iu.foroConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                    <a href='iusubirArchivoConsultor.php?a=$a&u=$u&m=0'><img width='100%' height='48' src='imagenes/btn_subirArchivo.jpg'/></a>
                    <a href='iuSeleccionProyectoEvaluacion.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registroEvaluacion.jpg'/></a>
                    <a href='iuRecursosConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_recursos.jpg'/></a>
                    <a href='../Controlador/ControladorBackup.php'><img width='100%' height='48' src='imagenes/btn_backup.jpg'/></a>
                    <a href='../Vista/iu.consultor.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>
                </nav>";
            ?>
                <div id="noticias_consultor" class="CSSTableGenerator">

                    <fieldset id="fieldsetForo"> 
                    <legend>Foro Consultor</legend>
                    <?php echo"<a href='iu.FormularioForoConsultor.php?a=$a&u=$u'>Registrar Tema</a>"?>
                    <form name="f" action="../Controlador/ControladorListaTemasForo.php" method="post">
                        <table align="center" border="0" cellspacing="2" cellpadding="2" width="100%">
                            <thead>
                                <tr>
                                    <td width="60%">Temas</td>
                                    <td width="10%">Comentarios</td>
                                    <td width="30%">Creado Por</td>
                                </tr>
                                <?php
                                require '../Controlador/ControladorListaTemasForoConsultor.php';
                                $estado= retornarEstadoTablaForo();
                                if($estado=="basio"){
                                    echo '<strong>"NO EXISTE TEMAS REGISTRADOS POR AHORA"</strong>';
                                }else if($estado=="lleno"){
                                    $lista = mostrarListaForoConsultor($a, $u);
                                    foreach($lista as $post):?>
                                <tr>
                                    <td><?php echo $post['titulo'];?></td>
                                    <td><?php echo $post['cantidad'];?></td>
                                    <td><?php echo $post['autor'];?></td>
                                </tr><?php endforeach;
                                }?>
                            </thead>
                        </table> 
                    </form>
                    </fieldset>
                </div>
            </article>
            <footer id="pie_consultor"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>
