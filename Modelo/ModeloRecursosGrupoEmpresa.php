<?php
require_once  '../Modelo/ModeloRecursosPublicos.php';
require_once  '../Controlador/Conexion.php';

function mostrarRecursosGE($idususario) {
    $res = "";
    
        
        $conec = new Conexion();
        $con = $conec->getConection();
        $divParcial = "";

        $sql1 = "SELECT idge_documento, grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario, 
                 nombredocumento, pathdocumentoge, titulo_gedocumento, descripciongedocumento
                 FROM ge_documento

                 where grupo_empresa_usuario_idusuario = '$idususario'
                 order by idge_documento desc";
        $resultado1 = pg_query($con, $sql1);

        if (!$resultado1) {
            echo "Ocurrio un error.\n";
        }
        while ($fila1 = pg_fetch_row($resultado1)) {
            $nombre_documento = $fila1[3];
            $descripcion_documento = $fila1[6];
            $ruta_documento = $fila1[4];
            $titulo_documento = $fila1[5];

            $divParcial = $divParcial . "
                        <div class='correcto' >
                        $titulo_documento<br>
                        $descripcion_documento<br>
                        <a href='$ruta_documento'>$nombre_documento</a><br>
                       
                        </table>
                </div>";
        }
        
        $res = $divParcial.mostrarRecursos();
    
    return $res;
}
