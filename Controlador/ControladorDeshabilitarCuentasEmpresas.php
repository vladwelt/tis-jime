<?php
require '../Modelo/ModeloDesHabilitarCuentasEmpresas.php';

$cuenta_empresa = $_GET['ge'];

if (!empty($_GET['ge'])) {
    DeshabilitarCuentaEmpresa($cuenta_empresa);
}
?>

