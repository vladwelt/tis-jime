<?php
require '../Modelo/ModeloEvaluacion.php';

$codGE=$_GET['c_a']; //codigo de la grupo empresa
       $codUGE=$_GET['i_u']; // codigo de usuario de la grupo empresa
       $a=$_GET['a'];// $a -> codigo del consultor
       $u=$_GET['u'];// $u -> codigo de usuario del consultor

$id_criterio = $_GET['cc'];
$nombre_criterio = $_GET['nc'];
$porcentaje_criterio = $_GET['pc'];
$tipo_criterio = $_GET['tc'];
$id_tipo = $_GET['it'];
$observaciones = $_POST['observaciones'];

if ($id_tipo == 1) {
    $nota = $_POST['verdadero_falso']; //"<input type=radio name=verdadero_falso value=FALSE>Falso<br>";
    registrar_evaluacion_final($codGE,$codUGE,$a,$u, $id_criterio, $id_tipo, $nota, $observaciones);
    header("Location: ../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE");
} elseif ($id_tipo == 2) {
    $nota = $_POST['nota'];
    registrar_evaluacion_final_numerico($codGE,$codUGE,$a,$u, $id_criterio, $id_tipo, $observaciones, $nota);
    header("Location: ../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE");
} elseif ($id_tipo == 3) {
    $nota = $_POST['conceptos'];
    registrar_evaluacion_final_escala_conceptual($codGE, $codUGE, $a, $u, $id_criterio, $nota, $id_tipo, $observaciones);
   // registrar_evaluacion_final($codGE,$codUGE,$a,$u, $id_criterio, $id_tipo, $nota, $observaciones);
    header("Location: ../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE");
} elseif ($id_tipo == 4) {
    $nota = $_POST['conceptos'];
    registrar_evaluacion_final_escala_numeral($codGE, $codUGE, $a, $u, $id_criterio, $nota, $id_tipo, $observaciones);
   // registrar_evaluacion_final_escala_numeral($codGE,$codUGE,$a,$u, $id_criterio, $id_tipo, $nota, $observaciones);
    header("Location: ../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE");
}  