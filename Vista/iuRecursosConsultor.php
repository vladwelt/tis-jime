<?php
session_start();
if (!$_SESSION['id_usuario']) {
    //MOSTRAR MENSAJE ("USUARIO NO AUTENTICADO")
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 2) {
        //MOSTRAR MENSAJE ("NO TIENE AUTORIZACION PARA ACCEDER A ESTE AREA ")
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
        <link href="css/alertas.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico"/>
    </head>

    <body id="body">
        <div id="principal_consultor">
            <header id="cabecera_consultor"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_consultor">
                <nav id="menu_consultor" >
                    <?php
                    $a = $_GET['a']; // $a -> codigo del consultor
                    $u = $_GET['u']; // $u -> codigo de usuario del consultor
                    echo"<a href='iu.registroProyecto.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registrarProyecto.jpg'/></a>    
                    <a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>
                    <a href='iuAddActividad.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_añadirActividad.jpg'/></a>
                    <a href='iu.foroConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                    <a href='iuSeleccionProyectoEvaluacion.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registroEvaluacion.jpg'/></a> 
                    <a href='iusubirArchivoConsultor.php?a=$a&u=$u&m=0'><img width='100%' height='48' src='imagenes/btn_subirArchivo.jpg'/></a>
                    <a href='iuRecursosConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_recursos.jpg'/></a>
                    <a href='../Controlador/ControladorBackup.php'><img width='100%' height='48' src='imagenes/btn_backup.jpg'/></a>
                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>";
                    ?>
                </nav>
                <div id="contenido_recursos">
                    <section>
                        <fieldset id='fieldsetComboDocumentos'>   
                            <legend>Seleccionar documentos</legend>
                            <?php
                            echo "<form action='../Controlador/ControladorRecursosConsultor.php?a=$a&u=$u&re=true' method='post'>";
                            ?>
                            <table width="370" border="0" >
                                <tr>
                                    <td align="right" id="combo_documentos">Documentos: </td>
                                    <td> 
                                        <select name="combo_documentos" id="combo_documentos" >
                                            <option value="actividades">Documentos de actividades</option>
                                            <option value="respuestas">Respuestas de actividades</option>
                                            <?php
                                            require_once '../Controlador/ControladorRecursosConsultor.php';
                                            echo obtenerInfoGE($u);
                                            ?>
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <input type='submit' id='btn_actualizar' name='actualizar' value='actualizar' />
                                    </td>
                                </tr>
                            </table>
                            </form>
                        </fieldset>
                    </section>
                    <section id='Recursos'>

                        <?php
                        require_once '../Controlador/ControladorRecursosConsultor.php';
                        if (isset($_GET['recu'])) {


                            if ($_GET['recu'] == 'actividades') {
                                require_once '../Controlador/ControladorRecursosConsultor.php';
                                echo listarRecursosDeActividades($u);
                            }elseif ($_GET['recu'] == 'respuestas') {
                                require_once '../Controlador/ControladorRecursosConsultor.php';
                                echo listarRespuestasAcitividades($u);
                            }elseif ($_GET['recu'] == 'todos') {
                                
                            }
                            else{
                                
                                require_once '../Controlador/ControladorRecursosConsultor.php';
                                echo listarAchivosGE($_GET['recu'],$u);
                            }
                        }
                        ?>

                    </section>
                </div>
            </article>
            <footer id="pie_consultor"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>