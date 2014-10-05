 <?php
require('../Modelo/ModeloMostrarPlanDePagos.php');
    function mostrarEstadoTablaPlanDePagos(){
        $estadoTabla = retornarEstadoDeTablaPlan();
        return $estadoTabla;
    }
    function mostrarEstadoTablaPlanDePagosEntregables(){
        $estadoTabla = retornarEstadoTablaPlanDePagosEntregables();
        return $estadoTabla;
    }
    function mostrarPlanDePagos($codP){
        $listaPlanDePago = retornarPlanDePago($codP);
    return $listaPlanDePago;    
    }
    function mostrarPlanDePagosEntregables($codP){
        $listaEntregables = retornarPlanDePagosEntregables($codP);
    return $listaEntregables;    
    }
?>
