<?php
// Requiring the model
require_once('../Modelo/ModeloListaTemasForo.php');
    function retornarEstadoTablaForo(){
        $estadoTabla= retornarEstadoDeTablaForo();
        return $estadoTabla;
    }
    function mostrarListaF(){
        $listaForo = mostrarListaForo();
    return $listaForo;    
    }
?>