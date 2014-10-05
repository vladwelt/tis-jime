<?php
require('../Modelo/ModeloMostrarPlanDePagosRegistrado.php');
    function mostrarEstadoTablaPlanDePagosRegistrado(){
        $estadoTabla = retornarEstadoTablaPlanDePagosRegistrado();
        return $estadoTabla;
    }
    function mostrarPlanDePagosRegistrado($a,$u){
        $listaPlanDePago = retornarPlanDePagosRegistrado($a,$u);
    return $listaPlanDePago;    
    }
?>