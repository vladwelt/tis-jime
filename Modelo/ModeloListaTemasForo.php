

<?php
 require ('../Controlador/Conexion.php');
     function retornarEstadoDeTablaForo(){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM foro";
        $result=  pg_query($con,$sql);
        $estado= pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
    function mostrarListaForo(){
        // Conectar con la base de datos y seleccionarla
            $conec=new Conexion(); 
            $con=$conec->getConection();  
            // Ejecutar la consulta SQL
        $result = pg_query($con,'SELECT codforo,titulo,autor,cantidad_comentarios  FROM foro');
        while ($row = pg_fetch_object($result)){
                $cod = $row->codforo;
                $t = $row->titulo;
                $a = $row->autor;
                $cantidad = $row->cantidad_comentarios ;
                echo "<tr>"
                . "<td><a href = '../Vista/ListaRespuestasForo.php?codforo=$cod&candC=$cantidad&nomArchivo=$t'>$t</a></td>"
                        . "<td>$cantidad</td>"
                        . "<td>$a</td>"
                        . "</tr>";
            }
            exit();
            pg_close($con);
    }
?>
