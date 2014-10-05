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
                    <a href='iu.subidaArchivo.html?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_subirArchivo.jpg'/></a>
                    <a href='iuSeleccionProyectoEvaluacion.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registroEvaluacion.jpg'/></a>
                    <a href='../Controlador/ControladorBackup.php'><img width='100%' height='48' src='imagenes/btn_backup.jpg'/></a>
                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>
                </nav>";
            ?>
                <div id="noticias_consultor">
                    <fieldset id="fieldsetForo"> 
                    <legend>Formulario Foro</legend> 
            <?php  echo"<form action='../Controlador/ControladorFormularioForoConsultor.php?1&a=$a&u=$u' method='post'>"?>
                            <table width="100%" border="2" cellspacing="2" cellpadding="2">
                                <input type="hidden" name="identificador" value="<?=$id?>">
                                    <tr>
                                        <?php
                                        require '../Controlador/ControladorFormularioForoConsultor.php';
                                        $nombreConsultor =  mostrarNombreDelConsultor($a,$u);
                                        echo"<td width='30%' align='right'><strong>Consultor(ra) :</strong></td>
                                             <td><strong>$nombreConsultor</strong></td>";
                                        ?>
                                    </tr>
                                    <tr>
                                        <td width="30%" align="right"><strong>Tema a Conversar :</strong></td>
                                        <td><input type="text" name="temaC" required ></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" align="right"><strong>Comentario :</strong></td>
                                        <td><textarea name="comentarioC" cols="70%" rows="6%" required></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center" ><input  type="submit" name="Submit" value="Registrar"></td>
                                    </tr>
                            </table>
                        </form>
                    </fieldset>
                </div>
            </article>
            <footer id="pie_consultor"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>