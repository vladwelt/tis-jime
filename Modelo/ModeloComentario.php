<?php 
require '../Controlador/Conexion.php';
function insertarComentarioForo($nombre, $comentario, $codigoForo, $candComentarios){
//qui el nombre de archivo
$cod =$codigoForo;
$cand = $candComentarios;
$tema = retornarNombreTemaForo($cod);
$leer = fopen("../Vista/Otros/Comentarios/".$cod."_".$tema.".data", "r"); 
$aleer = fread($leer ,filesize("../Vista/Otros/Comentarios/".$cod."_".$tema.".data")); 

$escribir =  fopen("../Vista/Otros/Comentarios/".$cod."_".$tema.".data","w"); 
fwrite($escribir,"<strong>$nombre</strong><br><p>$comentario</p><hr>$aleer"); 
fclose($escribir);

modificarCantidadComentarios($cand,$cod);
}
function retornarNombreTemaForo($cod){
    $conec=new Conexion(); 
    $con=$conec->getConection();
    
  $consulta = pg_query($con,"SELECT titulo FROM foro WHERE codforo='$cod';");
  $row = pg_fetch_object($consulta);
  $nombre = $row->titulo;
  return $nombre;
    
}
function modificarCantidadComentarios($cand,$cod){
    $conec=new Conexion(); 
    $con=$conec->getConection();
    $cand = $cand + 1;
     $sql = "UPDATE foro";
     $sql.= " SET cantidad_comentarios='$cand'";
     $sql.= "WHERE codforo ='$cod'";
     pg_query($con,$sql) or die ("ERROR" .pg_last_error());
}
?>