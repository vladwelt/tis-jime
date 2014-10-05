<?php
require ('../Controlador/Conexion.php');
    function mostrarTema($codForo){
        // Conectar con la base de datos y seleccionarla
        $conec=new Conexion(); 
        $con=$conec->getConection(); 
        // Ejecutar la consulta SQL
        $sql="SELECT titulo,autor,mensaje FROM foro WHERE codforo='$codForo'";
        $result = pg_query($con,$sql);
        // Crear el array de elementos para la capa de la vista
        while  ($row = pg_fetch_object($result)){
            $retornar = "<l1><strong>".$row->autor."</strong></l1><br>";
            $retornar.="<l1><strong>".$row->titulo."</strong></l1><br>";
            $retornar.="<l1>".$row->mensaje."</l1>";
        }
        // Closing connection
        pg_close($con);
        return $retornar;
}
?>