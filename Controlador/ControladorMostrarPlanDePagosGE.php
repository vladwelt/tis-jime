<?php
    require '../Modelo/ModeloMostrarPlanDePagosGE.php';
    function mostrarNombreDeLaGE($codGE,$codUGE){
        $nombreGE = retornarNombreDeLaGE($codGE,$codUGE);
        return $nombreGE;
    }
    function mostrarEstadoTablaPlanDePagosGE(){
        $estadoTabla = retornarEstadoTablaPlanGE();
        return $estadoTabla;
    }
    function mostrarPlanDePagosGE($codGE,$codUGE,$codC,$codUC){
        $planDePagosGE = retornarPlanDePagosGE($codGE,$codUGE,$codC,$codUC);
        return $planDePagosGE;    
    }
?>
