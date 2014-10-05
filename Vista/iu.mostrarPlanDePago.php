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
<title>GRUPO-EMPRESA</title>
<link href="css/grupo_empresa_2.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
</head>

<body id="body">
<div id="principal_grupoEmpresa">
    <header id="cabecera_grupoEmpresa"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_grupoEmpresa">
    <?php 
    $a = $_GET['a'];// $a -> codigo grupo empresa
    $u =$_GET['u'];//$u -> codigo usuario grupo empresa
    echo"<nav id='menu_grupoEmpresa' >
            <a href='iu.propuestaDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
            <a href='iu.mostraPlanDePagosRegistrado.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
            <a href='iu.foroGrupoEmpresa.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
            <a href='../Vista/iuDiaReunionGE.php?a=$a&u=$u'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
            <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
            <a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
            <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>
         </nav>";
    ?>
    <div id="noticias_grupoEmpresa" >
        <fieldset id="fieldsetForo"> 
         <legend>Plan de Pagos</legend>
         <form name="f" action="../Controlador/ContriladorMostrarPlanDePagos.php" method="post">
            <div class="CSSTableGenerator">
                <table align="center" border="2" class="encabezado" width="670" >
                    <thead>
                        <tr>
                            <td>Hito O Evento</td>
                            <td>Porcentaje</td>
                            <td>Monto</td>
                            <td>Fecha De Pago</td>
                           <!-- <td>Entregables</td> -->
                        </tr>
                         <?php
                         require '../Controlador/ControladorMostrarPlanDePagos.php';
                         $estado = mostrarEstadoTablaPlanDePagos();
                         if($estado=="basio"){
                            echo ' "NO EXISTE UN REGISTRO RECIENTE" ';
                         }else if($estado=="lleno"){
                            $codP=$_GET['c_p']; 
                            $array_planDePagos = mostrarPlanDePagos($codP);
                            $contador = 0;
                                while ($contador <= sizeof($array_planDePagos)-1){?>
                                        <tr>
                                            <td><?php echo $array_planDePagos[$contador]?></td>
                                            <td><?php echo $array_planDePagos[$contador+1]?></td>
                                            <td><?php echo $array_planDePagos[$contador+2]?></td>
                                            <td><?php echo $array_planDePagos[$contador+3]?></td>
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
        <fieldset id="fieldsetForo"> 
         <legend>Entregables</legend>
         <form name="f" action="../Controlador/ContriladorMostrarPlanDePagos.php" method="post">
            <div class="CSSTableGenerator">
                <table align="center" border="2" class="encabezado" width="10%" >
                    <thead>
                        <tr>
                            <td>Hito O Evento</td>
                            <td>Entregables</td>
                        </tr>
                         <?php
                         //require '../Controlador/ControladorMostrarPlanDePagos.php';
                         $estado = mostrarEstadoTablaPlanDePagosEntregables();
                         if($estado=="basio"){
                            echo ' "NO EXISTE UN REGISTRO RECIENTE" ';
                         }else if($estado=="lleno"){
                            $codP=$_GET['c_p']; 
                            $array_planDePagos = mostrarPlanDePagosEntregables($codP);
                            $contador = 0;
                                while ($contador <= sizeof($array_planDePagos)-1){?>
                                        <tr>
                                            <td><?php echo $array_planDePagos[$contador]?></td>
                                            <td><?php echo $array_planDePagos[$contador+1]?></td>
                                        </tr>        
                                <?php  
                                $contador=$contador+2;
                                }
                         }?>
                    </thead>
                </table>
            </div>     
         </form>
        </fieldset>
    </div>
    </article>
    <footer id="pie_grupoEmpresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
</div>
</body>
</html>