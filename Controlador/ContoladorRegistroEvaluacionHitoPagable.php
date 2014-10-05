<?php
require '../Modelo/ModeloRegistroEvaluacionHitoPagable.php';
        $codC=$_GET['a'];
        $codUC=$_GET['u'];
        $codGE=$_GET['c_a'];
        $codUGE=$_GET['i_u'];
        $codHE=$_GET['c_h'];
        $nombreHE=$_GET['n_h'];
        $codPPago = $_GET['c_p'];
        
        $hitoE=$_POST['hitoEvento'];
        $montoP=$_POST['monto_pago'];
        $porcentajeS=$_POST['porcentajeSatisfaccion'];
        $porcentajeA=$_POST['porcentajeAlcanzado'];
        
        registraPagoDelConsultor($codC, $codUC, $codGE, $codUGE, $codPPago, $codHE, $hitoE, $montoP, $porcentajeS, $porcentajeA);
        eliminarElPuntoDataDeEvaluacionHitosGE($codHE,$nombreHE);
        header("Location: ../Vista/iu.mostrarPlanDePagosGE.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE");
?>
