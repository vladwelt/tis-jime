<?php
require '../Controlador/Conexion.php';

function insertar_fecha($cod_grupo_empresa, $fecha) {
    $con = new Conexion();
    $c = $con->getConection();
    $cons_id_usuario_ge = pg_query($c, "select usuario_idusuario from grupo_empresa where codgrupo_empresa = " . $cod_grupo_empresa . ";");
    $id_usuario_conseguido = pg_fetch_object($cons_id_usuario_ge);
    $id_usuario_ge = $id_usuario_conseguido->usuario_idusuario;

    $cons_cod_calendario = pg_query($c, "select codcalendario from calendario where grupo_empresa_codgrupo_empresa = " . $cod_grupo_empresa . ";");
    $cod_conseguido = pg_fetch_object($cons_cod_calendario);
    $cod_calendario = $cod_conseguido->codcalendario;

    $consulta = pg_query($c, "INSERT INTO evaluacion_semanal(calendario_codcalendario, calendario_grupo_empresa_codgrupo_empresa, calendario_grupo_empresa_usuario_idusuario, fecha)
    VALUES (" . $cod_calendario . ", " . $cod_grupo_empresa . ", " . $id_usuario_ge . ", '" . $fecha . "');");
}

function recuperar_fechas_reunionsemanal($cod_ge) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select fecha from evaluacion_semanal where calendario_grupo_empresa_codgrupo_empresa =".$cod_ge);
    $arreglo_fechas = array();
    while ($f = pg_fetch_object($consulta)) {
        $fecha = $f->fecha;
        $arreglo_fechas[] = $fecha;
    }
    return $arreglo_fechas;
}

function recuperar_fechas_hitos($cod_ge) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select fechapago from hito_pagable where plan_pago_calendario_grupo_empresa_codgrupo_empresa =".$cod_ge);
    $arreglo_fechas = array();
    while ($f = pg_fetch_object($consulta)) {
        $fecha = $f->fechapago;
        $arreglo_fechas[] = $fecha;
    }
    return $arreglo_fechas;
}

function conseguir_id_fecha($cod_ge, $d, $m, $a){
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select codevaluacion_semanal from evaluacion_semanal where calendario_grupo_empresa_codgrupo_empresa = ".$cod_ge." and fecha = '".$a."-".$m."-".$d."';");
    $cod_semana;
    while ($f = pg_fetch_object($consulta)) {
        $cod_semana = $f->codevaluacion_semanal;
    }
    return $cod_semana;
}

function conseguir_id_hito($cod_ge, $d, $m, $a){
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select codhito_pagable from hito_pagable where plan_pago_calendario_grupo_empresa_codgrupo_empresa = ".$cod_ge." and fechapago = '".$a."-".$m."-".$d."';");
    while ($f = pg_fetch_object($consulta)) {
        $cod_hito = $f->codhito_pagable;
    }
    return $cod_hito;
}

function conseguir_nombre_hito($cod_hito){
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select hitoevento from hito_pagable where codhito_pagable=".$cod_hito);
    while ($f = pg_fetch_object($consulta)) {
        $nombre_hito = $f->hitoevento;
    }
    return $nombre_hito;
}

function ver_dia_fijado($cod_grupoempresa) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select dia_reunion_fijado from calendario where grupo_empresa_codgrupo_empresa =".$cod_grupoempresa);
    while ($f = pg_fetch_object($consulta)) {
        $fijado = $f->dia_reunion_fijado;
    }
    return $fijado;
}

function marcar_dia_fijado($cod_grupoempresa) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "UPDATE calendario SET dia_reunion_fijado=true WHERE grupo_empresa_codgrupo_empresa =".$cod_grupoempresa);
}

function conseguir_fin_proyecto($cod_grupoempresa) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, "select fechafinproyecto 
from proyecto p, consultor_proyecto_grupo_empresa i
where proyecto_codproyecto = codproyecto and i.grupo_empresa_codgrupo_empresa = $cod_grupoempresa");
    while ($f = pg_fetch_object($consulta)) {
        $fin_proy = $f->fechafinproyecto;
    }
    return $fin_proy;
}