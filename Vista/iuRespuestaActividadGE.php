<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 3 ) {
        if($_SESSION['rol'] != 4 )
        {
        session_destroy();
        header("Location: ../Vista/iuIngresar.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Grupo-Empresa</title>
        <link href="css/grupo_empresa.css" rel="stylesheet" type="text/css" />
        <link href="css/subir_archivo.css.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico" />
    </head>

    <body id="body">
        <div id="principal_grupo_empresa">
            <header id="cabecera_grupo_empresa"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_usuarios">
                <?php
                $a = $_GET['a'];// $a -> codigo grupo empresa
                $u =$_GET['u'];//$u -> codigo usuario grupo empresa
                $m =$_GET['m'];//$m -> mensaje de subida
                $codigo_actividad=$_GET['ca'];
                $usuario_consultor=$_GET['uc'];
                $codigo_consultor=$_GET['cc'];
                $cabezaraMenu="<nav id='menu_grupo_empresa'>";
                
                $funcionRepresentante="<a href='iu.propuestaDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
                            <a href='iu.mostrarPlanDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                            <a href='iu.foroGrupoEmpresa.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                            <a href='../Vista/iuDiaReunionGE.php?a=$a&u=$u'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuRegistroSocio.php?a=$a&u=$u'><img src='imagenes/btn_registrarSocio.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>";
                
                $funcionSocio="<a href='iu.mostrarPlanDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                            <a href='iu.foroGrupoEmpresa.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>              
                            <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>";
                $cierreMenu="</nav>";
                
               if($_SESSION['rol']==3){
                   echo $cabezaraMenu.$funcionRepresentante.$cierreMenu;
               }
               else{
                   echo $cabezaraMenu.$funcionSocio.$cierreMenu;
               }
                ?>
                <div id="subidaArchivoEmpresa">
                    <?php
        $formulario= "
            
        <fieldset id='fieldsetSubirArchivo'>   
        <legend>Subir Archivo</legend>
                <form action='../Controlador/ControladorProcesarSubidaArchivo.php?a=$a&u=$u&m=0&ca=$codigo_actividad&uc=$usuario_consultor&cc=$codigo_consultor&r=1' method='post' enctype='multipart/form-data'> 
        
                <table id='tabla_formulario_subir_archivos'>
           <tr>
                       <td align='right'>Título:</td>
                       <td ><input title='Se necesita un título para la subida' type='text' name='text_titulo' id='titulo_subida' placeholder='título descriptivo' required /></td>
                   </tr>
           
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
            <footer id="pie_grupo_empresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>