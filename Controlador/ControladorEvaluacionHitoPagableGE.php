<?php
    require '../Modelo/ModeloEvaluacionHitoPagableGE.php';
    function mostrarEntregables($codHito){
        $entregables = retornarEntregables($codHito);
        if (isset($_REQUEST['true'])){return $entregables;}
        else{insertarTablaRegistros($codHito); return $entregables;}
            
    }
    function mostaraEstadoTablaRegistros(){
        $estadoTabla = retornarEstadoTablaRegistros();
        return $estadoTabla;
    }
    if(isset($_REQUEST['registarEPPGE'])){
        $codGE=$_GET['c_a'];
        $codUGE=$_GET['i_u'];
        $codC=$_GET['a'];
        $codUC=$_GET['u'];
        $codH=$_GET['c_h'];
        $nombreH=$_GET['n_h'];
        $monto=$_GET['monto'];
        $p_s=$_GET['p_s'];
        $codPPago=$_GET['c_p'];

        $entregable=$_POST['entregable'];    
        $porcentaje=$_POST['porcentaje'];
        $alcance=$_POST['porcentajeAlcansado'];
        if ($alcance <= $porcentaje) {
            $codE= retornarCodEntregables($codH, $entregable);
            $sumaAlcance=$alcance;
            eliminarEntregableTablaRegistros($codH,$entregable,$codE);
            registrarEvaluacionPlanDePagosGE($porcentaje, $alcance, $codH, $entregable, $nombreH, $sumaAlcance);
            header("Location: ../Vista/iu.evaluacionHitoPagableGE.php?tablaEvaluacionNueva&true&tabla&c_e=$codE&a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE&c_h=$codH&entregable=$entregable&n_h=$nombreH&monto=$monto&p_s=$p_s&c_p=$codPPago");
        }else if($alcance>$porcentaje) {
            header("Location: ../Vista/iu.evaluacionHitoPagableGE.php?tablaEvaluacion&mensajeEVA&true&c_e=$codE&a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE&c_h=$codH&entregable=$entregable&n_h=$nombreH&monto=$monto&p_s=$p_s&c_p=$codPPago");
        }
        
    }
    function mostrarRegistrosEtregables($codHito){
        $listaEntregables= retornarRegistro($codHito);
        return $listaEntregables;
    }
?>
