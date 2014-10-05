<?php
require '../Controlador/Conexion.php';
    function retornarNombreDelaGrupoEmpresa($a,$u){
        $conec = new Conexion();
        $con=$conec->getConection();
        $sql="SELECT nombrelargoge FROM grupo_empresa g WHERE g.codgrupo_empresa='$a' AND g.usuario_idusuario='$u'";
        $result = pg_query($con,$sql);
        $row = pg_fetch_object($result);
        $nombre = $row->nombrelargoge;
        return $nombre;
    }
    function insertarForoGE($nombreGE, $temaGE, $comentarioGE, $candComentarios){
        $conec = new Conexion();
        $con=$conec->getConection();
        $sql = "INSERT INTO foro (autor, titulo, mensaje, cantidad_comentarios )";
        $sql.= "VALUES ('$nombreGE','$temaGE','$comentarioGE','$candComentarios')";
        pg_query($con,$sql) or die ("ERROR :( " .pg_last_error());

        //crear su archivo.data
        $codForo = retornarCodForo($nombreGE, $temaGE, $comentarioGE, $candComentarios);
        $miarchivo=fopen('../Vista/Otros/Comentarios/'.$codForo.'_'.$temaGE.'.data','w');
        fclose($miarchivo);
    }
    function retornarCodForo($nombreGE, $temaGE, $comentarioGE, $candComentarios){
        $conec = new Conexion();
        $con = $conec->getConection();
        $sql = "SELECT codforo FROM foro f WHERE f.autor='$nombreGE' AND f.titulo='$temaGE' AND f.mensaje='$comentarioGE' AND f.cantidad_comentarios='$candComentarios';";
        $consulta = pg_query($con,$sql);
        $row = pg_fetch_object($consulta);
        $cod = $row->codforo;
        return $cod;
    }
?>
