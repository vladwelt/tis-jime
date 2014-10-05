<?php
session_start();
if (!$_SESSION['id_usuario']) {
    //MOSTRAR MENSAJE ("USUARIO NO AUTENTICADO")
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 3) {
        //MOSTRAR MENSAJE ("NO TIENE AUTORIZACION PARA ACCEDER A ESTE AREA ")
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
                echo "<nav id='menu_grupo_empresa'>
                            <a href='iu.propuestaDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
                            <a href='iu.mostrarPlanDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                            <a href='iu.foroGrupoEmpresa.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                            <a href='../Vista/iuDiaReunionGE.php?a=$a&u=$u'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuRecursosGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_recursos.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>
                      </nav>";
                ?>
                <div id="noticias_grupoEmpresa">
                <fieldset id="fieldsetForo"> 
                <legend>FORMULARIO DEL FORO</legend> 
         <?php echo"<form name='f' action='../Controlador/ControladorFormularioForoGrupoEmpresa.php?GE&a=$a&u=$u' method='post'>";?>
                        <table width="100%" border="2" cellspacing="2" cellpadding="2">
                            <input type="hidden" name="identificador" value="<?=$id?>">
                            <tr>
                                <?php
                                    require '../Controlador/ControladorFormularioForoGrupoEmpresa.php';
                                    $nombreGE =  mostrarNombreDelaGrupoEmpresa($a,$u);
                                    echo"<td width='30%' align='right'><strong>Por :</strong></td>
                                         <td><strong>$nombreGE</strong></td>";
                                ?>
                            </tr>
                            <tr>
                                <td width="30%" align="right"><strong>Tema a Conversar :</strong></td>
                                <td><input type="text" name="temaGE" required></td>
                            </tr>
                            <tr>
                                <td width="30%" align="right"><strong>Comentario :</strong></td>
                                <td><textarea name="comentarioGE" cols="70%" rows="6%" required></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" ><input  type="submit" name="Submit" value="Registrar"></td>
                            </tr>
                        </table>
                    </form>
                </fieldset>    
                </div>   
            </article>
            <footer id="pie_grupo_empresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>
