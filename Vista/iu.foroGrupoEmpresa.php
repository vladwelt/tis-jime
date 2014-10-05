<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 3) {
        if ($_SESSION['rol'] != 4) {
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
        <link rel="shortcut icon" href="imagenes/favicon.ico" />
    </head>

    <body id="body">
        <div id="principal_grupo_empresa">
            <header id="cabecera_grupo_empresa"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_usuarios">
                <?php
                $a = $_GET['a'];// $a -> codigo grupo empresa
                $u =$_GET['u'];//$u -> codigo usuario grupo empresa
                echo "<nav id='menu_grupo_empresa'>"
                        ."<a href='iu.propuestaDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
                            <a href='iu.mostraPlanDePagosRegistrado.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                            <a href='iu.foroGrupoEmpresa.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                            <a href='../Vista/iuDiaReunionGE.php?a=$a&u=$u'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuRegistroSocio.php?a=$a&u=$u'><img src='imagenes/btn_registrarSocio.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>
                
                </nav>";
                ?>
                <div id="noticias_grupoEmpresa" class="CSSTableGenerator">
                    <fieldset id="fieldsetForo"> 
                    <legend>Foro Consultor</legend>
                    <?php echo"<a href='iu.FormularioForoGrupoEmpresa.php?a=$a&u=$u'>Registrar Tema</a>";?>
                    <form name="f" action="../Controlador/ControladorListaTemasForo.php" method="post">
                        <table align="center" border="2" class="encabezado" width="850">
                            <thead>
                                <tr>
                                    <td width="60%">Temas</td>
                                    <td width="10%">Comentarios</td>
                                    <td width="30%">Creado Por</td>
                                </tr>
                                <?php
                                require '../Controlador/ControladorListaTemasForoGrupoEmpresa.php';
                                $estado= retornarEstadoTablaForoGE();
                                if($estado=="basio"){
                                    echo '" NO EXISTE TEMAS REGISTRADOS POR AHORA "';
                                }else if($estado=="lleno"){
                                    $lista = mostrarListaFGE($a,$u);
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
            <footer id="pie_grupo_empresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>