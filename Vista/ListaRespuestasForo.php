<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NUEVO TEMA</title>
<link href="css/foro.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico">
</head>
        <?php
            $codF=$_GET['codforo'];
            //echo "este es el cod :$ax<br>";
        ?>
<body id="body">
<div id="principal_formulario_foro">
  <header id="cabecera_formulario_foro"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
  <nav id="menu_formulario_foro"><a href="iuIngresar.php"><img src="imagenes/btn_ingresar.jpg" width="24%" height="46" alt="btn_ingresar" /></a><a href="iu.noticias.php"><img src="imagenes/btn_noticias.jpg" width="25%" height="46" alt="btn_noticias" /></a><a href="iu.foro.php"><img src="imagenes/btn_foro.jpg" width="25%" height="46" alt="btn_foro" /></a><a href="iu.nosotros.html"><img src="imagenes/btn_nosotros.jpg" width="25%" height="46" alt="btn_nosotros" /></a></nav>
  <article id="contenido_formulario_foro">
      

        <fieldset id="fieldsetForo"> 
        <legend>RESPONDER FORO</legend>
            <form id="valorNombre" action="../Controlador/ControladorComentario.php" method="get">
                <table align="left" border="0" class="encabezado" width="100%">      
                    <tr>
                        <td width="1%"><b>Nombre:</b></td><td><input name="nombre"></td>  
                        <input name="codigo" value="<?=$_GET['codforo'];?>" type="hidden">
                        <input name="cantidad" value="<?=$_GET['candC'];?>" type="hidden">
                    </tr>
                    <tr>
                        <td width="1%"><b>Comentario:</b></td> <td><textarea name="comentario" cols="100%" rows="5%" required></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="Submit"  value="Enviar Comentario" /></td>  
                    </tr>
                </table>
            </form>    
        </fieldset>
        <br> 
        <div id="contenido" >
            <fieldset id="fieldsetForo"> 
            <legend>TEMA DE CONVERSACION</legend>
            <table align="left" border="0" class="encabezado" width="100%"> 
                <td> 
                    <?php
                    require '../Controlador/ControladorMostrarTema.php';
                    echo mostrarTemaAComentar($codF);
                    ?> 
                </td> 
            </table>
            </fieldset>
        </div> 
        <div id="contenido" >  
            <fieldset id="fieldsetForo"> 
            <legend>Comentarios de los Visitantes</legend>
            <table  align="left" border="0" class="encabezado" width="100%">   
                <td> 
                    <?php
                    $codArchivo = $_GET['codforo'];
                    $nombreArchivo = $_GET['nomArchivo'];
                    include ("Otros/Comentarios/".$codArchivo."_".$nombreArchivo.".data");
                    ?> 
                </td> 
            </table>
            </fieldset>
        </div>
  </article>
  <footer id="pie_formulario_foro"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
 </body>
</html>
