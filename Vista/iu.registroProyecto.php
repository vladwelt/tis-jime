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

<link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
<link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui-1.8.20.js"></script>
<script>
$(document).ready(function(){
  $( "#fecha_fin_proyecto" ).datepicker({ dateFormat: "yy/mm/dd", minDate: '0'});
  
  var endingDate = $(this).attr('endingDate');
  
 });
</script>
</head>

<body id="body">
<div id="principal_consultor">
    <header id="cabecera_consultor"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_consultor">
    <nav id="menu_consultor" >
    <?php
    $a=$_GET['a'];// $a -> codigo del consultor
    $u=$_GET['u'];// $u -> codigo de usuario del consultor
   echo"<a href='iu.registroProyecto.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registrarProyecto.jpg'/></a>    
        <a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>
        <a href='iuAddActividad.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_añadirActividad.jpg'/></a>
        <a href='iu.foroConsultor.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
        <a href='iu.subidaArchivo.html?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_subirArchivo.jpg'/></a>
        <a href='iuSeleccionProyectoEvaluacion.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_registroEvaluacion.jpg'/></a>
        <a href='../Controlador/ControladorBackup.php'><img width='100%' height='48' src='imagenes/btn_backup.jpg'/></a>
        <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>";
    ?>
    </nav>
    <div id="noticias_consultor">
        <fieldset id="fieldsetForo"> 
        <legend>Formulario Del Proyecto</legend>
        <?php
        if(isset($_REQUEST['mensaje1'])){
            $mensaje=$_GET['mensaje1']; 
            echo "<fieldset id='fieldsetForo'> 
                    <legend>Mensaje</legend>
                    <br>EL PROYECTO <strong>".$mensaje."</strong> YA EXIXTE<br>
                  </fieldset>";
        }else if(isset($_REQUEST['mensaje3'])){
                $cp=$_GET['cp'];
                $np=$_GET['np'];
                $fp=$_GET['fp'];
                 echo "<fieldset > 
                        <legend>Mensaje</legend>
                        <table bgcolor=#C6E1E1 border='0'>
                            <tr>
                                <td><strong>El Proyecto:</strong> $np</td>
                            </tr>
                            <tr>
                                <td><strong>Codigo:</strong> $cp<td>
                            </tr>
                            <tr>
                                <td><strong>Fecha De Conclucion:</strong> $fp</td>
                            </tr>
                        </table>
                        <strong>Ha sido registrado con exito</strong>   
                       </fieldset>";
        }
        ?>
        <?php
        echo"<form action='../Controlador/ControladorResgistroProyecto.php?a=$a&u=$u' method='post'>";
        ?>
            <h2>Registro de Proyecto</h2>
                <table width="100%" border="0">
                    <tr>
                        <td align="right">Nombre del Proyecto:</td>
                        <td width="10%"><input type="text" name="nombre_proyecto" id="nombre_proyecto" required <?php if(isset($_REQUEST['mensaje2'])){$np=$_GET['np']; echo"value='$np'"; }?> /></td>
                    </tr>
                    <tr>
                        <td align="right">Codigo del Proyecto:</td>
                        <td width="10$"><input type="text" name="codigo_proyecto" id="codigo_proyecto" title="CPTIS-1402-2014 (NOMBRE-NUMERO-AÑO)" pattern="[A-Z0-9-]+" required <?php if(isset($_REQUEST['mensaje2'])){$cp=$_GET['cp']; echo"value='$cp'"; }?> /></td>
                        <td align="rigth" width="50%"><?php if(isset($_REQUEST['mensaje2'])){
                            $mensaje=$_GET['cp']; 
                            echo" EL CODIGO <strong>".$mensaje."</strong> YA EXISTE";}?>
                        </td>
                    </tr>
<!--                    <tr>
                        <td width="186" align="right">Gestion del Proyecto:</td>
                        <td><p>
                            <label><input name="visible_para" type="radio" id="gestion_1" value="gestio_1" checked="checked" />Primer Semestre</label><br />
                            <label><input name="visible_para" type="radio" id="gestion_2" value="getion_2" />Segundo Semestre</label><br />
                        </p></td>
                   </tr>-->
                    <tr>
                        <td align="right">Fecha Fin del Proyecto:</td>
                        <td width="10%"><input type="text" name="fecha_fin_proyecto" id="fecha_fin_proyecto" required <?php if(isset($_REQUEST['mensaje2'])){$fp=$_GET['fp']; echo"value='$fp'"; }?> /></td>
                    </tr>
                    <tr>
                        <td align="center">&nbsp;</td>
                        <td width="10%">
                            <label>
                                <input  type="submit" name="btn_registroProyecto" id="btn_registroProyecto" value="Añadir" />
                            </label>
                        </td>
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

