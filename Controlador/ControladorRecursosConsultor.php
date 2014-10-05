<?php
require_once '../Modelo/ModeloRecursosConsultor.php';
require_once '../Modelo/ModeloObtenerInfoGE.php';


if (isset($_GET['re'])) {
    $seleccionado = $_POST['combo_documentos'];
    $a = $_GET['a'];
    $u = $_GET['u'];
    if ($seleccionado == 'actividades') {
        $recu="actividades";
        header("Location: ../Vista/iuRecursosConsultor.php?a=$a&u=$u&recu=$recu");
    } elseif ($seleccionado == 'respuestas') {
        $recu="respuestas";
        header("Location: ../Vista/iuRecursosConsultor.php?a=$a&u=$u&recu=$recu");
    }elseif($seleccionado == 'todos'){
        $recu="todos";
        header("Location: ../Vista/iuRecursosConsultor.php?a=$a&u=$u&recu=$recu");
    }else{
        header("Location: ../Vista/iuRecursosConsultor.php?a=$a&u=$u&recu=$seleccionado");
    }
}

function recursos($idUsuario) {
    echo mostrarRecursosConsultor($idUsuario);
}

function obtenerInfoGE($idUsuarioCons) {
    echo obtenerInfo($idUsuarioCons);
}
function listarRespuestasAcitividades($idUsuarioCons) {
    echo obtenerRespuestasActividades($idUsuarioCons);
}
function listarRecursosDeActividades($usuarioConsultor) {
    echo obtenerRecursosActividades($usuarioConsultor);
}
function listarAchivosGE($usuarioGE,$usuarioConsultor) {
    echo  ArchivosGE($usuarioGE,$usuarioConsultor);
}