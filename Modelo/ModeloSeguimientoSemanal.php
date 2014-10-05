<?php

require '../Controlador/Conexion.php';

function insertar($cod_grupo_empresa, $cod_evaluacion, $rol, $esperado) {
    $con = new Conexion();
    $c = $con->getConection();
    
    $cons_id_usuario_ge = pg_query($c, "select usuario_idusuario from grupo_empresa where codgrupo_empresa = ".$cod_grupo_empresa.";");
    $id_usuario_conseguido = pg_fetch_object($cons_id_usuario_ge);
    $id_usuario_ge = $id_usuario_conseguido->usuario_idusuario;
    
    $cons_cod_calendario = pg_query($c, "select codcalendario from calendario where grupo_empresa_codgrupo_empresa = ".$cod_grupo_empresa.";");
    $cod_conseguido = pg_fetch_object($cons_cod_calendario);
    $cod_calendario = $cod_conseguido->codcalendario;

    $consulta = pg_query($c, "INSERT INTO detalle_ge(evaluacion_semanal_calendario_grupo_empresa_usuario_idusuario, evaluacion_semanal_calendario_grupo_empresa_codgrupo_empresa, evaluacion_semanal_calendario_codcalendario, evaluacion_semanal_codevaluacion_semanal, rol, esperado) VALUES (".$id_usuario_ge.", ".$cod_grupo_empresa.", ".$cod_calendario.", ".$cod_evaluacion.", '".$rol."', '".$esperado."');");
 
}



function ingresarDetalleConsultor($cod_grupo_empresa, $cod_evaluacion, $cod_registro, $realizado, $observaciones, $detalle, $cond_consultor){
    $con = new Conexion();
    $c = $con->getConection();
    $cantidad = cantidad_filas_seguimiento($cod_registro);
    if($cantidad > 0){
        $consulta = pg_query($c, "UPDATE detalle_cons SET realizado='".$realizado."', observaciones='".$observaciones."', detalle_esperado ='".$detalle."' WHERE detalle_ge_iddetalle_ge =".$cod_registro.";");
    }else{
        $cons_id_usuario_ge = pg_query($c, "select usuario_idusuario from grupo_empresa where codgrupo_empresa = ".$cod_grupo_empresa.";");
    $id_usuario_conseguido = pg_fetch_object($cons_id_usuario_ge);
    $id_usuario_ge = $id_usuario_conseguido->usuario_idusuario;
    
    $cons_cod_calendario = pg_query($c, "select codcalendario from calendario where grupo_empresa_codgrupo_empresa = ".$cod_grupo_empresa.";");
    $cod_conseguido = pg_fetch_object($cons_cod_calendario);
    $cod_calendario = $cod_conseguido->codcalendario;

    $consulta = pg_query($c, "INSERT INTO detalle_cons(consultor_idconsultor, detalle_ge_evaluacion_semanal_codevaluacion_semanal, detalle_ge_evaluacion_semanal_calendario_codcalendario, detalle_ge_evaluacion_semanal_calendario_grupo_empresa_codgrupo, detalle_ge_evaluacion_semanal_calendario_grupo_empresa_usuario_, detalle_ge_iddetalle_ge, realizado, observaciones, detalle_esperado) VALUES ($cond_consultor, ".$cod_evaluacion.", ".$cod_calendario.", ".$cod_grupo_empresa.", ".$id_usuario_ge.", ".$cod_registro.", '".$realizado."', '".$observaciones."', '".$detalle."')");
    
        }
}

function conseguir_rol($id_detalle_avance) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta_rol = pg_query($c, "select rol from detalle_ge where iddetalle_ge = ".$id_detalle_avance.";");
    $f_rol = pg_fetch_object($consulta_rol);
    $rol = $f_rol->rol;
    echo $rol;
}

function conseguir_esperado($id_detalle_avance) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta_esperado = pg_query($c, "select esperado from detalle_ge where iddetalle_ge = ".$id_detalle_avance.";");
    $f_esperado = pg_fetch_object($consulta_esperado);
    $esperado = $f_esperado->esperado;
    echo $esperado;
}

function conseguir_realizado($id_detalle_avance) {
    $con = new Conexion();
    $c = $con->getConection();
    $cantidad = cantidad_filas_seguimiento($id_detalle_avance);
    if($cantidad > 0){
    $consulta_realizado = pg_query($c, "select realizado from detalle_cons where detalle_ge_iddetalle_ge = ".$id_detalle_avance.";");
    $f_realizadoado = pg_fetch_object($consulta_realizado);
    $realizado = $f_realizadoado->realizado;
    echo $realizado;
    }else
    {
        echo "";
    }
}

function conseguir_observaciones($id_detalle_avance) {
    $con = new Conexion();
    $c = $con->getConection();
    $cantidad = cantidad_filas_seguimiento($id_detalle_avance);
    if($cantidad > 0){
    $consulta_observaciones = pg_query($c, "select observaciones from detalle_cons where detalle_ge_iddetalle_ge = ".$id_detalle_avance.";");
    $f_observacion = pg_fetch_object($consulta_observaciones);
    $observacion = $f_observacion->observaciones;
    echo $observacion;
    }else{
        echo "";
    }
}

function conseguir_detalle($id_detalle_avance) {
    $con = new Conexion();
    $c = $con->getConection();
    $cantidad = cantidad_filas_seguimiento($id_detalle_avance);
    if($cantidad > 0){
    $consulta_detalle = pg_query($c, "select detalle_esperado from detalle_cons where detalle_ge_iddetalle_ge = ".$id_detalle_avance.";");
    $f_detalle = pg_fetch_object($consulta_detalle);
    $detalle_esperado = $f_detalle->detalle_esperado;
    echo $detalle_esperado;
    }else{
        echo "";
    }
}

function cantidad_filas_seguimiento($id_detalle_avance) {
    $con = new Conexion();
    $c = $con->getConection();
    
    $consulta_cantidad_conseguida = pg_query($c, "select count(*) from detalle_cons where detalle_ge_iddetalle_ge = ".$id_detalle_avance.";");
    $f = pg_fetch_object($consulta_cantidad_conseguida);
    $cant = $f->count;
    return $cant;
}