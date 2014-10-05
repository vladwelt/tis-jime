<?php
include '../Modelo/ModeloEvaluacion.php';
$a = $_GET['a'];
$u = $_GET['u'];
$proyecto = $_POST['cbox_proyectos'];

if(no_existe_registro_proyecto($proyecto, $a)){
insertar_registro_evaluacion($proyecto,$a,$u);
header("Location: ../Vista/iuRegistroEvaluacion.php?a=$a&u=$u&p=100&proyecto=$proyecto");
}else{
    //existe = e
    header("Location: ../Vista/iuTablaRegistroEvaluacion.php?a=$a&u=$u&proyecto=$proyecto&e=1");
}

function no_existe_registro_proyecto($proyecto, $a){
    return no_existe_registro($proyecto, $a);
}