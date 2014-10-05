<?php
require ('../Controlador/Conexion.php');
function DeshabilitarCuentaConsultor($cuentaConsultor){
    $conexion = new Conexion();
    $conexion->getConection();
    $sql = "update usuario set habilitada='f' where idusuario = '$cuentaConsultor'";
    $rs = pg_query($sql);
    header("Location: ../Vista/iuAdminCuentasConsultores.php");
}
?>