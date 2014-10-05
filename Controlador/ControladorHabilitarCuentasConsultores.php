<?php

require '../Modelo/ModeloHabilitarCuentasConsultores.php';
 
$cuentaConsultor = $_GET['cons'];
if (!empty($_GET['cons'])) {
    habilitarCuentaConsultor($cuentaConsultor);
}
?>
