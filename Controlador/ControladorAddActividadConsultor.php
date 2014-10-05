<?php
require_once '../Modelo/ModeloAddActividadConsultor.php';
$idconsultor = $_GET['a'];
$id_usuarioConsultor = $_GET['u'];
$visible_para = $_POST["combo_visible"];
$req_repuesta = $_POST["requiere"];
$fecha_ini = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$hora_ini = $_POST["hora_ini"];
$hora_fin = $_POST["hora_fin"];
$titulo = $_POST["txt_titulo"];
$descripcion = $_POST["ctxt_descripcion"];
$contestada = "FALSE";

if (!$_FILES['nombre_archivo_subir']['name'] == "") {
    $nombreArchivo = $_FILES['nombre_archivo_subir']['name'];
    $nombreTemporalArchivo = $_FILES['nombre_archivo_subir']['tmp_name'];
    $tipoArchivo = $_FILES['nombre_archivo_subir']['type'];
    AddActividadConArchivo($id_usuarioConsultor, $idconsultor, $visible_para, $req_repuesta, $fecha_ini, $fecha_fin, $hora_ini, $hora_fin, $titulo, $descripcion, $contestada, $nombreArchivo, $nombreTemporalArchivo);
    header("Location: ../Vista/iu.consultor.php?a=$idconsultor&u=$id_usuarioConsultor");
} else {
    AddActividad($id_usuarioConsultor, $idconsultor, $visible_para, $req_repuesta, $fecha_ini, $fecha_fin, $hora_ini, $hora_fin, $titulo, $descripcion, $contestada);
    header("Location: ../Vista/iu.consultor.php?a=$idconsultor&u=$id_usuarioConsultor");
}
?>
