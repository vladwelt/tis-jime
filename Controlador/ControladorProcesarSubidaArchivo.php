<?php
require '../Modelo/ModeloProcesarSubidaArchivo.php';

$nombreArchivo = $_FILES['nombre_archivo_subir']['name'];
$nombreTemporalArchivo = $_FILES['nombre_archivo_subir']['tmp_name'];
$tipoArchivo = $_FILES['nombre_archivo_subir']['type'];

$titulo = $_POST['text_titulo'];
$cod = $_GET['a'];
$idUsuario = $_GET['u'];
if (isset($_GET['pu'])) {
    $descripcion = $_POST['text_descripcion'];
    $m = subirArchivoPublico($titulo, $tipoArchivo, $nombreArchivo, $nombreTemporalArchivo, $descripcion, FALSE);
    echo $m;
    header("Location:../Vista/iuSubirArchivoConsultor.php?a=$cod&u=$idUsuario&m=$m");
} elseif (isset($_GET['ge'])) {
    $descripcion = $_POST['text_descripcion'];
    $m = subirPropuesta($idUsuario, $tipoArchivo, $cod, $nombreArchivo, $nombreTemporalArchivo, $descripcion, FALSE);
    header("Location:../Vista/iuGrupoEmpresa.php?a=$codConsultor&u=$idUsuario&m=$m");
} elseif (isset($_GET['r'])) {


    $codigo_actividad = $_GET['ca'];
    $usuario_consultor = $_GET['uc'];
    $codigo_consultor = $_GET['cc'];
    $m = guardarArchivoGEActividad($nombreArchivo, $nombreTemporalArchivo, $codigo_actividad, $titulo, $usuario_consultor, $codigo_consultor, $idUsuario, $cod, $tipoArchivo);
    
    if (!($m == 2)) {
        header("Location:../Vista/iuRespuestaActividadGE.php?m=$m&a=$cod&u=$idUsuario&ca=$codigo_actividad&uc=$usuario_consultor&cc=$codigo_consultor");
    } else {
       header("Location:../Vista/iuGrupoEmpresa.php?a=$cod&u=$idUsuario&m=$m");
    }
} else {
    header("Location:../Vista/iuGrupoEmpresa.php?a=$cod&u=$idUsuario&m=1");
}
?>
