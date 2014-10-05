<?php
require_once '../Modelo/ModeloProcesarSubidaArchivo.php';
require_once('../Controlador/Conexion.php');

function AddActividad($id_usuarioConsultor,$idconsultor,$visible_para, $req_repuesta, $fecha_ini, $fecha_fin, $hora_inicio, $hora_fin, $titulo, $descripcion, $contestada) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $consultor_usuario_idusuario = $id_usuarioConsultor;
    $consultor_idconsultor = $idconsultor;
    $actividad_visible_para = $visible_para;
    $actividad_requiere_respuesta = $req_repuesta;
    $fecha_inicio_actividad = $fecha_ini;
    $fecha_fin_actividad = $fecha_fin;
    $hora_inicio_actividad = $hora_inicio;
    $hora_fin_actividad = $hora_fin;
    $titulo_actividad = $titulo;
    $descripcion_actividad = $descripcion;
    $actividad_contestada = $contestada;

    $sql_insertar = "INSERT INTO cons_actividad (consultor_usuario_idusuario,consultor_idconsultor,visiblepara,requiererespuesta,fechainicio,fechafin,horainicio,horafin"
            . ",titulo,descripcion,contestada)";
    $sql_insertar.="VALUES ($consultor_usuario_idusuario,'$consultor_idconsultor','$actividad_visible_para','$actividad_requiere_respuesta','$fecha_inicio_actividad','$fecha_fin_actividad'"
            . ",'$hora_inicio_actividad','$hora_fin_actividad','$titulo_actividad','$descripcion_actividad','$actividad_contestada')";
    pg_query($con, $sql_insertar) or die("ERROR :( " . pg_last_error());
    header("Location: ../Vista/iu.consultor.php?a=$consultor_idconsultor&u=$consultor_usuario_idusuario");
}

function AddActividadConArchivo($id_usuarioConsultor,$idconsultor,$visible_para, $req_repuesta, $fecha_ini, $fecha_fin, $hora_inicio, $hora_fin, $titulo, $descripcion, $contestada,$archivo,$archivo_tmp) {
    
    $array_datosArchivo=  guardarArchivoActividad($archivo,$archivo_tmp,$id_usuarioConsultor);
    
    $nombreArchivo=$array_datosArchivo[0];
    $rutaArchivo=$array_datosArchivo[1];
    
    
    $conec = new Conexion();
    $con = $conec->getConection();

    $consultor_usuario_idusuario = $id_usuarioConsultor;
    $consultor_idconsultor = $idconsultor;
    $actividad_visible_para = $visible_para;
    $actividad_requiere_respuesta = $req_repuesta;
    $fecha_inicio_actividad = $fecha_ini;
    $fecha_fin_actividad = $fecha_fin;
    $hora_inicio_actividad = $hora_inicio;
    $hora_fin_actividad = $hora_fin;
    $titulo_actividad = $titulo;
    $descripcion_actividad = $descripcion;
    $actividad_contestada = $contestada;

    $sql_insertar = "INSERT INTO cons_actividad (consultor_usuario_idusuario,consultor_idconsultor,visiblepara,requiererespuesta,fechainicio,fechafin,horainicio,horafin"
            . ",titulo,descripcion,contestada,ruta, archivo)";
    $sql_insertar.="VALUES ($consultor_usuario_idusuario,'$consultor_idconsultor','$actividad_visible_para','$actividad_requiere_respuesta','$fecha_inicio_actividad','$fecha_fin_actividad'"
            . ",'$hora_inicio_actividad','$hora_fin_actividad','$titulo_actividad','$descripcion_actividad','$actividad_contestada','$rutaArchivo','$nombreArchivo')";
    pg_query($con, $sql_insertar) or die("ERROR :( " . pg_last_error());    
}

?>