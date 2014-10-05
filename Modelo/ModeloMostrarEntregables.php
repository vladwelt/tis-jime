<?php
require '../Controlador/Conexion.php';
function retornarPlanPagoEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE,$montoT,$porcentajeR,$hito_evento,$porcentaje_pago,$fecha_pago){
        $conec=new Conexion(); 
        $con=$conec->getConection();  
        $sql ="SELECT codplanpago_entregables,entregable "; 
        $sql.="FROM planpago_entregables p ";
        $sql.="WHERE p.plandepagos_propuestapago_codpropuestapago='$codplan_papo' AND p.plandepagos_propuestapago_grupo_empresa_usuario_idusuario='$cod_usuarioGE' AND p.plandepagos_propuestapago_grupo_empresa_codgrupo_empresa='$cod_ge' AND p.plandepagos_codplandepagos='$cod_hito'";
        $result = pg_query($con,$sql);
        $array_entregables = array();
        while ($row = pg_fetch_object($result)){
            $codE = $row->codplanpago_entregables;
            $e = $row->entregable;
            $array_entregables[] = "- ".$e; 
            $array_entregables[] = "<a href = '../Controlador/ControladorMostrarEntregables.php?Delet&a=$cod_ge&u=$cod_usuarioGE&c_e=$codE&m_t=$montoT&p_r=$porcentajeR&c_h=$cod_hito&c_p=$codplan_papo&h_e=$hito_evento&p_p=$porcentaje_pago&f_p=$fecha_pago'>Eliminar</a>";
        }
        return $array_entregables;
        pg_close($con);
}
function  eliminarPlanPagoEntregables($codE){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql="delete from planpago_entregables p where p.codplanpago_entregables='$codE'";
        pg_query($con,$sql);
        pg_close($con);
}
function retornarEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE){
        $conec=new Conexion(); 
        $con=$conec->getConection();  
        $c_p=$codplan_papo;
        $c_h=$cod_hito;
        $c_ge=$cod_ge;
        $c_uge=$cod_usuarioGE;
            // Ejecutar la consulta SQL
        $sql ="SELECT entregable "; 
        $sql.="FROM entregables e ";
        $sql.="WHERE e.hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar='$c_uge' AND e.hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres='$c_ge' AND e.hito_pagable_plan_pago_codplan_pago='$c_p' AND e.hito_pagable_codhito_pagable='$c_h'";
        $result = pg_query($con,$sql);
        $array_entregables = array();
        while ($row = pg_fetch_object($result)){
            $e = $row->entregable;
            $array_entregables[] = "- ".$e; 
        }
        return $array_entregables;
        pg_close($con);
}
?>
