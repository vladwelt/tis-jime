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
<link href="css/consultorVistaGE.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
</head>

<body id="body">
<div id="principal_consultor_vistaGE">
    <header id="cabecera_consultor_vistaGE"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_consultor_vistaGE">
       <?php
       $codGE=$_GET['c_a'];//codigo grupo empresa
       $codUGE=$_GET['i_u'];//codigo usuario grupo empresa
       $codC=$_GET['a'];//codigo consultor
       $codUC=$_GET['u'];//codigo usuario consultor
            echo "<nav id='menu_consultor_vistaGE'>"
                    ."<a href='../Controlador/ControladorContrato.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_generarContrato.jpg'/></a>"
                    ."<a href='iu.mostrarPlanDePagosGE.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>"     
                    ."<a href='iu.estadoDeEvaluacionPlanDePagos.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verEvaluacionPlanDePagos.jpg'/></a>"     
                    ."<a href='iuListaEmpresas.php?a=$codC&u=$codUC'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>"
                    . "<a href='../Vista/iuDocenteGECalendario.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_calendario_docenteGE.jpg' width='100%' height='48' alt='btn_1' /></a>"
                    . "<a href='../Vista/iuTablaCriteriosEvaluacion.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_evaluacion_final.jpg' width='100%' height='48' alt='btn_1' /></a>"
                    ."<a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>"
                  ."</nav>";
        ?>
        <div id="campoBlanco_consultor_vistaGE">
            <fieldset id="fieldsetForo"> 
            <legend>Plan de Pagos <strong><?php require '../Controlador/ControladorMostrarPlanDePagosGE.php'; echo mostrarNombreDeLaGE($codGE,$codUGE); ?></strong></legend>
            <form name="f" action="../Controlador/ContriladorMostrarPlanDePagosGE.php" method="post">
                <div class="CSSTableGenerator">
                    <table align="center" border="0" class="encabezado" width="100%">
                         <thead>
                         <tr>
                             <td>Hito O Evento</td>
                             <td>Porcentaje</td>
                             <td>Monto</td>
                             <td>Fecha De Pago</td>
                         </tr>
                         <?php 
                            //require '../Controlador/ControladorMostrarPlanDePagosGE.php';
                            $estado = mostrarEstadoTablaPlanDePagosGE();
                            if ($estado == "basio") {
                                echo ' <strong>"NO EXISTE UN REGISTRO RECIENTE"</strong> ';
                            }  else if ($estado == "lleno") {
                                $array_planDePagosGE = mostrarPlanDePagosGE($codGE,$codUGE,$codC,$codUC);
                                $contador = 0;
                                while ($contador <= sizeof($array_planDePagosGE)-1){?>
                                        <tr>
                                            <td><?php echo $array_planDePagosGE[$contador]?></td>
                                            <td><?php echo $array_planDePagosGE[$contador+1]?></td>
                                            <td><?php echo $array_planDePagosGE[$contador+2]?></td>
                                            <td><?php echo $array_planDePagosGE[$contador+3]?></td>
                                        </tr>        
                                <?php  
                                $contador=$contador+4;
                                }
                            }?>
                         </thead>
                    </table>
                </div>     
            </form>
            </fieldset>
        </div>
    </article>
    <footer id="pie_consultor_vistaGE"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
</div>
</body>
</html>