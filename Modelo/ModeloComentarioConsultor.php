<?php
require '../Controlador/Conexion.php';
    function retornarNombreDelConsultor($a, $u){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql="SELECT nombreconsultor FROM consultor c WHERE c.idconsultor='$a' AND c.usuario_idusuario='$u'";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $nombre = $row->nombreconsultor;
        return $nombre;
    }
    function insertarComentarioForo($nombreConsultor, $comentario, $codForo, $candComentarios){
        $cand = $candComentarios;
        $tema = retornarNombreTemaForo($codForo);
        $leer = fopen("../Vista/Otros/Comentarios/".$codForo."_".$tema.".data", "r"); 
        $aleer = fread($leer ,filesize("../Vista/Otros/Comentarios/".$codForo."_".$tema.".data")); 
        $escribir =  fopen("../Vista/Otros/Comentarios/".$codForo."_".$tema.".data","w"); 
        fwrite($escribir,"<strong>$nombreConsultor</strong><br><p>$comentario</p><hr>$aleer"); 
        fclose($escribir);
        modificarCantidadComentarios($cand,$codForo);
    }
    function retornarNombreTemaForo($codForo){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $consulta = pg_query($con,"SELECT titulo FROM foro WHERE codforo='$codForo';");
        $row = pg_fetch_object($consulta);
        $nombre = $row->titulo;
        return $nombre;
    }
    function modificarCantidadComentarios($cand,$codForo){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $cand = $cand + 1;
        $sql = "UPDATE foro";
        $sql.= " SET cantidad_comentarios='$cand'";
        $sql.= "WHERE codforo ='$codForo'";
        pg_query($con,$sql) or die ("ERROR" .pg_last_error());
    }
    
?>