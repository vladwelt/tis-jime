<?php

require('../Controlador/Conexion.php');
    
    function insertarProyecto($codigo_proyecto, $nombre_proyecto, $fecha_fin_proyecto)
    {
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql = "INSERT INTO proyecto (codproyecto, nombreproyecto, fechafinproyecto, vigente)";
        $sql.= "VALUES ('$codigo_proyecto','$nombre_proyecto','$fecha_fin_proyecto','TRUE')";
        pg_query($con,$sql) or die ("ERROR " .pg_last_error());

    }
    function verificarSiExisteProyecto($codigo_proyecto, $nombre_proyecto, $fecha_fin_proyecto){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM proyecto p WHERE p.codproyecto='$codigo_proyecto' AND p.nombreproyecto='$nombre_proyecto' AND p.fechafinproyecto='$fecha_fin_proyecto'";
        $consulta=  pg_query($con,$sql);
        $estado = pg_fetch_object($consulta);
        return $estado;
    }
    function verificarSiExisteCodigoDelProyecto($codigo_proyecto){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT * FROM proyecto p WHERE p.codproyecto='$codigo_proyecto'";
        $consulta=  pg_query($con,$sql);
        $estado = pg_fetch_object($consulta);
        return $estado;
        
    }
?>
