<?php
    require '../Modelo/ModeloPropuestaPlanDePago.php';
    function mostrarEstadoTablaPropuestaDePago(){
        $estadoTabla= retornarEstadoPropuestaDePago();
        return $estadoTabla;
    }
    function mostrarPropuestaDePagosGE($a,$u){
        $listaPropuestaPagos = retornaPropuestaDePagosGE($a,$u);
        return $listaPropuestaPagos;
    }
if (isset($_REQUEST['Delet'])) {
    $cod_UGE = $_GET['u'];
    $cod_GE = $_GET['a'];
    $cod_PPago = $_GET['c_p'];
    eliminarPropuestaDePago($cod_PPago);
    header("Location: ../Vista/iu.propuestaDePago.php?Form&a=$cod_GE&u=$cod_UGE");
}
if (isset($_REQUEST['insert'])) {
    $cod_UGE = $_GET['u'];
    $cod_GE = $_GET['a'];
    $cod_PPago = $_GET['c_p'];
    insertarEstadoPropuestaDePago($cod_PPago);
    header("Location: ../Vista/iu.propuestaDePago.php?Form&a=$cod_GE&u=$cod_UGE");
}
    
if(isset($_REQUEST['1'])){
    //require '../Modelo/ModeloPropuestaPlanDePago.php';
    $cod_usuarioGE = $_GET['u'];
    $cod_grupoE = $_GET['a'];
    $monto_total = $_POST['monto_total'];
    $porcentaje_satisfaccion = $_POST['porcentaje_satisfaccion'];
    $porcentaje=100;
    if ($porcentaje_satisfaccion <= 100) {
        insertarPropuestaDePago($monto_total, $porcentaje_satisfaccion, $cod_grupoE, $cod_usuarioGE);
        header("Location: ../Vista/iu.propuestaDePago.php?Form&a=$cod_grupoE&u=$cod_usuarioGE&m_t=$monto_total&p_r=$porcentaje");
    }else if ($porcentaje_satisfaccion >100) {
        header("Location: ../Vista/iu.propuestaDePago.php?Form&SMS&a=$cod_grupoE&u=$cod_usuarioGE&MT=$monto_total&PS=$porcentaje_satisfaccion");
    }
    
}    
if(isset($_REQUEST['Reg'])){
    //require '../Modelo/ModeloPropuestaPlanDePago.php';
    $cod_usuarioGE = $_GET['u'];
    $cod_grupoE = $_GET['a'];
    $monto_total = $_POST['monto_total'];
    $porcentaje_satisfaccion = $_POST['porcentaje_satisfaccion'];
    $porcentaje=100;
    if ($porcentaje_satisfaccion <= 100) {
        registrarPropuestaDePago($monto_total, $porcentaje_satisfaccion, $cod_grupoE, $cod_usuarioGE);
        $codPlan_pago= retornarCodPlanDePago($monto_total,$porcentaje_satisfaccion);
        header("Location: ../Vista/iu.propuestaDePago.php?Form&a=$cod_grupoE&u=$cod_usuarioGE&m_t=$monto_total&p_s=$porcentaje&c_p=$codPlan_pago");
    }else if ($porcentaje_satisfaccion >100) {
        header("Location: ../Vista/iu.propuestaDePago.php?SMS&a=$cod_grupoE&u=$cod_usuarioGE&MT=$monto_total&PS=$porcentaje_satisfaccion");
    }
    
}
if(isset($_REQUEST['2'])){
    //require '../Modelo/ModeloPropuestaPlanDePago.php';
    $cod_usuarioGE = $_GET['u'];
    $cod_grupoE = $_GET['a'];
    $monto_total = $_POST['monto_total'];
    $porcentaje_restante = $_POST['porcentaje_restante'];   
    $hito_evento = $_POST['hito_evento'];
    $porcentaje_pago = $_POST['porcentaje_pago'];
    $fecha_pago = $_POST['fecha_pago'];
    $codigoPlan = $_POST['codPlan_pago'];
    $montopago = (($monto_total * $porcentaje_pago) / $porcentaje_restante);
    
    if ($montopago>0) {
        if($porcentaje_pago<=$porcentaje_restante){
        $M_T = ($monto_total-$montopago);
        $P_R = ($porcentaje_restante-$porcentaje_pago);
        insertarRegistroDePlanDePago($monto_total, $montopago, $porcentaje_restante, $hito_evento, $porcentaje_pago, $fecha_pago, $codigoPlan, $cod_grupoE, $cod_usuarioGE);
        $c_h = retornarCodPlandePagoss($codigoPlan,$montopago,$hito_evento,$porcentaje_pago,$fecha_pago);
        header("Location: ../Vista/iu.registroDePlanDePagos.php?h_e=$hito_evento&p_p=$porcentaje_pago&f_p=$fecha_pago&a=$cod_grupoE&u=$cod_usuarioGE&m_t=$M_T&p_r=$P_R&c_p=$codigoPlan&c_h=$c_h");
        } else if($porcentaje_pago>$porcentaje_restante){
            header("Location: ../Vista/iu.registroDePlanDePagos.php?AVI&a=$cod_grupoE&u=$cod_usuarioGE&m_t=$monto_total&p_r=$porcentaje_restante&c_p=$codigoPlan");
        }else if ($M_T == 0){
            header("Location: ../Vista/iu.registroDePlanDePagos.php?a=$cod_grupoE&u=$cod_usuarioGE&m_t=$M_T&p_r=$P_R&c_p=$codigoPlan&c_h=$c_h");
            //header("Location: ../Vista/iu.mostrarPlandePago.php?a=$cod_grupoE&cod=$codigoPlan");
        }
    } else {
        header("Location: ../Vista/iu.mostrarPlandePago.php?a=$cod_grupoE&u=$cod_usuarioGE&c_p=$codigoPlan");
    }
}
if(isset($_REQUEST['Reg'])){
    //require '../Modelo/ModeloPropuestaPlanDePago.php';
    $cod_usuarioGE = $_GET['u'];
    $cod_grupoE = $_GET['a'];
    $monto_total = $_POST['monto_total'];
    $porcentaje_satisfaccion = $_POST['porcentaje_satisfaccion'];   
    $hito_evento = $_POST['hito_evento'];
    $porcentaje_pago = $_POST['porcentaje_pago'];
    $fecha_pago = $_POST['fecha_pago'];
    $codigoPlan = $_POST['codPlan_pago'];
    $monto = (($monto_total * $porcentaje_pago) / $porcentaje_satisfaccion);
    
       
    if ($monto>0) {
        if($porcentaje_pago<=$porcentaje_satisfaccion){
        $M_T = $monto_total-$monto;
        $P_S = $porcentaje_satisfaccion-$porcentaje_pago;
        registrarRegistroDePlanDePago($monto_total, $porcentaje_satisfaccion, $hito_evento, $porcentaje_pago, $fecha_pago, $codigoPlan, $cod_grupoE, $cod_usuarioGE);
        $c_h = retornarCodHitoEvento($hito_evento,$porcentaje_pago,$fecha_pago);
        header("Location: ../Vista/iu.registroDePlanDePagos.php?a=$cod_grupoE&u=$cod_usuarioGE&m_t=$M_T&p_s=$P_S&c_p=$codigoPlan&c_h=$c_h");
        } else if($porcentaje_pago>$porcentaje_satisfaccion){
            header("Location: ../Vista/iu.registroDePlanDePagos.php?a=$cod_grupoE&u=$cod_usuarioGE&m_t=$monto_total&p_s=$porcentaje_satisfaccion&&c_p=$codigoPlan");
        }else if ($M_T == 0){
            header("Location: ../Vista/iu.registroDePlanDePagos.php?a=$cod_grupoE&u=$cod_usuarioGE&m_t=$M_T&p_s=$P_S&c_p=$codigoPlan&c_h=$c_h");
            //header("Location: ../Vista/iu.mostrarPlandePago.php?a=$cod_grupoE&cod=$codigoPlan");
        }
    } else {
        header("Location: ../Vista/iu.mostrarPlandePago.php?a=$cod_grupoE&u=$cod_usuarioGE&c_p=$codigoPlan");
    }
}
?>