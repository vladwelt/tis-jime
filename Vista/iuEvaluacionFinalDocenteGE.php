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
        <link href="css/evaluacion.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico"/>
    </head>

    <body id="body">
        <div id="principal_seguimiento">
            <header id="cabecera_seguimiento"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_seguimiento">
                <?php
       $codGE=$_GET['c_a']; //codigo de la grupo empresa
       $codUGE=$_GET['i_u']; // codigo de usuario de la grupo empresa
       $a=$_GET['a'];// $a -> codigo del consultor
       $u=$_GET['u'];// $u -> codigo de usuario del consultor
            echo "<nav id='menu_seguimiento'>"
                    ."<a href='../Controlador/ControladorContrato.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_generarContrato.jpg'/></a>"
                    ."<a href='iu.mostrarPlanDePagosGE.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>"     
                    ."<a href='iu.estadoDeEvaluacionPlanDePagos.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verEvaluacionPlanDePagos.jpg'/></a>"     
                    ."<a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>"
                    . "<a href='../Vista/iuDocenteGECalendario.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_calendario_docenteGE.jpg' width='100%' height='48' alt='btn_1' /></a>"
                        . "<a href='../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_evaluacion_final.jpg' width='100%' height='48' alt='btn_1' /></a>"
                    ."<a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>"
                ."</nav>";
                  $id_criterio = $_GET['cc'];
                $nombre_criterio = $_GET['nc'];
                $porcentaje_criterio = $_GET['pc'];
                $tipo_criterio = $_GET['tc'];
                $id_tipo_criterio = $_GET['it'];
                
                ?>  
                <div id="noticias_seguimiento">
                    <h2> EVALUACION FINAL </h2>

                    <?php echo "<form name='formulario' method='POST' action='../Controlador/ControladorEvaluacionFinalDocenteGE.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE&cc=$id_criterio&nc=$nombre_criterio&pc=$porcentaje_criterio&tc=$tipo_criterio&it=$id_tipo_criterio'>";?>
                        <lbl>Criterio:</lbl>
                        <br />
                        <textarea id="txtSeguimiento" name="criterio" readonly="readonly"><?php echo $nombre_criterio;?></textarea>
                        <br />
                        <lbl>Porcentaje de calificación:</lbl>
                        <br />
                        <textarea id="txtSeguimiento" name="forma" readonly="readonly"><?php echo $porcentaje_criterio;?></textarea>
                        <br />
                        <lbl>Forma de evaluación:</lbl>
                        <br />
                        <?php require '../Controlador/ControladorTipoEvaluacionDGE.php';
                        echo $tipo_criterio.'<br />';
                        mostrar_tipo_calificacion($id_tipo_criterio, $id_criterio);
                        ?>
                        <br />
                        <lbl>Observaciones:</lbl>
                        <br />
                        <textarea id="txtSeguimiento" name="observaciones" required="" pattern="[a-zA-Z0-9.,+_-]+"></textarea>
                        <br />
                        <input type='submit' value='Registrar'>
                    </form>
                </div> 

            </article>
            <footer id="pie_seguimiento"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>
