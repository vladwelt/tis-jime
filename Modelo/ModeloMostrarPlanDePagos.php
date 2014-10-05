<?php
require '../Controlador/Conexion.php';
    function retornarEstadoDeTablaPlan(){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM plandepagos";
        $result=  pg_query($con,$sql);
        $estado= pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
    function retornarEstadoTablaPlanDePagosEntregables(){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM planpago_entregables";
        $result=  pg_query($con,$sql);
        $estado= pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
    function retornarPlanDePago($codP){
        
        $conec=new Conexion(); 
        $con=$conec->getConection();  
        $sql = "SELECT hitoevento,porcentajepago,montopago,fechapago FROM plandepagos p WHERE p.propuestapago_codpropuestapago='$codP' ";
        $result = pg_query($con,$sql);
        $array_planpagos = array();
        while ($row = pg_fetch_object($result)){
            $h = $row->hitoevento;
            $p = $row->porcentajepago;
            $m = $row->montopago;
            $f = $row->fechapago;
            
            $array_planpagos[] = $h;
            $array_planpagos[] = $p;
            $array_planpagos[] = $m;
            $array_planpagos[] = $f;
            }
            return $array_planpagos;
        pg_close($con);
    }
    function retornarPlanDePagosEntregables($codP){
        
        $conec=new Conexion(); 
        $con=$conec->getConection();  
        $array_entregables = array();
        $array_codPlanDePAgos = retornarArrayCodPlanDePAgos($codP);
        $contador = 0;
        while ($contador <= sizeof($array_codPlanDePAgos)-1){
            $codPlanDePagos = $array_codPlanDePAgos[$contador]; 
            $sql ="SELECT hitoevento,entregable "; 
            $sql.="FROM planpago_entregables pe,plandepagos p ";
            $sql.="WHERE pe.plandepagos_propuestapago_codpropuestapago=p.propuestapago_codpropuestapago AND pe.plandepagos_codplandepagos='$codPlanDePagos' AND p.codplandepagos='$codPlanDePagos'";
            $result = pg_query($con,$sql);
            while ($row = pg_fetch_object($result)){
                $h = $row->hitoevento;
                $e = $row->entregable;
            
                $array_entregables[] = $h;
                $array_entregables[] = $e;
            }
            $contador=$contador+1;
        }    
            return $array_entregables;
        pg_close($con);
    }
    function retornarArrayCodPlanDePAgos($codP){
        $conec=new Conexion();
        $con=$conec->getConection();
        $array_codP = array();
        $sql="SELECT codplandepagos ";
        $sql.="FROM plandepagos p "; 
        $sql.="WHERE p.propuestapago_codpropuestapago='$codP'";
        $result = pg_query($con,$sql);
        while ($row = pg_fetch_object($result)){
            $cod = $row->codplandepagos;
            $array_codP[]=$cod;
        }
        return $array_codP;
    }
    function retornarCodPlanDePago($codGE,$codUsuarioGE){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql="SELECT codplan_pago FROM plan_pago p WHERE p.calendario_grupo_empresa_codgrupo_empresa='$codGE' AND p.calendario_grupo_empresa_usuario_idusuario='$codUsuarioGE'";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $cod = $row->codplan_pago;
        return $cod;        
    }
?>