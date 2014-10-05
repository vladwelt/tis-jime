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
        <title>Consultor</title>
        <link href="css/seguimiento.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico" />
    </head>

    <body id="body">
        <div id="principal_seguimiento">
            <header id="cabecera_seguimiento"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_seguimiento">
                <?php
                include '../Controlador/ControladorSeguimientoGE.php';
                //a = codigo de la grupoempresa
                //b = codigo del calendario de la grupoempresa
                $b = $_GET['b'];
                //c = codigo del registro de un detalle
                $c = $_GET['c'];


                $codUGE = $_GET['i_u']; // codigo de usuario de la grupo empresa
                $c_a = $_GET['c_a']; // $a -> codigo del consultor
                $a = $_GET['a'];
                $u = $_GET['u']; // $u -> codigo de usuario del consultor


                echo "<nav id='menu_seguimiento'>"
                . "<a href='../Controlador/ControladorContrato.php?a=$a&u=$u&c_a=$c_a&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_generarContrato.jpg'/></a>"
                . "<a href='iu.mostrarPlanDePagosGE.php?a=$a&u=$u&c_a=$c_a&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>"
                . "<a href='iu.estadoDeEvaluacionPlanDePagos.php?a=$a&u=$u&c_a=$c_a&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verEvaluacionPlanDePagos.jpg'/></a>"
                . "<a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>"
                . "<a href='../Vista/iuDocenteGECalendario.php?a=$a&u=$u&c_a=$c_a&i_u=$codUGE'><img src='imagenes/btn_calendario_docenteGE.jpg' width='100%' height='48' alt='btn_1' /></a>"
                . "<a href='../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$c_a&i_u=$codUGE'><img src='imagenes/btn_evaluacion_final.jpg' width='100%' height='48' alt='btn_1' /></a>"
                . "<a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>"
                . " </nav>";
                ?>
                <div id="noticias_seguimiento">
                    <h2> Seguimiento: Reunión semanal </h2>
                    <lbl2>Registro de seguimiento del avance semanal</lbl2>
                    <?php
                    echo "<form name='formulario' method='POST' action='../Controlador/ControladorSeguimientoDocenteGE.php?c_a=$c_a&b=$b&c=$c&a=$a'>"
                    ?>
                    <lbl>Rol:</lbl>
                    <br />
                    <textarea id="txtSeguimiento" name="rol" required="" pattern="[a-zA-Z0-9.,+_-]+" readonly="readonly"><?php mostrar_rol($c); ?></textarea>
                    <br />
                    <lbl>Qué se hara?</lbl>
                    <br />
                    <textarea id="txtSeguimiento" name="esperado" required="" pattern="[a-zA-Z0-9.,+_-]+" readonly="readonly" ><?php mostrar_esperado($c) ?></textarea>
                    <br />
                    <lbl>Detalle</lbl>
                    <br />
                    <textarea id="txtSeguimiento" name="detalle" required="" pattern="[a-zA-Z0-9.,+_-]+" onclick="clearContents(this);"><?php mostrar_detalle_esperado($c); ?></textarea>
                    <br />
                    <lbl>Qué se hizo?</lbl>
                    <br />
                    <textarea id="txtSeguimiento" name="realizado" required="" pattern="[a-zA-Z0-9.,+_-]+" onclick="clearContents(this);"><?php mostrar_realizado($c); ?></textarea>
                    <br />
                    <lbl>Observaciones</lbl>
                    <br />
                    <textarea id="txtSeguimiento" name="observaciones" required="" pattern="[a-zA-Z0-9.,+_-]+" onclick="clearContents(this);"><?php mostrar_observaciones($c); ?></textarea>
                    <br />

                    <input type="submit" name="btn_regAvance" id="btn_regAvance" value="Registrar">

                    </form>
                    <br />

                    <br />
                    <br />
                    <script>
                        function clearContents(element) {
                            element.value = '';
                        }
                    </script>
                </div>   
            </article>
            <footer id="pie_seguimiento"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>