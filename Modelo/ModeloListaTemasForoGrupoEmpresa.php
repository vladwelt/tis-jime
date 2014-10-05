<?php
require ('../Controlador/Conexion.php');
     function retornarEstadoDeTablaForoGrupoEmpresa(){
        $conec = new Conexion(); 
        $con = $conec->getConection();
        $sql="SELECT * FROM foro";
        $result=  pg_query($con,$sql);
        $estado= pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
    function mostrarListaForoGrupoEmpresa($a,$u){
            $conec = new Conexion(); 
            $con = $conec->getConection();
            $sql = "SELECT codforo,titulo,autor,cantidad_comentarios  FROM foro";
            $result = pg_query($con,$sql);
            while ($row = pg_fetch_object($result)){
                $cod = $row->codforo;
                $titulo = $row->titulo;
                $autor = $row->autor;
                $cantidad = $row->cantidad_comentarios ;
                echo "<tr>"
                . "<td><a href = '../Vista/iu.ListaRespuestasForoGrupoEmpresa.php?a=$a&u=$u&c_f=$cod&candC=$cantidad&nomArchivo=$titulo'>$titulo</a></td>"
                        . "<td>$cantidad</td>"
                        . "<td>$autor</td>"
                        . "</tr>";
            }
            exit();
            pg_close($con);
    }
?>
