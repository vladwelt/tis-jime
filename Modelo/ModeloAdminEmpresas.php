<?php

require ('../Controlador/Conexion.php');

function crear_tabla_admin_empresas() {
    $conexion = new Conexion();
    $conexion->getConection();
    $sql = "SELECT * FROM usuario as u , grupo_empresa as ge WHERE u.idusuario=ge.usuario_idusuario";
    $rows = $conexion->ejecutarSql($sql);
    $miarchivo = fopen('../Vista/Otros/tablaEmpresas.data', 'w');
    $cadena = "<table border=1><tr> <td>GRUPO - EMPRESA</td> <td>ESTADO</td> <td> </td> <td> </td></tr> ";
    
    for ($i = 0; $i < count($rows); $i++) {
        $row = $rows[$i];
        $nombreEmpresa = $row['nombrelargoge'];
        $estado_cuenta = $row['habilitada'];
        $id_empresa=$row['usuario_idusuario'];
        if ($estado_cuenta == "t") {
            $estado_true = "Activa";
            $cadena .= "<tr><td>$nombreEmpresa</td><td>$estado_true</td><td></td><td><a href= ../Controlador/ControladorDeshabilitarCuentasEmpresas.php?ge=$id_empresa>deshabilitar</a></td> </tr>";
        } else {
            $estado_false="Inactiva";
            $cadena .= "<tr><td>$nombreEmpresa</td><td>$estado_false</td><td><a href= ../Controlador/ControladorHabilitarCuentasEmpresas.php?ge=$id_empresa>habilitar</a></td><td></td></tr>";
        }
    }
    $cadena .= "</table>";
    fwrite($miarchivo, $cadena);
    fclose($miarchivo);
}
