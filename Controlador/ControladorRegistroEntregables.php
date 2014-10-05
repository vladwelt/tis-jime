<?php
require '../Modelo/ModeloRegistroEntregables.php';
$codGE=$_GET['a'];
$codUGE=$_GET['u'];
$codPlanPago=$_GET['c_p'];
$codHito=$_GET['c_h'];
$entregable=$_POST['entregable'];
$m_t=$_GET['m_t'];
$p_r=$_GET['p_r'];
$hito = $_GET['hito'];
$porcentajepago=$_GET['porpa'];
$fechapago=$_GET['fepa'];
insertarEntrgables($codGE,$codUGE ,$codPlanPago, $codHito, $entregable);
header("Location: ../Vista/iu.registroDePlanDePagos.php?tabla&a=$codGE&u=$codUGE&c_p=$codPlanPago&c_h=$codHito&m_t=$m_t&p_r=$p_r&h_e=$hito&p_p=$porcentajepago&f_p=$fechapago&TR");
?>
