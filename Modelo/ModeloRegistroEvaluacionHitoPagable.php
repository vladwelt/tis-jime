<?php
require '../Controlador/Conexion.php';
    function eliminarElPuntoDataDeEvaluacionHitosGE($codHE,$nombreHE){
        unlink("../Vista/Otros/EvaluacionHitosGE/".$codHE."_".$nombreHE.".data");
    }
    function registraPagoDelConsultor($codC, $codUC, $codGE, $codUGE, $codPPago, $codHE, $hitoE, $montoP, $porcentajeS, $porcentajeA){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $codCalendario=retornarCodCalendario($codGE,$codUGE);
        if ($porcentajeA<$porcentajeS) {
            $sql2 = "INSERT INTO pago_consultor (consultor_idconsultor,consultor_usuario_idusuario,hito_pagable_plan_pago_codplan_pago,hito_pagable_codhito_pagable,hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar,hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres,hito_pagable_plan_pago_calendario_codcalendario,hitooevento,porcentajesatisfaccion,porcentajealcazado,montopago,estadopago)";
            $sql2.= "VALUES ('$codC','$codUC','$codPPago','$codHE','$codUGE','$codGE','$codCalendario','$hitoE','$porcentajeS','$porcentajeA','$montoP','NO ACEPTADO')";
            pg_query($con,$sql2) or die ("ERROR :( " .pg_last_error());
        }else if($porcentajeA>=$porcentajeS){
            $sql2 = "INSERT INTO pago_consultor (consultor_idconsultor,consultor_usuario_idusuario,hito_pagable_plan_pago_codplan_pago,hito_pagable_codhito_pagable,hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar,hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres,hito_pagable_plan_pago_calendario_codcalendario,hitooevento,porcentajesatisfaccion,porcentajealcazado,montopago,estadopago)";
            $sql2.= "VALUES ('$codC','$codUC','$codPPago','$codHE','$codUGE','$codGE','$codCalendario','$hitoE','$porcentajeS','$porcentajeA','$montoP','ACEPTADO')";
            pg_query($con,$sql2) or die ("ERROR :( " .pg_last_error());
        }
    }
    function retornarCodCalendario($codGE,$codUGE){
        $conec = new Conexion();
        $con = $conec->getConection();
        $sql = "SELECT codcalendario FROM calendario c WHERE c.grupo_empresa_codgrupo_empresa='$codGE' AND c.grupo_empresa_usuario_idusuario='$codUGE'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $cod = $row->codcalendario;
        return $cod;
    }
    function retornarCodPlanDePagos($codCalendario,$codGE,$codUGE,$porcentajeS){
        $conec = new Conexion(); 
        $con = $conec->getConection();
        $sql = "SELECT codplan_pago FROM plan_pago p WHERE p.calendario_codcalendario='$codCalendario' AND p.calendario_grupo_empresa_codgrupo_empresa='$codGE' AND p.calendario_grupo_empresa_usuario_idusuario='$codUGE' AND p.porcentajesatisfaccion='$porcentajeS'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $cod = $row->codplan_pago;
        return $cod;
    }
    function retornarCodHitoOEvento($codP,$codCalendario,$codGE,$codUGE,$hitoE,$montoP){
        $conec = new Conexion();
        $con = $conec->getConection();
        $sql = "SELECT codhito_pagable FROM hito_pagable h WHERE h.plan_pago_codplan_pago='$codP' AND h.plan_pago_calendario_codcalendario='$codCalendario' AND h.plan_pago_calendario_grupo_empresa_codgrupo_empresa='$codGE' AND h.plan_pago_calendario_grupo_empresa_usuario_idusuario='$codUGE' AND h.hitoevento='$hitoE' AND h.monto='$montoP'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $cod = $row->codhito_pagable;
        return $cod;
    }
?>
