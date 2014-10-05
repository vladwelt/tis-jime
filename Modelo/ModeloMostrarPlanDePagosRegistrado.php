<?php
require '../Controlador/Conexion.php';
    function retornarEstadoTablaPlanDePagosRegistrado(){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM hito_pagable";
        $result=  pg_query($con,$sql);
        $estado= pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
    function retornarPlanDePagosRegistrado($a,$u){
        
        $conec=new Conexion(); 
        $con=$conec->getConection(); 
        $codP = optenerCodPlanDePago($a,$u);
        $sql ="SELECT hitoevento,porcentajepago,monto,fechapago ";
        $sql.="FROM hito_pagable h ";
        $sql.="WHERE h.plan_pago_codplan_pago='$codP' ";
        $result = pg_query($con,$sql);
        $array_planpagos = array();
        while ($row = pg_fetch_object($result)){
            $h = $row->hitoevento;
            $p = $row->porcentajepago;
            $m = $row->monto;
            $f = $row->fechapago;
            
            $array_planpagos[] = $h;
            $array_planpagos[] = $p;
            $array_planpagos[] = $m;
            $array_planpagos[] = $f;
            }
            return $array_planpagos;
        pg_close($con);
    }
    function optenerCodPlanDePago($a,$u){
        $conec=new Conexion(); 
        $con=$conec->getConection();        
        //$sql="SELECT codplan_pago FROM plan_pago p WHERE p.montototal='$mt' and p.porcentajesatisfaccion='$pt'";
        $sql="SELECT max(codplan_pago) plan_pago FROM plan_pago p WHERE p.calendario_grupo_empresa_codgrupo_empresa='$a' and p.calendario_grupo_empresa_usuario_idusuario='$u'";
        //$sql="SELECT max(codplan_pago) FROM plan_pago p WHERE p.montototal='$mt' AND p.porcentajesatisfaccion='pt'";
        $consulta=pg_query($con,$sql);
        $row = pg_fetch_array($consulta);
        $cod = $row[0];
        return $cod;
    }
?>