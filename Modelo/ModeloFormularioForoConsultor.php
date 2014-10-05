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
    function insertarTemaConversacionForo($nombreConsultor,$temaC,$comentarioC,$candComentarios){
        $conec=new Conexion(); 
        $con=$conec->getConection();
        $sql = "INSERT INTO foro (autor, titulo, mensaje, cantidad_comentarios )";
        $sql.= "VALUES ('$nombreConsultor','$temaC','$comentarioC','$candComentarios')";
        pg_query($con,$sql) or die ("ERROR" .pg_last_error());

    //crear su archivo.data
        $codForo = retornarCodForo($nombreConsultor,$temaC,$comentarioC,$candComentarios);
        $miarchivo=fopen('../Vista/Otros/Comentarios/'.$codForo.'_'.$temaC.'.data','w');
        fclose($miarchivo);
    }
    function retornarCodForo($nombreConsultor,$temaC,$comentarioC,$candComentarios){
        $conexion = new Conexion();
        $con = $conexion->getConection();
        $sql="SELECT codforo FROM foro f WHERE f.autor='$nombreConsultor' AND f.titulo='$temaC' AND f.mensaje='$comentarioC' AND f.cantidad_comentarios='$candComentarios'";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $cod = $row->codforo;
        return $cod;
    } 
?>
