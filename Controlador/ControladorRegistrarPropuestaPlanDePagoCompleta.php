<?php
require '../Modelo/ModeloRegistrarPropuestaPlanDePagoCompleta.php';
    $codGE = $_GET['a'];
    $codUGE = $_GET['u'];
    $codP = $_GET['c_p'];
    $montoT = $_GET['m_t'];
    $porcentajeS = $_GET['p_s'];
    insertarPropuestaPlanDePagoCompleta($codGE,$codUGE,$codP,$montoT,$porcentajeS);
    insertarEstadoRegistroPropuestaDePago($codP);
    header("Location: ../Vista/iu.propuestaDePago.php?Form&a=$codGE&u=$codUGE&c_p=$codP"); 
?>
