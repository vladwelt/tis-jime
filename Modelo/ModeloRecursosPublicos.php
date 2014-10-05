<?php
require_once '../Controlador/Conexion.php';

function mostrarRecursos() {
    $res = "";
    

        $conec = new Conexion();
        $con = $conec->getConection();

        $sql = "SELECT codpublico, titulodocumento, descdocpublico, nombredocupublico, rutadocpublico
                       FROM documentospublicos
                       ORDER BY codpublico DESC";
        $resultado = pg_query($con, $sql);
        $divParcial =  "<div class='titulos'id='recursos' ><font size='5'>Recursos&nbsp&nbspPúblicos</font></div>";
        if (!$resultado) {
            echo "Ocurrio un error.\n";
        }
        while ($fila = pg_fetch_row($resultado)) {
            $nombre_documento = $fila[3];
            $descripcion_documento = $fila[2];
            $ruta_documento = $fila[4];
            $titulo_documento = $fila[1];

            $divParcial = $divParcial . "
                        <div  class='correcto'>
                        $titulo_documento<br>
                        $descripcion_documento<br>
                        <a href='$ruta_documento'>$nombre_documento</a>
                       
                        
                </div>";
        }
        pg_close();
        
       
        $res = $divParcial;
    
    return $res;
}
