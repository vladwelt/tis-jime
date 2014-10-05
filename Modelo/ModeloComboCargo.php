<?php

require '../Controlador/Conexion.php';
function existeRepresentate($idGrupoempresa)
{
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql = "SELECT idsocio
            FROM socio
            WHERE grupo_empresa_codgrupo_empresa='$idGrupoempresa' and tipo_socio_codtipo_socio=1";
    
    $result = pg_query($con,$sql);
    $rows = pg_num_rows($result);
    if($rows==0)
    {   
        echo "<option value='1'>Representante legal</option>";
    }
 else {
        echo "";    
    }
    
}
?>
