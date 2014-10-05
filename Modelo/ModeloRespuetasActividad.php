<?php
require_once  '../Controlador/Conexion.php';

function mostrarRespuestas($idUsuario) {
    $res = "";
    
      
        $conec = new Conexion();
        $con = $conec->getConection();
        $divParcial = "";

        $sql1 = "  SELECT nombre, ruta_respuesta, titulo
                   FROM respuesta_actividad
                   where consultor_idconsultor='$idUsuario'";
        $resultado1 = pg_query($con, $sql1);

        if (!$resultado1) {
            echo "Ocurrio un error.\n";
        }
        while ($fila1 = pg_fetch_row($resultado1)) {
            $nombre_archivo = $fila1[0];
            $ruta_documento = $fila1[1];
            $titulo_documento = $fila1[2];

            $divParcial = $divParcial . "
                <div class='correcto' >
                        $titulo_documento<br>
                <a href='$ruta_documento' target='_blank'>$nombre_archivo</a><br>                                            
                </div>";
        }
        
        $res = $divParcial;
    
    return $res;
}
