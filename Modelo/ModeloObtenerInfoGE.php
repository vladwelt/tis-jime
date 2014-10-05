<?php
require_once '../Controlador/Conexion.php';
function obtenerInfo($usuarioCons) {
    $res;
        $conec = new Conexion();
        $con = $conec->getConection();
        $divParcial = "";
    $sql = "SELECT p.grupo_empresa_usuario_idusuario as uge ,ge.nombrelargoge
            FROM consultor_proyecto_grupo_empresa as p , grupo_empresa as ge, usuario as u
            where p.consultor_usuario_idusuario = '$usuarioCons' and u.idusuario = 
            ge.usuario_idusuario and u.idusuario = p.grupo_empresa_usuario_idusuario and habilitada = 'true'";

    $resultado = pg_query($con, $sql);

        if (!$resultado) {
            echo "Ocurrio un error.\n";
        }
        while ($fila = pg_fetch_row($resultado)) {
            $usuarioGE = $fila[0];
            $nombreGE = $fila[1];
           

            $divParcial = $divParcial ."<option value=$usuarioGE>$nombreGE</option>";
        }
        pg_close();
        $res = $divParcial;
        
        return $res;
}
