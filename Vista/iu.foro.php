<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FORO</title>
<link href="css/foro.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
</head>

<body id="body">
<div id="principal_foro">
  <header id="cabecera_foro"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
  <nav id="menu_foro"><a href="iuIngresar.php"/><img src="imagenes/btn_ingresar.jpg" width="24%" height="46" alt="btn_ingresar" /></a><a href="iu.noticias.php"><img src="imagenes/btn_noticias.jpg" width="25%" height="46" alt="btn_noticias" /></a><a href="iu.foro.php"><img src="imagenes/btn_foro.jpg" width="25%" height="46" alt="btn_foro" /></a><a href="iu.nosotros.html"><img src="imagenes/btn_nosotros.jpg" width="25%" height="46" alt="btn_nosotros" /></a></nav>
  <article id="contenido_foro">
      <div id="tablaaa" class="CSSTableGenerator"> 
    <fieldset id="fieldsetForo"> 
        <legend>FORO</legend>
        <a href="FormularioForo.html">Registrar Tema</a>
    <form name="f" action="../Controlador/ControladorListaTemasForo.php" method="post">
        <table align="left" border="2" class="encabezado" width="850">
                <thead>
                    <tr>
                        <td width="60%">Temas</td>
                        <td width="10%">Comentarios</td>
                        <td width="30%">Creado Por</td>
                    </tr>
                    <?php
                    require '../Controlador/ControladorListaTemasForo.php';
                    $estado= retornarEstadoTablaForo();
                    if($estado=="basio"){
                        echo '" NO EXISTE TEMAS REGISTRADOS POR AHORA "';
                    }else if($estado=="lleno"){
                        $lista = mostrarListaF();
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
  <footer id="pie_foro">
      <p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software  </p>
   </footer>
</div>
</body>
    
</html>
