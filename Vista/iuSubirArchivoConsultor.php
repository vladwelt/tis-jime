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
<title>SUBIR ARCHIVO</title>
<link href="css/subir_archivo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
</head>

<body id="body">
<div id="principal_subir_archivo">
    <header id="cabecera_subir_archivo"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_usuarios">
      <nav id="menu_seguimiento" >
      <?php
                $a=$_GET['a'];// $a -> codigo del consultor
                $u=$_GET['u'];// $u -> codigo de usuario del consultor
                $m=$_GET['m'];// $m -> variable de mensajes
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
      <div id="subirArchivo">
        
        <?php
        $formulario= "
            
        <fieldset id='fieldsetSubirArchivo'>   
        <legend>Subir Archivo</legend>
                <form action='../Controlador/ControladorProcesarSubidaArchivo.php?a=$a&u=$u&m=0&pu=on' method='post' enctype='multipart/form-data'> 
        
                <table id='tabla_formulario_subir_archivos'>
           <tr>
                       <td align='right'>Título:</td>
                       <td ><input title='Se necesita un título para la subida' type='text' name='text_titulo' id='titulo_subida' placeholder='título descriptivo' required /></td>
                   </tr>
           <tr>
                       <td align='right'>Descripción:</td>
                       <td ><textarea name='text_descripcion' id='descripcion_subida' cols='45' rows='5' placeholder='descripcion del archivo que esta subiendo'  required></textarea></td>
                   </tr>
           <tr>
               <td align='right'>&nbsp;</td>
               <td width='300'><p><input name ='nombre_archivo_subir' type='file'  size='37' required='' /></p>     
               </td>
               
          </tr>
          <tr>
              <td height='23'></td>
              <td align='right'><input type='submit' name='enviar' value='Subir archivo' /></td>
          </tr>
       </table>
       </form>
       </fieldset>";
         switch ($m){
                           case 0:echo $formulario; 
                           break;
                           case 1:
                               echo $formulario; 
                               echo"<H1><span style='color:#867979'>Solo son permitidos archivos  PDF</span>  </H1>";
                           break;
                           case 2:echo"<H1><span style='color:#867979'>Archivo subido exitosamente</span>  </H1>";
                           break;  
                           }
        ?>
         
     </div>
</article>              
<footer id="pie_subir_archivo"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
</div>
</body>
</html>


