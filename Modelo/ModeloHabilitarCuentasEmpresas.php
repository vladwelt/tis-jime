<?php

require ('../Controlador/Conexion.php');

function habilitarCuentaEmpresa($cuentaEmpresa) {
    $conexion = new Conexion();
    $conexion->getConection();
    $sql = "update usuario set habilitada='t' where idusuario = '$cuentaEmpresa'";
    $rs = pg_query($sql);
    header("Location: ../Vista/iuAdminCuentasEmpresas.php");
}

?>