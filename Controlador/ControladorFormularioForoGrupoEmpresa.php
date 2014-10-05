<?php
require '../Modelo/ModeloFormularioForoGrupoEmpresa.php';
    function mostrarNombreDelaGrupoEmpresa($a,$u){
        $nombreGE = retornarNombreDelaGrupoEmpresa($a,$u);
        return $nombreGE;
    }
    if (isset($_REQUEST['GE'])) {
        $codGE = $_GET['a'];
        $codUsuarioGE = $_GET['u'];
        $nombreGE = retornarNombreDelaGrupoEmpresa($codGE, $codUsuarioGE);
        $temaGE = $_POST['temaGE'];
        $comentarioGE = $_POST['comentarioGE'];
        $candComentarios=0;
        insertarForoGE($nombreGE, $temaGE, $comentarioGE, $candComentarios);
        header("Location: ../Vista/iu.foroGrupoEmpresa.php?a=$codGE&u=$codUsuarioGE&candtidad=$candComentarios");
    } 
?>
