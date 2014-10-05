<?php
require '../Controlador/Conexion.php';
    function insertarPropuestaPlanDePagoCompleta($codGE,$codUGE,$codP,$montoT,$porcentajeS){
        $conec = new Conexion();
        $con = $conec->getConection();
        $codC = optenerCodigoCalendario($codGE,$codUGE); 
        $sql = "INSERT INTO plan_pago (codplan_pago,
                                       calendario_codcalendario,
                                       calendario_grupo_empresa_codgrupo_empresa,
                                       calendario_grupo_empresa_usuario_idusuario,
                                       montototal,
                                       porcentajesatisfaccion)";
        $sql.= "VALUES ('$codP','$codC','$codGE','$codUGE','$montoT','$porcentajeS')";
        pg_query($con,$sql) or die ("ERROR!!!!!" .pg_last_error());
        
        $array_planDePagos = optenerPlanDePagosCompleto($codP);
        $contador = 0;
        while ($contador <= sizeof($array_planDePagos)-1){
            $codH = $array_planDePagos[$contador];
            $hitoE = $array_planDePagos[$contador+1];
            $porcentajeP = $array_planDePagos[$contador+2];
            $montoP = $array_planDePagos[$contador+3];
            $fechaP = $array_planDePagos[$contador+4];
            $sql2 = "INSERT INTO hito_pagable (codhito_pagable,
                                               plan_pago_codplan_pago,
                                               plan_pago_calendario_codcalendario,
                                               plan_pago_calendario_grupo_empresa_codgrupo_empresa,
                                               plan_pago_calendario_grupo_empresa_usuario_idusuario,
                                               hitoevento,
                                               porcentajepago,
                                               monto,
                                               fechapago)";
            $sql2.= "VALUES ('$codH','$codP','$codC','$codGE','$codUGE','$hitoE','$porcentajeP','$montoP','$fechaP')";
            pg_query($con,$sql2) or die ("ERROR!!!!!" .pg_last_error());
            $contador=$contador+5;
        }
        $array_planDePagosEntregables = optenerplanDePagosEntregablesCompleto($codP);
        $cont = 0;
        while ($cont <= sizeof($array_planDePagosEntregables)-1){
            $codE = $array_planDePagosEntregables[$cont];
            $codHP = $array_planDePagosEntregables[$cont+1];
            $entregable = $array_planDePagosEntregables[$cont+2];
            $sql3 = "INSERT INTO entregables (codentregables,
                                            hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar,
                                            hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres,
                                            hito_pagable_plan_pago_calendario_codcalendario,
                                            hito_pagable_plan_pago_codplan_pago,
                                            hito_pagable_codhito_pagable,
                                            entregable)";
            $sql3.= "VALUES ('$codE','$codUGE','$codGE','$codC','$codP','$codHP','$entregable')";
            pg_query($con,$sql3) or die ("ERROR!!!!!" .pg_last_error());
            $cont = $cont+3;
        }
    }
    function insertarEstadoRegistroPropuestaDePago($codP){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql = "UPDATE propuestapago ";
        $sql.="SET estadoregistro = 'TRUE' ";
        $sql.="WHERE codpropuestapago='$codP'";
        pg_query($con,$sql);
        pg_close($con);
    }
    function optenerCodigoCalendario($codGE,$codUGE){
        $conec = new Conexion();
        $con = $conec->getConection();
        $sql="SELECT codcalendario ";
        $sql.="FROM calendario c ";
        $sql.="WHERE c.grupo_empresa_codgrupo_empresa='$codGE' AND c.grupo_empresa_usuario_idusuario='$codUGE'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $cod = $row->codcalendario;
        return $cod;
        pg_close($con);
    }
    function optenerPlanDePagosCompleto($codP){
        $conec = new Conexion();
        $con = $conec->getConection();
        $array_planDePagos = array();
        $sql="SELECT codplandepagos,hitoevento,porcentajepago,montopago,fechapago ";
        $sql.="FROM plandepagos p ";
        $sql.="WHERE p.propuestapago_codpropuestapago='$codP'";
        $result = pg_query($con,$sql);
        while($row = pg_fetch_object($result)){
            $c_p = $row->codplandepagos;
            $h_e = $row->hitoevento;
            $p_p = $row->porcentajepago;
            $m_p = $row->montopago;
            $f_p = $row->fechapago;
            $array_planDePagos[]=$c_p;
            $array_planDePagos[]=$h_e;
            $array_planDePagos[]=$p_p;
            $array_planDePagos[]=$m_p;
            $array_planDePagos[]=$f_p;
        }
        return $array_planDePagos;
        pg_close($con);
    }
    function optenerplanDePagosEntregablesCompleto($codP){
        $conec = new Conexion();
        $con = $conec->getConection();
        $array_planDePagosEntregables = array();
        $sql="SELECT codplanpago_entregables,plandepagos_codplandepagos,entregable ";
        $sql.="FROM planpago_entregables p ";
        $sql.="WHERE p.plandepagos_propuestapago_codpropuestapago='$codP'";
        $result = pg_query($con,$sql);
        while($row = pg_fetch_object($result)){
            $c_e = $row->codplanpago_entregables;
            $p_c = $row->plandepagos_codplandepagos;
            $e = $row->entregable;
            $array_planDePagosEntregables[]=$c_e;
            $array_planDePagosEntregables[]=$p_c;
            $array_planDePagosEntregables[]=$e;
        }
        return $array_planDePagosEntregables;
        pg_close($con);
    }
?>

