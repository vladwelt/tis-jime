<?php
require '../Modelo/ModeloEvaluacion.php';
$a=$_GET['a'];// $a -> codigo del consultor
$u=$_GET['u'];// $u -> codigo de usuario del consultor
$tipo_evaluacion = $_GET['te'];
$num_campos = $_GET['nc'];
$nombre_criterio = $_GET['ncr'];
$proyecto = $_GET['cp'];
$porcen_calif = $_GET['pcent'];
$porcen_rest = $_GET['pcr'];

if ($tipo_evaluacion==3) {
    for ($i = 1; $i <= $num_campos; $i++) {
        $concepto = $_POST['concepto' . $i];
        $porcentaje = $_POST['puntaje' . $i];
        registrar_escala_conceptual($tipo_evaluacion, $proyecto, $u, $a, $nombre_criterio, $concepto, $porcentaje);
    }
    if($porcen_rest>0){
        header("Location: ../Vista/iuRegistroEvaluacion.php?a=$a&u=$u&p=$porcen_rest&proyecto=$proyecto");
    }else{
        header("Location: ../Vista/iuTablaRegistroEvaluacion.php?a=$a&u=$u&proyecto=$proyecto&e=1");
    }
    //header("Location: ../Vista/iuRegistroEvaluacion.php?a=$a&u=$u&p=$porcen_rest&proyecto=$proyecto");
}else {
    for ($i = 1; $i <= $num_campos; $i++) {
        $concepto = $_POST['concepto' . $i];
        $porcentaje = $_POST['puntaje' . $i];
        registrar_escala_numeral($tipo_evaluacion, $proyecto, $u, $a, $nombre_criterio, $concepto." - ".$porcentaje, $porcentaje);
    }
    if($porcen_rest>0){
        header("Location: ../Vista/iuRegistroEvaluacion.php?a=$a&u=$u&p=$porcen_rest&proyecto=$proyecto");
    }else{
        header("Location: ../Vista/iuTablaRegistroEvaluacion.php?a=$a&u=$u&proyecto=$proyecto&e=1");
    }
}
