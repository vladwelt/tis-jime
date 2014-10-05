<?php
require('../Modelo/ModeloMostrarEntregables.php');
    
    function mostrarPlanPagoEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE,$montoT,$porcentajeR,$hito_evento,$porcentaje_pago,$fecha_pago){
        $listaEntregables = retornarPlanPagoEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE,$montoT,$porcentajeR,$hito_evento,$porcentaje_pago,$fecha_pago);
    return $listaEntregables;    
    }
    function mostrarEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE){
        $listaEntregables = retornarEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE);
    return $listaEntregables;
    }
    if (isset($_REQUEST['Delet'])) {
    $codGE = $_GET['a'];
    $codUGE = $_GET['u'];
    $montoT = $_GET['m_t'];
    $porcentajeR = $_GET['p_r'];
    $codE = $_GET['c_e'];
    $codHito = $_GET['c_h'];
    $codP = $_GET['c_p'];
    $hito_evento = $_GET['h_e'];
    $porcentaje_pago = $_GET['p_p'];
    $fecha_pago = $_GET['f_p'];
    eliminarPlanPagoEntregables($codE);
    header("Location: ../Vista/iu.registroDePlanDePagos.php?tabla&a=$codGE&u=$codUGE&m_t=$montoT&p_r=$porcentajeR&c_h=$codHito&c_p=$codP&h_e=$hito_evento&p_p=$porcentaje_pago&f_p=$fecha_pago");
    }
?>
