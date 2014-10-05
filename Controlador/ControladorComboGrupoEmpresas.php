<?php
require ('../Controlador/Conexion.php');

obtenerGrupoEmpresas();

function obtenerGrupoEmpresas() {
    $conexion = new Conexion();
    $conexion->getConection();
    $sql = " select usuario_idusuario,nombrelargoge from usuario as u , grupo_empresa as ge where u.idusuario = ge.usuario_idusuario and habilitada = 't'" ;
    $rows = $conexion->ejecutarSql($sql);
    $caden="";
        $miarchivo=fopen('../Vista/Otros/grupos.data','w');
        fclose($miarchivo);
    for ($i = 0; $i < count($rows); $i++) {
        $row = $rows[$i];
        $id_usuario=$row['usuario_idusuario'];
        $nombre_grupo=$row['nombrelargoge'];
        $caden ="<option value=$id_usuario>$nombre_grupo</option>";
        $escribir =  fopen("../Vista/Otros/grupos.data", "a"); 
        fwrite($escribir,"$caden");
    }
    return $caden;
}
?>