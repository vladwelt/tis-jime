<?php
require '../Modelo/ModeloComentarioGrupoEmpresa.php';
    function mostrarNombreDelaGE($a,$u){
        $nombreGE =  retornarNombreDelaGrupoEmpresa($a, $u);
        return $nombreGE;
    }
    if(isset($_REQUEST['GE'])){
    $codGE=$_GET['a'];
    $codUsuarioGE=$_GET['u'];
    $nombreGE = retornarNombreDelaGrupoEmpresa($codGE,$codUsuarioGE);
    $comentario=$_POST['comentario'];
    $codForo=$_POST['codigo'];
    $candComentarios=$_POST['cantidad'];
    insertarComentarioForo($nombreGE, $comentario, $codForo, $candComentarios);
    header("Location: ../Vista/iu.foroConsultor.php?a=$codGE&u=$codUsuarioGE&c_f=$codForo&nom=$nombreGE&COM=$comentario");
    }
?>
