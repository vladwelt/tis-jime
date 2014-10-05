<?php

require ('../Controlador/Conexion.php');

function crear_tabla_admin_consultores() {
    $conexion = new Conexion();
    $conexion->getConection();
    $sql ="SELECT * FROM usuario as u , consultor as c WHERE u.idusuario=c.usuario_idusuario ";
    $rows= $conexion->ejecutarSql($sql);
    $miarchivo = fopen('../Vista/Otros/tablaConsultores.data', 'w');
    $cadena = "<table border=1><tr> <td>CONSULTOR</td> <td>ESTADO</td> <td> </td> <td> </td></tr> ";
    for ($i = 0; $i < count($rows); $i++) {
        $row = $rows[$i];
        $nombre_consultor = $row['nombreconsultor'];
        $estado_cuenta = $row['habilitada'];
        $id_consultor = $row['usuario_idusuario'];
        if ($estado_cuenta == 't') {
           $estado_true="Activa"; 
           $cadena .= "<tr><td>$nombre_consultor</td><td>$estado_true</td><td></td><td><a href= ../Controlador/ControladorDeshabilitarCuentasConsultores.php?cons=$id_consultor>Deshabilitar</a></td> </tr>"; 
        }else{
           $estado_false="Inactiva";
           $cadena .= "<tr><td>$nombre_consultor</td><td>$estado_false</td><td><a href= ../Controlador/ControladorHabilitarCuentasConsultores.php?cons=$id_consultor>Habilitar</a></td><td></td></tr>";
        }
        
    }
    $cadena .="</table>";
    fwrite($miarchivo, $cadena);
    fclose($miarchivo);
}

?>