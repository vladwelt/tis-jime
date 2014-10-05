<?php

require_once('../Modelo/ModeloListaTemasForoConsultor.php');
    function retornarEstadoTablaForo(){
        $estadoTabla= retornarEstadoDeTablaForo();
        return $estadoTabla;
    }
    function mostrarListaForoConsultor($a,$u){
        $listaForoConsultor = retornarListaForoConsultor($a,$u);
    return $listaForoConsultor;    
    }
?>
