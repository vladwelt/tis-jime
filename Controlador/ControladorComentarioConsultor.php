<?php
require '../Modelo/ModeloComentarioConsultor.php';
    function mostrarNombreDelConsultor($a,$u){
        $nombreConsultor =  retornarNombreDelConsultor($a, $u);
        return $nombreConsultor;    
    } 
    if(isset($_REQUEST['1'])){
    $codC=$_GET['a'];
    $codUsuarioC=$_GET['u'];
    $nombreConsultor = retornarNombreDelConsultor($codC, $codUsuarioC);
    $comentario=$_POST['comentario'];
    $codForo=$_POST['codigo'];
    $candComentarios=$_POST['cantidad'];
    insertarComentarioForo($nombreConsultor, $comentario, $codForo, $candComentarios);
    header("Location: ../Vista/iu.foroConsultor.php?a=$codC&u=$codUsuarioC&c_f=$codForo&nom=$nombreConsultor&COM=$comentario");
    }
?>
