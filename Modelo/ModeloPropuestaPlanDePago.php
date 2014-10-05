<?php
require('../Controlador/Conexion.php');
     function retornarEstadoPropuestaDePago(){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM propuestapago";
        $result=  pg_query($con,$sql);
        $estado= pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
    function retornaPropuestaDePagosGE($a,$u){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql = "SELECT codpropuestapago,montototal,porcentajesatisfaccion,estado,estadoregistro ";
        $sql.="FROM propuestapago p ";
        $sql.="WHERE p.grupo_empresa_usuario_idusuario='$u' AND p.grupo_empresa_codgrupo_empresa='$a'";
            $result = pg_query($con,$sql);
            $array_propuestaPagosGE = array();
            $porcentaje_restante = 100;
            while ($row = pg_fetch_object($result)){
                $cod = $row->codpropuestapago;
                $montoT = $row->montototal;
                $porcentajeS = $row->porcentajesatisfaccion;
                $estado = $row->estado;
                $estadoRegitro = $row->estadoregistro;
                if ($estado == "f" && $estadoRegitro == "f") {
                $array_propuestaPagosGE[] = " ";
                $array_propuestaPagosGE[] = $montoT;
                $array_propuestaPagosGE[] = $porcentajeS;
                $array_propuestaPagosGE[] = "<input size='2xp' type='submit' value=' ' style='background-color:#b22222; border:1px solid black' title='FALTA AÑADIR PLANDE PAGOS' readonly='readonly' /> "
                                            ."<a href = '../Vista/iu.registroDePlanDePagos.php?AVI&a=$a&u=$u&m_t=$montoT&p_r=$porcentaje_restante&c_p=$cod'>Añadir Plan De Pagos</a>";
                $array_propuestaPagosGE[] = "<a href = '../Controlador/ControladorPropuestaPlanDePago.php?Delet&a=$a&u=$u&c_p=$cod'>Eliminar</a>";
                }else if ($estado == "t" && $estadoRegitro == "f") {
                $array_propuestaPagosGE[] = "<input size='2xp' type='submit' value=' ' style='background-color:#b22222; border:1px solid black' title='FALTA REGISTRAR' readonly='readonly' /> "
                                            ."<a href = '../Controlador/ControladorRegistrarPropuestaPlanDePagoCompleta.php?a=$a&u=$u&c_p=$cod&m_t=$montoT&p_s=$porcentajeS'>Registrar</a>";
                $array_propuestaPagosGE[] = $montoT;
                $array_propuestaPagosGE[] = $porcentajeS;
                $array_propuestaPagosGE[] = "<input size='2xp' type='submit' value=' ' style='background-color:#32cd32; border:1px solid black' title='YA ESTA REGISTRADO' readonly='readonly' /> "
                                            ."<a href = '../Vista/iu.mostrarPlanDePago.php?a=$a&u=$u&m_t=$montoT&p_s=$porcentajeS&c_p=$cod'>Mostrar Plan</a>";
                $array_propuestaPagosGE[] = "<a href = '../Controlador/ControladorPropuestaPlanDePago.php?Delet&a=$a&u=$u&c_p=$cod'>Eliminar</a>";
                }else if ($estado == "t" && $estadoRegitro == "t"){
                $array_propuestaPagosGE[] = "<input size='2xp' type='submit' value=' ' style='background-color:#32cd32; border:1px solid black' title='YA ESTA REGISTRADO' readonly='readonly' /> "
                                            ."<strong>Registrado</strong>";
                $array_propuestaPagosGE[] = $montoT;
                $array_propuestaPagosGE[] = $porcentajeS;
                $array_propuestaPagosGE[] = "<input size='2xp' type='submit' value=' ' style='background-color:#32cd32; border:1px solid black' title='YA ESTA REGISTRADO' readonly='readonly' /> "
                                            ."<a href = '../Vista/iu.mostrarPlanDePago.php?a=$a&u=$u&m_t=$montoT&p_s=$porcentajeS&c_p=$cod'>Mostrar Plan</a>";
                $array_propuestaPagosGE[] = "<a href = '../Controlador/ControladorPropuestaPlanDePago.php?Delet&a=$a&u=$u&c_p=$cod'>Eliminar</a>";    
                }
            }
                return $array_propuestaPagosGE;
            pg_close($con);
    
    }
    function eliminarPropuestaDePago($cod_PPago){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql3="delete from planpago_entregables p where p.plandepagos_propuestapago_codpropuestapago='$cod_PPago'";
        $sql2="delete from plandepagos p where p.propuestapago_codpropuestapago='$cod_PPago'";
        $sql1="delete from propuestapago p where p.codpropuestapago='$cod_PPago'";
        pg_query($con,$sql3);
        pg_query($con,$sql2);
        pg_query($con,$sql1);
        pg_close($con);
    }
    function insertarEstadoPropuestaDePago($cod_PPago){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql = "UPDATE propuestapago ";
        $sql.="SET estado = 'TRUE' ";
        $sql.="WHERE codpropuestapago='$cod_PPago'";
        pg_query($con,$sql);
        pg_close($con);
    }
    function insertarPropuestaDePago($monto_total, $porcentaje_satisfaccion, $cod_grupoE, $cod_usuarioGE){
        $conec=new Conexion(); 
        $con=$conec->getConection();        
        $sql = "INSERT INTO propuestapago (grupo_empresa_usuario_idusuario,grupo_empresa_codgrupo_empresa,montototal,porcentajesatisfaccion,estado,estadoregistro)";
        $sql.= "VALUES ('$cod_usuarioGE','$cod_grupoE','$monto_total','$porcentaje_satisfaccion','FALSE','FALSE')";
        pg_query($con,$sql) or die ("ERROR :( " .pg_last_error());
    } 

    function registrarPropuestaDePago($monto_total, $porcentaje_satisfaccion, $cod_grupoE, $cod_usuarioGE){
        $conec=new Conexion(); 
        $con=$conec->getConection();        
        $cod_calendario=retornarCodCalendario($cod_grupoE,$cod_usuarioGE);
        $sql = "INSERT INTO plan_pago (calendario_codcalendario,calendario_grupo_empresa_codgrupo_empresa,calendario_grupo_empresa_usuario_idusuario,montototal,porcentajesatisfaccion)";
        $sql.= "VALUES ('$cod_calendario','$cod_grupoE','$cod_usuarioGE','$monto_total','$porcentaje_satisfaccion')";
        pg_query($con,$sql) or die ("ERROR :( " .pg_last_error());
    }
    function insertarRegistroDePlanDePago($monto_total, $montopago, $porcentaje_restante, $hito_evento, $porcentaje_pago, $fecha_pago, $codigoPlan, $cod_grupoE, $cod_usuarioGE){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $monto=establecerMonto($monto_total,$porcentaje_restante,$porcentaje_pago);
        if($monto!=0){
        $sql = "INSERT INTO plandepagos (propuestapago_grupo_empresa_codgrupo_empresa,propuestapago_grupo_empresa_usuario_idusuario,propuestapago_codpropuestapago,hitoevento,porcentajepago,montopago,fechapago)";
        $sql.= "VALUES ('$cod_grupoE','$cod_usuarioGE','$codigoPlan','$hito_evento','$porcentaje_pago','$montopago','$fecha_pago')";
        pg_query($con,$sql) or die ("ERROR :( " .pg_last_error());
        }
    }
    
    function registrarRegistroDePlanDePago($monto_total, $porcentaje_satisfaccion, $hito_evento, $porcentaje_pago, $fecha_pago, $codigoPlan, $cod_grupoE, $cod_usuarioGE){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $cod_calendario=  retornarCodCalendario($cod_grupoE, $cod_usuarioGE);
        $monto=establecerMonto($monto_total,$porcentaje_satisfaccion,$porcentaje_pago);
        if($monto!=0){
        $sql = "INSERT INTO hito_pagable (plan_pago_codplan_pago,plan_pago_calendario_codcalendario,plan_pago_calendario_grupo_empresa_codgrupo_empresa,plan_pago_calendario_grupo_empresa_usuario_idusuario,hitoevento,porcentajepago,monto,fechapago)";
        $sql.= "VALUES ('$codigoPlan','$cod_calendario','$cod_grupoE','$cod_usuarioGE','$hito_evento','$porcentaje_pago','$monto','$fecha_pago')";
        pg_query($con,$sql) or die ("ERROR :( " .pg_last_error());
        }
    }
    function establecerMonto($monto_total,$porcentaje_restante,$porcentaje_pago){
        $monT = $monto_total;
        $porR = $porcentaje_restante;
        $porP = $porcentaje_pago;
        $monto = 0;
        if ($monT!=0) {
            $monto = (($monT*$porP)/$porR);  
        }   
        return $monto;
    }
   
        //esta funcion recupera del BD el codigo dela tabla plan_pago
    function retornarCodCalendario($cod_grupoE,$cod_usuarioGE){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql="SELECT codcalendario FROM calendario c WHERE c.grupo_empresa_codgrupo_empresa='$cod_grupoE' AND c.grupo_empresa_usuario_idusuario='$cod_usuarioGE'";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $cod = $row->codcalendario;
        return $cod;        
    }

    function retornarCodPlanDePago($monto_total,$porcentaje_satisfaccion){
        $conec=new Conexion(); 
        $con=$conec->getConection();        
        $mt=$monto_total;
        $pt=$porcentaje_satisfaccion;
        //$sql="SELECT codplan_pago FROM plan_pago p WHERE p.montototal='$mt' and p.porcentajesatisfaccion='$pt'";
        $sql="SELECT max(codplan_pago) plan_pago FROM plan_pago p WHERE p.montototal='$mt' and p.porcentajesatisfaccion='$pt'";
        //$sql="SELECT max(codplan_pago) FROM plan_pago p WHERE p.montototal='$mt' AND p.porcentajesatisfaccion='pt'";
        $consulta=pg_query($con,$sql);
        $row = pg_fetch_array($consulta);
        $cod = $row[0];
        return $cod;
    }
    
    function retornarCodPlandePagoss($codigoPlan,$montopago,$hito_evento,$porcentaje_pago,$fecha_pago){
        $conec=new Conexion();
        $con=$conec->getConection();
        $sql="SELECT codplandepagos ";
        $sql.="FROM plandepagos p ";
        $sql.="WHERE p.propuestapago_codpropuestapago='$codigoPlan' AND p.hitoevento='$hito_evento' AND p.porcentajepago='$porcentaje_pago' AND p.montopago='$montopago' AND p.fechapago='$fecha_pago'";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $cod = $row->codplandepagos;
        return $cod;
    }
    
    function retornarCodHitoEvento($hito_evento,$porcentaje_pago,$fecha_pago){
        $conec=new Conexion();
        $con=$conec->getConection();
        $h_e = $hito_evento;
        $p_p = $porcentaje_pago;
        $f_p = $fecha_pago;
        
        $sql="SELECT codhito_pagable FROM hito_pagable h WHERE h.hitoevento='$h_e' and h.porcentajepago='$p_p' and h.fechapago='$f_p'";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $cod = $row->codhito_pagable;
        return $cod;
    }
?>