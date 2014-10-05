<?php

require '../Modelo/ModeloDeshabilitarCuentasConsulores.php';

$cuenta_consultor = $_GET['cons'];

if (!empty($_GET['cons'])) {
    DeshabilitarCuentaConsultor($cuenta_consultor);
}
?>
