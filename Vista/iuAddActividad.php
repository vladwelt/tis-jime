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
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ACTIVIDAD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="imagenes/favicon.ico"/>
        <link href="css/add_actividad.css" rel="stylesheet" type="text/css" />
        <link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
        <link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/jquery-ui-1.8.20.js"></script>
        <script>
            $(document).ready(function() {
                $("#fecha_inicio").datepicker({dateFormat: "yy/mm/dd", minDate: '0'});

                var endingDate = $(this).attr('endingDate');

            });
        </script>
        <script>
            $(document).ready(function() {
                $("#fecha_fin").datepicker({dateFormat: "yy/mm/dd", minDate: '0'});

                var endingDate = $(this).attr('endingDate');

            });
        </script>
    </head>

    <body id="body">
        <div id="principal_actividad">
            <header id="cabecera_actividad"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_usuarios">
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
                <div id="addActividad">
                    <fieldset id="fieldsetActividad">   
                        <legend>Añadir Actividad</legend>
                        <?php echo "<form action='../Controlador/ControladorAddActividadConsultor.php?a=$a&u=$u' method='post' enctype='multipart/form-data'>"; ?>
                        <table id="tabla__formulario_actividades">
                            <tr>
                                <td width="186" align="right">Visible para:</td>
                                <td><p>
                                        <select name="combo_visible" id="combo_visible">
                                            <option value="publica">Publica</option>
                                            <?php
                                            require ('../Controlador/ControladorComboGrupoEmpresas.php');
                                            require ('../Vista/Otros/grupos.data');
                                            ?>
                                        </select>          
                                    </p></td>
                            </tr>

                            <tr>
                                <td align="right">Requiere respuesta:</td>
                                <td >
                                    <label><input type="radio" name="requiere" id="si_requiere" value="si_requiere" />Si</label>
                                    <label><input type="radio" name="requiere"  id="no_requiere" value="no_requiere" checked="checked" />No</label>
                                </td>
                            </tr> 

                            <tr>
                                <td align="right">Fecha inicio:</td>
                                <td ><input title="Requiere fecha AA/MM/DD " type="text" name="fecha_inicio" id="fecha_inicio" placeholder="Seleccione una fecha" required /> Hra.<input title="formato correcto hh:mm 24HRS." name="hora_ini" type="text" id="hora_inicio" data-format="hh:mm" class="input-small" placeholder="HH:MM " pattern="([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}" id="24h" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Fecha conclusion:</td>
                                <td ><input title="Se necesita una fecha de conclusión para la actividad" type="text" name="fecha_fin" id="fecha_fin" placeholder="Seleccione una fecha" required />Hra.<input title="formato correcto hh:mm 24HRS." name="hora_fin" type="text" id="hora_fin" data-format="hh:mm " class="input-small" placeholder="HH:MM " pattern="([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}" id="24h" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Título:</td>
                                <td ><input title="Se necesita un título para la actividad" type="text" name="txt_titulo" id="titulo" placeholder="Actividad descriptiva"  required /></td>
                            </tr>

                            <tr>
                                <td align="right">Descripción:</td>
                                <td ><textarea name="ctxt_descripcion" id="descripcion" cols="45" rows="5" placeholder="Descripción breve de la actividad..."required=""></textarea></td>
                            </tr>

                            <tr>
                                <td></td>     
                                <td><input name ="nombre_archivo_subir" type="file"   /></td><td ><label><input  type="submit" name="btn_addActividad" id="btn_addActividad" value="Añadir" /></label></td>
                            </tr>            
                        </table>
                        </form>
                    </fieldset>
                </div>
            </article>
            <footer id="pie_actividad"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>
