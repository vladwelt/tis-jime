<?php
require '../Modelo/ModeloListaTemasForoGrupoEmpresa.php';
    function retornarEstadoTablaForoGE(){
        $estadoTabla = retornarEstadoDeTablaForoGrupoEmpresa();
        return $estadoTabla;
    }
    function mostrarListaFGE($a,$u){
        $listaForoGE = mostrarListaForoGrupoEmpresa($a,$u);
    return $listaForoGE;    
    }
?>
