<?php
require '../Controlador/Conexion.php';
    function retornarNombreDelaGrupoEmpresa($a, $u){
        $conec = new Conexion();
        $con = $conec->getConection();
        $sql="SELECT nombrelargoge FROM grupo_empresa g WHERE g.codgrupo_empresa='$a' AND g.usuario_idusuario='$u'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $nombre = $row->nombrelargoge;
        return $nombre;
    }
    function insertarComentarioForo($nombreGE, $comentario, $codForo, $candComentarios){
        $cand = $candComentarios;
        $tema = retornarNombreTemaForo($codForo);
        $leer = fopen("../Vista/Otros/Comentarios/".$codForo."_".$tema.".data", "r"); 
        $aleer = fread($leer ,filesize("../Vista/Otros/Comentarios/".$codForo."_".$tema.".data")); 
        $escribir =  fopen("../Vista/Otros/Comentarios/".$codForo."_".$tema.".data","w"); 
        fwrite($escribir,"<strong>$nombreGE</strong><br><p>$comentario</p><hr>$aleer"); 
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
