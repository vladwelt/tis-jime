<?php
require '../Controlador/Conexion.php';
    function insertarEntrgables($codGE,$codUGE ,$codPlanPago, $codHito, $entregable){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql = "INSERT INTO planpago_entregables (plandepagos_propuestapago_codpropuestapago,plandepagos_propuestapago_grupo_empresa_usuario_idusuario,plandepagos_propuestapago_grupo_empresa_codgrupo_empresa,plandepagos_codplandepagos,entregable)";
        $sql.= "VALUES ('$codPlanPago','$codUGE','$codGE','$codHito','$entregable')";
        pg_query($con,$sql) or die ("ERROR!!!!!" .pg_last_error());
    }
    function registrarEntrgables($codGE,$codUGE ,$codPlanPago, $codHito, $entregable){
        $conec=new Conexion();
        $con=$conec->getConection();
        $codCalendario = retornarCalendarioGE($codGE,$codUGE); 
        $sql = "INSERT INTO entregables (hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar,hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres,hito_pagable_plan_pago_calendario_codcalendario,hito_pagable_plan_pago_codplan_pago,hito_pagable_codhito_pagable,entregable)";
        $sql.= "VALUES ('$codUGE','$codGE','$codCalendario','$codPlanPago','$codHito','$entregable')";
        pg_query($con,$sql) or die ("ERROR!!!!!" .pg_last_error());
    }
    function retornarCalendarioGE($codGE,$codUGE){
        $conec = new Conexion();
        $con = $conec->getConection();
        $sql="SELECT codcalendario FROM calendario c WHERE c.grupo_empresa_codgrupo_empresa='$codGE' AND c.grupo_empresa_usuario_idusuario='$codUGE'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $cod = $row->codcalendario;
        return $cod;
    }
?>
