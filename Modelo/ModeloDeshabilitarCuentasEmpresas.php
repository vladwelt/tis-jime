<?php
require ('../Controlador/Conexion.php');
function DeshabilitarCuentaEmpresa($cuentaEmpresa){
    $conexion = new Conexion();
    $conexion->getConection();
    $sql = "update usuario set habilitada='f' where idusuario = '$cuentaEmpresa'";
    $rs = pg_query($sql);
    header("Location: ../Vista/iuAdminCuentasEmpresas.php");
}
?>