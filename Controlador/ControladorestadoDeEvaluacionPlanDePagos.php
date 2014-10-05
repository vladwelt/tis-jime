<?php
    require '../Modelo/ModeloestadoDeEvaluacionPlanDePagos.php';
    function mostrarNombreDeLaGEE($codGE,$codUGE){
        $nombreGE = retornarNombreDeLaGEE($codGE,$codUGE);
        return $nombreGE;
    }
    function mostrarEstadoTablaPagoConsultor(){
        $estadoTabla = retornarEstadoDeTablaPagoConsultor();
        return $estadoTabla;
    }
    function retornarEstadoDeEvaluaciones($codC,$codUC,$codGE,$codUGE){
        $array_evaluaciones=  retornarEstadoDeEvaluacionesPlanDePagos($codC,$codUC,$codGE,$codUGE);
        return $array_evaluaciones;
    }
    
?>
