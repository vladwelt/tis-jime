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
                $codGE = $_GET['c_a']; //codigo de la grupo empresa
                $codUGE = $_GET['i_u']; // codigo de usuario de la grupo empresa
                $a = $_GET['a']; // $a -> codigo del consultor
                $u = $_GET['u']; // $u -> codigo de usuario del consultor
                echo "<nav id='menu_seguimiento'>"
                . "<a href='../Controlador/ControladorContrato.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_generarContrato.jpg'/></a>"
                . "<a href='iu.mostrarPlanDePagosGE.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>"
                . "<a href='iu.estadoDeEvaluacionPlanDePagos.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verEvaluacionPlanDePagos.jpg'/></a>"
                . "<a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>"
                . "<a href='../Vista/iuDocenteGECalendario.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_calendario_docenteGE.jpg' width='100%' height='48' alt='btn_1' /></a>"
                . "<a href='../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_evaluacion_final.jpg' width='100%' height='48' alt='btn_1' /></a>"
                . "<a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>"
                . "</nav>";
                ?>  
                <div id="noticias_seguimiento">
                    <h2> Evaluación Final </h2>
                    <lbl2>Pulse sobre uno de los criterios para evaluar a la Grupo-Empresa.</lbl2>

                    <form name="f" action="../Controlador/ControladorSeguimientoGE.php" method="post">
                        <table align=center frame="void" border="0" class="encabezado" width="500" bgcolor=#C6E1E1>
                            <br>
                            <thead>
                            <tbody align="center" style="font:  1.1em/1.1em 'FB Armada' arial">
                                <tr><th>Criterio</th><th>Tipo</th><th>Porcentaje</th><th>Nota</th></tr>

                                <?php
                                include '../Controlador/controladorTablaEvaluacion.php';

                                $lista = mostrarTabla($a, $u, $codGE, $codUGE);
                                $lista_e = mostrar_tabla_evaluados($a, $u, $codGE, $codUGE);
                                $contador = 0;
                                $contador_e = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    ?>
                                    <tr>
                                        <td><?php echo $lista[$contador] ?></td>
                                        <td><?php echo $lista[$contador + 1] ?></td>
                                        <td><?php echo $lista[$contador + 2] ?></td>
                                        <td><?php echo $lista[$contador + 3] ?></td>
                                    </tr>

                                    <?php
                                    $contador = $contador + 4;
                                }
                                while ($contador_e <= sizeof($lista_e) - 1) {
                                    ?>
                                    <tr>
                                        <td><?php echo $lista_e[$contador_e] ?></td>
                                        <td><?php echo $lista_e[$contador_e + 1] ?></td>
                                        <td><?php echo $lista_e[$contador_e + 2] ?></td>
                                        <td><?php echo $lista_e[$contador_e + 3] ?></td>
                                    </tr>

                                    <?php
                                    $contador_e = $contador_e + 4;
                                }
                                ?>

                            <tbody>
                                </thead>
                        </table> 
                        <br />

                        <lbl style='margin-left: 30em'>TOTAL:</lbl>
                        <lbl3><?php echo mostrar_nota($codGE); ?></lbl3>
                        <br />

                    </form> 
                </div>   
            </article>
            <footer id="pie_seguimiento"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
    </body>
</html>